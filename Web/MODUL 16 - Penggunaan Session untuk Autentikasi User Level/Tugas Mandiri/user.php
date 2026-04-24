<?php
require_once "auth.php";
require_level("user");
require_once "koneksi.php";

$data = mysqli_query($koneksi, "SELECT * FROM tb_siswa ORDER BY nis ASC");
?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Siswa User</title>
  </head>
  <body>
    <h2>Data Siswa</h2>
    <p>Login sebagai: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> (user)</p>
    <p>Halaman ini hanya dapat melihat data siswa.</p>
    <p><a href="logout.php">Logout</a></p>

    <table border="1" cellpadding="8" cellspacing="0">
      <tr>
        <th>No</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>TTL</th>
        <th>Alamat</th>
        <th>Kota</th>
        <th>JK</th>
        <th>Hobi</th>
        <th>Ekskul</th>
      </tr>
      <?php if ($data && mysqli_num_rows($data) > 0) : ?>
        <?php $no = 1; ?>
        <?php while ($row = mysqli_fetch_assoc($data)) : ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($row['nis']); ?></td>
            <td><?php echo htmlspecialchars($row['nama']); ?></td>
            <td><?php echo htmlspecialchars($row['kelas']); ?></td>
            <td><?php echo htmlspecialchars($row['ttl']); ?></td>
            <td><?php echo htmlspecialchars($row['alamat']); ?></td>
            <td><?php echo htmlspecialchars($row['kota']); ?></td>
            <td><?php echo htmlspecialchars($row['jk']); ?></td>
            <td><?php echo htmlspecialchars($row['hobi']); ?></td>
            <td><?php echo htmlspecialchars($row['ekskul']); ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else : ?>
        <tr>
          <td colspan="10">Belum ada data siswa.</td>
        </tr>
      <?php endif; ?>
    </table>
  </body>
</html>
