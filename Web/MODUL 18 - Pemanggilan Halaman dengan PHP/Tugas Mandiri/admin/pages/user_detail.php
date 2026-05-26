<?php
$id = (int) ($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT id, username, nama_lengkap, role FROM users WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result ? $result->fetch_assoc() : null;
$stmt->close();
?>
<div class="panel-card">
    <?php if (!$user): ?>
        <div class="alert alert-danger border-0 mb-0">Data user tidak ditemukan.</div>
    <?php else: ?>
        <div class="section-head">
            <div>
                <h3>Detail User</h3>
                <p class="text-secondary mb-0">Informasi lengkap akun pengguna.</p>
            </div>
            <a href="index.php?page=user" class="btn btn-outline-secondary rounded-pill">Kembali</a>
        </div>

        <div class="detail-grid">
            <div class="detail-item">
                <span>ID</span>
                <strong><?= (int) $user['id'] ?></strong>
            </div>
            <div class="detail-item">
                <span>Nama Lengkap</span>
                <strong><?= htmlspecialchars($user['nama_lengkap']) ?></strong>
            </div>
            <div class="detail-item">
                <span>Username</span>
                <strong><?= htmlspecialchars($user['username']) ?></strong>
            </div>
            <div class="detail-item">
                <span>Role</span>
                <strong><?= htmlspecialchars($user['role']) ?></strong>
            </div>
        </div>
    <?php endif; ?>
</div>
