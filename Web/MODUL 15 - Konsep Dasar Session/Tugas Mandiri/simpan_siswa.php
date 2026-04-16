<?php
session_start();

require_once "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $ttl = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $jk_input = $_POST['jenis_kelamin'];
    $jk = $jk_input === "Laki-laki" ? "L" : "P";
    $hobi = isset($_POST['hobby']) ? implode(", ", $_POST['hobby']) : "";
    $ekskul = isset($_POST['ekskul']) ? implode(", ", $_POST['ekskul']) : "";

    $stmt = mysqli_prepare($koneksi, "INSERT INTO tb_siswa (nis, nama, kelas, ttl, alamat, kota, jk, hobi, ekskul) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssssssss", $nis, $nama, $kelas, $ttl, $alamat, $kota, $jk, $hobi, $ekskul);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header("Location: tampil_siswa.php");
exit();
