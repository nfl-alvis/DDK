<?php
require_once "auth.php";
require_admin();   // ← hanya admin
include "koneksi.php";

$id  = (int)($_GET['id'] ?? 0);
$res = $conn->query("SELECT image FROM news WHERE id = $id LIMIT 1");
if (!$res || $res->num_rows === 0) {
    header("Location: tampil.php");
    exit;
}
$row = $res->fetch_assoc();

if ($conn->query("DELETE FROM news WHERE id = $id")) {
    if (!empty($row['image']) && file_exists("upload/" . $row['image']))
        unlink("upload/" . $row['image']);
    header("Location: tampil.php?success=delete");
} else {
    echo "Error: " . $conn->error;
}
$conn->close();