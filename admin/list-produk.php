<?php
session_start();

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
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <img
                        src="assets/img/produk/samsung-a14.avif"
                        alt=""
                        style="width: 80px; height: 80px"
                        class="rounded  mx-auto d-block "
                        />
                  </div>
                </td>
                <td>
                  <p class="fw-medium mb-1">Samsung Galaxy A14</p>
                </td>
                <td>
                  <span class="badge badge-success rounded-pill d-inline">15</span>
                </td>
                <td>Rp. 2,500,000.00</td>
                <td>
                  <button type="button" class="btn btn-link btn-sm btn-rounded">
                    Edit
                  </button>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <img
                        src="https://mdbootstrap.com/img/new/avatars/6.jpg"
                        class="rounded-circle"
                        alt=""
                        style="width: 45px; height: 45px"
                        />
                  </div>
                </td>
                <td>
                  <p class="fw-normal mb-1">Consultant</p>
                  <p class="text-muted mb-0">Finance</p>
                </td>
                <td>
                  <span class="badge badge-primary rounded-pill d-inline"
                        >Onboarding</span
                    >
                </td>
                <td>Junior</td>
                <td>
                  <button
                          type="button"
                          class="btn btn-link btn-rounded btn-sm fw-bold"
                          data-mdb-ripple-color="dark"
                          >
                    Edit
                  </button>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <img
                        src="https://mdbootstrap.com/img/new/avatars/7.jpg"
                        class="rounded-circle"
                        alt=""
                        style="width: 45px; height: 45px"
                        />
                  </div>
                </td>
                <td>
                  <p class="fw-normal mb-1">Designer</p>
                  <p class="text-muted mb-0">UI/UX</p>
                </td>
                <td>
                  <span class="badge badge-warning rounded-pill d-inline">Awaiting</span>
                </td>
                <td>Senior</td>
                <td>
                  <button
                          type="button"
                          class="btn btn-link btn-rounded btn-sm fw-bold"
                          data-mdb-ripple-color="dark"
                          >
                    Edit
                  </button>
                </td>
              </tr>
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
