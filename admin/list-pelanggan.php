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
include('includes/navbar.php');
?>


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
      <div class="table-responsive text-nowrap">
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