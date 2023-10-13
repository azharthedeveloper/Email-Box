<?php
session_start();
require 'database/database_class.php';
require 'database/database_settings.php';

if (isset($_POST['login'])) {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    $checking = new database($hostname,$username,$password,$database);
    $query    = "SELECT * FROM users WHERE email = '{$_POST['email']}' AND  password = '{$_POST['password']}'";
    $result   = $checking->query_exec($query);
    print_r($result);
    if ($result->num_rows > 0) {
    $row      = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $row;
        header("location:dashboard.php");
    }else{
        $msg = "Invalid Email or Password";
        header("location:index.php?msg=$msg&color=#ac0000");
    }
}

?>