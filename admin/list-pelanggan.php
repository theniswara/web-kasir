<?php
session_start();
require '../config/functions-pelanggan.php';
require_once '../config/dbcon.php';

if (!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
}

$customer = mysqli_query($conn, "SELECT * FROM customer");

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

  <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center me-auto">
      <div class="nav-item d-flex align-items-center">
        <span class="w-px-22 h-px-22"><i class="icon-base bx bx-search icon-md"></i></span>
        <form class="d-none d-md-flex flex-grow-1 mx-4" role="search" style="max-width:400px;" action="" method="post">
          <input
            type="text"
            class="form-control border-0 shadow-none ps-1 ps-sm-2 d-md-block d-none"
            id="keyword2"
            name="keyword"
            placeholder="Search..."
            aria-label="Search..."
            autofocus />
        </form>
      </div>
    </div>
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-md-auto">
      <ul class="navbar-nav flex-row align-items-center ms-md-auto">
        <li class="nav-item">
          <a class="btn btn-danger btn-sm fw-bold px-3" href="../logout.php">
            <i class="icon-base bx bx-power-off me-2"></i>Log Out
          </a>
        </li>
      </ul>
    </ul>
  </div>
</nav>

<!-- / Navbar -->


<!-- Content wrapper -->
<div class="content-wrapper">
  <div class="container-xxl flex_-grow-1 container-p-y">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h4 class="card-header fw-bold">Pelanggan
        <a href="tambah-pelanggan.php" class="btn btn-primary float-end">
          <span class="icon-base bx bx-plus icon-sm me-2"></span>Tambah Pelanggan
        </a>
      </h4>
      <div class="table-responsive text-nowrap" id="container2">
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-primary text-white align-middle">
            <tr>
              <th class="text-center" style="width:5%">No</th>
              <th style="width:30%">Nama</th>
              <th style="width:20%">Nomor HP</th>
              <th style="width:30%">Email</th>
              <th class="text-center" style="width:15%">Action</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <?php $i = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($customer)) : ?>
              <tr>
                <td class="text-center fw-bold"><?= $i ?></td>
                <td>
                  <span class="fw-semibold text-dark"><?= htmlspecialchars($row['nama']) ?></span>
                </td>
                <td>
                  <span class="text-dark"><i class="bx bx-phone me-2 text-success"></i><?= htmlspecialchars($row['no_hp']) ?></span>
                </td>
                <td>
                  <span class="text-dark"><i class="bx bx-envelope me-2 text-info"></i><?= htmlspecialchars($row['email']) ?></span>
                </td>
                <td>
                  <div class="d-flex justify-content-center gap-2">
                    <a href="edit-pelanggan.php?id=<?= $row['id_customer'] ?>" class="btn btn-success btn-sm btn-rounded" title="Edit">
                      <i class="bx bx-edit"></i>
                    </a>
                    <a href="../config/hapus-pelanggan.php?id=<?= $row['id_customer'] ?>" class="btn btn-danger btn-sm btn-rounded" title="Hapus" onclick="return confirm('Yakin ingin menghapus pelanggan ini?');">
                      <i class="bx bx-trash"></i>
                    </a>
                  </div>
                </td>
              </tr>
              <?php $i++; ?>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->


  <script src="assets/js/jquery-3.7.1.js"></script>
  <script src="assets/js/script2.js"></script>

  <script>
    // Sidebar active tab logic for List Produk
    document.addEventListener('DOMContentLoaded', function() {
      var sidebarLink = document.querySelector('a[href="list-pelanggan.php"]');
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