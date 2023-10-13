<?php
session_start();


$user = $_SESSION['user'];

require 'database/database_class.php';
require 'database/database_settings.php';




/*====  COMPOSE FORM  =====*/

if (isset($_POST['action']) && $_POST['action'] == 'compose') {
    ?>
    <h1 class="content-heading">Compose</h1>
    <p style="text-align: center;color:green" id="msg"></p>
    <input class="compose_fields" type="text" id="to" name="to" placeholder="To"><br>
    <input class="compose_fields" type="text" id="subject" name="subject" placeholder="Subject"><br>
    <input class="compose_fields" type="text" id="cc" name="cc" placeholder="Cc"><br>
    <textarea class="compose_fields" id="message" name="message" rows="6" placeholder="Message"></textarea><br>
    <button class="btn-draft" type="submit" onclick="send_draft()" id="draft"><i class="fas fa-save"></i> Draft</button>
    <button class="btn-compose" type="submit" onclick="send_email()" id="send">Send <i class="fas fa-paper-plane"></i></button>
    <?php
}

/*====  SENDING EMAIL  =====*/

elseif(isset($_POST['action']) && $_POST['action'] == 'send_email'){
  
    $obj = new database($hostname,$username,$password,$database);

    
    $ccjson  = $_POST['ccjson'];
    $ccarray = json_decode($ccjson); 
    if ($ccarray !== [""]) {
            foreach ($ccarray as $key => $cc_email) {
                
            $query = "SELECT * FROM users WHERE email='{$cc_email}'";
            $result = $obj->query_exec($query);
            $cc = mysqli_fetch_assoc($result);
         
            $query  = "INSERT INTO emails(sender_id,email_subject,email_cc,email_message,sender_status,receiver_status,receiver_id)
                      VALUE ('{$user['user_id']}','{$_POST['subject']}','{$cc_email}','{$_POST['message']}','sent','inbox','{$cc['user_id']}')";
            $result = $obj->query_exec($query);
                   
        }
    }

    $query = "SELECT * FROM users WHERE email='{$_POST['to']}'";
    $result = $obj->query_exec($query);
    $to = mysqli_fetch_assoc($result);

    $query = "INSERT INTO emails(sender_id,email_to,email_subject,email_message,sender_status,receiver_status,receiver_id)
              VALUE ('{$user['user_id']}','{$_POST['to']}','{$_POST['subject']}','{$_POST['message']}','sent','inbox','{$to['user_id']}')";
    $result = $obj->query_exec($query);
    echo "Email Sended Successfully";
            

}

/*====  SENDING EMAIL TO DRAFT  =====*/

elseif (isset($_POST['action']) && $_POST['action'] == 'send_draft') {

    $obj = new database($hostname,$username,$password,$database);

    if ($_POST['cc'] != "") {
        $query = "SELECT * FROM users WHERE email='{$_POST['cc']}'";
        $result = $obj->query_exec($query);
        $cc = mysqli_fetch_assoc($result);
        // print_r($cc);
          $query = "INSERT INTO emails(sender_id,email_subject,email_cc,email_message,sender_status,receiver_id)
                  VALUE ('{$user['user_id']}','{$_POST['subject']}','{$_POST['cc']}','{$_POST['message']}','draft','{$cc['user_id']}')";
        $result = $obj->query_exec($query);
       
    }

    $query  = "SELECT * FROM users WHERE email='{$_POST['to']}'";
    $result = $obj->query_exec($query);
    $to     = mysqli_fetch_assoc($result);
    $query  = "INSERT INTO emails(sender_id,email_subject,email_message,sender_status,receiver_id)
              VALUE ('{$user['user_id']}','{$_POST['subject']}','{$_POST['message']}','draft','{$to['user_id']}')";
    $result = $obj->query_exec($query);
   
    echo "Email Sended to Draft";
}


/*====  GETTING INBOX EMAIL'S  =====*/

elseif (isset($_POST['action']) && $_POST['action'] == 'inbox') {
    ?>
    <h1 class="content-heading">Inbox</h1>
    <button class="inbox_delete" onclick="send_trash_inbox()" type="submit" id="draft">Delete</button>
    <p style="text-align: center;color:green" id="msg"></p>
    <?php
    $obj = new database($hostname,$username,$password,$database);
    $query = "SELECT * FROM emails e ,users u WHERE  e.sender_id = u.user_id AND e.receiver_status = 'inbox' AND e.receiver_id = '{$user['user_id']}' ";
    $result = $obj->query_exec($query);
    if ($result->num_rows > 0) {
        ?>
        <!-- <table class="record">
            <tr>
                <th>Check</th>
                <th>Sender</th>
                <th>Subject</th>
                <th>Message</th>
            </tr> -->
            <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <p id="emails">
                <input type="checkbox" id="inbox_email" name="email_id" value="<?php echo $row['email_id'] ?>">
                <span id="emailer"><?php echo $row['first_name']." ".$row['last_name']; ?></span>
                <span id="email_subject"><?php echo $row['email_subject'] ?></span>
                <span id="email_body">- <?php echo $row['email_message'] ?></span>
                </p>
            
            <?php
        }
        ?>
        <!-- </table> -->
        <?php
    }else{
        echo " NO EMAIL";
    }
}

/*====  GETTING SENT EMAIL'S  =====*/

