<?php
session_start();

require '../config/functions-produk.php';


if (!isset($_SESSION["login"])) { // jika tdak ada session login 
  header("Location: ../login.php"); // Kembali ke hlm login
  exit;
}

$produk = query("SELECT * FROM produk");

include('includes/header.php');
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row g-6">

    <!-- Form controls -->
    <div class="col-md-12">
      <div class="card">
        <h4 class="card-header fw-extrabold">Buat Pesanan</h4>
        <div class="card-body">
          <div class="row mb-4 align-items-end">
            <div class="col-md-6">
              <label for="exampleFormControlSelect1" class="form-label">Example select</label>
              <select name="id_produk" class=" mySelect2 form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                <option selected>Pilih Produk</option>
                <?php 
                  foreach ($produk as $p) : ?>
                  <option value="<?= $p['id_produk'] ?>"><?= $p['nama_produk'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-4">
              <label for="defaultInput" class="form-label">Quantity</label>
              <input name="quantity" id="defaultInput" class="form-control form-control-lg" type="number" placeholder="Default input" />
            </div>
            <div class="col-md-2">
            <button type="submit" name="tambahItem" class="btn btn-primary">Tambah Item</button>
          </div>

        

        </div>
      </div>
    </div>

    <!-- Input Sizing -->
    <!-- <div class="col-md-6">
      <div class="card">
        <h5 class="card-header">Input Sizing & Shape</h5>
        <div class="card-body">
          <small class="fw-medium">Input text</small>

          <div class="mt-2 mb-4">
            <label for="largeInput" class="form-label">Large input</label>
            <input
              id="largeInput"
              class="form-control form-control-lg"
              type="text"
              placeholder=".form-control-lg" />
          </div>
          <div class="mb-4">
            <label for="defaultInput" class="form-label">Default input</label>
            <input id="defaultInput" class="form-control" type="text" placeholder="Default input" />
          </div>
          <div>
            <label for="smallInput" class="form-label">Small input</label>
            <input
              id="smallInput"
              class="form-control form-control-sm"
              type="text"
              placeholder=".form-control-sm" />
          </div>
        </div>
        <hr class="m-0" />
        <div class="card-body">
          <small class="fw-medium">Input select</small>
          <div class="mt-2 mb-4">
            <label for="largeSelect" class="form-label">Large select</label>
            <select id="largeSelect" class="form-select form-select-lg">
              <option>Large select</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
          <div class="mb-4">
            <label for="defaultSelect" class="form-label">Default select</label>
            <select id="defaultSelect" class="form-select">
              <option>Default select</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
          <div>
            <label for="smallSelect" class="form-label">Small select</label>
            <select id="smallSelect" class="form-select form-select-sm">
              <option>Small select</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
        </div>
        <hr class="m-0" />
        <div class="card-body">
          <small class="fw-medium">Input Shape</small>
          <div class="mt-2">
            <label for="roundedInput" class="form-label">Rounded input</label>
            <input
              id="roundedInput"
              class="form-control rounded-pill"
              type="text"
              placeholder="Default input" />
          </div>
        </div>
      </div>
    </div> -->

  </div>
</div>
<!-- / Content -->



<script>
  // Sidebar active tab logic for List Produk
  document.addEventListener('DOMContentLoaded', function() {
    var sidebarLink = document.querySelector('a[href="buat-pesanan.php"]');
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
<?php
include('includes/footer.php')
?>