<?php
require_once "auth.php";
require_level("admin");
require_once "koneksi.php";

if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];
    $stmt = mysqli_prepare($koneksi, "DELETE FROM tb_siswa WHERE nis = ?");
    mysqli_stmt_bind_param($stmt, "s", $nis);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header("Location: edit_siswa.php?pesan=hapus-berhasil");
exit();
