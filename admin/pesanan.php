<?php
session_start();
require '../config/dbcon.php';
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
<!-- Content wrapper -->
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h4 class="card-header fw-bold">Daftar Pesanan / Transaksi
      </h4>
      <div class="table-responsive text-nowrap">
        <table class="table table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Customer</th>
              <th>Kasir</th>
              <th>Total</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            while ($row = mysqli_fetch_assoc($transaksi)): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['tanggal']) ?></td>
                <td><?= htmlspecialchars($row['customer_nama']) ?></td>
                <td><?= htmlspecialchars($row['kasir_nama']) ?></td>
                <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                <td>
                  <a href="struk.php?id=<?= $row['id_transaksi'] ?>" class="btn btn-info btn-sm" target="_blank">Lihat Struk</a>
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