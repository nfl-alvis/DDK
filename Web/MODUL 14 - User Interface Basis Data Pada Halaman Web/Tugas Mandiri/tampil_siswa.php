<?php
require_once "koneksi.php";
$data = mysqli_query($koneksi, "SELECT * FROM tb_siswa ORDER BY nis ASC");
?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Siswa</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 20px;
      }
      table {
        width: 100%;
        border-collapse: collapse;
      }
      th,
      td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
      }
      th {
        background: #f2f2f2;
      }
      a {
        margin-right: 8px;
      }
    </style>
  </head>
  <body>
    <h2>Data Siswa</h2>
    <p><a href="Form_Ekskul.html">Daftar</a></p>
    <table>
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
        <th>Aksi</th>
      </tr>
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
        <td>
          <a href="edit_siswa.php?nis=<?php echo urlencode($row['nis']); ?>">Edit</a>
          <a href="hapus_siswa.php?nis=<?php echo urlencode($row['nis']); ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>
  </body>
</html>
