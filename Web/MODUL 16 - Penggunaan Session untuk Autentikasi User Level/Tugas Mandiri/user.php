<?php
require_once "auth.php";
require_level("user");
require_once "koneksi.php";

$data = mysqli_query($koneksi, "SELECT * FROM tb_siswa ORDER BY nis ASC");
$total_siswa = $data ? mysqli_num_rows($data) : 0;
?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Siswa User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/app.css" />
</head>

<body>
  <div class="page-shell">
    <div class="container">
      <div class="hero-card page-card mb-4">
        <div class="row g-4 align-items-center">
          <div class="col-lg-8">
            <span class="brand-mark">User Dashboard</span>
            <h1 class="display-6 fw-bold mt-4 mb-3">Lihat data siswa</h1>
            <p class="section-intro mb-4">
              Dashboard user read-only
            </p>
            <div class="meta-list">
              <span class="meta-pill">Login: <?php echo htmlspecialchars($_SESSION['username']); ?></span>
              <span class="meta-pill">Role: user</span>
              <span class="meta-pill">Total siswa: <?php echo $total_siswa; ?></span>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="d-flex flex-wrap gap-2 justify-content-lg-end hero-actions">
              <a href="logout.php" class="btn btn-outline-light">Logout</a>
            </div>
          </div>
        </div>
      </div>

      <div class="glass-card page-card">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
          <div>
            <h2 class="h3 fw-bold mb-1">Daftar Data Siswa</h2>
            <p class="small-muted mb-0">Data berikut ditampilkan dari tabel siswa dan hanya bisa dilihat oleh user.</p>
          </div>
          <span class="status-badge"><?php echo $total_siswa; ?> data tersedia</span>
        </div>

        <?php if ($data && mysqli_num_rows($data) > 0) : ?>
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
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php while ($row = mysqli_fetch_assoc($data)) : ?>
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
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        <?php else : ?>
          <div class="empty-state">Belum ada data siswa yang bisa ditampilkan.</div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>

</html>