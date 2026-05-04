<?php
require_once "auth.php";
require_admin();   // ← hanya admin
include "koneksi.php";

$id  = (int)($_GET['id'] ?? 0);
$res = $conn->query("SELECT * FROM news WHERE id = $id LIMIT 1");
if (!$res || $res->num_rows === 0) {
    echo '<div class="container mt-5"><div class="alert alert-danger">Berita tidak ditemukan.</div><a href="tampil.php" class="btn btn-secondary">Kembali</a></div>';
    exit;
}
$row = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Berita</title>
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
  .card{border:none;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.08)}
  .card-header{background:linear-gradient(135deg,#fd7e14,#ffc107);border-radius:12px 12px 0 0!important}
  .form-control{border:1.5px solid #e0e0e0;border-radius:10px;font-family:'DM Sans',sans-serif}
  .form-control:focus{border-color:#fd7e14;box-shadow:0 0 0 3px rgba(253,126,20,.12)}
  .current-img{max-width:160px;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,.1)}
  #preview{max-width:160px;border-radius:8px;display:none;margin-top:10px}
  .btn-save{background:linear-gradient(135deg,#fd7e14,#ffc107);border:none;border-radius:10px;color:#fff;font-weight:600;padding:11px 28px}
  .btn-save:hover{opacity:.9;color:#fff}
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

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-7">
      <div class="card">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
          <h5 class="mb-0 text-white"><i class="bi bi-pencil-square me-2"></i>Edit Berita</h5>
          <a href="tampil.php" class="btn btn-light btn-sm rounded-pill">
            <i class="bi bi-arrow-left me-1"></i>Kembali
          </a>
        </div>
        <div class="card-body p-4">
          <form action="proses_edit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="hidden" name="old_image" value="<?= htmlspecialchars($row['image']) ?>">

            <div class="mb-3">
              <label class="form-label fw-semibold">Judul Berita</label>
              <input type="text" name="title" class="form-control"
                     value="<?= htmlspecialchars($row['title']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Konten</label>
              <textarea name="content" class="form-control" rows="6" required><?= htmlspecialchars($row['content']) ?></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Author</label>
              <input type="text" name="author" class="form-control"
                     value="<?= htmlspecialchars($row['author']) ?>" required>
            </div>
            <div class="mb-4">
              <label class="form-label fw-semibold">Gambar Saat Ini</label><br>
              <img src="upload/<?= htmlspecialchars($row['image']) ?>" class="current-img" alt="Gambar saat ini">
              <div class="mt-3">
                <label class="form-label fw-semibold">Ganti Gambar <span class="text-muted fw-normal">(opsional)</span></label>
                <input type="file" name="image" id="imgInput" class="form-control" accept="image/*">
                <img id="preview" src="#" alt="Preview baru">
                <div class="form-text">Kosongkan jika tidak ingin mengganti gambar.</div>
              </div>
            </div>
            <div class="d-flex gap-2">
              <button type="submit" class="btn-save">
                <i class="bi bi-save me-1"></i>Simpan Perubahan
              </button>
              <a href="tampil.php" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('imgInput').addEventListener('change', function() {
    const p = document.getElementById('preview');
    const f = this.files[0];
    if (f) {
      const r = new FileReader();
      r.onload = e => { p.src = e.target.result; p.style.display = 'block'; };
      r.readAsDataURL(f);
    }
  });
</script>
</body>
</html>