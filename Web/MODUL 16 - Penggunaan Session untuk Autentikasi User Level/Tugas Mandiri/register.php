<?php
require_once "auth.php";

if (isset($_SESSION['username'], $_SESSION['level'])) {
  redirect_to_dashboard();
}

$pesan = "";
$alert_class = "alert-warning";
$kode_pesan = $_GET['pesan'] ?? "";

switch ($kode_pesan) {
  case "register-kosong":
    $pesan = "Semua data register harus diisi.";
    break;
  case "password-tidak-sama":
    $pesan = "Konfirmasi password tidak sama.";
    $alert_class = "alert-danger";
    break;
  case "username-sudah-ada":
    $pesan = "Username sudah digunakan.";
    $alert_class = "alert-danger";
    break;
  case "level-tidak-valid":
    $pesan = "Level akun tidak valid.";
    break;
  case "gagal-simpan-user":
    $pesan = "Registrasi gagal disimpan.";
    $alert_class = "alert-danger";
    break;
}
?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register Akun</title>
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
              <span class="brand-mark">Register Akun</span>
              <h1 class="auth-title mt-4 mb-3">Buat Akun.</h1>
              <p class="section-intro mb-4">
                Buat akun baru dengan username unik dan password yang aman.
              </p>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="form-panel">
              <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
                <div>
                  <p class="text-uppercase text-secondary fw-semibold mb-2">Pendaftaran</p>
                  <h2 class="h3 fw-bold mb-1">Register Akun Baru</h2>
                  <p class="small-muted mb-0">Lengkapi data berikut untuk membuat akun.</p>
                </div>
              </div>

              <?php if ($pesan !== "") : ?>
                <div class="alert <?php echo $alert_class; ?> border-0 shadow-sm info-card" role="alert">
                  <?php echo htmlspecialchars($pesan); ?>
                </div>
              <?php endif; ?>

              <form action="Proses_Register.php" method="post" class="row g-3">
                <div class="col-12">
                  <label for="username" class="form-label">Username</label>
                  <input
                    type="text"
                    name="username"
                    id="username"
                    class="form-control"
                    required
                    autocomplete="username" />
                </div>
                <div class="col-md-6">
                  <label for="password" class="form-label">Password</label>
                  <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    required
                    autocomplete="new-password" />
                </div>
                <div class="col-md-6">
                  <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
                  <input
                    type="password"
                    name="konfirmasi_password"
                    id="konfirmasi_password"
                    class="form-control"
                    required
                    autocomplete="new-password" />
                </div>
                <div class="col-12 d-flex flex-column flex-sm-row gap-2 pt-2">
                  <button type="submit" class="btn btn-brand flex-fill">Register</button>
                  <button type="reset" class="btn btn-outline-secondary btn-ghost flex-fill">Reset</button>
                </div>
              </form>

              <p class="auth-links small-muted mt-4 mb-0">
                Sudah punya akun? <a href="login.php">Kembali ke login</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>