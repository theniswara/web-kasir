<?php 
session_start();
require '../config/functions.php';

//  ambil data di url
$id = $_GET["id"];
// query data produk berdasarkan id
$produk = query("SELECT * FROM produk WHERE id_produk = $id")[0];

if (!isset($_SESSION["login"])) { // jika tdak ada session login 
  header("Location: ../login.php"); // Kembali ke hlm login
  exit;
}

// Cek apakah tombol submit sudah ditekan
if (isset($_POST["submit"])) {
  
  // Cek apakah data berhasil diedit
  if ( edit($_POST) > 0) {
    echo "<script>
            alert('Data berhasil diedit')
            document.location.href = 'list-produk.php'
          </script>";
  } else {
    echo "<script>
            alert('Data gagal diedit')
            document.location.href = 'list-produk.php'
          </script>";
  }


}

// Ambil data kategori untuk dropdown
$kategori = query("SELECT * FROM kategori");
$merek = query("SELECT * FROM merek");




include('includes/header.php'); 
?>

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row mb-6 gy-6">
    <div class="col-xl">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="mb-0 fw-bold">Edit Produk</h4>
        </div>
        <div class="card-body">
          <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="id_produk" value="<?= $produk["id_produk"];?>">
            <input type="hidden" name="gambarLama" value="<?= $produk["gambar"];?>">
            <div class="mb-4">
              <label for="nama_produk" class="form-label">Nama Produk</label>
              <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="<?= $produk["nama_produk"]; ?>" autofocus required>
            </div>
            <div class="mb-4">
              <label class="form-label">Kategori</label>
              <select name="id_kategori" class="form-control" required>
                <option value="">Pilih Kategori</option>
                <?php foreach($kategori as $k): ?>
                  <option value="<?= $k['id_kategori'] ?>" <?= $produk['id_kategori'] == $k['id_kategori'] ? 'selected' : '' ?>><?= $k['nama_kategori'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-4">
              <label class="form-label">Merek</label>
              <select name="id_merek" class="form-control" required>
                <option value="">Pilih Merek</option>
                <?php foreach($merek as $m): ?>
                  <option value="<?= $m['id_merek'] ?>" <?= $produk['id_merek'] == $m['id_merek'] ? 'selected' : '' ?>><?= $m['nama'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-4">
              <label class="form-label">Harga</label>
              <div class="input-group mb-3">
              <span class="input-group-text">Rp.</span>

              <input type="number" name="harga" class="form-control" value="<?= $produk["harga"]; ?>" required>
              </div>
            </div>
            <div class="mb-4">
              <label class="form-label">Gambar Produk</label>
              <div class="card" style="width: 10rem;">
                <img src="./assets/img/produk/<?= $produk['gambar'] ?>" class="card-img-top" alt="...">
              </div>
              <input type="file" name="gambar" class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

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