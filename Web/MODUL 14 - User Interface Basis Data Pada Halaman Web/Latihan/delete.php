<?php
include "koneksi.php";

$nis  = $_GET['nis'];
$nama = $_GET['nama'];

$query = "DELETE FROM tb_siswa WHERE nis = '$nis'";
$hasil = mysqli_query($koneksi, $query);

if ($hasil) {
    echo "<script>document.location.href = 'tampil.php';</script>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}
