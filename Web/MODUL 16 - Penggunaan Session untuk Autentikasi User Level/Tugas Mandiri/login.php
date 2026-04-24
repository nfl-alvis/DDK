<?php
require_once "auth.php";

if (isset($_SESSION['username'], $_SESSION['level'])) {
    redirect_to_dashboard();
}

$pesan = "";
$kode_pesan = $_GET['pesan'] ?? "";

switch ($kode_pesan) {
    case "logout":
        $pesan = "Anda telah logout.";
        break;
    case "registrasi-berhasil":
        $pesan = "Registrasi berhasil. Silakan login.";
        break;
    case "login-gagal":
        $pesan = "Username atau password salah.";
        break;
    case "data-login-kosong":
        $pesan = "Username dan password harus diisi.";
        break;
    case "harus-login":
        $pesan = "Silakan login terlebih dahulu.";
        break;
    case "level-tidak-valid":
        $pesan = "Level akun tidak valid.";
        break;
}
?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Sistem Data Siswa</title>
  </head>
  <body>
    <h2>Login Sistem Data Siswa</h2>
    <p>Masuk sebagai admin untuk mengelola data, atau sebagai user untuk melihat data siswa.</p>

    <?php if ($pesan !== "") : ?>
      <p><strong><?php echo htmlspecialchars($pesan); ?></strong></p>
    <?php endif; ?>

    <form action="Proses_Login.php" method="post">
      <fieldset>
        <legend>Form Login</legend>
        <table>
          <tr>
            <td><label for="username">Username</label></td>
            <td>:</td>
            <td><input type="text" name="username" id="username" required autocomplete="username" /></td>
          </tr>
          <tr>
            <td><label for="password">Password</label></td>
            <td>:</td>
            <td><input type="password" name="password" id="password" required autocomplete="current-password" /></td>
          </tr>
        </table>
      </fieldset>

      <p>
        <input type="submit" value="Login" />
        <input type="reset" value="Reset" />
      </p>
    </form>

    <p>Belum punya akun? <a href="register.php">Register di sini</a></p>
  </body>
</html>
