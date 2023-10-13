<?php
session_start();



session_destroy();
$msg = "Logged Out";
header("location:index.php?msg=$msg&color=green");



?>