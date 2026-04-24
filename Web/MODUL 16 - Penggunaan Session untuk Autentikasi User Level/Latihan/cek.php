<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($level_akses)) {
    if ($_SESSION['level'] != $level_akses) {
        echo "Akses ditolak!";
        exit();
    }
}
