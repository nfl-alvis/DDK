<?php
require_once "auth.php";

if (isset($_SESSION['username'], $_SESSION['level'])) {
  redirect_to_dashboard();
}

$pesan = "";
$alert_class = "alert-info";
$kode_pesan = $_GET['pesan'] ?? "";

switch ($kode_pesan) {
  case "logout":
    $pesan = "Anda telah logout.";
    $alert_class = "alert-success";
    break;
  case "registrasi-berhasil":
    $pesan = "Registrasi berhasil. Silakan login.";
    $alert_class = "alert-success";
    break;
  case "login-gagal":
    $pesan = "Username atau password salah.";
    $alert_class = "alert-danger";
    break;
  case "data-login-kosong":
    $pesan = "Username dan password harus diisi.";
    $alert_class = "alert-warning";
    break;
  case "harus-login":
    $pesan = "Silakan login terlebih dahulu.";
    $alert_class = "alert-warning";
    break;
  case "level-tidak-valid":
    $pesan = "Level akun tidak valid.";
    $alert_class = "alert-warning";
    break;
}
?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Sistem Data Siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/app.css" />
</head>

<body>
  <div class="auth-page">
    <div class="container">
      <div class="card auth-card">
        <div class="row g-0">
          <div class="col-lg-5">
            <div class="auth-hero">
              <span class="brand-mark">Sistem Siswa</span>
              <h1 class="auth-title mt-4 mb-3">Masuk ke panel data siswa dan ekstrakurikuler.</h1>
              <p class="section-intro mb-4">
                Admin dapat mengelola data siswa, sedangkan user hanya melihat data yang sudah tersimpan.
              </p>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="form-panel">
              <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
                <div>
                  <p class="text-uppercase text-secondary fw-semibold mb-2">Autentikasi</p>
                  <h2 class="h3 fw-bold mb-1">Login Sistem Data Siswa</h2>
                  <p class="small-muted mb-0">Gunakan username dan password yang sudah terdaftar.</p>
                </div>
              </div>

              <?php if ($pesan !== "") : ?>
                <div class="alert <?php echo $alert_class; ?> border-0 shadow-sm info-card" role="alert">
                  <?php echo htmlspecialchars($pesan); ?>
                </div>
              <?php endif; ?>

              <form action="Proses_Login.php" method="post" class="row g-3">
                <div class="col-12">
                  <label for="username" class="form-label">Username</label>
                  <input
                    type="text"
                    name="username"
                    id="username"
                    class="form-control"
                    required
                    autocomplete="username"
                    autofocus />
                </div>
                <div class="col-12">
                  <label for="password" class="form-label">Password</label>
                  <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    required
                    autocomplete="current-password" />
                </div>
                <div class="col-12 d-flex flex-column flex-sm-row gap-2 pt-2">
                  <button type="submit" class="btn btn-brand flex-fill">Login</button>
                  <button type="reset" class="btn btn-outline-secondary btn-ghost flex-fill">Reset</button>
                </div>
              </form>

              <p class="auth-links small-muted mt-4 mb-0">
                Belum punya akun? <a href="register.php">Register di sini</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>