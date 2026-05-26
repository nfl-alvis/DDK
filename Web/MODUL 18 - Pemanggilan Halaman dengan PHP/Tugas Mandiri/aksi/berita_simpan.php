<?php
require_once "../auth.php";
require_once "../koneksi.php";

require_admin();

$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');
$author = trim($_POST['author'] ?? '');

if ($title === '' || $content === '' || $author === '' || empty($_FILES['image']['name'])) {
    set_flash('warning', 'Data berita harus dilengkapi.');
    header("Location: ../index.php?page=berita_form&aksi=tambah");
    exit;
}

$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
$allowed = ['jpg', 'jpeg', 'png', 'gif'];

if (!in_array($ext, $allowed, true)) {
    set_flash('danger', 'Format gambar tidak valid.');
    header("Location: ../index.php?page=berita_form&aksi=tambah");
    exit;
}

$new_name = time() . "_" . preg_replace('/[^A-Za-z0-9._-]/', '_', basename($_FILES['image']['name']));
$target = "../upload/" . $new_name;

if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    set_flash('danger', 'Gagal upload gambar berita.');
    header("Location: ../index.php?page=berita_form&aksi=tambah");
    exit;
}

$stmt = $conn->prepare("INSERT INTO news (title, content, author, image) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $title, $content, $author, $new_name);

if ($stmt->execute()) {
    set_flash('success', 'Berita berhasil ditambahkan.');
} else {
    set_flash('danger', 'Gagal menyimpan berita.');
}

$stmt->close();
header("Location: ../index.php?page=berita");
exit;
