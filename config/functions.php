<?php 
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "toko_gadget");



function query($query) {
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = []; // Kotak kosong untuk menampung data
  while( $row = mysqli_fetch_assoc($result) ) {
    $rows[] = $row; // Menampung data ke dalam kotak
  }
  return $rows;
}

// Function registrasi
function registrasi($data){
  // konek ke database
  global $conn;


  // stripslashes = membersihkan username 
  // Memaksa agar input menjadi huruf kecil
  $username = strtolower(stripslashes($data["username"]));

  // Memungkinkan user memasukan tanda kutip
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

//     // Mengatasi sring kosong
//   if (empty(trim($username))) {
//     return false;
// } 

  // Cek username sudah ada / belum
  $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

  if(mysqli_fetch_assoc($result)) {
    echo "<script>
            alert('Username sudah terdaftar')
          </script>";
      return false;
  }

  // Konfirmasi password
  if($password != $password2) {
    echo "<script>
            alert('konfirmasi password tidak sesuai')
          </script>";
          return false;
  }

  // enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // Tambahkan user baru ke database
  mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password', '')");

  // Menghasilkan 1 jika berhasil -1 jika gagal
  return mysqli_affected_rows($conn);


}

// Function tambah produk
function tambah($data) {
  global $conn;

  $nama_produk = $data["nama_produk"];
  $id_kategori = $data["id_kategori"];
  $harga = $data["harga"];
  $gambar = $data["gambar"];
  $id_merek = $data["id_merek"];

  // query insert data
$query = "INSERT INTO produk 
          VALUES
          ('', '$gambar', '$nama_produk', '1', '', '$harga', '$id_kategori', '$id_merek')";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn); 

}


?>