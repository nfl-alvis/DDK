<?php
require_once "auth.php";
require_level("admin");
?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Pendaftaran Ekskul</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/app.css" />
</head>

<body>
  <div class="page-shell">
    <div class="container">
      <div class="hero-card page-card mb-4">
        <div class="row g-4 align-items-center">
          <div class="col-lg-8">
            <span class="brand-mark">Panel Admin</span>
            <h1 class="display-6 fw-bold mt-4 mb-3">Tambah data siswa untuk pendaftaran ekstrakurikuler.</h1>
            <p class="section-intro mb-4">
              Isi data siswa secara lengkap
            </p>
            <div class="meta-list">
              <span class="meta-pill">Login: <?php echo htmlspecialchars($_SESSION['username']); ?></span>
              <span class="meta-pill">Role: admin</span>
              <span class="meta-pill">Input Terstruktur</span>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="d-flex flex-wrap gap-2 justify-content-lg-end hero-actions">
              <a href="edit_siswa.php" class="btn btn-light">Kembali ke Data</a>
              <a href="logout.php" class="btn btn-outline-light">Logout</a>
            </div>
          </div>
        </div>
      </div>

      <div class="glass-card page-card">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
          <div>
            <h2 class="h3 fw-bold mb-1">Form Pendaftaran Ekskul</h2>
            <p class="small-muted mb-0">Semua field penting sudah disusun agar lebih cepat diisi.</p>
          </div>
          <span class="status-badge">* Wajib diisi</span>
        </div>

        <form method="post" action="simpan_siswa.php" class="row g-4">
          <div class="col-md-6">
            <label for="nis" class="form-label">NIS</label>
            <input type="text" name="nis" id="nis" class="form-control" required />
          </div>

          <div class="col-md-6">
            <label for="nama" class="form-label">Nama Siswa</label>
            <input type="text" name="nama" id="nama" class="form-control" required />
          </div>

          <div class="col-md-6">
            <label for="kelas" class="form-label">Kelas</label>
            <select name="kelas" id="kelas" class="form-select" required>
              <option value="X">X</option>
              <option value="XI">XI</option>
              <option value="XII">XII</option>
            </select>
          </div>

          <div class="col-md-6">
            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required />
          </div>

          <div class="col-12">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control" required></textarea>
          </div>

          <div class="col-md-6">
            <label for="kota" class="form-label">Kota</label>
            <input type="text" name="kota" id="kota" class="form-control" required />
          </div>

          <div class="col-md-6">
            <label class="form-label d-block">Jenis Kelamin</label>
            <div class="checkbox-grid">
              <label class="choice-card">
                <input type="radio" name="jenis_kelamin" value="Laki-laki" class="form-check-input" required />
                <div>
                  <span class="fw-semibold d-block">Laki-laki</span>
                  <small class="text-secondary">Pilih untuk siswa laki-laki</small>
                </div>
              </label>
              <label class="choice-card">
                <input type="radio" name="jenis_kelamin" value="Perempuan" class="form-check-input" required />
                <div>
                  <span class="fw-semibold d-block">Perempuan</span>
                  <small class="text-secondary">Pilih untuk siswa perempuan</small>
                </div>
              </label>
            </div>
          </div>

          <div class="col-12">
            <label class="form-label d-block">Hobi</label>
            <div class="checkbox-grid">
              <label class="choice-card">
                <input type="checkbox" name="hobby[]" value="Membaca" id="h1" class="form-check-input" />
                <div>
                  <span class="fw-semibold d-block">Membaca</span>
                  <small class="text-secondary">Minat literasi dan bacaan</small>
                </div>
              </label>
              <label class="choice-card">
                <input type="checkbox" name="hobby[]" value="Olahraga" id="h2" class="form-check-input" />
                <div>
                  <span class="fw-semibold d-block">Olahraga</span>
                  <small class="text-secondary">Aktivitas fisik dan kebugaran</small>
                </div>
              </label>
              <label class="choice-card">
                <input type="checkbox" name="hobby[]" value="Musik" id="h3" class="form-check-input" />
                <div>
                  <span class="fw-semibold d-block">Musik</span>
                  <small class="text-secondary">Minat seni dan instrumen</small>
                </div>
              </label>
            </div>
          </div>

          <div class="col-12">
            <label for="ekskul" class="form-label">Pilihan Ekskul</label>
            <select name="ekskul[]" id="ekskul" class="form-select multi-select" multiple required>
              <option value="Paskibra">Paskibra</option>
              <option value="PMR">PMR</option>
              <option value="Pramuka">Pramuka</option>
            </select>
            <div class="table-note mt-2">Gunakan tombol `Ctrl` atau `Cmd` untuk memilih lebih dari satu ekskul.</div>
          </div>

          <div class="col-12 d-flex flex-column flex-sm-row justify-content-end gap-2 pt-2">
            <a href="edit_siswa.php" class="btn btn-outline-secondary btn-ghost">Batal</a>
            <button type="reset" class="btn btn-outline-secondary btn-ghost">Reset</button>
            <button type="submit" class="btn btn-brand">Simpan Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>