<?php
require_once "../auth.php";
require_once "../koneksi.php";

require_admin();

$id = (int) ($_POST['id'] ?? 0);
$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');
$author = trim($_POST['author'] ?? '');
$old_image = $_POST['old_image'] ?? '';

if ($id <= 0 || $title === '' || $content === '' || $author === '') {
    set_flash('warning', 'Data berita belum lengkap.');
    header("Location: ../index.php?page=berita");
    exit;
}

$image_name = $old_image;

if (!empty($_FILES['image']['name'])) {
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($ext, $allowed, true)) {
        set_flash('danger', 'Format gambar tidak valid.');
        header("Location: ../index.php?page=berita_form&aksi=edit&id=$id");
        exit;
    }

    $image_name = time() . "_" . preg_replace('/[^A-Za-z0-9._-]/', '_', basename($_FILES['image']['name']));
    $target = "../upload/" . $image_name;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        set_flash('danger', 'Gagal upload gambar baru.');
        header("Location: ../index.php?page=berita_form&aksi=edit&id=$id");
        exit;
    }

    if ($old_image !== '' && file_exists("../upload/" . $old_image)) {
        unlink("../upload/" . $old_image);
    }
}

$stmt = $conn->prepare("UPDATE news SET title = ?, content = ?, author = ?, image = ? WHERE id = ?");
$stmt->bind_param("ssssi", $title, $content, $author, $image_name, $id);

if ($stmt->execute()) {
    set_flash('success', 'Berita berhasil diperbarui.');
} else {
    set_flash('danger', 'Gagal memperbarui berita.');
}

$stmt->close();
header("Location: ../index.php?page=berita");
exit;
