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
include('includes/navbar.php');
{
  # code...
}
?>

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