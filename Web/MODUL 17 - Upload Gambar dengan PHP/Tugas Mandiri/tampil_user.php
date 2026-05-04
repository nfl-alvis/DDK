<?php
require_once "auth.php";
require_login();   // ← semua user yang sudah login (termasuk user biasa)
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Terkini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
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

        .news-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 2px 14px rgba(0, 0, 0, .07);
            overflow: hidden;
            transition: transform .2s, box-shadow .2s
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, .13)
        }

        .news-card img {
            width: 100%;
            height: 190px;
            object-fit: cover
        }

        .card-title-text {
            font-weight: 700;
            font-size: 1rem;
            color: #1a1a2e
        }

        .card-excerpt {
            color: #6c757d;
            font-size: .87rem;
            line-height: 1.6
        }

        .card-meta {
            font-size: .78rem;
            color: #adb5bd;
            display: flex;
            justify-content: space-between;
            margin-top: 12px;
            padding-top: 10px;
            border-top: 1px solid #f0f0f0
        }

        .btn-read {
            display: inline-block;
            margin-top: 12px;
            background: linear-gradient(135deg, #1a1a2e, #0f3460);
            color: #fff;
            border-radius: 8px;
            padding: 7px 18px;
            font-size: .84rem;
            font-weight: 600;
            text-decoration: none;
            transition: opacity .2s
        }

        .btn-read:hover {
            opacity: .85;
            color: #fff
        }

        .page-heading {
            font-family: 'Playfair Display', serif;
            font-size: 1.9rem;
            color: #1a1a2e
        }

        .info-banner {
            background: #e8f4ff;
            border-left: 4px solid #0f3460;
            border-radius: 8px;
            padding: 10px 18px;
            font-size: .88rem;
            color: #0f3460
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

    <div class="container py-4">
        <div class="mb-4">
            <h4 class="page-heading mb-1"><i class="bi bi-newspaper me-2"></i>Berita Terkini</h4>
            <div class="info-banner mt-3">
                <i class="bi bi-info-circle me-2"></i>
                Anda login sebagai <strong>User</strong>. Hanya dapat membaca berita — tidak bisa menambah, mengedit, atau menghapus.
            </div>
        </div>

        <?php
        $sql    = "SELECT * FROM news ORDER BY id DESC";
        $result = $conn->query($sql);
        ?>

        <?php if ($result && $result->num_rows > 0): ?>
            <div class="row g-4 pb-5">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="news-card card h-100">
                            <img src="upload/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                            <div class="card-body d-flex flex-column p-3">
                                <div class="card-title-text"><?= htmlspecialchars($row['title']) ?></div>
                                <p class="card-excerpt flex-grow-1 mt-2"><?= htmlspecialchars(substr($row['content'], 0, 100)) ?>...</p>
                                <a href="detail_user.php?id=<?= $row['id'] ?>" class="btn-read">
                                    <i class="bi bi-eye me-1"></i>Baca Selengkapnya
                                </a>
                                <div class="card-meta">
                                    <span><i class="bi bi-person me-1"></i><?= htmlspecialchars($row['author']) ?></span>
                                    <span><i class="bi bi-calendar me-1"></i><?= $row['date'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-inbox display-3"></i>
                <p class="mt-3">Belum ada berita tersedia.</p>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>