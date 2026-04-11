<?php
include "koneksi.php";
$nis = $_POST['nis'];
$nama = $_POST['nama'];

$query = "UPDATE tb_siswa SET nama='$nama' WHERE nis='$nis'";
$hasil = mysqli_query($koneksi, $query);
if ($hasil) {
    header("Location: tampil.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
