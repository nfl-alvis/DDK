<?php
$total_user = 0;
$total_admin = 0;
$total_berita = 0;

$result_user = $conn->query("SELECT COUNT(*) AS total_user, SUM(role = 'admin') AS total_admin FROM users");
if ($result_user) {
    $row_user = $result_user->fetch_assoc();
    $total_user = (int) ($row_user['total_user'] ?? 0);
    $total_admin = (int) ($row_user['total_admin'] ?? 0);
}

$result_berita = $conn->query("SELECT COUNT(*) AS total_berita FROM news");
if ($result_berita) {
    $row_berita = $result_berita->fetch_assoc();
    $total_berita = (int) ($row_berita['total_berita'] ?? 0);
}
?>
<section class="hero-banner">
    <div>
        <span class="eyebrow text-primary">Selamat Datang</span>
        <h2><?= is_admin() ? 'Dashboard Admin' : 'Dashboard User' ?></h2>
        <p>
            Anda login sebagai <strong><?= htmlspecialchars($_SESSION['role']) ?></strong>.
            <?= is_admin() ? 'Anda dapat mengelola seluruh data user dan berita.' : 'Anda hanya dapat melihat daftar dan detail data.' ?>
        </p>
    </div>
    <div class="hero-stats">
        <div class="stat-card">
            <span>Total User</span>
            <strong><?= $total_user ?></strong>
        </div>
        <div class="stat-card">
            <span>Total Admin</span>
            <strong><?= $total_admin ?></strong>
        </div>
        <div class="stat-card">
            <span>Total Berita</span>
            <strong><?= $total_berita ?></strong>
        </div>
    </div>
</section>

<div class="row g-4 mt-1">
    <div class="col-lg-6">
        <div class="panel-card h-100">
            <h3>Hak Akses User</h3>
            <p class="text-secondary mb-3">Pembatasan akses berdasarkan level session.</p>
            <ul class="feature-bullets">
                <li><strong>Admin</strong> dapat insert, detail, edit, dan delete data user serta berita.</li>
                <li><strong>User</strong> hanya dapat membuka menu daftar dan detail data.</li>
                <li>Logout akan menghapus session lalu kembali ke halaman login.</li>
            </ul>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel-card h-100">
            <h3>Navigasi Cepat</h3>
            <p class="text-secondary mb-3">Gunakan menu berikut untuk masuk ke halaman utama.</p>
            <div class="quick-links">
                <a href="index.php?page=user" class="quick-link">
                    <i class="bi bi-people"></i>
                    <span>Kelola User</span>
                </a>
                <a href="index.php?page=berita" class="quick-link">
                    <i class="bi bi-newspaper"></i>
                    <span>Kelola Berita</span>
                </a>
            </div>
        </div>
    </div>
</div>
