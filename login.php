<?php
session_start();
require 'config/dbcon.php';
require 'config/auth.php';


if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  // ambil username berdasarkan id
  $result = mysqli_query($conn, "SELECT username FROM user WHERE id_user = $id");
  $row = mysqli_fetch_assoc($result);

  // cek cookie dan username
  if ($key === hash('sha256', $row['username'])) {
    $_SESSION['login'] = true;
  }
}

if (isset($_SESSION["login"])) {
  header("Location: admin/index.php");
  exit;
}


// Cek apakah tombol login sudah ditekan 
// Form menggunakan method post
if (isset($_POST["login"])) {

  $username = $_POST["username"];
  $password = $_POST["password"];

  // Cek satu per satu username & pass apakah ada di db
  $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

  // cek username
  // mysqli_num_rows = ngitung berapa baris yang dikembalikan dari fungsi select
  if (mysqli_num_rows($result) === 1) {
    // jika hasilnya = 1 maka ada

    // cek password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) { // ngcek stirng apakah sama dengan hashnya
      // Sebelum ke hlm index, set session dulu
      $_SESSION["login"] = true;

      // cek remember me
      if (isset($_POST['remember-me'])) {
        // buat cookie
        setcookie('id', $row['id_user'], time() + 60,);
        setcookie('key', hash('sha256', $row['username']), time() + 60);
      }

      // perbolehkan user masuk ke sistem
      header("Location: admin/index.php");
      exit;
    }
  }

  $error = true;
}


include('includes/header.php');

?>
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
          <h3 class="mb-1">Login </h3>
          <p class="mb-6">Login untuk masuk ke halaman Dashboard</p>
          <?php if (isset($error)) : ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <strong>Username atau Password salah!</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

          <?php endif; ?>

          <form id="formAuthentication" class="mb-6" action="" method="post">
            <div class="mb-6">
              <label for="email" class="form-label">Username</label>
              <input
                type="text"
                class="form-control"
                id="username"
                name="username"
                placeholder="Masukkan username"
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
            <div class="mb-8">
              <div class="d-flex justify-content-between">
                <div class="form-check mb-0">
                  <input class="form-check-input" type="checkbox" name="remember-me" id="remember-me" />
                  <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
                <a href="auth-forgot-password-basic.html">
                  <span>Forgot Password?</span>
                </a>
              </div>
            </div>
            <div class="mb-6">
              <button class="btn btn-primary d-grid w-100" name="login" type="submit">Login</button>
            </div>
          </form>

          <p class="text-center">
            <span>Belum punya akun?</span>
            <a href="registrasi.php">
              <span class="text-primary fw-bold">Buat akun</span>
            </a>
          </p>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
</div>

<!-- / Content -->
<?php include('includes/footer.php'); ?>