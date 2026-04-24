<?php
require_once "auth.php";
require_once "koneksi.php";

if (isset($_SESSION['username'], $_SESSION['level'])) {
    redirect_to_dashboard();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: register.php");
    exit();
}

$username = trim($_POST['username'] ?? "");
$password = $_POST['password'] ?? "";
$konfirmasi_password = $_POST['konfirmasi_password'] ?? "";
$level = $_POST['level'] ?? "";

if ($username === "" || $password === "" || $konfirmasi_password === "" || $level === "") {
    header("Location: register.php?pesan=register-kosong");
    exit();
}

if (!in_array($level, ["admin", "user"], true)) {
    header("Location: register.php?pesan=level-tidak-valid");
    exit();
}

if ($password !== $konfirmasi_password) {
    header("Location: register.php?pesan=password-tidak-sama");
    exit();
}

$cek_user = mysqli_prepare($koneksi, "SELECT username FROM tb_user WHERE username = ?");
mysqli_stmt_bind_param($cek_user, "s", $username);
mysqli_stmt_execute($cek_user);
$hasil_cek = mysqli_stmt_get_result($cek_user);

if ($hasil_cek && mysqli_num_rows($hasil_cek) > 0) {
    mysqli_stmt_close($cek_user);
    header("Location: register.php?pesan=username-sudah-ada");
    exit();
}

mysqli_stmt_close($cek_user);

$password_hash = password_hash($password, PASSWORD_DEFAULT);
$simpan_user = mysqli_prepare($koneksi, "INSERT INTO tb_user (username, password, level) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($simpan_user, "sss", $username, $password_hash, $level);
$berhasil = mysqli_stmt_execute($simpan_user);
mysqli_stmt_close($simpan_user);

if (!$berhasil) {
    header("Location: register.php?pesan=gagal-simpan-user");
    exit();
}

header("Location: login.php?pesan=registrasi-berhasil");
exit();
