<?php
$page = $_GET['page'] ?? 'dashboard';
?>
<div class="sidebar">
    <h2>Admin</h2>

    <a href="index.php?page=dashboard" class="<?= ($page == 'dashboard') ? 'active' : '' ?>">Dashboard</a>
    <a href="index.php?page=user" class="<?= ($page == 'activate') ? 'active' : '' ?>">User</a>
    <a href="index.php?page=berita" class="<?= ($page == 'berita') ? 'active' : '' ?>">Berita</a>
    <hr>
    <a href="page=logout">Logout</a>
</div>