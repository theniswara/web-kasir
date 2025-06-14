<?php
session_start();
require_once '../config/dbcon.php';
require '../config/functions-pelanggan.php';
require '../config/functions-produk.php';

if (!isset($_SESSION["login"])) { // jika tdak ada session login 
  header("Location: ../login.php"); // Kembali ke hlm login
  exit;
}

// Ambil semua transaksi
$query = "SELECT t.*, c.nama as customer_nama, u.username as kasir_nama
          FROM transaksi t
          LEFT JOIN customer c ON t.id_customer = c.id_customer
          LEFT JOIN user u ON t.id_user = u.id_user
          ORDER BY t.tanggal DESC, t.id_transaksi DESC";
$transaksi = mysqli_query($conn, $query);

include('includes/header.php');
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
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h4 class="card-header fw-bold">Daftar Pesanan / Transaksi
      </h4>
      <div class="table-responsive text-nowrap">
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-primary text-white align-middle">
            <tr>
              <th class="text-center" style="width:6%">No</th>
              <th style="width:18%">Tanggal</th>
              <th style="width:28%">Customer</th>
              <th style="width:18%">Kasir</th>
              <th style="width:18%">Total</th>
              <th class="text-center" style="width:12%">Aksi</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <?php $no = 1;
            while ($row = mysqli_fetch_assoc($transaksi)): ?>
              <tr>
                <td class="text-center fw-bold"><?= $no++ ?></td>
                <td class="align-middle"><span class="badge bg-label-info px-2 py-1"><i class="bx bx-calendar me-1"></i><?= htmlspecialchars($row['tanggal']) ?></span></td>
                <td class="align-middle"><span class="fw-semibold text-dark"><?= htmlspecialchars($row['customer_nama']) ?></span></td>
                <td class="align-middle"><span class="fw-semibold text-dark"><?= htmlspecialchars($row['kasir_nama']) ?></span></td>
                <td class="align-middle text-end"><span class="fw-bold">Rp <?= number_format($row['total'], 0, ',', '.') ?></span></td>
                <td class="align-middle">
                  <div class="d-flex justify-content-center gap-2">
                    <a href="struk.php?id=<?= $row['id_transaksi'] ?>" class="btn btn-info btn-sm btn-rounded px-2" target="_blank" title="Lihat Struk">
                      <i class="bx bx-receipt"></i> Struk
                    </a>
                  </div>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->

  <script>
    // Sidebar active tab logic for List Produk
    document.addEventListener('DOMContentLoaded', function() {
      var sidebarLink = document.querySelector('a[href="pesanan.php"]');
      if (sidebarLink) {
        // Remove 'active' from all menu-item
        document.querySelectorAll('.menu-item').forEach(function(item) {
          item.classList.remove('active');
        });
        // Add 'active' to the parent .menu-item of the current link
        var parentMenuItem = sidebarLink.closest('.menu-item');
        if (parentMenuItem) {
          parentMenuItem.classList.add('active');
          // If inside submenu, also open parent and set parent as active
          var parentMenuToggle = parentMenuItem.closest('.menu-sub');
          if (parentMenuToggle) {
            var parentToggleItem = parentMenuToggle.closest('.menu-item');
            if (parentToggleItem) {
              parentToggleItem.classList.add('open', 'active');
            }
          }
        }
      }
    });
  </script>



  <?php include('includes/footer.php'); ?>