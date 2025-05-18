<?php
session_start();

// koneksi database
$conn = mysqli_connect("localhost", "root", "", "toko_gadget");

// ambil data dari tabel produk
$result = mysqli_query($conn, "SELECT * FROM produk");

// ambil data produk dari objek result (fetch)
// while( $row = mysqli_fetch_assoc($result)) {

//   var_dump($row['nama_produk']); 
//   // $produk[] = $row;
// }



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
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php while( $row = mysqli_fetch_assoc($result)) : ?>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <img
                        src="assets/img/produk/<?= $row['gambar'] ?>"
                        alt=""
                        style="width: 80px; height: 80px"
                        class="rounded  mx-auto d-block"
                        />
                  </div>
                </td>
                <td>
                  <p class="fw-medium mb-1"><?= $row['nama_produk'] ?></p>
                </td>
                <td>
                  <span class="badge badge-success rounded-pill d-inline"><?= $row['stok'] ?></span>
                </td>
                <td>Rp. <?= number_format($row['harga'], 0, ',', '.') ?></td>
                <td>
                  <button type="button" class="btn btn-link btn-sm btn-rounded">
                    Edit
                  </button>
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
