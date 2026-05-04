<?php
require_once "auth.php";
require_admin();          // ← hanya admin; user biasa diblokir
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin — Kelola Berita</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  body{background:#f4f6fb;font-family:'DM Sans',sans-serif}
  .navbar{background:linear-gradient(135deg,#1a1a2e,#0f3460)}
  .navbar-brand{font-family:'Playfair Display',serif;font-size:1.4rem;color:#fff!important}
  .navbar-brand span{color:#e94560}
  .role-badge{background:rgba(233,69,96,.15);color:#e94560;border:1px solid rgba(233,69,96,.3);border-radius:20px;padding:3px 12px;font-size:.8rem;font-weight:600}
  .user-info{background:rgba(255,255,255,.1);color:#fff;border-radius:20px;padding:3px 12px;font-size:.85rem}
  .card{border:none;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.07)}
  .table thead th{background:linear-gradient(135deg,#1a1a2e,#0f3460);color:#fff;border:none;font-weight:600}
  .table tbody tr:hover{background:#f0f4ff}
  .img-thumb{width:80px;height:60px;object-fit:cover;border-radius:6px}
  .badge-author{background:#e8f0ff;color:#0f3460;padding:3px 10px;border-radius:20px;font-size:.82rem;font-weight:500}
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="tampil.php">Portal<span>Berita</span></a>
    <div class="ms-auto d-flex align-items-center gap-3">
      <span class="user-info"><i class="bi bi-person-circle me-1"></i><?= htmlspecialchars($_SESSION['nama_lengkap']) ?></span>
      <span class="role-badge"><i class="bi bi-shield-check me-1"></i>Admin</span>
      <a href="logout.php" class="btn btn-sm btn-outline-light rounded-pill px-3">
        <i class="bi bi-box-arrow-right me-1"></i>Logout
      </a>
    </div>
  </div>
</nav>

<div class="container py-4">

  <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
      <i class="bi bi-check-circle me-2"></i>
      <?= $_GET['success'] === 'delete' ? 'Berita berhasil dihapus.' : 'Berita berhasil diperbarui.' ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <div class="card">
    <div class="card-body p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0 fw-bold"><i class="bi bi-newspaper me-2 text-danger"></i>Kelola Berita</h5>
        <a href="form_upload.php" class="btn btn-danger btn-sm px-3">
          <i class="bi bi-plus-lg me-1"></i>Tambah Berita
        </a>
      </div>

      <?php
        $sql    = "SELECT * FROM news ORDER BY id DESC";
        $result = $conn->query($sql);
      ?>

      <?php if ($result && $result->num_rows > 0): ?>
      <div class="table-responsive">
        <table class="table table-bordered align-middle mb-0">
          <thead>
            <tr>
              <th>No</th><th>Judul</th><th>Konten</th>
              <th>Author</th><th>Gambar</th><th>Tanggal</th>
              <th style="width:175px">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td class="text-center text-muted"><?= $no++ ?></td>
              <td class="fw-semibold"><?= htmlspecialchars($row['title']) ?></td>
              <td class="text-muted" style="max-width:200px">
                <?= htmlspecialchars(substr($row['content'], 0, 80)) ?>...
              </td>
              <td><span class="badge-author"><?= htmlspecialchars($row['author']) ?></span></td>
              <td><img src="upload/<?= htmlspecialchars($row['image']) ?>" class="img-thumb" alt=""></td>
              <td class="text-muted small"><?= $row['date'] ?></td>
              <td>
                <a href="detail.php?id=<?= $row['id'] ?>"
                   class="btn btn-info btn-sm text-white mb-1">
                  <i class="bi bi-eye"></i> Detail
                </a>
                <a href="edit.php?id=<?= $row['id'] ?>"
                   class="btn btn-warning btn-sm mb-1">
                  <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="hapus.php?id=<?= $row['id'] ?>"
                   class="btn btn-danger btn-sm mb-1"
                   onclick="return confirm('Yakin ingin menghapus berita ini?')">
                  <i class="bi bi-trash"></i> Hapus
                </a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
      <?php else: ?>
      <div class="text-center py-5 text-muted">
        <i class="bi bi-inbox display-4"></i>
        <p class="mt-3">Belum ada berita. <a href="form_upload.php">Tambah sekarang</a>.</p>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>