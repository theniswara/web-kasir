<?php
session_start();
require '../config/functions-produk.php';
$produk = query("SELECT * FROM produk");


if (!isset($_SESSION["login"])) { // jika tdak ada session login 
  header("Location: ../login.php"); // Kembali ke hlm login
  exit;
}

// tombol cari ditekan
if (isset($_POST["cari"])) {
  $books = cari($_POST["keyword"]);
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

  <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center me-auto">
      <div class="nav-item d-flex align-items-center">
        <span class="w-px-22 h-px-22"><i class="icon-base bx bx-search icon-md"></i></span>
        <form class="d-none d-md-flex flex-grow-1 mx-4" role="search" style="max-width:400px;" action="" method="post">
          <input
            type="text"
            class="form-control border-0 shadow-none ps-1 ps-sm-2 d-md-block d-none"
            id="keyword"
            name="keyword"
            placeholder="Cari..."
            aria-label="Search..."
            autocomplete="off"
            autofocus />
        </form>
      </div>
    </div>
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-md-auto">
      <ul class="navbar-nav flex-row align-items-center ms-md-auto">
        <li class="nav-item">
          <a class="btn btn-danger btn-sm fw-bold px-3" href="../logout.php">
            <i class="icon-base bx bx-power-off me-2"></i>Log Out
          </a>
        </li>
      </ul>
    </ul>
  </div>
</nav>

<!-- / Navbar -->

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
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-primary text-white align-middle">
            <tr>
              <th class="text-center" style="width:5%">No</th>
              <th style="width:12%">Gambar</th>
              <th style="width:22%">Nama Produk</th>
              <th style="width:13%">Kategori</th>
              <th style="width:13%">Merek</th>
              <th style="width:8%">Stok</th>
              <th style="width:14%">Harga</th>
              <th class="text-center" style="width:13%">Aksi</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <?php $i = 1; ?>
            <?php foreach ($produk as $row) : ?>
              <tr>
                <td class="text-center fw-bold"> <?= $i ?> </td>
                <td>
                  <div class="d-flex align-items-center justify-content-center">
                    <img src="assets/img/produk/<?= $row['gambar'] ?>" alt="" style="width: 70px; height: 70px; object-fit: cover;" class="rounded shadow-sm mx-auto d-block" />
                  </div>
                </td>
                <td class="align-middle">
                  <span class="fw-semibold text-dark"><?= htmlspecialchars($row['nama_produk']) ?></span>
                </td>
                <td class="text-center align-middle">
                  <?php
                  if ($row['id_kategori'] == 1) {
                    echo '<a title="Smartphone"><span class="badge bg-label-info"><i class="menu-icon tf-icons bx bxs-smartphone mx-auto"></i></span></a>';
                  } elseif ($row['id_kategori'] == 2) {
                    echo '<a title="Laptop"><span class="badge bg-label-warning"><i class="menu-icon tf-icons bx bx-laptop mx-auto"></i></span></a>';
                  } else {
                    echo '<span class="badge bg-secondary rounded-pill d-inline"><i class="bx bx-question-mark"></i> Lainnya</span>';
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
                    } else if ($row['id_merek'] == 11) {
                      echo 'Nokia';
                    } else {
                      echo '<span class="badge bg-secondary rounded-pill d-inline"><i class="bx bx-question-mark"></i> Lainnya</span>';
                    } ?>
                  </span>
                </td>
                <td class="align-middle text-center">
                  <span class="badge bg-label-primary fs-6 px-3 py-2"><i class="bx bx-cube me-1"></i><?= htmlspecialchars($row['stok']) ?></span>
                </td>
                <td class="align-middle text-end">
                  <span class="fw-bold">Rp. <?= number_format($row['harga'], 0, ',', '.') ?></span>
                </td>
                <td>
                  <div class="d-flex justify-content-center gap-2">
                    <?php if ($row["stok"] == 0) { ?>
                      <a href="edit-produk.php?id=<?= $row["id_produk"] ?>" class="btn btn-success btn-sm btn-rounded" title="Edit">
                        <i class="bx bx-edit"></i>
                      </a>
                    <?php } else { ?>
                      <a href="edit-produk.php?id=<?= $row["id_produk"] ?>" class="btn btn-success btn-sm btn-rounded" title="Edit">
                        <i class="bx bx-edit"></i>
                      </a>
                      <a href="../config/hapus-produk.php?id=<?= $row["id_produk"] ?>" class="btn btn-danger btn-sm btn-rounded" title="Hapus" onclick="return confirm('Yakin ingin menghapus produk ini?');">
                        <i class="bx bx-trash"></i>
                      </a>
                    <?php }; ?>
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