elseif (isset($_POST['action']) && $_POST['action'] == 'sent') {
    ?>
    <h1 class="content-heading">Sent</h1>
    <button class="inbox_delete" onclick="send_trash_sent()" type="submit" id="draft">Delete</button>
    <p style="text-align: center;color:green" id="msg"></p>
    <?php
    $obj = new database($hostname,$username,$password,$database);
    $query = "SELECT * FROM emails e ,users u WHERE  e.receiver_id = u.user_id AND e.sender_status = 'sent' AND e.sender_id = '{$user['user_id']}'";
    $result = $obj->query_exec($query);
    if ($result->num_rows > 0) {
        ?>
        <table class="record">
            <tr>
                <th>Check</th>
                <th>Sended to</th>
                <th>Subject</th>
                <th>Message</th>
            </tr>
            <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><input type="checkbox" name="email_id" value="<?php echo $row['email_id'] ?>"></td>
                <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                <td><?php echo $row['email_subject'] ?></td>
                <td><?php echo $row['email_message'] ?> </td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
    }else{
        echo " NO EMAIL";
    }
}

/*====  GETTING DRAFT EMAIL'S  =====*/

elseif (isset($_POST['action']) && $_POST['action'] == 'draft') {
    ?>
    <h1 class="content-heading">Draft</h1>
    <button class="inbox_delete" onclick="send_trash_draft()" type="submit" id="draft">Delete</button>
    <p style="text-align: center;color:green" id="msg"></p>
    <?php
    $obj = new database($hostname,$username,$password,$database);
    $query = "SELECT * FROM emails e,users u WHERE e.receiver_id = u.user_id AND e.sender_status = 'draft' AND e.sender_id = '{$user['user_id']}'";
    $result = $obj->query_exec($query);
    if ($result->num_rows > 0) {
        ?>
        <table class="record">
            <tr>
                <th>Check</th>
                <th>Name</th>
                <th>Subject</th>
                <th>Message</th>
            </tr>
            <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><input type="checkbox" name="email_id" value="<?php echo $row['email_id'] ?>"></td>
                <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                <td><?php echo $row['email_subject'] ?></td>
                <td><?php echo $row['email_message'] ?> </td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
    }else{
        echo " No Email In Draft";
    }
}

/*====  GETTING TRASH EMAIL'S  =====*/

elseif (isset($_POST['action']) && $_POST['action'] == 'trash') {
    ?>
    <h1 class="content-heading">Trash</h1>
    <button onclick="trash_remove()" class="inbox_delete" type="submit">Delete</button>
    <p style="text-align: center;color:green" id="msg"></p>
    <?php
    $obj = new database($hostname,$username,$password,$database);
    $query = "SELECT * FROM users u,emails e 
            WHERE e.receiver_id = u.user_id AND sender_status = 'trash' AND e.sender_id = '{$user['user_id']}' 
            OR e.sender_id = u.user_id AND receiver_status = 'trash' AND e.receiver_id = '{$user['user_id']}'";
    $result = $obj->query_exec($query);
    if ($result->num_rows > 0) {
        ?>
        <table class="record">
            <tr>
                <th>Check</th>
                <th>Name</th>
                <th>Subject</th>
                <th>Message</th>
            </tr>
            <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><input type="checkbox" name="email_id" value="<?php echo $row['email_id'] ?>"></td>
                <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                <td><?php echo $row['email_subject'] ?></td>
                <td><?php echo $row['email_message'] ?> </td>
            </tr>
            <?php
        }
        ?>
        </table>

        <?php   
    }else{
        echo " No Email In Trash";
    }
}


/*====  SENDING INBOX EMAIL'S TO TRASH  =====*/

elseif (isset($_POST['action']) && $_POST['action'] == 'send_trash_inbox') {

    $obj    = new database($hostname,$username,$password,$database);

    $query  = "UPDATE emails SET receiver_status = 'trash' WHERE email_id = '{$_POST['email_id']}' ";
    $result = $obj->query_exec($query);
    if ($result) {
        echo "Email Sended to Trash";
    }

}

/*====  SENDING SENT EMAIL'S TO TRASH  =====*/

elseif (isset($_POST['action']) && $_POST['action'] == 'send_trash_sent') {
 
    $obj    = new database($hostname,$username,$password,$database);

    $query  = "UPDATE emails SET sender_status = 'trash' WHERE email_id = '{$_POST['email_id']}' ";
    $result = $obj->query_exec($query);
    if ($result) {
        echo "Email Sended to Trash";
    }

}

/*====  SENDING DRAFT EMAIL'S TO TRASH  =====*/

elseif (isset($_POST['action']) && $_POST['action'] == 'send_trash_draft') {

    $obj    = new database($hostname,$username,$password,$database);

    $query  = "UPDATE emails SET sender_status = 'trash' WHERE email_id = '{$_POST['email_id']}' ";
    $result = $obj->query_exec($query);
    if ($result) {
        echo "Email Sended to Trash";
    }
}

/*====  REMOVEING FROM TRASH  =====*/

elseif(isset($_POST['action']) && $_POST['action'] == 'trash_remove'){

    $obj   = new database($hostname,$username,$password,$database);

    $query  = "SELECT * FROM emails WHERE email_id = '{$_POST['email_id']}'";
    $result = $obj->query_exec($query);
    $record = mysqli_fetch_assoc($result);
    
    if ($record['sender_status'] == 'trash') {
        $query  = "UPDATE emails SET sender_status = 'delete' WHERE email_id='{$record['email_id']}'";
        $result = $obj->query_exec($query);
        if ($result) {
            echo "Email Deleted";
        }

    }else{
        if ($record['receiver_status'] == 'trash') {
            $query  = "UPDATE emails SET receiver_status = 'delete' WHERE email_id='{$record['email_id']}'";
            $result = $obj->query_exec($query);
            if ($result) {
                echo "Email Deleted";
            }
        }
    }
}

?>