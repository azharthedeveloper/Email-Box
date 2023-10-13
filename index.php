<?php
session_start();

if (isset($_SESSION['user'])) {
    header("location:dashboard.php");
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

    <h2 class="login-heading">My Mail</h2>
    <?php
    if (isset($_GET['msg'])) {
        ?>
        <p id="msg" style="color: <?php echo $_GET['color'] ?>;"><?php echo $_GET['msg'] ?></p>
        <?php
    }
    ?>
    <form action="login_process.php" method="POST">
        <input type="email" name="email" placeholder="Email">
        <input type="password"name="password" placeholder="Password">
        <input type="submit" name="login" value="Login">
    </form>
    <a href="register.php" style="text-decoration: none; color:#2cc">Create Account?</a>
    </div>
</body>
<script>
    setInterval(function() {
    document.getElementById('msg').innerHTML = "";
}, 3000);

</script>
</html>
 