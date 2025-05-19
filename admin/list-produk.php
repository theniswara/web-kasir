<?php
session_start();
require '../config/functions.php';
$produk = query("SELECT * FROM produk");


if (!isset($_SESSION["login"])) { // jika tdak ada session login 
  header("Location: ../login.php"); // Kembali ke hlm login
  exit;
}

include('includes/header.php'); 
?>


<!-- Content wrapper -->
<div class="content-wrapper">
   <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h4 class="card-header fw-bold">Produk
        <a href="tambah-produk.php" class="btn btn-primary float-end">
          <span class="icon-base bx bx-plus icon-sm me-2"></span>Tambah Produk
        </a>
      </h4>
      <div class="table-responsive text-nowrap">
        <table class="table table-bordered">
          <thead class="fw-bold">

          
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach( $produk as $row ) : ?>
              <tr>
                <td class="text-center"><?= $i ?></td>
                <td>
                  <div class="d-flex align-items-center">
                    <img
                        src="assets/img/produk/<?= $row['gambar'] ?>"
                        alt=""
                        style="width: 80px; height: 80px; object-fit: cover;"
                        class="rounded  mx-auto d-block"
                        />
                  </div>
                </td>
                <td>
                  <p class="fw-medium mb-1"><?= $row['nama_produk'] ?></p>
                </td>
                <td class="text-center">
                  <?php
                    // Ganti dengan id_kategori yang sesuai
                    if ($row['id_kategori'] == 1) {
                      // Misal kategori 1: Makanan
                      echo '
                        <span class="badge bg-label-primary"> <i class="menu-icon tf-icons bx bxs-smartphone mx-auto"></i></span>';
                    } elseif ($row['id_kategori'] == 2) {
                      // Misal kategori 2: Minuman
                       echo '
                        <span class="badge bg-label-primary"> <i class="menu-icon tf-icons bx bx-laptop mx-auto"></i></span>';
                    } else {
                      // Kategori lain
                      echo '<span class="badge badge-secondary rounded-pill d-inline"><i class="bx bx-question-mark"></i> Lainnya</span>';
                    }
                  ?>
                </td>
                <td>Rp. <?= number_format($row['harga'], 0, ',', '.') ?></td>
                <td>
                  <button type="button" class="btn btn-link btn-sm btn-rounded">
                    Edit
                  </button>
                </td>
              </tr>
              <?php $i++; ?>
              <?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        </div>
                        <!--/ Basic Bootstrap Table -->

<script>
  // Sidebar active tab logic for List Produk
  document.addEventListener('DOMContentLoaded', function() {
    var sidebarLink = document.querySelector('a[href="list-produk.php"]');
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
