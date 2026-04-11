<?php

include "koneksi.php";
$nis = $_GET['nis'];
$query = "SELECT * FROM tb_siswa WHERE nis='$nis'";
$hasil = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($hasil);

?>

<form action="proses_update.php" method="post">
    <table border="1">
        <tr>
            <td>NIS</td>
            <td>:</td>
            <td><input type="text" name="nis" value="<?php echo $data['nis']; ?>" readonly></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><input type="text" name="nama" value="<?php echo $data['nama']; ?>"></td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="submit" value="Kirim">
            </td>
            <td></td>
            <td>
                <input type="reset" name="reset" value="Reset">
            </td>
        </tr>
        <tr></tr>
    </table>
</form>
