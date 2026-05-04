<?php
require_once "auth.php";
require_admin();   // ← hanya admin
include "koneksi.php";

$id        = (int)$_POST['id'];
$title     = $conn->real_escape_string($_POST['title']);
$content   = $conn->real_escape_string($_POST['content']);
$author    = $conn->real_escape_string($_POST['author']);
$old_image = $_POST['old_image'];

if (!empty($_FILES['image']['name'])) {
    $ext     = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($ext, $allowed)) die("Format gambar tidak valid.");

    $new_name = time() . "_" . basename($_FILES['image']['name']);
    $target   = "upload/" . $new_name;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target))
        die("Gagal upload gambar baru.");

    if (!empty($old_image) && file_exists("upload/" . $old_image))
        unlink("upload/" . $old_image);

    $img_field = $conn->real_escape_string($new_name);
} else {
    $img_field = $conn->real_escape_string($old_image);
}

$sql = "UPDATE news SET title='$title', content='$content', author='$author', image='$img_field' WHERE id=$id";
if ($conn->query($sql)) {
    header("Location: tampil.php?success=edit");
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
