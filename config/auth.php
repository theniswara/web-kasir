<?php
include 'dbcon.php';

// Function registrasi
function registrasi($data)
{
  // konek ke database
  global $conn;


  // stripslashes = membersihkan username 
  // Memaksa agar input menjadi huruf kecil
  $username = strtolower(stripslashes($data["username"]));
  $email = strtolower(stripslashes($data["email"]));

  // Memungkinkan user memasukan tanda kutip
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $password2 = mysqli_real_escape_string($conn, $data["password2"]);

  //     // Mengatasi sring kosong
  //   if (empty(trim($username))) {
  //     return false;
  // } 

  // Cek username sudah ada / belum
  $resultUsername = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

  if (mysqli_fetch_assoc($resultUsername)) {
    echo "<script>
            alert('Username sudah terdaftar')
          </script>";
    return false;
  }

  // Cek email sudah ada / belum
  $resultEmail = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email' ");

  if (mysqli_fetch_assoc($resultEmail)) {
    echo "<script>
          alert ('Email sudah terdaftar!')  
        </script>";
    return false; 
  }

  // Konfirmasi password
  if ($password != $password2) {
    echo "<script>
            alert('konfirmasi password tidak sesuai')
          </script>";
    return false;
  }

  // enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // Tambahkan user baru ke database
  mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$email', '$password', '')");

  // Menghasilkan 1 jika berhasil -1 jika gagal
  return mysqli_affected_rows($conn);
}

?>