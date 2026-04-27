<?php
require_once "auth.php";
require_level("admin");
require_once "koneksi.php";

$pesan = "";
$alert_class = "alert-success";
$kode_pesan = $_GET['pesan'] ?? "";

switch ($kode_pesan) {
  case "tambah-berhasil":
    $pesan = "Data siswa berhasil ditambahkan.";
    break;
  case "update-berhasil":
    $pesan = "Data siswa berhasil diupdate.";
    break;
  case "hapus-berhasil":
    $pesan = "Data siswa berhasil dihapus.";
    break;
}

$nis_lama = trim($_GET['nis'] ?? "");
$data_edit = null;
$info_edit = "";

if ($nis_lama !== "") {
  $query = mysqli_prepare($koneksi, "SELECT * FROM tb_siswa WHERE nis = ?");
  mysqli_stmt_bind_param($query, "s", $nis_lama);
  mysqli_stmt_execute($query);
  $result = mysqli_stmt_get_result($query);
  $data_edit = $result ? mysqli_fetch_assoc($result) : null;
  mysqli_stmt_close($query);

  if (!$data_edit) {
    $info_edit = "Data siswa yang ingin diedit tidak ditemukan.";
  }
}

$data_siswa = mysqli_query($koneksi, "SELECT * FROM tb_siswa ORDER BY nis ASC");
$total_siswa = $data_siswa ? mysqli_num_rows($data_siswa) : 0;
$kelas_options = ["X", "XI", "XII"];
?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Data Siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/app.css" />
</head>

