<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Portal Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a1a2e;
            --accent: #e94560;
            --accent2: #0f3460;
            --card-bg: #ffffff;
            --text: #1a1a2e;
            --muted: #6c757d;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            background: var(--primary);
            overflow: hidden;
        }

        /* ── Left Panel ── */
        .left-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            position: relative;
            background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 60%, #16213e 100%);
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(233, 69, 96, 0.18) 0%, transparent 70%);
            top: -100px;
            left: -100px;
            animation: pulse 6s ease-in-out infinite;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(15, 52, 96, 0.4) 0%, transparent 70%);
            bottom: -80px;
            right: -80px;
            animation: pulse 8s ease-in-out infinite reverse;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.7;
            }

            50% {
                transform: scale(1.15);
                opacity: 1;
            }
        }

        .brand-logo {
            font-family: 'Playfair Display', serif;
            font-size: 2.4rem;
            color: #fff;
            letter-spacing: -1px;
            position: relative;
            z-index: 2;
            margin-bottom: 8px;
        }

        .brand-logo span {
            color: var(--accent);
        }

        .tagline {
            color: rgba(255, 255, 255, 0.55);
            font-size: 1rem;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 2;
            margin-bottom: 60px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 24px;
            position: relative;
            z-index: 2;
            animation: fadeUp 0.6s ease both;
        }

        .feature-item:nth-child(1) {
            animation-delay: 0.1s;
        }

        .feature-item:nth-child(2) {
            animation-delay: 0.2s;
        }

        .feature-item:nth-child(3) {
            animation-delay: 0.3s;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .feature-icon {
            width: 44px;
            height: 44px;
            background: rgba(233, 69, 96, 0.15);
            border: 1px solid rgba(233, 69, 96, 0.3);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .feature-text strong {
            display: block;
            color: #fff;
            font-size: 0.95rem;
            font-weight: 600;
        }

        .feature-text span {
            color: rgba(255, 255, 255, 0.45);
            font-size: 0.82rem;
        }

        /* ── Right Panel (Form) ── */
        .right-panel {
            width: 480px;
            flex-shrink: 0;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px 50px;
            position: relative;
        }

        .login-box {
            width: 100%;
            animation: fadeUp 0.5s ease both 0.1s;
        }

        .login-box h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 6px;
        }

        .login-box .subtitle {
            color: var(--muted);
            font-size: 0.9rem;
            margin-bottom: 36px;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--primary);
            letter-spacing: 0.3px;
        }

        .form-control {
            border: 1.5px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-family: 'DM Sans', sans-serif;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(233, 69, 96, 0.12);
            outline: none;
        }

        .input-group .form-control {
            border-right: none;
            border-radius: 10px 0 0 10px;
        }

        .input-group .btn-outline-secondary {
            border: 1.5px solid #e0e0e0;
            border-left: none;
            border-radius: 0 10px 10px 0;
            background: #f8f9fa;
            color: var(--muted);
            transition: all 0.2s;
        }

        .input-group .btn-outline-secondary:hover {
            background: #e9ecef;
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, var(--accent), #c0392b);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 0.5px;
            font-family: 'DM Sans', sans-serif;
            transition: opacity 0.2s, transform 0.1s;
            margin-top: 8px;
        }

        .btn-login:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert-login {
            border-radius: 10px;
            font-size: 0.9rem;
            border: none;
            background: #fff0f3;
            color: var(--accent);
            border-left: 4px solid var(--accent);
        }

        .demo-accounts {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 14px 18px;
            margin-top: 24px;
            font-size: 0.82rem;
            color: var(--muted);
        }

        .demo-accounts strong {
            color: var(--primary);
            display: block;
            margin-bottom: 6px;
        }

        .demo-row {
            display: flex;
            justify-content: space-between;
            padding: 3px 0;
        }

        .demo-badge {
            display: inline-block;
            padding: 1px 8px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-admin {
            background: rgba(233, 69, 96, 0.1);
            color: var(--accent);
        }

        .badge-user {
            background: rgba(15, 52, 96, 0.1);
            color: var(--accent2);
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
                overflow: auto;
            }

            .left-panel {
                padding: 40px 30px;
                min-height: auto;
            }

            .brand-logo {
                font-size: 1.8rem;
            }

            .right-panel {
                width: 100%;
                padding: 40px 30px;
            }

            .feature-item {
                margin-bottom: 16px;
            }
        }
    </style>
</head>

<body>

    <?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        header("Location: tampil.php");
        exit;
    }
    $error = $_GET['error'] ?? '';
    ?>

    <!-- Left decorative panel -->
    <div class="left-panel">
        <div class="brand-logo">Portal<span>Berita</span></div>
        <p class="tagline">Sistem Manajemen Berita Terpadu</p>

        <div class="feature-item">
            <div class="feature-icon"><i class="bi bi-shield-lock"></i></div>
            <div class="feature-text">
                <strong>Akses Terproteksi</strong>
                <span>Login wajib untuk mengelola konten</span>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><i class="bi bi-person-badge"></i></div>
            <div class="feature-text">
                <strong>2 Level Pengguna</strong>
                <span>Admin dengan akses penuh, User hanya baca</span>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><i class="bi bi-newspaper"></i></div>
            <div class="feature-text">
                <strong>Manajemen Berita</strong>
                <span>Upload, edit, dan hapus konten berita</span>
            </div>
        </div>
    </div>

    <!-- Right form panel -->
    <div class="right-panel">
        <div class="login-box">
            <h2>Selamat Datang</h2>
            <p class="subtitle">Masuk untuk melanjutkan ke Portal Berita</p>

            <?php if ($error === 'invalid'): ?>
                <div class="alert alert-login mb-3" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>Username atau password salah.
                </div>
            <?php elseif ($error === 'unauthorized'): ?>
                <div class="alert alert-login mb-3" role="alert">
                    <i class="bi bi-lock me-2"></i>Anda harus login terlebih dahulu.
                </div>
            <?php elseif ($error === 'forbidden'): ?>
                <div class="alert alert-login mb-3" role="alert">
                    <i class="bi bi-ban me-2"></i>Akses ditolak. Hanya admin yang dapat melakukan tindakan ini.
                </div>
            <?php endif; ?>

            <form action="proses_login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="passwordInput" class="form-control" placeholder="Masukkan password" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePass" tabindex="-1">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                </button>
            </form>

            <div class="demo-accounts">
                <strong><i class="bi bi-info-circle me-1"></i>Akun Demo</strong>
                <div class="demo-row">
                    <span><span class="demo-badge badge-admin">admin</span> admin / <code>admin123</code></span>
                    <span>Akses penuh</span>
                </div>
                <div class="demo-row">
                    <span><span class="demo-badge badge-user">user</span> user1 / <code>user123</code></span>
                    <span>Hanya baca</span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePass').addEventListener('click', function() {
            const inp = document.getElementById('passwordInput');
            const icon = document.getElementById('eyeIcon');
            if (inp.type === 'password') {
                inp.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                inp.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        });
    </script>
</body>

</html>