<?php
session_start();

require_once "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nis_lama = $_POST['nis_lama'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $ttl = $_POST['ttl'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $jk = $_POST['jk'];
    $hobi = $_POST['hobi'];
    $ekskul = $_POST['ekskul'];

    $stmt = mysqli_prepare(
        $koneksi,
        "UPDATE tb_siswa SET nis = ?, nama = ?, kelas = ?, ttl = ?, alamat = ?, kota = ?, jk = ?, hobi = ?, ekskul = ? WHERE nis = ?"
    );
    mysqli_stmt_bind_param($stmt, "ssssssssss", $nis, $nama, $kelas, $ttl, $alamat, $kota, $jk, $hobi, $ekskul, $nis_lama);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header("Location: tampil_siswa.php");
exit();
