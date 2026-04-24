<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function redirect_to_dashboard(): void
{
    if (!isset($_SESSION['level'])) {
        header("Location: login.php");
        exit();
    }

    if ($_SESSION['level'] === "admin") {
        header("Location: edit_siswa.php");
        exit();
    }

    if ($_SESSION['level'] === "user") {
        header("Location: user.php");
        exit();
    }

    session_unset();
    session_destroy();
    header("Location: login.php?pesan=level-tidak-valid");
    exit();
}

function require_login(): void
{
    if (!isset($_SESSION['username'], $_SESSION['level'])) {
        header("Location: login.php?pesan=harus-login");
        exit();
    }
}

function require_level(string $level): void
{
    require_login();

    if ($_SESSION['level'] !== $level) {
        redirect_to_dashboard();
    }
}
