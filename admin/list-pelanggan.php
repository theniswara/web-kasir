<?php
session_start();
require '/xampp/htdocs/COLLEGE/uas_sm2/web-kasir/config/functons-customer.php';
$customer = query("SELECT * FROM customer");

if (!isset($_SESSION["login"])) { // jika tdak ada session login 
  header("Location: ../login.php"); // Kembali ke hlm login
  exit;
}

include('includes/header.php');
?>


<!-- Content wrapper -->
<div class="content-wrapper">
  <div class="container-xxl flex_-grow-1 container-p-y">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header">Pesanan
        <button type="button" class="btn btn-primary float-end">
          <span class="icon-base bx bx-plus icon-sm me-2"></span>Tambah Admin
        </button>
      </h5>
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Nomor HP</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <?php $i = 1; ?>
            <?php foreach ($customer as $row) : ?>
              <tr>
                <td class="text-center"><?= $i ?></td>
                <td>
                  <span class="fw-semibold text-dark"><?= htmlspecialchars($row['nama']) ?></span>
                </td>
                <td>
                  <span class=" text-dark"><?= htmlspecialchars($row['no_hp']) ?></span>
                </td>
                <td>
                  <span class=" text-dark"><?= htmlspecialchars($row['email']) ?></span>
                </td>
                <td>
                  <div class="d-flex justify-content-center gap-2">
                    <a href="edit-produk.php?id=<?= $row["id_produk"] ?>" class="btn btn-success btn-sm btn-rounded" title="Edit">
                      <i class="bx bx-edit"></i>
                    </a>
                    <a href="../config/hapus.php?id=<?= $row["id_produk"] ?>" class="btn btn-danger btn-sm btn-rounded" title="Hapus" onclick="return confirm('Yakin ingin menghapus produk ini?');">
                      <i class="bx bx-trash"></i>
                    </a>
                  </div>
                </td>
              </tr>
              <?php $i++ ?>
            <?php endforeach; ?>
            </tr>
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