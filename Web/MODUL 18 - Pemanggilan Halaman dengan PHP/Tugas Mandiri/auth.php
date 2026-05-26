<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function is_logged_in(): bool
{
    return isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['role']);
}

function is_admin(): bool
{
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function redirect_dashboard(): void
{
    header("Location: index.php?page=dashboard");
    exit;
}

function require_login(): void
{
    if (!is_logged_in()) {
        header("Location: login.php?pesan=harus-login");
        exit;
    }
}

function require_admin(): void
{
    require_login();

    if (!is_admin()) {
        header("Location: index.php?page=forbidden");
        exit;
    }
}

function flash_message(): array
{
    $pesan = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);

    if (!is_array($pesan)) {
        return [];
    }

    return $pesan;
}

function set_flash(string $type, string $message): void
{
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message,
    ];
}
