<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Primary Meta Tags -->
    <meta name="title" content="<?= $title; ?>">
    <meta name="description" content="Saqoe adalah aplikasi web inovatif untuk melacak, mengelola, dan menganalisa keuangan harian serta event Anda dengan mudah.">
    <meta name="keywords" content="Saqoe, manajemen keuangan, dompet digital, pencatat pengeluaran, aplikasi mahasiswa, finance tracker">
    <meta name="author" content="Faisal Ridwan - qreatip.com">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= base_url(); ?>">
    <meta property="og:title" content="<?= $title; ?>">
    <meta property="og:description" content="Saqoe adalah aplikasi web inovatif untuk melacak, mengelola, dan menganalisa keuangan harian serta event Anda dengan mudah.">
    <meta property="og:image" content="<?= base_url('assets/img/logotok.png'); ?>">

    <title><?= $title; ?></title>

    <!-- Favicon -->
    <link rel="icon" href="<?= base_url('assets/img/logotok.png'); ?>" type="image/png">
    <link rel="apple-touch-icon" href="<?= base_url('assets/img/logotok.png'); ?>">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    
    <!-- Custom Global CSS -->
    <link href="<?= base_url('assets/'); ?>css/custom.css" rel="stylesheet">
    
    <style>
        /* Additional Landing Page Sections Enhancements */
        .dev-section {
            background-color: #f8f9fc;
        }
        .cta-section {
            background: linear-gradient(135deg, #224abe 0%, #4e73df 100%);
            color: white;
        }
        .github-link, .domain-link {
            transition: all 0.3s ease;
        }
        .github-link:hover, .domain-link:hover {
            opacity: 0.8;
            transform: translateY(-3px);
            text-decoration: none;
        }
        .adv-feature-card {
            border-left: 4px solid #4e73df;
            padding-left: 1.5rem;
            margin-bottom: 2rem;
        }
    </style>
</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#page-top">
                <img src="<?= base_url('assets/img/logotok.png'); ?>" alt="Saqoe Logo">
                SAQOE
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-2">
                        <a class="nav-link font-weight-bold" href="#features">Fitur Utama</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link font-weight-bold" href="#advanced">Kapabilitas</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link font-weight-bold" href="#developer">Developer</a>
                    </li>
                    <?php if(isset($is_logged_in) && $is_logged_in): ?>
                    <li class="nav-item mx-2">
                        <a class="nav-link font-weight-bold" href="<?= base_url('user'); ?>">Dashboard (<?= $user['name'] ?>)</a>
                    </li>
                    <li class="nav-item mx-2 mt-2 mt-lg-0">
                        <a class="btn btn-light btn-sm font-weight-bold text-danger rounded-pill px-4 py-2" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item mx-2">
                        <a class="nav-link font-weight-bold" href="<?= base_url('auth'); ?>">Login</a>
                    </li>
                    <li class="nav-item mx-2 mt-2 mt-lg-0">
                        <a class="btn btn-light btn-sm font-weight-bold text-primary rounded-pill px-4 py-2" href="<?= base_url('auth/registration'); ?>">Daftar Gratis</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- SECTION 1: Hero Section -->
    <header class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-9 col-lg-10">
                    <img src="<?= base_url('assets/img/logotok.png'); ?>" alt="Saqoe Logo" width="120" class="mb-4 shadow-sm rounded-circle bg-white p-2">
                    <h1 class="hero-title">Kendalikan Keuanganmu<br>Wujudkan Mimpimu.</h1>
                    <p class="hero-subtitle">Saqoe adalah platform pencatatan keuangan cerdas yang didesain khusus untuk melacak pengeluaran harian, multi-dompet, transaksi rutin, dan mengatur budget event Anda dengan sangat mudah, presisi, dan elegan.</p>
                    <div class="d-flex justify-content-center flex-wrap gap-3 mt-4">
                        <?php if(isset($is_logged_in) && $is_logged_in): ?>
                        <a href="<?= base_url('user'); ?>" class="btn-custom-light mx-2 mb-3 shadow">Lanjutkan ke Dashboard</a>
                        <?php else: ?>
                        <a href="<?= base_url('auth/registration'); ?>" class="btn-custom-light mx-2 mb-3 shadow">Mulai Sekarang</a>
                        <a href="<?= base_url('auth'); ?>" class="btn-custom-outline mx-2 mb-3">Login Akun</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- SECTION 2: Key Features -->
    <section id="features" class="py-5 bg-white border-bottom">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="font-weight-bold text-gray-900">Mengapa Memilih Saqoe?</h2>
                <p class="text-muted">Fitur esensial yang kami hadirkan untuk memudahkan hidup Anda.</p>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="feature-box text-center">
                        <i class="fas fa-chart-pie feature-icon"></i>
                        <h4 class="font-weight-bold text-gray-900 mb-3">Analitik Dashboard Dinamis</h4>
                        <p class="text-muted mb-0">Visualisasi instan arus kas Anda melalui grafik dan chart persentase interaktif. Pantau kebiasaan pengeluaran Anda hanya dengan satu pandangan.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="feature-box text-center">
                        <i class="fas fa-wallet feature-icon"></i>
                        <h4 class="font-weight-bold text-gray-900 mb-3">Manajemen Harian Presisi</h4>
                        <p class="text-muted mb-0">Catat setiap pemasukan dan pengeluaran harian. Setiap data dapat ditelusuri di tabel riwayat cerdas berbasis DataTables untuk pencarian instan.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="feature-box text-center">
                        <i class="fas fa-calendar-check feature-icon"></i>
                        <h4 class="font-weight-bold text-gray-900 mb-3">Manajemen Event Spesifik</h4>
                        <p class="text-muted mb-0">Pisahkan alokasi budget untuk kepanitiaan, liburan, atau event khusus tanpa mengacaukan perhitungan uang belanja bulanan utama Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: Advanced Capabilities -->
    <section id="advanced" class="py-5 bg-light border-bottom">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="font-weight-bold text-gray-900 mb-4">Kemampuan Tingkat Lanjut</h2>
                    <p class="text-muted mb-4">Saqoe tidak hanya mencatat angka, melainkan dibangun dengan berbagai fitur tingkat lanjut yang mengakomodasi gaya hidup finansial modern.</p>
                    
                    <div class="adv-feature-card">
                        <h5 class="font-weight-bold text-primary">Kombinasi Multi-Dompet (Split-Payment)</h5>
                        <p class="text-muted small mb-0">Uang tunai kurang saat membayar? Jangan khawatir, fitur kombinasi dua dompet memungkinkan Anda mencatat satu pengeluaran yang memotong dua saldo akun/e-wallet sekaligus.</p>
                    </div>
                    
                    <div class="adv-feature-card">
                        <h5 class="font-weight-bold text-primary">Transaksi Rutin Otomatis (Recurring)</h5>
                        <p class="text-muted small mb-0">Punya tagihan listrik, Netflix, atau uang kos bulanan? Daftarkan di Transaksi Rutin, dan sistem Saqoe akan otomatis mengeksekusi tagihan di tanggal yang ditentukan setiap bulannya.</p>
                    </div>
                    
                    <div class="adv-feature-card">
                        <h5 class="font-weight-bold text-primary">Keamanan Data Terjamin</h5>
                        <p class="text-muted small mb-0">Sistem registrasi yang aman dengan algoritma password hashing, deteksi URL mandiri, serta session control ketat agar data keuangan sensitif Anda hanya bisa diakses oleh Anda.</p>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <!-- Placeholder untuk Ilustrasi Vektor -->
                    <img src="<?= base_url('assets/img/logotok.png'); ?>" class="img-fluid rounded-circle shadow-lg p-5 bg-white" alt="Advanced Features" style="max-width: 350px;">
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: Developer & Credits -->
    <section id="developer" class="py-5 dev-section">
        <div class="container py-5 text-center">
            <h2 class="font-weight-bold text-gray-900 mb-4">Dikembangkan dengan ❤️ oleh Profesional</h2>
            <p class="text-muted mb-5 w-75 mx-auto">Saqoe merupakan *Open-Source Project* yang didekasikan untuk mempermudah manajemen keuangan personal dan sebagai portofolio pengembangan aplikasi web berkinerja tinggi (CodeIgniter & Bootstrap).</p>
            
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-sm border-0 py-4 px-3 h-100">
                        <div class="card-body">
                            <div class="mb-4">
                                <i class="fab fa-github fa-4x text-gray-900"></i>
                            </div>
                            <h4 class="font-weight-bold mb-1">Faisal Ridwan</h4>
                            <p class="text-muted small mb-3">Full-Stack Engineer & Creator</p>
                            <a href="https://github.com/faisalridwan" target="_blank" class="btn btn-dark btn-sm rounded-pill px-4 github-link shadow-sm"><i class="fab fa-github mr-2"></i> Kunjungi GitHub</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-5 mt-4 mt-md-0">
                    <div class="card shadow-sm border-0 py-4 px-3 h-100">
                        <div class="card-body">
                            <div class="mb-4">
                                <i class="fas fa-globe fa-4x text-primary"></i>
                            </div>
                            <h4 class="font-weight-bold mb-1">qreatip.com</h4>
                            <p class="text-muted small mb-3">Creative Digital Studio</p>
                            <a href="https://qreatip.com" target="_blank" class="btn btn-primary btn-sm rounded-pill px-4 domain-link shadow-sm"><i class="fas fa-external-link-alt mr-2"></i> Eksplorasi Portofolio</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 5: Call To Action -->
    <section class="py-5 cta-section text-center">
        <div class="container py-4">
            <h2 class="font-weight-bold mb-3">Siap Merapikan Keuangan Anda?</h2>
            <p class="lead mb-4">Bergabunglah dengan ratusan orang lainnya yang telah mempercayakan arus kas mereka bersama Saqoe.</p>
            <?php if(isset($is_logged_in) && $is_logged_in): ?>
            <a href="<?= base_url('user'); ?>" class="btn btn-light btn-lg text-primary font-weight-bold rounded-pill px-5 shadow">Ke Dashboard Saya</a>
            <?php else: ?>
            <a href="<?= base_url('auth/registration'); ?>" class="btn btn-light btn-lg text-primary font-weight-bold rounded-pill px-5 shadow">Daftar Akun Gratis Sekarang</a>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white py-4 shadow-sm">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="mb-3 mb-md-0">
                <span class="text-muted font-weight-bold">Copyright &copy; Saqoe (by Faisal Ridwan) <?= date('Y'); ?>.</span>
            </div>
            <div>
                <a href="https://github.com/faisalridwan/saqoe" target="_blank" class="text-muted mx-2"><i class="fab fa-github fa-lg"></i></a>
                <a href="https://qreatip.com" target="_blank" class="text-muted mx-2"><i class="fas fa-globe fa-lg"></i></a>
            </div>
        </div>
    </footer>

    <!-- Logout Modal-->
    <?php if(isset($is_logged_in) && $is_logged_in): ?>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Konfirmasi Logout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-gray-800">Pilih "Logout" di bawah ini jika Anda sudah siap untuk mengakhiri sesi Anda dan keluar dari aplikasi.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary rounded-pill" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-danger rounded-pill px-4" href="<?= base_url('auth/logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

    <script>
        // Smooth scrolling using jQuery easing
        $('a.nav-link[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: (target.offset().top - 70)
                    }, 1000, "easeInOutExpo");
                    return false;
                }
            }
        });
    </script>
</body>
</html>
