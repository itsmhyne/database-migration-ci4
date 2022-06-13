<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= APP_NAME ?></title>

    <!-- icon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('public/assets/icon') ?>/<?= APP_ICON ?>">
    <!-- jQuery -->
    <script src="<?= base_url('public/assets') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('public/assets') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('public/assets') ?>/dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('public/assets') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('public/assets') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('public/assets') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('public/assets') ?>/dist/css/sweetalert2.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url('public/assets') ?>/dist/css/toastr.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('public/assets') ?>/dist/css/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('public/assets') ?>/dist/css/select2.css">
    <script src="<?= base_url('public/assets') ?>/dist/js/select2.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= base_url('public/assets') ?>/plugins/chart.js/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js" integrity="sha512-R/QOHLpV1Ggq22vfDAWYOaMd5RopHrJNMxi8/lJu8Oihwi4Ho4BRFeiMiCefn9rasajKjnx9/fTQ/xkWnkDACg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        select[readonly]+span.select2-container span.select2-selection {
            background-color: #ECECEC;
            pointer-events: none;
        }
    </style>
    <script type="text/javascript">
        $.fn.select2.defaults.set("theme", "bootstrap4");
        // $.fn.datepicker.defaults.autoclose = true;
        // $.fn.datepicker.defaults.format = 'dd/mm/yyyy';
    </script>
</head>

<body class="sidebar-mini layout-navbar-fixed layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url('public/assets') ?>/index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> -->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Auth/Logout') ?>" class="nav-link" onclick="logout()">
                        <i class="fa fa-sign-out-alt mr-2"></i> Sign Out
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url('') ?>" class="brand-link">
                <img src="<?= base_url('public/assets') ?>/icon/room.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?= APP_NAME ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url('public/assets') ?>/dist/img/user/<?= $session_foto ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $session_name; ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline d-none">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="<?= base_url('') ?>" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <?php if ($session_group_id == 2) : ?>
                            <li class="nav-item">
                                <a href="<?= base_url('Peminjaman') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Ruangan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('Peminjaman/ruang_dipinjam') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-history"></i>
                                    <p>
                                        Riwayat Peminjaman
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($session_group_id == 1) : ?>
                            <li class="nav-item">
                                <a href="<?= base_url('Peminjaman/daftar_peminjaman') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Riwayat Peminjaman
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('Pengajuan') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Pengajuan
                                        <span class="badge badge-info right"><?= $jumlahPengajuan ?></span>
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-header">PENGATURAN</li>
                        <?php if ($session_group_id == 1) : ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-database"></i>
                                    <p>
                                        Datamaster
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('Datamaster/room') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Ruangan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Komunitas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('Manajemen') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Manajemen Admin
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Profile
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?= @$content; ?>
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; <?= date('Y') ?> <a href="<?= base_url() ?>"><?= APP_NAME ?></a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- Bootstrap 4 -->
    <script src="<?= base_url('public/assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('public/assets') ?>/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="<?= base_url('public/assets') ?>/dist/js/demo.js"></script> -->
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('public/assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('public/assets') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('public/assets') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('public/assets') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url('public/assets') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('public/assets') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url('public/assets') ?>/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url('public/assets') ?>/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url('public/assets') ?>/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url('public/assets') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url('public/assets') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url('public/assets') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- loading overlay -->
    <script src="<?= base_url('public/assets') ?>/dist/js/loadingoverlay.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('public/assets') ?>/dist/js/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?= base_url('public/assets') ?>/dist/js/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script>
        function base_url(url) {
            return "<?php echo base_url() ?>" + url;
        }
        $(document).ready(function() {
            $('.select2').select2()
        });
    </script>
</body>

</html>