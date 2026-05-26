<?php
$id = (int) ($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT id, title, content, author, image, date FROM news WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$berita = $result ? $result->fetch_assoc() : null;
$stmt->close();
?>
<div class="panel-card">
    <?php if (!$berita): ?>
        <div class="alert alert-danger border-0 mb-0">Data berita tidak ditemukan.</div>
    <?php else: ?>
        <div class="section-head">
            <div>
                <h3>Detail Berita</h3>
                <p class="text-secondary mb-0">Baca isi berita secara lengkap.</p>
            </div>
            <a href="index.php?page=berita" class="btn btn-outline-secondary rounded-pill">Kembali</a>
        </div>

        <?php if (!empty($berita['image'])): ?>
            <img src="upload/<?= htmlspecialchars($berita['image']) ?>" class="detail-image mb-4" alt="<?= htmlspecialchars($berita['title']) ?>">
        <?php endif; ?>

        <h2 class="article-title mb-3"><?= htmlspecialchars($berita['title']) ?></h2>
        <div class="d-flex flex-wrap gap-2 mb-4">
            <span class="meta-chip light"><i class="bi bi-person"></i><?= htmlspecialchars($berita['author']) ?></span>
            <span class="meta-chip light"><i class="bi bi-calendar-event"></i><?= htmlspecialchars($berita['date']) ?></span>
        </div>
        <div class="article-body"><?= nl2br(htmlspecialchars($berita['content'])) ?></div>
    <?php endif; ?>
</div>
