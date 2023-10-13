<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location:index.php?msg=Login First&color=red");
}
$user = $_SESSION['user'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $user['first_name']." ".$user['last_name'] ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="js/ajax.js"></script>
</head>
<body class="dashboard_page">
<div class="dashboard">
        <div class="sidebar">
                <h3>My Mail</h3>
            <button onclick="compose()" class="sidebar-button active"><i class="fas fa-envelope"></i> Compose</button>
            <button onclick="inbox()"   class="sidebar-button"><i class="fas fa-inbox"></i> Inbox</button>
            <button onclick="sent()"    class="sidebar-button"><i class="fas fa-paper-plane"></i> Sent</button>
            <button onclick="draft()"   class="sidebar-button"><i class="fas fa-file-alt"></i> Draft</button>
            <button onclick="trash()"   class="sidebar-button"><i class="fas fa-trash"></i> Trash</button>
        </div>
        <div class="content">
            <header class="dashboard-header">
                <span>Welcome, <?php echo $user['first_name']." ".$user['last_name'] ?> </span>
               <a href="logout.php"><button class="logout-button"> <i class="fas fa-sign-out-alt"></i></button></a>
            </header>
            <div class="content-area" id="content_area">
                <p id="content-welcome-heading"> My Mail</p>
                <p id="content-welcome-line">Your personal mail solution for efficient communication.</p>

            </div>
        </div>
    </div>
</body>
</html>