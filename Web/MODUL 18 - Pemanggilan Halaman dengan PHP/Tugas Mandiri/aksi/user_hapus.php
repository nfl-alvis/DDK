<?php
require_once "../auth.php";
require_once "../koneksi.php";

require_admin();

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    set_flash('warning', 'Data user tidak valid.');
    header("Location: ../index.php?page=user");
    exit;
}

if ((int) $_SESSION['user_id'] === $id) {
    set_flash('danger', 'Akun yang sedang login tidak dapat dihapus.');
    header("Location: ../index.php?page=user");
    exit;
}

$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    set_flash('success', 'Data user berhasil dihapus.');
} else {
    set_flash('danger', 'Gagal menghapus data user.');
}

$stmt->close();
header("Location: ../index.php?page=user");
exit;
