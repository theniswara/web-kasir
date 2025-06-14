<?php 
session_start();
require '../config/functions-produk.php';

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
  if ( editProduk($_POST) > 0) {
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

<nav
  class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
  id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
      <i class="icon-base bx bx-menu icon-md"></i>
    </a>
  </div>

  <!-- Brand/Logo -->
  <a class="navbar-brand fw-bold text-primary d-none d-xl-block me-4" href="index.php" style="font-size:1.5rem; letter-spacing:1px;">
    <i class="icon-base bx bx-store-alt me-2"></i>GadgetIn Admin
  </a>

  <!-- Search Bar
  <form class="d-none d-md-flex flex-grow-1 mx-4" role="search" style="max-width:400px;">
    <input class="form-control border-0 shadow-sm" type="search" placeholder="Cari produk, kategori..." aria-label="Search">
    <button class="btn btn-outline-primary ms-2" type="submit"><i class="bx bx-search"></i></button>
  </form> -->

  <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">

    <ul class="navbar-nav flex-row align-items-center ms-md-auto">
      <!-- Place this tag where you want the button to render. -->
      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a
          class="nav-link dropdown-toggle hide-arrow p-0"
          href="javascript:void(0);"
          data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online">
                    <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="mb-0">John Doe</h6>
                  <small class="text-body-secondary">Admin</small>
                </div>
              </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider my-1"></div>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <i class="icon-base bx bx-user icon-md me-3"></i><span>My Profile</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <i class="icon-base bx bx-cog icon-md me-3"></i><span>Settings</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <span class="d-flex align-items-center align-middle">
                <i class="flex-shrink-0 icon-base bx bx-credit-card icon-md me-3"></i><span class="flex-grow-1 align-middle">Billing Plan</span>
                <span class="flex-shrink-0 badge rounded-pill bg-danger">4</span>
              </span>
            </a>
          </li>
          <li>
            <div class="dropdown-divider my-1"></div>
          </li>
          <li>
            <a class="dropdown-item" href="../logout.php">
              <i class="icon-base bx bx-power-off icon-md me-3"></i><span>Log Out</span>
            </a>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>
</nav>

<!-- / Navbar -->

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
              <label class="form-label" for="stok">Stok / Jumlah</label>
              <input type="number" name="stok" id="stok" class="form-control" value="<?= $produk["stok"]; ?>" min="0" required>
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
    var sidebarLink = document.querySelector('a[href="edit-produk.php"]');
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