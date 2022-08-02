<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $judul; ?> | Wlee Laundry</title>
  <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
  <link rel="icon" href="<?= base_url('assets/img/wlee.png') ?>">
</head>

<body id="page-top">
  <div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" title="Wlee Laundry">
        <div class="sidebar-brand-icon">
          <i class="fas fa-grin-tongue-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Wlee <sup>LAUNDRY</sup></div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item <?= $judul == 'Dashboard' ? 'active' : null ?>">
        <a class="nav-link" href="<?= base_url('dashboard') ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- Admin -->
      <?php if ($this->session->userdata('role') == 'Admin') { ?>
        <li class="nav-item <?= $judul == 'Registrasi' ? 'active' : null ?>">
          <a class="nav-link" href="<?= base_url('registrasi') ?>">
            <i class="fas fa-fw fa-user-plus"></i>
            <span>Registrasi</span>
          </a>
        </li>
        <li class="nav-item <?= $judul == 'Pelanggan' ? 'active' : null ?>">
          <a class="nav-link" href="<?= base_url('pelanggan') ?>">
            <i class="fas fa-fw fa-user-alt"></i>
            <span>Pelanggan</span>
          </a>
        </li>
        <li class="nav-item <?= $judul == 'Pengguna' ? 'active' : null ?>">
          <a class="nav-link" href="<?= base_url('pengguna') ?>">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Pengguna</span>
          </a>
        </li>
        <li class="nav-item <?= $judul == 'Paket Cucian' ? 'active' : null ?>">
          <a class="nav-link" href="<?= base_url('paket') ?>">
            <i class="fas fa-fw fa-box-open"></i>
            <span>Paket Cucian</span>
          </a>
        </li>
        <li class="nav-item <?= $judul == 'Outlet' ? 'active' : null ?>">
          <a class="nav-link" href="<?= base_url('outlet') ?>">
            <i class="fas fa-fw fa-store"></i>
            <span>Outlet</span>
          </a>
        </li>
      <?php } ?>
      <!-- Kasir -->
      <?php if ($this->session->userdata('role') == 'Kasir') { ?>
        <li class="nav-item <?= $judul == 'Registrasi' ? 'active' : null ?>">
          <a class="nav-link" href="<?= base_url('registrasi') ?>">
            <i class="fas fa-fw fa-user-plus"></i>
            <span>Registrasi</span>
          </a>
        </li>
      <?php } ?>
      <!-- Owner -->
      <?php if ($this->session->userdata('role') == 'Owner') { ?>
        <li class="nav-item <?= $judul == 'Pelanggan' ? 'active' : null ?>">
          <a class="nav-link" href="<?= base_url('pelanggan') ?>">
            <i class="fas fa-fw fa-user-alt"></i>
            <span>Pelanggan</span>
          </a>
        </li>
        <li class="nav-item <?= $judul == 'Pengguna' ? 'active' : null ?>">
          <a class="nav-link" href="<?= base_url('pengguna') ?>">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Pengguna</span>
          </a>
        </li>
        <li class="nav-item <?= $judul == 'Paket Cucian' ? 'active' : null ?>">
          <a class="nav-link" href="<?= base_url('paket') ?>">
            <i class="fas fa-fw fa-box-open"></i>
            <span>Paket Cucian</span>
          </a>
        </li>
        <li class="nav-item <?= $judul == 'Outlet' ? 'active' : null ?>">
          <a class="nav-link" href="<?= base_url('outlet') ?>">
            <i class="fas fa-fw fa-store"></i>
            <span>Outlet</span>
          </a>
        </li>
      <?php } ?>
      <li class="nav-item <?= $judul == 'Transaksi' ? 'active' : null ?>">
        <a class="nav-link" href="<?= base_url('transaksi') ?>">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Transaksi</span>
        </a>
      </li>
      <hr class="sidebar-divider d-none d-md-block">
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Topbar Search -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h3 class="mt-2 text-dark" style="font-weight: 500;"><?= $judul ?></h3>
          </form>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link">
                <span class="text-dark"><i class="fas fa-fw fa-user-cog mr-1"></i> Pengguna : <?= $this->session->userdata('nama_user') ?></span>
              </a>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link tombol-keluar" href="<?= base_url('login/keluar') ?>">
                <span class="text-danger"><i class="fas fa-sign-out-alt"></i> Keluar</span>
              </a>
            </li>
          </ul>
        </nav>
        <div class="container-fluid">