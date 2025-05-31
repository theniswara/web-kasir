<?php

require 'config/auth.php';

# Kalau tombol register ditekan
if (isset($_POST["register"])) {
  // Jalankan function
  // Kalau nilai > 0 = ada user baru yang masuk ke db
  if (registrasi($_POST) > 0) {
    // Kasih pop up
    echo "<script>
            alert('User baru berhasil ditambahkan, silahkan Login!')
          </script>";
  } else {
    echo mysqli_error($conn);
  }
}



?>

<!doctype html>

<html
  lang="en"
  class="layout-wide customizer-hide"
  data-assets-path="admin/assets/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Registrasi</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="admin/assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="admin/assets/vendor/fonts/iconify-icons.css" />

  <!-- Core CSS -->
  <!-- build:css assets/vendor/css/theme.css  -->

  <link rel="stylesheet" href="admin/assets/vendor/css/core.css" />
  <link rel="stylesheet" href="admin/assets/css/demo.css" />

  <!-- Vendors CSS -->

  <link rel="stylesheet" href="admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- endbuild -->

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="admin/assets/vendor/css/pages/page-auth.css" />

  <!-- Color changes -->
  <link rel="stylesheet" href="admin/assets/css/custom-overrides.css" />
  <link rel="stylesheet" href="admin/assets/css/sidebar-highlight-overrides.css" />

  <!-- Helpers -->
  <script src="admin/assets/vendor/js/helpers.js"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

  <script src="admin/assets/js/config.js"></script>
</head>

<body>

  <!-- Content -->

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card px-sm-6 px-0">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <span class="text-primary">
                    <svg
                      xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                      <g fill="currentColor">
                        <path d="M1 0a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h5v1H2v2h6V9H2V2h10v4h2V1a1 1 0 0 0-1-1z" />
                        <path d="M10 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zm1 7V9h3v5z" />
                      </g>
                    </svg>
                  </span>
                </span>
                <span class="app-brand-text demo text-heading fw-bold">GadgetIn</span>
              </a>
            </div>
            <!-- /Logo -->
            <h3 class="mb-1">Registrasi</h3>
            <p class="mb-6">Silahkan isi data diri anda untuk melakukan registrasi akun baru.</p>

            <form id="formAuthentication" class="mb-6" action="" method="post">
              <div class="mb-6">
                <label for="username" class="form-label"> Username</label>
                <input
                  type="text"
                  class="form-control"
                  id="username"
                  name="username"
                  placeholder="Masukkan username"
                  autofocus
                  required />

              </div>
              <div class="mb-6">
                <label for="email" class="form-label"> Email</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
                  placeholder="Masukkan email"
                  autofocus
                  required />

              </div>
              <div class="mb-6 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password"
                    required />
                  <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-6 form-password-toggle">
                <label class="form-label" for="password2">Konfirmasi Password</label>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password2"
                    class="form-control"
                    name="password2"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" 
                    aria-describedby="password"
                    required />
                  <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-6">
                <button class="btn btn-primary d-grid w-100" type="submit" name="register">Registrasi</button>
              </div>
            </form>

            <p class="text-center">
              <span>Sudah punya akun?</span>
              <a href="login.php">
                <span class="text-primary fw-bold"> Login</span>
              </a>
            </p>

          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>

  <!-- / Content -->
  <?php

  include('includes/scripts.php');
  include('includes/footer.php');

  ?>