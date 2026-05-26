<?php
require_once "auth.php";
require_once "koneksi.php";

require_login();

$page = $_GET['page'] ?? 'dashboard';
$page_title_map = [
    'dashboard' => 'Dashboard',
    'user' => 'Data User',
    'user_form' => 'Form User',
    'user_detail' => 'Detail User',
    'berita' => 'Data Berita',
    'berita_form' => 'Form Berita',
    'berita_detail' => 'Detail Berita',
    'forbidden' => 'Akses Ditolak',
];
$allowed = [
    'dashboard',
    'user',
    'user_form',
    'user_detail',
    'berita',
    'berita_form',
    'berita_detail',
    'forbidden',
];

if (!in_array($page, $allowed, true)) {
    $page = 'dashboard';
}

$admin_only_pages = ['user_form', 'berita_form'];
if (in_array($page, $admin_only_pages, true) && !is_admin()) {
    $page = 'forbidden';
}

$page_title = $page_title_map[$page] ?? 'Dashboard';
$flash = flash_message();

include "admin/templates/header.php";
include "admin/templates/sidebar.php";
include "admin/pages/$page.php";
include "admin/templates/footer.php";
