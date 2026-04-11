<?php
require_once "koneksi.php";

$nis_lama = $_GET['nis'];
$query = mysqli_prepare($koneksi, "SELECT * FROM tb_siswa WHERE nis = ?");
mysqli_stmt_bind_param($query, "s", $nis_lama);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);
$data = mysqli_fetch_assoc($result);
mysqli_stmt_close($query);
?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Siswa</title>
    <style>
      * {
        font-family: "Times New Roman", Times, serif;
      }
      body {
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: #f5f5f5;
      }
      form {
        width: 450px;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 10px;
        background: white;
      }
      h2 {
        text-align: center;
      }
      table {
        width: 100%;
        border-spacing: 8px;
      }
      input[type="text"],
      input[type="date"],
      textarea {
        width: 100%;
        padding: 5px;
        box-sizing: border-box;
      }
      .radio-group {
        display: flex;
        gap: 12px;
      }
    </style>
  </head>
  <body>
    <form action="update_siswa.php" method="post">
      <h2>Edit Data Siswa</h2>
      <input type="hidden" name="nis_lama" value="<?php echo $data['nis']; ?>" />
      <table>
        <tr>
          <td>NIS</td>
          <td>:</td>
        <td><input type="text" name="nis" value="<?php echo htmlspecialchars($data['nis']); ?>" required /></td>
        </tr>
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td><input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required /></td>
        </tr>
        <tr>
          <td>Kelas</td>
          <td>:</td>
          <td><input type="text" name="kelas" value="<?php echo htmlspecialchars($data['kelas']); ?>" required /></td>
        </tr>
        <tr>
          <td>Tgl Lahir</td>
          <td>:</td>
          <td><input type="date" name="ttl" value="<?php echo htmlspecialchars($data['ttl']); ?>" required /></td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td>:</td>
          <td><textarea name="alamat" required><?php echo htmlspecialchars($data['alamat']); ?></textarea></td>
        </tr>
        <tr>
          <td>Kota</td>
          <td>:</td>
          <td><input type="text" name="kota" value="<?php echo htmlspecialchars($data['kota']); ?>" required /></td>
        </tr>
        <tr>
          <td>JK</td>
          <td>:</td>
          <td>
            <div class="radio-group">
              <label><input type="radio" name="jk" value="L" <?php echo $data['jk'] == 'L' ? 'checked' : ''; ?> required /> L</label>
              <label><input type="radio" name="jk" value="P" <?php echo $data['jk'] == 'P' ? 'checked' : ''; ?> required /> P</label>
            </div>
          </td>
        </tr>
        <tr>
          <td>Hobi</td>
          <td>:</td>
          <td><input type="text" name="hobi" value="<?php echo htmlspecialchars($data['hobi']); ?>" required /></td>
        </tr>
        <tr>
          <td>Ekskul</td>
          <td>:</td>
          <td><input type="text" name="ekskul" value="<?php echo htmlspecialchars($data['ekskul']); ?>" required /></td>
        </tr>
      </table>
      <br />
      <button type="submit">Update</button>
      <a href="tampil_siswa.php">Batal</a>
    </form>
  </body>
</html>
