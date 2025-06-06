<?php
session_start();
require '../config/functions-pelanggan.php';

if (!isset($_SESSION["login"])) { // jika tdak ada session login 
  header("Location: ../login.php"); // Kembali ke hlm login
  exit;
}

// Cek apakah tombol submit sudah ditekan
if (isset($_POST["submit"])) {
  
  // Cek apakah data berhasil ditambahkan
  if ( tambahPelanggan($_POST) > 0) {
    echo "<script>
            alert('Data berhasil ditambahkan')
            document.location.href = 'list-pelanggan.php'
          </script>";
  } else {
    echo "<script>
            alert('Data gagal ditambahkan')
            document.location.href = 'list-pelanggan.php'
          </script>";
  }


  // cek apakah data berhasil ditambahkan
  var_dump(mysqli_affected_rows($conn));
}

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
  <!-- Basic Layout -->
  <div class="row mb-6 gy-6">
    <div class="col-xl">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="mb-0 fw-bold">Tambah Pelangan</h4>
          <small class="text-body float-end">Pelanggan/Cusomer</small>
        </div>
        <div class="card-body">
          <form method="post" action="">
            <div class="mb-6">
              <label class="form-label" for="basic-icon-default-fullname">Nama</label>
              <div class="input-group input-group-merge">
                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="icon-base bx bx-user"></i></span>
                <input
                  type="text"
                  class="form-control"
                  name="nama"
                  id="nama"
                  placeholder="Masukkan nama lengkap..."
                  aria-describedby="basic-icon-default-fullname2" autofocus required/>
              </div>
            </div>
            <div class="mb-6">
              <label class="form-label" for="basic-icon-default-email">Email</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="icon-base bx bx-envelope"></i></span>
                <input
                  type="email"
                  id="email"
                  name="email"
                  class="form-control"
                  placeholder="user@email.com"
                  aria-label="user@email.com"
                  aria-describedby="basic-icon-default-email2" required/>
              </div>
            </div>  
            <div class="mb-6">
              <label class="form-label" for="basic-icon-default-phone">No Telepon</label>
              <div class="input-group input-group-merge">
                <span id="basic-icon-default-phone2" class="input-group-text"><i class="icon-base bx bx-phone"></i></span>
                <input
                  type="text"
                  id="no_hp"
                  name="no_hp"
                  class="form-control phone-mask"
                  placeholder="658 799 8941"
                  aria-label="658 799 8941"
                  aria-describedby="basic-icon-default-phone2" required/>
              </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- / Content -->

<script>
  // Sidebar active tab logic for List Produk
  document.addEventListener('DOMContentLoaded', function() {
    var sidebarLink = document.querySelector('a[href="tambah-pelanggan.php"]');
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