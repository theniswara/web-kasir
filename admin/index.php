<?php
session_start();

if (!isset($_SESSION["login"])) { // jika tdak ada session login 
  header("Location: ../login.php"); // Kembali ke hlm login
  exit;
}
include('includes/header.php');
require_once '../config/dbcon.php';

function getCount($tableName)
{
  global $conn;
  $query = "SELECT COUNT(*) as total FROM `$tableName`";
  $result = mysqli_query($conn, $query);
  if ($result) {
    $row = mysqli_fetch_assoc($result);
    return (int)$row['total'];
  } else {
    return 0;
  }
}
?>


<nav
  class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
  id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
      <i class="icon-base bx bx-menu icon-md"></i>
    </a>
  </div>

  <!-- Brand/Logo -->
  <a class="navbar-brand fw-bold text-primary d-none d-xl-block me-4" href="index.php" style="font-size:1.5rem; letter-spacing:1px;">
    <i class="icon-base bx bx-store-alt me-2"></i>GadgetIn Admin
  </a>

  <!-- Search Bar
  <form class="d-none d-md-flex flex-grow-1 mx-4" role="search" style="max-width:400px;">
    <input class="form-control border-0 shadow-sm" type="search" placeholder="Cari produk, kategori..." aria-label="Search">
    <button class="btn btn-outline-primary ms-2" type="submit"><i class="bx bx-search"></i></button>
  </form> -->

  <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">

    <ul class="navbar-nav flex-row align-items-center ms-md-auto">
      <!-- Place this tag where you want the button to render. -->
      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a
          class="nav-link dropdown-toggle hide-arrow p-0"
          href="javascript:void(0);"
          data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online">
                    <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="mb-0">John Doe</h6>
                  <small class="text-body-secondary">Admin</small>
                </div>
              </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider my-1"></div>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <i class="icon-base bx bx-user icon-md me-3"></i><span>My Profile</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <i class="icon-base bx bx-cog icon-md me-3"></i><span>Settings</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <span class="d-flex align-items-center align-middle">
                <i class="flex-shrink-0 icon-base bx bx-credit-card icon-md me-3"></i><span class="flex-grow-1 align-middle">Billing Plan</span>
                <span class="flex-shrink-0 badge rounded-pill bg-danger">4</span>
              </span>
            </a>
          </li>
          <li>
            <div class="dropdown-divider my-1"></div>
          </li>
          <li>
            <a class="dropdown-item" href="../logout.php">
              <i class="icon-base bx bx-power-off icon-md me-3"></i><span>Log Out</span>
            </a>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>
</nav>

<!-- / Navbar -->


<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold mb-4 text-primary">Selamat Datang di Dashboard Kasir GadgetIn</h4>
    <p class="mb-4">Pantau data produk, pelanggan, dan transaksi secara real-time.</p>
    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <div class="card-body text-center">
            <i class="bx bx-package text-primary mb-2" style="font-size:2rem"></i>
            <h6 class="mb-1">Total Produk</h6>
            <h3 class="fw-bold mb-2"><?= getCount('produk') ?></h3>
            <a href="list-produk.php" class="btn btn-sm btn-outline-primary mt-2">Lihat Produk</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <div class="card-body text-center">
            <i class="bx bx-user text-success mb-2" style="font-size:2rem"></i>
            <h6 class="mb-1">Total Pelanggan</h6>
            <h3 class="fw-bold mb-2"><?= getCount('customer') ?></h3>
            <a href="list-pelanggan.php" class="btn btn-sm btn-outline-success mt-2">Lihat Pelanggan</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <div class="card-body text-center">
            <i class="bx bx-receipt text-warning mb-2" style="font-size:2rem"></i>
            <h6 class="mb-1">Total Transaksi</h6>
            <h3 class="fw-bold mb-2"><?= getCount('transaksi') ?></h3>
            <a href="pesanan.php" class="btn btn-sm btn-outline-warning mt-2">Lihat Pesanan</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- / Content -->
  <?php include('includes/footer.php'); ?>