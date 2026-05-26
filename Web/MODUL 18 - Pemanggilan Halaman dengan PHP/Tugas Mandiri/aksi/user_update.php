<?php
require_once "../auth.php";
require_once "../koneksi.php";

require_admin();

$id = (int) ($_POST['id'] ?? 0);
$nama_lengkap = trim($_POST['nama_lengkap'] ?? '');
$username = trim($_POST['username'] ?? '');
$role = $_POST['role'] ?? '';
$password = $_POST['password'] ?? '';

if ($id <= 0 || $nama_lengkap === '' || $username === '' || $role === '') {
    set_flash('warning', 'Data user belum lengkap.');
    header("Location: ../index.php?page=user");
    exit;
}

if (!in_array($role, ['admin', 'user'], true)) {
    set_flash('danger', 'Role user tidak valid.');
    header("Location: ../index.php?page=user");
    exit;
}

$cek = $conn->prepare("SELECT id FROM users WHERE username = ? AND id <> ? LIMIT 1");
$cek->bind_param("si", $username, $id);
$cek->execute();
$exists = $cek->get_result();
$has_user = $exists && $exists->num_rows > 0;
$cek->close();

if ($has_user) {
    set_flash('danger', 'Username sudah digunakan user lain.');
    header("Location: ../index.php?page=user_form&aksi=edit&id=$id");
    exit;
}

if ($password !== '') {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET nama_lengkap = ?, username = ?, password = ?, role = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $nama_lengkap, $username, $hash, $role, $id);
} else {
    $stmt = $conn->prepare("UPDATE users SET nama_lengkap = ?, username = ?, role = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nama_lengkap, $username, $role, $id);
}

if ($stmt->execute()) {
    if ((int) $_SESSION['user_id'] === $id) {
        $_SESSION['username'] = $username;
        $_SESSION['nama_lengkap'] = $nama_lengkap;
        $_SESSION['role'] = $role;
    }
    set_flash('success', 'Data user berhasil diperbarui.');
} else {
    set_flash('danger', 'Gagal memperbarui data user.');
}

$stmt->close();
header("Location: ../index.php?page=user");
exit;
