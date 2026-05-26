<?php
$result = $conn->query("SELECT id, title, content, author, image, date FROM news ORDER BY id DESC");
?>
<div class="panel-card">
    <div class="section-head">
        <div>
            <h3>Menu Berita</h3>
            <p class="text-secondary mb-0">Daftar berita yang ditampilkan dalam portal.</p>
        </div>
        <?php if (is_admin()): ?>
            <a href="index.php?page=berita_form&aksi=tambah" class="btn btn-brand rounded-pill">
                <i class="bi bi-plus-circle me-2"></i>Tambah Berita
            </a>
        <?php endif; ?>
    </div>

    <div class="table-responsive">
        <table class="table align-middle table-modern">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Author</th>
                    <th>Tanggal</th>
                    <th>Gambar</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php $no = 1; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <div class="fw-semibold"><?= htmlspecialchars($row['title']) ?></div>
                                <small class="text-secondary"><?= htmlspecialchars(mb_strimwidth($row['content'], 0, 80, '...')) ?></small>
                            </td>
                            <td><?= htmlspecialchars($row['author']) ?></td>
                            <td><?= htmlspecialchars($row['date']) ?></td>
                            <td>
                                <?php if (!empty($row['image'])): ?>
                                    <img src="upload/<?= htmlspecialchars($row['image']) ?>" class="table-thumb" alt="<?= htmlspecialchars($row['title']) ?>">
                                <?php else: ?>
                                    <span class="text-secondary">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <a href="index.php?page=berita_detail&id=<?= (int) $row['id'] ?>" class="btn btn-sm btn-outline-primary rounded-pill">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <?php if (is_admin()): ?>
                                    <a href="index.php?page=berita_form&aksi=edit&id=<?= (int) $row['id'] ?>" class="btn btn-sm btn-outline-warning rounded-pill">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="aksi/berita_hapus.php?id=<?= (int) $row['id'] ?>" class="btn btn-sm btn-outline-danger rounded-pill" onclick="return confirm('Hapus berita ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-secondary py-4">Belum ada berita.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
