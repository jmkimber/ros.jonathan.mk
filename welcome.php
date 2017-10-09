<link rel="stylesheet" href="login.css">

<?php
    session_start();
?>

<div class="body content">
    <div class="welcome">
        <div class="alert alert-success"><?= $_SESSION['message'] ?></div>
        Welcome <span class="user"><?= $_SESSION['username'] ?></span>
    </div>
</div>