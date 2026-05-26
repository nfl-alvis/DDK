<?php
$current_page = $_GET['page'] ?? 'dashboard';
?>
<aside class="sidebar-panel">
    <div>
        <div class="brand-box">
            <span class="eyebrow text-light-emphasis">Portal Berita</span>
            <h2>Modul 18</h2>
            <p>Dashboard berbasis pemanggilan halaman PHP.</p>
        </div>

        <nav class="nav flex-column nav-menu">
            <a class="nav-link <?= $current_page === 'dashboard' ? 'active' : '' ?>" href="index.php?page=dashboard">
                <i class="bi bi-grid"></i>Dashboard
            </a>
            <a class="nav-link <?= in_array($current_page, ['user', 'user_form', 'user_detail'], true) ? 'active' : '' ?>" href="index.php?page=user">
                <i class="bi bi-people"></i>User
            </a>
            <a class="nav-link <?= in_array($current_page, ['berita', 'berita_form', 'berita_detail'], true) ? 'active' : '' ?>" href="index.php?page=berita">
                <i class="bi bi-newspaper"></i>Berita
            </a>
        </nav>
    </div>

    <div class="sidebar-footer">
        <div class="user-badge">
            <div class="fw-semibold"><?= htmlspecialchars($_SESSION['nama_lengkap']) ?></div>
            <small>@<?= htmlspecialchars($_SESSION['username']) ?> • <?= htmlspecialchars($_SESSION['role']) ?></small>
        </div>
        <a href="logout.php" class="btn btn-outline-light w-100 rounded-pill">
            <i class="bi bi-box-arrow-right me-2"></i>Logout
        </a>
    </div>
</aside>

<main class="content-panel">
    <div class="topbar">
        <div>
            <span class="eyebrow text-primary">Session Aktif</span>
            <h1 class="page-heading"><?= htmlspecialchars(ucwords(str_replace('_', ' ', $page))) ?></h1>
        </div>
        <div class="topbar-meta">
            <span class="meta-chip"><i class="bi bi-person-circle"></i><?= htmlspecialchars($_SESSION['nama_lengkap']) ?></span>
            <span class="meta-chip"><i class="bi bi-shield-check"></i><?= htmlspecialchars(strtoupper($_SESSION['role'])) ?></span>
        </div>
    </div>

    <?php if (!empty($flash)): ?>
        <div class="alert alert-<?= htmlspecialchars($flash['type']) ?> border-0 shadow-sm">
            <?= htmlspecialchars($flash['message']) ?>
        </div>
    <?php endif; ?>
