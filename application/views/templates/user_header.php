<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Custom styles for this page -->
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css" rel="stylesheet">

    <link rel="icon" href="<?=base_url()?>/logotok.png" type="image/png">

    <!-- Custom Global CSS -->
    <link href="<?= base_url('assets/'); ?>css/custom.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" class="min-vh-100">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('user'); ?>">
                <i class=""><img src="<?= base_url('assets/'); ?>img/logotok.png" alt="" width="50%" height="50%"></i>
                <div class="sidebar-brand-text" style="padding-right: 30px;">Saqoe</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= ($title == 'Dashboard') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('user'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Main Menu
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?= (strpos($title, 'Harian') !== false && strpos($title, 'History') === false) ? 'active' : '' ?>">
                <a class="nav-link <?= (strpos($title, 'Harian') !== false && strpos($title, 'History') === false) ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#harian">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Harian</span>
                </a>
                <div id="harian" class="collapse <?= (strpos($title, 'Harian') !== false && strpos($title, 'History') === false) ? 'show' : '' ?>" aria-labelledby="headingTwo">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= ($title == 'Harian Pemasukan') ? 'active' : '' ?>" href="<?= base_url('user/harianPemasukan'); ?>">Pemasukan</a>
                        <a class="collapse-item <?= ($title == 'Harian Pengeluaran') ? 'active' : '' ?>" href="<?= base_url('user/harianPengeluaran'); ?>">Pengeluaran</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item <?= (strpos($title, 'Event') !== false && strpos($title, 'History') === false) ? 'active' : '' ?>">
                <a class="nav-link <?= (strpos($title, 'Event') !== false && strpos($title, 'History') === false) ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#event">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Event</span>
                </a>
                <div id="event" class="collapse <?= (strpos($title, 'Event') !== false && strpos($title, 'History') === false) ? 'show' : '' ?>" aria-labelledby="headingUtilities">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= ($title == 'Kelola Event') ? 'active' : '' ?>" href="<?= base_url('event'); ?>">Kelola Event</a>
                        <a class="collapse-item <?= (strpos($title, 'Pemasukan') !== false && strpos($title, 'Event') !== false && strpos($title, 'History') === false) ? 'active' : '' ?>" href="<?= base_url('user/eventPemasukan'); ?>">Pemasukan</a>
                        <a class="collapse-item <?= (strpos($title, 'Pengeluaran') !== false && strpos($title, 'Event') !== false && strpos($title, 'History') === false) ? 'active' : '' ?>" href="<?= base_url('user/eventPengeluaran'); ?>">Pengeluaran</a>
                    </div>
                </div>
            </li>

            <li class="nav-item <?= ($title == 'Kelola Kategori') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('kategori'); ?>">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Kelola Kategori</span>
                </a>
            </li>

            <li class="nav-item <?= ($title == 'Kelola Dompet') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('dompet'); ?>">
                    <i class="fas fa-fw fa-wallet"></i>
                    <span>Kelola Dompet</span>
                </a>
            </li>

            <li class="nav-item <?= ($title == 'Wishlist' || strpos($title, 'Target') !== false) ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('wishlist'); ?>">
                    <i class="fas fa-fw fa-bullseye"></i>
                    <span>Target Menabung</span>
                </a>
            </li>

            <li class="nav-item <?= ($title == 'Hutang Piutang' || strpos($title, 'Hutang') !== false) ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('hutangpiutang'); ?>">
                    <i class="fas fa-fw fa-handshake"></i>
                    <span>Hutang Piutang</span>
                </a>
            </li>

            <li class="nav-item <?= (strpos($title, 'History') !== false) ? 'active' : '' ?>">
                <a class="nav-link <?= (strpos($title, 'History') !== false) ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#history">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>History</span>
                </a>
                <div id="history" class="collapse <?= (strpos($title, 'History') !== false) ? 'show' : '' ?>" aria-labelledby="headingUtilities">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= ($title == 'History Harian') ? 'active' : '' ?>" href="<?= base_url('user/historyHarian'); ?>">Harian</a>
                        <a class="collapse-item <?= ($title == 'History Event') ? 'active' : '' ?>" href="<?= base_url('user/historyEvent'); ?>">Event</a>
                    </div>
                </div>
            </li>

            <li class="nav-item <?= ($title == 'Transaksi Rutin') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('transaksirutin'); ?>">
                    <i class="fas fa-fw fa-sync-alt"></i>
                    <span>Transaksi Rutin</span>
                </a>
            </li>

            <li class="nav-item <?= ($title == 'Kalender Keuangan') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('kalender'); ?>">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Kalender Keuangan</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Addons
            </div> -->

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-fw"></i>
                    <span>Logout</span>
                </a>
            </li>

            <!-- Nav Item - Charts -->


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column min-vh-100">

            <!-- Main Content -->
            <div id="content" class="flex-grow-1">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Saldo Dompet -->
                        <?php 
                            $ci =& get_instance();
                            $un = $ci->session->userdata('username');
                            $ci->db->where('username', $un);
                            $list_dompet_header = $ci->db->get('dompet')->result_array();
                        ?>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle font-weight-bold text-black-50" href="#" id="saldoDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Total Saldo: Rp. <?= number_format($user['saldo'], 0, ',', '.'); ?>
                            </a>
                            <!-- Dropdown - Saldo Dompet -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="saldoDropdown">
                                <h6 class="dropdown-header">
                                    Rincian Saldo Dompet
                                </h6>
                                <?php foreach ($list_dompet_header as $dh) : ?>
                                <a class="dropdown-item d-flex align-items-center" href="<?= base_url('dompet'); ?>">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-wallet text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500"><?= $dh['nama_dompet']; ?></div>
                                        <span class="font-weight-bold">Rp. <?= number_format($dh['saldo'], 0, ',', '.'); ?></span>
                                    </div>
                                </a>
                                <?php endforeach; ?>
                                <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('dompet'); ?>">Kelola Dompet</a>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <?php 
                                $ci =& get_instance();
                                $un = $ci->session->userdata('username');
                                // Get latest 3 activities
                                $ci->db->order_by('tanggal', 'DESC');
                                $ci->db->order_by('jam', 'DESC');
                                $notifs = $ci->db->get_where('harianhistori', ['username' => $un], 3)->result_array();
                                $count_notif = count($notifs);
                            ?>
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <?php if($count_notif > 0): ?>
                                <span class="badge badge-danger badge-counter"><?= $count_notif; ?></span>
                                <?php endif; ?>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <?php if($count_notif > 0): ?>
                                    <?php foreach($notifs as $n): ?>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle <?= $n['tipe'] == 'Pemasukan' ? 'bg-success' : 'bg-warning'; ?>">
                                                <i class="fas <?= $n['tipe'] == 'Pemasukan' ? 'fa-donate' : 'fa-shopping-cart'; ?> text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500"><?= $n['tanggal']; ?> <?= $n['jam']; ?></div>
                                            <span class="font-weight-bold">
                                                <?= $n['tipe']; ?>: <?= $n['nama']; ?>
                                                (Rp. <?= number_format($n['tipe'] == 'Pemasukan' ? $n['pemasukan'] : $n['pengeluaran'], 0, ',', '.'); ?>)
                                            </span>
                                        </div>
                                    </a>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Belum ada notifikasi</a>
                                <?php endif; ?>
                                <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('user/historyHarian'); ?>">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('user/profile'); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    My Profile
                                </a>
                                <a class="dropdown-item" href="<?= base_url('user/edit'); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Edit Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Breadcrumbs -->
                <div class="container-fluid mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb shadow-sm bg-white">
                            <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>"><i class="fas fa-home"></i> Home</a></li>
                            <?php if(isset($title) && $title != 'Dashboard'): ?>
                            <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                            <?php endif; ?>
                        </ol>
                    </nav>
                </div>