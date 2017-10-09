<?php

    require_once('config/db.php');
    session_start();
    $_SESSION['message'] = '';
    
    // make database connection
    $mysqli = new mysqli("$db_hostname", "$db_username", "$db_password", "$db_name");
    //$mysqli = new mysqli('localhost', 'root', '123smileql123', 'ros_accounts');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //two passwords are matching
        if ($_POST['password'] == $_POST['confirmpassword']) {

            $username = $mysqli->real_escape_string($_POST['username']);
            $email = $mysqli->real_escape_string($_POST['email']);
            $password = md5($_POST['password']); //md5 hash password for security
            //$avatar_path = $mysqli->real_escape_string('image/'.$_FILES['avatar']['name']);

            // make sure file type is image
            // if (preg_match("!image!", $_FILES['avatar']['type'])) {
            //  //copy image to images/ folder
            //  if (copy($_FILES['avatar']['tmp_name'], $avatar_path)) {
            //
            //  }
            // }


            $_SESSION['username'] = $username;

            $sql = "INSERT INTO users (username, email, password) "
                    . "VALUES ('$username', '$email', '$password')";

            //if the query is successful, redirect to welcome.php
            if ($mysqli->query($sql) === true) {
                $_SESSION['message'] = "Registration successful! Added $username to database!";
                header("location: welcome.php");
            }

            else {
                $_SESSION['message'] = 'User could not be added to the database!';
            }

        }
        else {
            $_SESSION['message'] = 'Two passwords do not match!';
        }

    }

?>

<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="login.css" type="text/css">
<div class="body-content">
    <div class="module">
        <h1>Create an account</h1>
        <form class="form" action="login.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
            <input type="text" placeholder="User Name" name="username" required>
            <input type="email" placeholder="Email" name="email" required>
            <input type="password" placeholder="Password" name="password" autocomplete="new-password" required>
            <input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required>
            <!-- <div class="avatar"><label>Select your avatar: </label><input type="file" name="avatar" accept="image/*" required></div> -->
            <input type="submit" value="Register" name="register" class="btn btn-block btn-primary">
        </form>
    </div>
</div>