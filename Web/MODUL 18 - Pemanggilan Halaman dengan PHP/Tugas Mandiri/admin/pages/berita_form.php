<?php
$aksi = $_GET['aksi'] ?? 'tambah';
$id = (int) ($_GET['id'] ?? 0);
$berita = [
    'id' => 0,
    'title' => '',
    'content' => '',
    'author' => '',
    'image' => '',
];

if ($aksi === 'edit') {
    $stmt = $conn->prepare("SELECT id, title, content, author, image FROM news WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result ? $result->fetch_assoc() : null;
    $stmt->close();

    if (!$data) {
        echo '<div class="panel-card"><div class="alert alert-danger border-0 mb-0">Data berita tidak ditemukan.</div></div>';
        return;
    }

    $berita = $data;
}
?>
<div class="panel-card">
    <div class="section-head">
        <div>
            <h3><?= $aksi === 'edit' ? 'Edit Berita' : 'Tambah Berita' ?></h3>
            <p class="text-secondary mb-0">Lengkapi judul, isi berita, author, dan gambar.</p>
        </div>
        <a href="index.php?page=berita" class="btn btn-outline-secondary rounded-pill">Kembali</a>
    </div>

    <form action="<?= $aksi === 'edit' ? 'aksi/berita_update.php' : 'aksi/berita_simpan.php' ?>" method="post" enctype="multipart/form-data" class="row g-3">
        <input type="hidden" name="id" value="<?= (int) $berita['id'] ?>">
        <input type="hidden" name="old_image" value="<?= htmlspecialchars($berita['image']) ?>">
        <div class="col-md-8">
            <label class="form-label fw-semibold">Judul Berita</label>
            <input type="text" name="title" class="form-control" required value="<?= htmlspecialchars($berita['title']) ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold">Author</label>
            <input type="text" name="author" class="form-control" required value="<?= htmlspecialchars($berita['author']) ?>">
        </div>
        <div class="col-12">
            <label class="form-label fw-semibold">Konten</label>
            <textarea name="content" class="form-control" rows="7" required><?= htmlspecialchars($berita['content']) ?></textarea>
        </div>
        <div class="col-12">
            <label class="form-label fw-semibold">Gambar <?= $aksi === 'edit' ? '<small class="text-secondary">(opsional)</small>' : '' ?></label>
            <input type="file" name="image" class="form-control" <?= $aksi === 'edit' ? '' : 'required' ?> accept=".jpg,.jpeg,.png,.gif,image/*">
            <?php if ($aksi === 'edit' && $berita['image'] !== ''): ?>
                <img src="upload/<?= htmlspecialchars($berita['image']) ?>" class="table-thumb mt-3" alt="<?= htmlspecialchars($berita['title']) ?>">
            <?php endif; ?>
        </div>
        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-brand rounded-pill px-4">
                <i class="bi bi-save me-2"></i>Simpan
            </button>
            <a href="index.php?page=berita" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
        </div>
    </form>
</div>
