<?php

session_start();

if (isset($_POST['login'])) {
    $user = isset($_POST['username']) ? trim($_POST['username']) : "";
    $pass = isset($_POST['password']) ? trim($_POST['password']) : "";
} else {
    header("Location: login.html");
    exit();
}

if ($user == "alvis" && $pass == "123") {
    $_SESSION['username'] = $user;
    header("Location: Form_Ekskul.html");
    exit();
} else {
    header("Location: login.html?error=1");
    exit();
}
