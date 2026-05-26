<?php
require_once "../auth.php";
require_once "../koneksi.php";

require_admin();

$nama_lengkap = trim($_POST['nama_lengkap'] ?? '');
$username = trim($_POST['username'] ?? '');
$role = $_POST['role'] ?? '';
$password = $_POST['password'] ?? '';

if ($nama_lengkap === '' || $username === '' || $role === '' || $password === '') {
    set_flash('warning', 'Semua data user harus diisi.');
    header("Location: ../index.php?page=user_form&aksi=tambah");
    exit;
}

if (!in_array($role, ['admin', 'user'], true)) {
    set_flash('danger', 'Role user tidak valid.');
    header("Location: ../index.php?page=user");
    exit;
}

$cek = $conn->prepare("SELECT id FROM users WHERE username = ? LIMIT 1");
$cek->bind_param("s", $username);
$cek->execute();
$exists = $cek->get_result();
$has_user = $exists && $exists->num_rows > 0;
$cek->close();

if ($has_user) {
    set_flash('danger', 'Username sudah digunakan.');
    header("Location: ../index.php?page=user_form&aksi=tambah");
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (username, nama_lengkap, password, role) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $nama_lengkap, $hash, $role);

if ($stmt->execute()) {
    set_flash('success', 'Data user berhasil ditambahkan.');
} else {
    set_flash('danger', 'Gagal menambahkan data user.');
}

$stmt->close();
header("Location: ../index.php?page=user");
exit;
