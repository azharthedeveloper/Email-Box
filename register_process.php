<?php
require 'database/database_class.php';
require 'database/database_settings.php';

$obj = new database($hostname,$username,$password,$database);

if (isset($_POST['action']) && $_POST['action'] == 'check_email') {
    
    $email  = $_POST['email'];
    $query  = "SELECT * FROM users WHERE email = '{$email}'";
    $result = $obj->query_exec($query);
    if ($result->num_rows > 0) {
        echo "Email Already Exists";
    }else{

    }
}

elseif (isset($_POST['register'])) {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    extract($_POST);
    $query  = "INSERT INTO users(first_name,last_name,email,password)
        VALUES('{$first_name}','{$last_name}','{$email}','{$password}')";
    $result = $obj->query_exec($query);
    if ($result) {
        $msg = "Account Created Now Login";
        header("Location:index.php?msg=$msg&color=#2cc");
    } 

}


?>