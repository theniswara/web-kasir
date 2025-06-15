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
include('includes/navbar.php');
?>

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