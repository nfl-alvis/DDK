<?php
session_start();
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    header("Location: login.php?error=invalid");
    exit;
}

$u   = $conn->real_escape_string($username);
$sql = "SELECT * FROM users WHERE username = '$u' LIMIT 1";
$res = $conn->query($sql);

if ($res && $res->num_rows === 1) {
    $user = $res->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id']      = $user['id'];
        $_SESSION['username']     = $user['username'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        $_SESSION['role']         = $user['role'];

        // Admin → halaman kelola, User → halaman baca
        header($user['role'] === 'admin'
            ? "Location: tampil.php"
            : "Location: tampil_user.php");
        exit;
    }
}

header("Location: login.php?error=invalid");
exit;