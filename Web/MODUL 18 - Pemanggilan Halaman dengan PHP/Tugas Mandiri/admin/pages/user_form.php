<?php
$aksi = $_GET['aksi'] ?? 'tambah';
$id = (int) ($_GET['id'] ?? 0);
$user = [
    'id' => 0,
    'nama_lengkap' => '',
    'username' => '',
    'role' => 'user',
];

if ($aksi === 'edit') {
    $stmt = $conn->prepare("SELECT id, nama_lengkap, username, role FROM users WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result ? $result->fetch_assoc() : null;
    $stmt->close();

    if (!$data) {
        echo '<div class="panel-card"><div class="alert alert-danger border-0 mb-0">Data user tidak ditemukan.</div></div>';
        return;
    }

    $user = $data;
}
?>
<div class="panel-card">
    <div class="section-head">
        <div>
            <h3><?= $aksi === 'edit' ? 'Edit User' : 'Tambah User' ?></h3>
            <p class="text-secondary mb-0">Isi data akun pengguna di bawah ini.</p>
        </div>
        <a href="index.php?page=user" class="btn btn-outline-secondary rounded-pill">Kembali</a>
    </div>

    <form action="<?= $aksi === 'edit' ? 'aksi/user_update.php' : 'aksi/user_simpan.php' ?>" method="post" class="row g-3">
        <input type="hidden" name="id" value="<?= (int) $user['id'] ?>">
        <div class="col-md-6">
            <label class="form-label fw-semibold">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" required value="<?= htmlspecialchars($user['nama_lengkap']) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">Username</label>
            <input type="text" name="username" class="form-control" required value="<?= htmlspecialchars($user['username']) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">Role</label>
            <select name="role" class="form-select" required>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">Password <?= $aksi === 'edit' ? '<small class="text-secondary">(kosongkan jika tidak diubah)</small>' : '' ?></label>
            <input type="password" name="password" class="form-control" <?= $aksi === 'edit' ? '' : 'required' ?>>
        </div>
        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-brand rounded-pill px-4">
                <i class="bi bi-save me-2"></i>Simpan
            </button>
            <a href="index.php?page=user" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
        </div>
    </form>
</div>
