<?php
require_once '../app/core/Flasher.php'; // Jika belum pakai composer/namespace

Flasher::loginFlash(); // Tampilkan pesan jika ada
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>App IT <?= $judul ?></title>
    <link rel="shortcut icon" href="<?= BASE_URL; ?>/img/it.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?= BASE_URL; ?>/css/style.css" rel="stylesheet" />
    <link href="<?= BASE_URL; ?>/css/custom.css?v=1.2" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script>
        const BASE_URL = '<?= BASE_URL ?>';
    </script>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-card">

        <!-- <nav class="sb-topnav navbar navbar-expand navbar-dark bg-success"> -->
        <a class="navbar-brand d-flex align-items-center gap-2 ps-3" href="#">
            <span class="fs-8 fw-bold">Dashboard IT</span>
            <img src="<?= BASE_URL; ?>/img/JNE.png" alt="JNE Logo" style="height: 30px;">
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4 d-flex align-items-center">
            <li class="nav-item me-2">

                <span class="text-white small text-uppercase"><?= htmlspecialchars($username) ?></span>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw text-light"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?= BASE_URL; ?>/auth/logout">Logout</a></li>
                </ul>
            </li>
        </ul>

    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <?php
                    $currentPage = basename($_SERVER['REQUEST_URI']);
                    $isUsers = in_array($currentPage, ['user_hybrid', 'user_sca']);
                    $isCounter = in_array($currentPage, ['counter', 'counter_tutup']);
                    ?>
                    <div class="nav">
                        <span class="nav-link mb-4" style="border-bottom: solid 1px white;"><img src="<?= BASE_URL; ?>/img/user.png" alt="JNE Logo" style="height: 30px;" class="me-2"> <?= htmlspecialchars($name) ?></span>

                        <a class="nav-link" href="<?= BASE_URL; ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i>
                            </div>
                            Dashboard
                        </a>
                        <!-- Data Agen & KP Menu -->
                        <a class="nav-link <?= $isCounter ? '' : 'collapsed' ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCounter" aria-expanded="<?= $isCounter ? 'true' : 'false' ?>" aria-controls="collapseKaryawan">
                            <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                            Data Agen & KP
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse <?= $isCounter ? 'show' : '' ?>" id="collapseCounter" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link <?= $currentPage === 'counter' ? 'active' : '' ?>" href="<?= BASE_URL; ?>/counter">Counter Aktif</a>
                                <a class="nav-link <?= $currentPage === 'counter_tutup' ? 'active' : '' ?>" href="<?= BASE_URL; ?>/counter_tutup">Counter Tutup</a>
                            </nav>
                        </div>
                        <!-- Data Users Menu -->
                        <a class="nav-link <?= $isUsers ? '' : 'collapsed' ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseKaryawan" aria-expanded="<?= $isUsers ? 'true' : 'false' ?>" aria-controls="collapseKaryawan">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Data Users
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse <?= $isUsers ? 'show' : '' ?>" id="collapseKaryawan" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link <?= $currentPage === 'user_hybrid' ? 'active' : '' ?>" href="<?= BASE_URL; ?>/user_hybrid">User Hybrid</a>
                                <a class="nav-link <?= $currentPage === 'user_sca' ? 'active' : '' ?>" href="<?= BASE_URL; ?>/user_sca">User SCA</a>
                            </nav>
                        </div>
                        <?php if (isset($data['userRole']) && in_array($data['userRole'], ['superadmin'])) : ?>
                            <a class="nav-link" href="<?= BASE_URL; ?>/user">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Users
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">IT Dev. JNE MEDAN</div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">