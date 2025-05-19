<?php 
session_start();
require '../config/functions.php';

if (!isset($_SESSION["login"])) { // jika tdak ada session login 
  header("Location: ../login.php"); // Kembali ke hlm login
  exit;
}

// Ambil data kategori untuk dropdown
$kategori = query("SELECT * FROM kategori");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses simpan produk di sini (validasi, upload gambar, dsb)
    // ...
}

include('includes/header.php'); 
?>

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row mb-6 gy-6">
    <div class="col-xl">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="mb-0 fw-bold">Tambah Produk</h4>
        </div>
        <div class="card-body">
          <form method="post" enctype="multipart/form-data">
            <div class="mb-4">
              <label class="form-label">Nama Produk</label>
              <input type="text" name="nama_produk" class="form-control" required>
            </div>
            <div class="mb-4">
              <label class="form-label">Kategori</label>
              <select name="id_kategori" class="form-control" required>
                <option value="">Pilih Kategori</option>
                <?php foreach($kategori as $k): ?>
                  <option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-4">
              <label class="form-label">Harga</label>
              <div class="input-group mb-3">
              <span class="input-group-text">Rp.</span>

              <input type="number" name="harga" class="form-control" required>
              </div>
            </div>
            <div class="mb-4">
              <label class="form-label">Gambar Produk</label>
              <input type="file" name="gambar" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Sidebar active tab logic for List Produk
  document.addEventListener('DOMContentLoaded', function() {
    var sidebarLink = document.querySelector('a[href="tambah-produk.php"]');
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