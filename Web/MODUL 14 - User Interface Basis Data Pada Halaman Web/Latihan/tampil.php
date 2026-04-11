<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Data</title>
</head>

<body>

    <?php
    include "koneksi.php";

    $query = "SELECT * FROM tb_siswa";
    $hasil = mysqli_query($koneksi, $query);
    $no = 1;
    $jumlah = mysqli_num_rows($hasil);
    ?>

    <p>Jumlah data: <?= $jumlah ?></p>
    <a href="insert.php">Daftar</a>

    <table border="1">
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th colspan="3">Action </th>
        </tr>

        <?php while ($data = mysqli_fetch_array($hasil)) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $data['nis'] ?></td>
                <td><?= $data['nama'] ?></td>
                <td><a href="detail.php?nis=<?= $data['nis'] ?>">Detail</a></td>
                <td><a href="form_update.php?nis=<?= $data['nis'] ?>">Edit</a></td>
                <td>
                    <a href="delete.php?nis=<?= $data['nis'] ?>"
                        onclick="return confirm('Yakin hapus data ini?')">
                        Delete
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>

    </table>

</body>

</html>