<?php
require_once "auth.php";
require_admin();   // ← hanya admin
include "koneksi.php";

$title   = $conn->real_escape_string($_POST['title']);
$content = $conn->real_escape_string($_POST['content']);
$author  = $conn->real_escape_string($_POST['author']);

$ext     = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
$allowed = ['jpg','jpeg','png','gif'];
if (!in_array($ext, $allowed)) die("Format gambar tidak valid.");

$new_name = time() . "_" . basename($_FILES['image']['name']);
$target   = "upload/" . $new_name;

if (!is_dir("upload")) mkdir("upload", 0777, true);

if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    $img = $conn->real_escape_string($new_name);
    $sql = "INSERT INTO news (title, content, author, image) VALUES ('$title','$content','$author','$img')";
    if ($conn->query($sql)) {
        header("Location: tampil.php");
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Gagal upload gambar. Pastikan folder 'upload/' dapat ditulisi.";
}
$conn->close();