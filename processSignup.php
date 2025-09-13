<?php
    session_start();
    require_once 'config.php';

    if(isset($_POST['username'])) {
        $username = trim($_POST['username']);
    } else {
        header("Location: signup.php?error=missing_username");
        $msg = "Username is required.";
        exit;
    }

    if(isset($_POST['password'])) {
        $password = trim($_POST['password']);
    } else {
        header("Location: signup.php?error=missing_password");
        $msg = "Password is required.";
        exit;
    }

    if(isset($_POST['email'])) {
        $email = trim($_POST['email']);
    } else {
        header("Location: signup.php?error=missing_email");
        $msg = "Email is required.";
        exit;
    }

    if(isset($_POST['confirm_password'])) {
        $confirm = trim($_POST['confirm_password']);
    } else {
        header("Location: signup.php?error=confirm_password");
        $msg = "password not confirmed.";
        exit;
    }

    if ($password !== $confirm) {
        header('Location: signup.php?error=passwords+do+not+match');
        $msg = "Passwords do not match.";
        exit;
    }

    $check = mysqli_query($conn, "SELECT userId FROM users WHERE username='$username' OR email='$email' ");
    if(mysqli_num_rows($check) > 0) {
        header('Location: signup.php?error=username+or+email+already+exists');
        $msg = "Username or email already exists.";
        exit;
    }

    $q = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if(mysqli_query($conn, $q)) {
        header('Location: login.php?msg=registration+successful');
        $msg = "Registration successful. You can now log in.";
        exit;
    } else {
        header('Location: signup.php?error=registration+failed');
        $msg = "Registration failed. Please try again.";
        exit;
    }
?>