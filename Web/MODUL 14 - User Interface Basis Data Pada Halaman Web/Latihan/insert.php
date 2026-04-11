<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data Siswa</title>
</head>

<body>

    <form action="" method="post">
        <table border="1">
            <tr>
                <td>NIS</td>
                <td>:</td>
                <td><input type="text" name="nis"></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit" value="Simpan" name="kirim">
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>

    <?php
    include "koneksi.php";

    @$nis   = $_POST['nis'];
    @$nama  = $_POST['nama'];
    @$kirim = $_POST['kirim'];

    if ($kirim) {
        $query = "INSERT INTO tb_siswa (nis, nama) VALUES ('$nis', '$nama')";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            echo "Data berhasil disimpan.<br>";
            echo "<a href='tampil.php'>Lihat Data</a>";
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
    ?>

    <br>
    <a href="insert.php">Daftar</a>

</body>

</html>