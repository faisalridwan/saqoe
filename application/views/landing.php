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
    <meta name="author" content="Saqoe Team">
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
                        <a class="nav-link font-weight-bold" href="#features">Fitur</a>
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

    <!-- Hero Section -->
    <header class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10">
                    <img src="<?= base_url('assets/img/logotok.png'); ?>" alt="Saqoe Logo" width="120" class="mb-4 shadow-sm rounded-circle bg-white p-2">
                    <h1 class="hero-title">Kendalikan Keuanganmu<br>Wujudkan Mimpimu.</h1>
                    <p class="hero-subtitle">Saqoe adalah platform pencatatan keuangan cerdas yang didesain khusus untuk melacak pengeluaran harian dan mengatur budget event Anda dengan sangat mudah, presisi, dan elegan.</p>
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

    <!-- Features Section -->
    <section id="features" class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="font-weight-bold text-gray-900">Mengapa Memilih Saqoe?</h2>
                <p class="text-muted">Fitur premium yang kami hadirkan untuk memudahkan hidup Anda.</p>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="feature-box text-center">
                        <i class="fas fa-wallet feature-icon"></i>
                        <h4 class="font-weight-bold text-gray-900 mb-3">Pencatatan Harian</h4>
                        <p class="text-muted mb-0">Catat setiap pemasukan dan pengeluaran harian Anda secara real-time. Tampilan rapi memudahkan Anda melihat ke mana uang Anda pergi.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="feature-box text-center">
                        <i class="fas fa-calendar-check feature-icon"></i>
                        <h4 class="font-weight-bold text-gray-900 mb-3">Manajemen Event</h4>
                        <p class="text-muted mb-0">Rencanakan budget khusus untuk liburan, kepanitiaan, atau acara spesial tanpa mencampuradukkan dengan saldo utama harian Anda.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="feature-box text-center">
                        <i class="fas fa-chart-pie feature-icon"></i>
                        <h4 class="font-weight-bold text-gray-900 mb-3">Analitik & History</h4>
                        <p class="text-muted mb-0">Visualisasikan arus kas Anda dengan grafik interaktif Chart.js dan lacak kembali setiap transaksi menggunakan tabel pintar DataTables.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white py-4 shadow-sm border-top">
        <div class="container text-center">
            <span class="text-muted font-weight-bold">Copyright &copy; Saqoe <?= date('Y'); ?>. All Rights Reserved.</span>
        </div>
    </footer>

    <!-- Logout Modal-->
    <?php if(isset($is_logged_in) && $is_logged_in): ?>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
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