<body>
  <div class="page-shell">
    <div class="container">
      <div class="hero-card page-card mb-4">
        <div class="row g-4 align-items-center">
          <div class="col-lg-8">
            <span class="brand-mark">Admin Dashboard</span>
            <h1 class="display-6 fw-bold mt-4 mb-3">Kelola data siswa.</h1>
            <p class="section-intro mb-4">
              Tambah, edit, dan hapus data siswa.
            </p>
            <div class="meta-list">
              <span class="meta-pill">Login: <?php echo htmlspecialchars($_SESSION['username']); ?></span>
              <span class="meta-pill">Role: admin</span>
              <span class="meta-pill">Total siswa: <?php echo $total_siswa; ?></span>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="d-flex flex-wrap gap-2 justify-content-lg-end hero-actions">
              <a href="Form_Ekskul.php" class="btn btn-light">Tambah Data</a>
              <a href="logout.php" class="btn btn-outline-light">Logout</a>
            </div>
          </div>
        </div>
      </div>

      <?php if ($pesan !== "") : ?>
        <div class="alert <?php echo $alert_class; ?> border-0 shadow-sm info-card mb-4" role="alert">
          <?php echo htmlspecialchars($pesan); ?>
        </div>
      <?php endif; ?>

      <?php if ($info_edit !== "") : ?>
        <div class="alert alert-warning border-0 shadow-sm info-card mb-4" role="alert">
          <?php echo htmlspecialchars($info_edit); ?>
        </div>
      <?php endif; ?>

      <?php if ($data_edit) : ?>
        <div class="glass-card page-card mb-4">
          <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
            <div>
              <h2 class="h3 fw-bold mb-1">Edit Data Siswa</h2>
              <p class="small-muted mb-0">Perbarui data siswa tanpa mengubah alur penyimpanan yang sudah ada.</p>
            </div>
            <span class="status-badge">NIS aktif: <?php echo htmlspecialchars($data_edit['nis']); ?></span>
          </div>

          <form action="update_siswa.php" method="post" class="row g-4">
            <input type="hidden" name="nis_lama" value="<?php echo htmlspecialchars($data_edit['nis']); ?>" />

            <div class="col-md-6">
              <label for="nis" class="form-label">NIS</label>
              <input
                type="text"
                name="nis"
                id="nis"
                class="form-control"
                value="<?php echo htmlspecialchars($data_edit['nis']); ?>"
                required />
            </div>

            <div class="col-md-6">
              <label for="nama" class="form-label">Nama Siswa</label>
              <input
                type="text"
                name="nama"
                id="nama"
                class="form-control"
                value="<?php echo htmlspecialchars($data_edit['nama']); ?>"
                required />
            </div>

            <div class="col-md-6">
              <label for="kelas" class="form-label">Kelas</label>
              <select name="kelas" id="kelas" class="form-select" required>
                <?php foreach ($kelas_options as $kelas_option) : ?>
                  <option value="<?php echo $kelas_option; ?>" <?php echo $data_edit['kelas'] === $kelas_option ? 'selected' : ''; ?>>
                    <?php echo $kelas_option; ?>
                  </option>
                <?php endforeach; ?>
                <?php if (!in_array($data_edit['kelas'], $kelas_options, true)) : ?>
                  <option value="<?php echo htmlspecialchars($data_edit['kelas']); ?>" selected>
                    <?php echo htmlspecialchars($data_edit['kelas']); ?>
                  </option>
                <?php endif; ?>
              </select>
            </div>

            <div class="col-md-6">
              <label for="ttl" class="form-label">Tanggal Lahir</label>
              <input
                type="date"
                name="ttl"
                id="ttl"
                class="form-control"
                value="<?php echo htmlspecialchars($data_edit['ttl']); ?>"
                required />
            </div>

            <div class="col-12">
              <label for="alamat" class="form-label">Alamat</label>
              <textarea name="alamat" id="alamat" class="form-control" required><?php echo htmlspecialchars($data_edit['alamat']); ?></textarea>
            </div>

            <div class="col-md-6">
              <label for="kota" class="form-label">Kota</label>
              <input
                type="text"
                name="kota"
                id="kota"
                class="form-control"
                value="<?php echo htmlspecialchars($data_edit['kota']); ?>"
                required />
            </div>

            <div class="col-md-6">
              <label class="form-label d-block">Jenis Kelamin</label>
              <div class="checkbox-grid">
                <label class="choice-card">
                  <input
                    type="radio"
                    name="jk"
                    value="L"
                    class="form-check-input"
                    <?php echo $data_edit['jk'] === 'L' ? 'checked' : ''; ?>
                    required />
                  <div>
                    <span class="fw-semibold d-block">Laki-laki</span>
                    <small class="text-secondary">Kode L</small>
                  </div>
                </label>
                <label class="choice-card">
                  <input
                    type="radio"
                    name="jk"
                    value="P"
                    class="form-check-input"
                    <?php echo $data_edit['jk'] === 'P' ? 'checked' : ''; ?>
                    required />
                  <div>
                    <span class="fw-semibold d-block">Perempuan</span>
                    <small class="text-secondary">Kode P</small>
                  </div>
                </label>
              </div>
            </div>

            <div class="col-md-6">
              <label for="hobi" class="form-label">Hobi</label>
              <input
                type="text"
                name="hobi"
                id="hobi"
                class="form-control"
                value="<?php echo htmlspecialchars($data_edit['hobi']); ?>"
                required />
            </div>

            <div class="col-md-6">
              <label for="ekskul" class="form-label">Ekskul</label>
              <input
                type="text"
                name="ekskul"
                id="ekskul"
                class="form-control"
                value="<?php echo htmlspecialchars($data_edit['ekskul']); ?>"
                required />
            </div>

            <div class="col-12 d-flex flex-column flex-sm-row justify-content-end gap-2 pt-2">
              <a href="edit_siswa.php" class="btn btn-outline-secondary btn-ghost">Batal</a>
              <button type="submit" class="btn btn-brand">Update Data</button>
            </div>
          </form>
        </div>
      <?php endif; ?>

      <div class="glass-card page-card">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
          <div>
            <h2 class="h3 fw-bold mb-1">Daftar Siswa</h2>
            <p class="small-muted mb-0">Seluruh data siswa yang tersimpan di database ditampilkan di bawah ini.</p>
          </div>
          <div class="d-flex flex-wrap gap-2">
            <span class="status-badge"><?php echo $total_siswa; ?> data siswa</span>
            <a href="Form_Ekskul.php" class="btn btn-brand">Tambah Baru</a>
          </div>
        </div>

        <?php if ($data_siswa && mysqli_num_rows($data_siswa) > 0) : ?>
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>TTL</th>
                  <th>Alamat</th>
                  <th>Kota</th>
                  <th>JK</th>
                  <th>Hobi</th>
                  <th>Ekskul</th>
                  <th class="table-actions">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php while ($row = mysqli_fetch_assoc($data_siswa)) : ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><span class="fw-semibold"><?php echo htmlspecialchars($row['nis']); ?></span></td>
                    <td><?php echo htmlspecialchars($row['nama']); ?></td>
                    <td><span class="badge rounded-pill text-bg-light border"><?php echo htmlspecialchars($row['kelas']); ?></span></td>
                    <td><?php echo htmlspecialchars($row['ttl']); ?></td>
                    <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                    <td><?php echo htmlspecialchars($row['kota']); ?></td>
                    <td>
                      <?php if ($row['jk'] === 'L') : ?>
                        <span class="badge text-bg-primary">Laki-laki</span>
                      <?php else : ?>
                        <span class="badge text-bg-danger">Perempuan</span>
                      <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['hobi']); ?></td>
                    <td><?php echo htmlspecialchars($row['ekskul']); ?></td>
                    <td class="table-actions">
                      <div class="d-flex flex-column gap-2">
                        <a href="edit_siswa.php?nis=<?php echo urlencode($row['nis']); ?>" class="btn btn-sm btn-outline-primary">
                          Edit
                        </a>
                        <a
                          href="hapus_siswa.php?nis=<?php echo urlencode($row['nis']); ?>"
                          class="btn btn-sm btn-outline-danger"
                          onclick="return confirm('Hapus data ini?')">
                          Hapus
                        </a>
                      </div>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        <?php else : ?>
          <div class="empty-state">
            Belum ada data siswa. Klik tombol <strong>Tambah Baru</strong> untuk mulai mengisi data.
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>

</html>