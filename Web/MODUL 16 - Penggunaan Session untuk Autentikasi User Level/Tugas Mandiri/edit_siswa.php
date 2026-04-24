<?php
require_once "auth.php";
require_level("admin");
require_once "koneksi.php";

$pesan = "";
$kode_pesan = $_GET['pesan'] ?? "";

switch ($kode_pesan) {
    case "tambah-berhasil":
        $pesan = "Data siswa berhasil ditambahkan.";
        break;
    case "update-berhasil":
        $pesan = "Data siswa berhasil diupdate.";
        break;
    case "hapus-berhasil":
        $pesan = "Data siswa berhasil dihapus.";
        break;
}

$nis_lama = trim($_GET['nis'] ?? "");
$data_edit = null;
$info_edit = "";

if ($nis_lama !== "") {
    $query = mysqli_prepare($koneksi, "SELECT * FROM tb_siswa WHERE nis = ?");
    mysqli_stmt_bind_param($query, "s", $nis_lama);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    $data_edit = $result ? mysqli_fetch_assoc($result) : null;
    mysqli_stmt_close($query);

    if (!$data_edit) {
        $info_edit = "Data siswa yang ingin diedit tidak ditemukan.";
    }
}

$data_siswa = mysqli_query($koneksi, "SELECT * FROM tb_siswa ORDER BY nis ASC");
?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Data Siswa</title>
    <style>
      * {
        box-sizing: border-box;
        font-family: "Times New Roman", Times, serif;
      }

      body {
        margin: 0;
        background: #f4f4f4;
        color: #222;
      }

      .container {
        max-width: 1100px;
        margin: 30px auto;
        padding: 0 16px 30px;
      }

      .card {
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
      }

      .header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
      }

      .header h2 {
        margin: 0 0 8px;
      }

      .actions a {
        margin-left: 10px;
      }

      .message {
        margin: 0 0 15px;
      }

      form table,
      .data-table {
        width: 100%;
      }

      form table {
        border-spacing: 8px;
      }

      input[type="text"],
      input[type="date"],
      textarea {
        width: 100%;
        padding: 6px;
      }

      textarea {
        min-height: 70px;
        resize: vertical;
      }

      .radio-group {
        display: flex;
        gap: 12px;
      }

      .data-table {
        border-collapse: collapse;
      }

      .data-table th,
      .data-table td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
        vertical-align: top;
      }

      .data-table th {
        background: #efefef;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="card">
        <div class="header">
          <div>
            <h2>Panel Admin Data Siswa</h2>
            <p>Login sebagai: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> (admin)</p>
          </div>
          <div class="actions">
            <a href="Form_Ekskul.php">Tambah Data</a>
            <a href="logout.php">Logout</a>
          </div>
        </div>
      </div>

      <?php if ($pesan !== "") : ?>
        <div class="card">
          <p class="message"><strong><?php echo htmlspecialchars($pesan); ?></strong></p>
        </div>
      <?php endif; ?>

      <?php if ($info_edit !== "") : ?>
        <div class="card">
          <p class="message"><strong><?php echo htmlspecialchars($info_edit); ?></strong></p>
        </div>
      <?php endif; ?>

      <?php if ($data_edit) : ?>
        <div class="card">
          <form action="update_siswa.php" method="post">
            <h3>Edit Data Siswa</h3>
            <input type="hidden" name="nis_lama" value="<?php echo htmlspecialchars($data_edit['nis']); ?>" />
            <table>
              <tr>
                <td>NIS</td>
                <td>:</td>
                <td><input type="text" name="nis" value="<?php echo htmlspecialchars($data_edit['nis']); ?>" required /></td>
              </tr>
              <tr>
                <td>Nama</td>
                <td>:</td>
                <td><input type="text" name="nama" value="<?php echo htmlspecialchars($data_edit['nama']); ?>" required /></td>
              </tr>
              <tr>
                <td>Kelas</td>
                <td>:</td>
                <td><input type="text" name="kelas" value="<?php echo htmlspecialchars($data_edit['kelas']); ?>" required /></td>
              </tr>
              <tr>
                <td>Tgl Lahir</td>
                <td>:</td>
                <td><input type="date" name="ttl" value="<?php echo htmlspecialchars($data_edit['ttl']); ?>" required /></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><textarea name="alamat" required><?php echo htmlspecialchars($data_edit['alamat']); ?></textarea></td>
              </tr>
              <tr>
                <td>Kota</td>
                <td>:</td>
                <td><input type="text" name="kota" value="<?php echo htmlspecialchars($data_edit['kota']); ?>" required /></td>
              </tr>
              <tr>
                <td>JK</td>
                <td>:</td>
                <td>
                  <div class="radio-group">
                    <label><input type="radio" name="jk" value="L" <?php echo $data_edit['jk'] === 'L' ? 'checked' : ''; ?> required /> L</label>
                    <label><input type="radio" name="jk" value="P" <?php echo $data_edit['jk'] === 'P' ? 'checked' : ''; ?> required /> P</label>
                  </div>
                </td>
              </tr>
              <tr>
                <td>Hobi</td>
                <td>:</td>
                <td><input type="text" name="hobi" value="<?php echo htmlspecialchars($data_edit['hobi']); ?>" required /></td>
              </tr>
              <tr>
                <td>Ekskul</td>
                <td>:</td>
                <td><input type="text" name="ekskul" value="<?php echo htmlspecialchars($data_edit['ekskul']); ?>" required /></td>
              </tr>
            </table>
            <p>
              <button type="submit">Update</button>
              <a href="edit_siswa.php">Batal</a>
            </p>
          </form>
        </div>
      <?php endif; ?>

      <div class="card">
        <h3>Daftar Siswa</h3>
        <table class="data-table">
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
          <?php if ($data_siswa && mysqli_num_rows($data_siswa) > 0) : ?>
            <?php $no = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($data_siswa)) : ?>
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
          <?php else : ?>
            <tr>
              <td colspan="11">Belum ada data siswa.</td>
            </tr>
          <?php endif; ?>
        </table>
      </div>
    </div>
  </body>
</html>
