<?php
if (session_status() === PHP_SESSION_NONE) session_start();

function require_login()
{
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php?error=unauthorized");
        exit;
    }
}

function require_admin()
{
    require_login();
    if ($_SESSION['role'] !== 'admin') {
        header("Location: login.php?error=forbidden");
        exit;
    }
}

function is_admin(): bool
{
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}
