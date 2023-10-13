<?php
session_start();

if (isset($_SESSION['user'])) {
    header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Mail</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body class="login_page">
<div class="login-container">

    <h2 class="login-heading">Create Account</h2>
    <p id="msg"></p>

    <?php
    if (isset($_GET['msg'])) {
        ?>
        <p style="color: <?php echo $_GET['color'] ?>;"><?php echo $_GET['msg'] ?></p>
        <?php
    }
    ?>
    <form action="register_process.php" method="POST">
        <input type="text" name="first_name" placeholder="First Name">
        <input type="text" name="last_name" placeholder="Last Name">
        <input onblur="checkemail()" type="text" id="email" name="email" placeholder="Email">
        <input type="password"name="password" placeholder="Password">
        <input id="sign_up" type="submit" name="register" value="Sign Up">
    </form>
    <span style="color:#ccc">Already have an account </span>  <a href="index.php" style="text-decoration: none; color:#2cc">Sign In?</a>
    </div>
</body>
<script>
    /*====  SETTING MESSAGE INTERVAL  =====*/

setInterval(function() {
    msg("");
}, 2000);

/*====  MESSAGE FUNCTION  =====*/

function msg(obj){
    document.getElementById('msg').innerHTML = obj;
}

    function checkemail(){
        var email = document.getElementById('email').value;
        // console.log(email);
        var obj;
        if (window.XMLHttpRequest) {
            obj = new XMLHttpRequest();
        } else {
            obj = new ActiveXObject('Microsoft.XMLHTTP');
        }
        obj.onreadystatechange = function(){
            if (obj.status == 200 && obj.readyState == 4) {
                if (obj.responseText) {
                    document.getElementById('msg').style.color = 'red';
                    msg(obj.responseText);
                    document.getElementById('sign_up').style.color       = 'red';
                    document.getElementById('sign_up').style.borderColor = 'red';
                    document.getElementById('sign_up').disabled          = true;
                    
                }else{
                    document.getElementById('sign_up').disabled          = false;
                    document.getElementById('sign_up').style.color       = '#2cc';
                    document.getElementById('sign_up').style.borderColor = '#2cc';
                    document.getElementById('sign_up').style.hoverColor  = '#2cc';
                }

            }
        }
        obj.open("POST","register_process.php");
        obj.setRequestHeader('content-type','application/x-www-form-urlencoded');
        obj.send("action=check_email&email="+email);
    }

</script>
</html>
 