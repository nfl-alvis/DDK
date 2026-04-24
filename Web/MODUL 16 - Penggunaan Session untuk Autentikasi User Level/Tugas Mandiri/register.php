<?php
require_once "auth.php";

if (isset($_SESSION['username'], $_SESSION['level'])) {
    redirect_to_dashboard();
}

$pesan = "";
$kode_pesan = $_GET['pesan'] ?? "";

switch ($kode_pesan) {
    case "register-kosong":
        $pesan = "Semua data register harus diisi.";
        break;
    case "password-tidak-sama":
        $pesan = "Konfirmasi password tidak sama.";
        break;
    case "username-sudah-ada":
        $pesan = "Username sudah digunakan.";
        break;
    case "level-tidak-valid":
        $pesan = "Level akun tidak valid.";
        break;
    case "gagal-simpan-user":
        $pesan = "Registrasi gagal disimpan.";
        break;
}
?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Akun</title>
  </head>
  <body>
    <h2>Register Akun</h2>
    <p>Buat akun baru untuk login ke sistem.</p>

    <?php if ($pesan !== "") : ?>
      <p><strong><?php echo htmlspecialchars($pesan); ?></strong></p>
    <?php endif; ?>

    <form action="Proses_Register.php" method="post">
      <fieldset>
        <legend>Form Register</legend>
        <table>
          <tr>
            <td><label for="username">Username</label></td>
            <td>:</td>
            <td><input type="text" name="username" id="username" required autocomplete="username" /></td>
          </tr>
          <tr>
            <td><label for="password">Password</label></td>
            <td>:</td>
            <td><input type="password" name="password" id="password" required autocomplete="new-password" /></td>
          </tr>
          <tr>
            <td><label for="konfirmasi_password">Konfirmasi Password</label></td>
            <td>:</td>
            <td><input type="password" name="konfirmasi_password" id="konfirmasi_password" required autocomplete="new-password" /></td>
          </tr>
          <tr>
            <td><label for="level">Level</label></td>
            <td>:</td>
            <td>
              <select name="level" id="level" required>
                <option value="user">user</option>
                <option value="admin">admin</option>
              </select>
            </td>
          </tr>
        </table>
      </fieldset>

      <p>
        <input type="submit" value="Register" />
        <input type="reset" value="Reset" />
      </p>
    </form>

    <p>Sudah punya akun? <a href="login.php">Kembali ke login</a></p>
  </body>
</html>
