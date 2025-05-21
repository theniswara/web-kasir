<?php
session_start();
require '../config/functions.php';
$produk = query("SELECT * FROM produk");


if (!isset($_SESSION["login"])) { // jika tdak ada session login 
  header("Location: ../login.php"); // Kembali ke hlm login
  exit;
} 

  // tombol cari ditekan
  if( isset($_POST["cari"]) ) {
    $books = cari($_POST["keyword"]);
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
      <div class="table-responsive text-nowrap" id="container">
        <table class="table table-bordered">
          <thead class="fw-bold">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Merek</th>
                <th>Harga</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($produk as $row) : ?>
                <tr>
                  <td class="text-center">
                    <?= $i ?>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img
                        src="assets/img/produk/<?= $row['gambar'] ?>"
                        alt=""
                        style="width: 80px; height: 80px; object-fit: cover;"
                        class="rounded mx-auto d-block"
                      />
                    </div>
                  </td>
                  <td class="align-middle">
                    <span class="fw-semibold text-dark"><?= htmlspecialchars($row['nama_produk']) ?></span>
                  </td>
                  <td class="text-center align-middle">
                    <?php
                      // Ganti dengan id_kategori yang sesuai
                      if ($row['id_kategori'] == 1) {
                        // Misal kategori 1: Makanan
                        echo '<a title="Smartphone">
                        <span class="badge bg-label-info"> <i class="menu-icon tf-icons bx bxs-smartphone mx-auto"></i></span></a>';
                      } elseif ($row['id_kategori'] == 2) {
                        // Misal kategori 2: Minuman
                        echo '<a title="Laptop">
                        <span class="badge bg-label-warning"> <i class="menu-icon tf-icons bx bx-laptop mx-auto"></i></span></a>';
                      } else {
                        // Kategori lain
                        echo '<span class="badge badge-secondary rounded-pill d-inline"><i class="bx bx-question-mark"></i> Lainnya</span>';
                      }
                    ?>
                  </td>
                    <td class="align-middle">
                    <span class="fw-semibold text-dark">
                      <?php 
                      if ($row['id_merek'] == 1) {
                        echo 'Samsung';
                      } else if ($row['id_merek'] == 2) {
                        echo 'Apple';
                      } else if ($row['id_merek'] == 3) {
                        echo 'Asus';
                      } else if ($row['id_merek'] == 4) {
                        echo 'Lenovo';
                      } else if ($row['id_merek'] == 5) {
                        echo 'Xiaomi';
                      } else if ($row['id_merek'] == 6) {
                        echo 'HP';
                      } else if ($row['id_merek'] == 7) {
                        echo 'Realme';
                      } else if ($row['id_merek'] == 8) {
                        echo 'Infinix';
                      } else if ($row['id_merek'] == 9) {
                        echo 'Acer';
                      } else if ($row['id_merek'] == 10) {
                        echo 'OPPO'; 
                      } else {
                        echo '<span class="badge badge-secondary rounded-pill d-inline"><i class="bx bx-question-mark"></i> Lainnya</span>';
                      } ?></span>
                  </td>
                  <td class="align-middle text-end">
                    <span class="fw-bold"">Rp. <?= number_format($row['harga'], 0, ',', '.') ?></span>
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
                <?php $i++; ?>
              <?php endforeach; ?>
            </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->

<script src="assets/js/script.js"></script>
  
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
