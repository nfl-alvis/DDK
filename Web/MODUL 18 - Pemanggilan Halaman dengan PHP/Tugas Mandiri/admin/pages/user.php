<?php
$result = $conn->query("SELECT id, username, nama_lengkap, role FROM users ORDER BY id DESC");
?>
<div class="panel-card">
    <div class="section-head">
        <div>
            <h3>Menu User</h3>
            <p class="text-secondary mb-0">Daftar akun yang dapat login ke sistem.</p>
        </div>
        <?php if (is_admin()): ?>
            <a href="index.php?page=user_form&aksi=tambah" class="btn btn-brand rounded-pill">
                <i class="bi bi-plus-circle me-2"></i>Tambah User
            </a>
        <?php endif; ?>
    </div>

    <div class="table-responsive">
        <table class="table align-middle table-modern">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php $no = 1; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="fw-semibold"><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td>
                                <span class="badge rounded-pill text-bg-<?= $row['role'] === 'admin' ? 'danger' : 'primary' ?>">
                                    <?= htmlspecialchars($row['role']) ?>
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="index.php?page=user_detail&id=<?= (int) $row['id'] ?>" class="btn btn-sm btn-outline-primary rounded-pill">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <?php if (is_admin()): ?>
                                    <a href="index.php?page=user_form&aksi=edit&id=<?= (int) $row['id'] ?>" class="btn btn-sm btn-outline-warning rounded-pill">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="aksi/user_hapus.php?id=<?= (int) $row['id'] ?>" class="btn btn-sm btn-outline-danger rounded-pill" onclick="return confirm('Hapus user ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-secondary py-4">Belum ada data user.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
