<?php
session_start();

require '../config/functions-produk.php';


if (!isset($_SESSION["login"])) { // jika tdak ada session login 
  header("Location: ../login.php"); // Kembali ke hlm login
  exit;
}

$produk = query("SELECT * FROM produk");

include('includes/header.php');
include('includes/navbar.php');
?>



<!-- Content -->
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-6">

      <!-- Form controls -->
      <div class="col-md-12">
        <div class="card">
          <h4 class="card-header fw-extrabold">Buat Pesanan</h4>
          <div class="card-body">
            <!-- Tampilkan nama customer yang dipilih (jika ada di session) -->
            <?php if (isset($_SESSION['customer_nama'])): ?>
              <div class="alert alert-info mb-3">
                <strong>Customer:</strong> <?= htmlspecialchars($_SESSION['customer_nama']) ?>
              </div>
            <?php endif; ?>

            <!-- Form pemilihan customer -->
            <form method="post" action="kode-pesanan.php">
              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label">Pilih Pelangan</label>
                  <select name="id_customer" class="form-select" required onchange="this.form.submit()">
                    <option value="">-- Pilih Pelanggan --</option>
                    <?php
                    require_once '../config/functions-pelanggan.php';
                    $customer = query("SELECT * FROM customer ORDER BY nama ASC");
                    $selected = $_POST['id_customer'] ?? $_SESSION['id_customer'] ?? '';
                    foreach ($customer as $c): ?>
                      <option value="<?= $c['id_customer'] ?>" <?= ($selected == $c['id_customer']) ? 'selected' : '' ?>><?= htmlspecialchars($c['nama']) ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <input type="hidden" name="set_customer" value="1">
            </form>

            <form method="post" action="kode-pesanan.php">
              <div class="row mb-4 align-items-end">
                <div class="col-md-6">
                  <label for="exampleFormControlSelect1" class="form-label">Pilih Produk</label>
                  <select name="id_produk" class="mySelect2 form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                    <option selected>Pilih Produk</option>
                    <?php foreach ($produk as $p) : ?>
                      <option value="<?= $p['id_produk'] ?>"><?= $p['nama_produk'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="defaultInput" class="form-label">Jumlah</label>
                  <input name="jumlah" id="defaultInput" class="form-control form-control-lg" type="number" placeholder="Jumlah" />
                </div>
                <div class="col-md-2">
                  <button type="submit" name="tambahItem" class="btn btn-primary">Tambah Item</button>
                </div>
              </div>
            </form>

            <?php if (isset($_SESSION['success'])): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['success']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
          </div>
        </div>

        <!-- Tabel Daftar Pesanan Sementara -->
        <?php if (!empty($_SESSION['produkItem'])): ?>
          <div class="table-responsive mt-4">
            <table class="table table-bordered align-middle">
              <thead class="table-light">
                <tr>
                  <th>Nama Produk</th>
                  <th>Harga Satuan</th>
                  <th>Qty</th>
                  <th>Total</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $grandTotal = 0;
                foreach ($_SESSION['produkItem'] as $key => $item):
                  $subTotal = $item['harga'] * $item['jumlah'];
                  $grandTotal += $subTotal;
                ?>
                  <tr>
                    <td><?= htmlspecialchars($item['nama_produk']) ?></td>
                    <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                    <td>
                      <form method="post" action="kode-pesanan.php" class="d-inline">
                        <input type="hidden" name="itemKey" value="<?= $key ?>">
                        <button type="submit" name="kurangQty" class="btn btn-outline-secondary btn-sm">-</button>
                      </form>
                      <span class="mx-2 fw-bold"><?= $item['jumlah'] ?></span>
                      <form method="post" action="kode-pesanan.php" class="d-inline">
                        <input type="hidden" name="itemKey" value="<?= $key ?>">
                        <button type="submit" name="tambahQty" class="btn btn-outline-secondary btn-sm">+</button>
                      </form>
                    </td>
                    <td>Rp <?= number_format($subTotal, 0, ',', '.') ?></td>
                    <td>
                      <form method="post" action="kode-pesanan.php" class="d-inline">
                        <input type="hidden" name="itemKey" value="<?= $key ?>">
                        <button type="submit" name="hapusItem" class="btn btn-danger btn-sm">Hapus</button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="3" class="text-end">Total</th>
                  <th colspan="2">Rp <?= number_format($grandTotal, 0, ',', '.') ?></th>
                </tr>
              </tfoot>
            </table>
          </div>
          <form method="post" action="kode-pesanan.php">
            <input type="hidden" name="id_customer" value="<?= isset($_SESSION['id_customer']) ? $_SESSION['id_customer'] : '' ?>">
            <button type="submit" name="simpanTransaksi" class="btn btn-success float-end">Simpan Transaksi</button>
          </form>
        <?php endif; ?>
      </div>
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