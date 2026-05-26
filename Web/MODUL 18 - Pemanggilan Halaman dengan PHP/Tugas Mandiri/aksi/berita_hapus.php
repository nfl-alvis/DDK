<?php
require_once "../auth.php";
require_once "../koneksi.php";

require_admin();

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    set_flash('warning', 'Data berita tidak valid.');
    header("Location: ../index.php?page=berita");
    exit;
}

$stmt = $conn->prepare("SELECT image FROM news WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$berita = $result ? $result->fetch_assoc() : null;
$stmt->close();

if (!$berita) {
    set_flash('danger', 'Data berita tidak ditemukan.');
    header("Location: ../index.php?page=berita");
    exit;
}

$delete = $conn->prepare("DELETE FROM news WHERE id = ?");
$delete->bind_param("i", $id);

if ($delete->execute()) {
    if (!empty($berita['image']) && file_exists("../upload/" . $berita['image'])) {
        unlink("../upload/" . $berita['image']);
    }
    set_flash('success', 'Berita berhasil dihapus.');
} else {
    set_flash('danger', 'Gagal menghapus berita.');
}

$delete->close();
header("Location: ../index.php?page=berita");
exit;
