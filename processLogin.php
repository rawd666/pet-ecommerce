<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$user = trim($_POST['username'] ?? '');
$pass = trim($_POST['password'] ?? '');

$q = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
$result = mysqli_query($conn, $q);

$user = mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['user_id'] = $user['userId'];
    $_SESSION['username'] = $user;
    header('Location: index.php'); 
    exit;
} else {
    header('Location: login.php?error=invalid+email+or+password');
    exit;
}
?>