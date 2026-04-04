<?php

session_start();

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
}

if ($user == "alvis" && $pass == "123") {
    $_SESSION['username'] = $user;
    header("Location: Form_Ekskul.php");
    exit();
} else {
    header("Location: login.php?error=1");
    exit();
}
