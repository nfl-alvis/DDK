<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .card-header { background: linear-gradient(135deg, #0d6efd, #0dcaf0); border-radius: 12px 12px 0 0 !important; }
        .btn-primary { background: linear-gradient(135deg, #0d6efd, #0dcaf0); border: none; }
        .btn-primary:hover { opacity: 0.9; }
        #image-preview { max-width: 200px; max-height: 200px; border-radius: 8px; display: none; margin-top: 10px; }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header py-3">
                    <h5 class="mb-0 text-white"><i class="bi bi-newspaper me-2"></i>Tambah Berita</h5>
                </div>
                <div class="card-body p-4">
                    <form action="proses_upload.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Judul Berita</label>
                            <input type="text" name="title" class="form-control" placeholder="Masukkan judul berita..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Konten</label>
                            <textarea name="content" class="form-control" rows="5" placeholder="Tulis konten berita di sini..." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Author</label>
                            <input type="text" name="author" class="form-control" placeholder="Nama penulis..." required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Gambar</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required id="imageInput">
                            <img id="image-preview" src="#" alt="Preview Gambar">
                            <div class="form-text">Format yang didukung: JPG, JPEG, PNG, GIF</div>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-cloud-upload me-1"></i> Upload Berita
                            </button>
                            <a href="tampil.php" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const preview = document.getElementById('image-preview');
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                preview.src = ev.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
</body>
</html>