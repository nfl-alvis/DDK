<?php

include "koneksi.php";
$nis = $_GET['nis'];
$query = "SELECT * FROM tb_siswa WHERE nis='$nis'";
$hasil = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($hasil);

?>

<table border="1">
    <tr>
        <td>NIS</td>
        <td>:</td>
        <td><?= $data['nis'] ?></td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td><?= $data['nama'] ?></td>
    </tr>
</table>