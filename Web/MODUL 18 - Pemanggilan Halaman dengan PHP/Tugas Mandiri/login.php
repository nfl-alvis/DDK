<?php
require_once "auth.php";

if (is_logged_in()) {
    redirect_dashboard();
}

$pesan = "";
$alert = "warning";
$kode = $_GET['pesan'] ?? "";

switch ($kode) {
    case "login-gagal":
        $pesan = "Username atau password salah.";
        $alert = "danger";
        break;
    case "data-kosong":
        $pesan = "Username dan password wajib diisi.";
        break;
    case "harus-login":
        $pesan = "Silakan login terlebih dahulu.";
        break;
    case "logout":
        $pesan = "Anda berhasil logout.";
        $alert = "success";
        break;
}
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Portal Berita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="auth-body">
    <div class="auth-shell">
        <div class="auth-card card border-0 shadow-lg overflow-hidden">
            <div class="row g-0">
                <div class="col-lg-6 auth-visual">
                    <div>
                        <span class="eyebrow">Modul 18</span>
                        <h1 class="auth-title">Portal berita dengan dashboard admin dan user.</h1>
                        <p class="auth-copy">
                            Admin dapat menambah, mengubah, menghapus, dan melihat detail data user maupun berita.
                            User hanya dapat masuk ke dashboard dan melihat detail data.
                        </p>
                        <div class="feature-list">
                            <div><i class="bi bi-shield-lock"></i> Session autentikasi</div>
                            <div><i class="bi bi-people"></i> CRUD menu user</div>
                            <div><i class="bi bi-newspaper"></i> CRUD menu berita</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="auth-form">
                        <span class="eyebrow text-primary">Autentikasi User</span>
                        <h2 class="h3 fw-bold mb-2">Masuk ke dashboard</h2>
                        <p class="text-secondary mb-4">Gunakan akun yang sudah tersedia pada tabel <code>users</code>.</p>

                        <?php if ($pesan !== ""): ?>
                            <div class="alert alert-<?= htmlspecialchars($alert) ?> border-0">
                                <?= htmlspecialchars($pesan) ?>
                            </div>
                        <?php endif; ?>

                        <form action="proses_login.php" method="post" class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold">Username</label>
                                <input type="text" name="username" class="form-control form-control-lg" required autofocus>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" name="password" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-12 d-grid">
                                <button type="submit" class="btn btn-brand btn-lg">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                                </button>
                            </div>
                        </form>

                        <div class="demo-note">
                            <strong>Catatan:</strong> level <code>admin</code> diarahkan ke dashboard admin,
                            level <code>user</code> tetap masuk dashboard tetapi hanya mode lihat/detail.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
