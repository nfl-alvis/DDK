<?php
require_once "auth.php";
require_login();   // ← semua user yang sudah login
include "koneksi.php";

$id  = (int)($_GET['id'] ?? 0);
$res = $conn->query("SELECT * FROM news WHERE id = $id LIMIT 1");
if (!$res || $res->num_rows === 0) {
    echo '<div class="container mt-5"><div class="alert alert-danger">Berita tidak ditemukan.</div><a href="tampil_user.php" class="btn btn-secondary">Kembali</a></div>';
    exit;
}
$row = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($row['title']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;400i&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f4f6fb;
            font-family: 'DM Sans', sans-serif
        }

        .navbar {
            background: linear-gradient(135deg, #1a1a2e, #0f3460)
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: #fff !important
        }

        .navbar-brand span {
            color: #e94560
        }

        .role-badge {
            background: rgba(100, 200, 255, .15);
            color: #7ecfff;
            border: 1px solid rgba(100, 200, 255, .3);
            border-radius: 20px;
            padding: 3px 12px;
            font-size: .8rem;
            font-weight: 600
        }

        .user-info {
            background: rgba(255, 255, 255, .1);
            color: #fff;
            border-radius: 20px;
            padding: 3px 12px;
            font-size: .85rem
        }

        .hero-img {
            width: 100%;
            max-height: 430px;
            object-fit: cover;
            border-radius: 14px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, .14);
            margin-bottom: 32px
        }

        .article-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.1rem;
            color: #1a1a2e;
            line-height: 1.3
        }

        .meta-badge {
            background: #f0f2f8;
            color: #0f3460;
            border-radius: 20px;
            padding: 5px 14px;
            font-size: .83rem;
            font-weight: 500
        }

        .article-body {
            font-size: 1.06rem;
            line-height: 1.9;
            color: #3a3a3a;
            white-space: pre-line
        }

        .card-article {
            border: none;
            border-radius: 14px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, .08);
            padding: 40px;
            background: #fff
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="tampil_user.php">Portal<span>Berita</span></a>
            <div class="ms-auto d-flex align-items-center gap-3">
                <span class="user-info"><i class="bi bi-person-circle me-1"></i><?= htmlspecialchars($_SESSION['nama_lengkap']) ?></span>
                <span class="role-badge"><i class="bi bi-person me-1"></i>User</span>
                <a href="logout.php" class="btn btn-sm btn-outline-light rounded-pill px-3">
                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <a href="tampil_user.php" class="btn btn-sm btn-outline-secondary rounded-pill mb-4">
                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar
                </a>
                <div class="card-article">
                    <img src="upload/<?= htmlspecialchars($row['image']) ?>" class="hero-img" alt="">
                    <h1 class="article-title mb-3"><?= htmlspecialchars($row['title']) ?></h1>
                    <div class="d-flex gap-2 flex-wrap mb-4">
                        <span class="meta-badge"><i class="bi bi-person me-1"></i><?= htmlspecialchars($row['author']) ?></span>
                        <span class="meta-badge"><i class="bi bi-calendar me-1"></i><?= $row['date'] ?></span>
                    </div>
                    <hr>
                    <div class="article-body"><?= htmlspecialchars($row['content']) ?></div>
                </div>
                <!-- Tidak ada tombol Edit / Hapus untuk user biasa -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>