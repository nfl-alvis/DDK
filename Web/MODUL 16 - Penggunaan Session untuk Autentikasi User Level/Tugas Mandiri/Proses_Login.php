<?php
require_once "auth.php";
require_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit();
}

$username = trim($_POST['username'] ?? "");
$password = $_POST['password'] ?? "";

if ($username === "" || $password === "") {
    header("Location: login.php?pesan=data-login-kosong");
    exit();
}

$stmt = mysqli_prepare($koneksi, "SELECT username, password, level FROM tb_user WHERE username = ?");
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = $result ? mysqli_fetch_assoc($result) : null;
mysqli_stmt_close($stmt);

if (!$data || !password_verify($password, $data['password'])) {
    header("Location: login.php?pesan=login-gagal");
    exit();
}

session_regenerate_id(true);
$_SESSION['username'] = $data['username'];
$_SESSION['level'] = $data['level'];

redirect_to_dashboard();
