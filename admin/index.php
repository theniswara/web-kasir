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

include('includes/navbar.php');

?>




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