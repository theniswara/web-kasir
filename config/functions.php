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

  $nama_produk = htmlspecialchars($data ["nama_produk"]);
  $id_kategori = htmlspecialchars($data["id_kategori"]);
  $harga = htmlspecialchars($data["harga"]);
  $id_merek = htmlspecialchars($data["id_merek"]);

  // upload gambar
  $gambar = upload();
  if (!$gambar) {
    return false;
  }

  // query insert data
$query = "INSERT INTO produk 
          VALUES
          ('', '$gambar', '$nama_produk', '1', '$harga', '$id_kategori', '$id_merek')";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn); 

}

// function upload
function upload() {
  $namaFile = $_FILES['gambar']['name'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

  // cek apakah adakah ada / tidak gambat yg diupload
  if( $error === 4 ) {
    echo "<script>
          alert('Pilih gambar!');
          </script>
          ";
    return false;
  }

  // Cek apakah yang diupload adalah gambar
  $ekstensiValid  = ['jpg', 'jpeg', 'png'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, $ekstensiValid)) {
      echo "<script>
          alert('Yang anda upload bukan gambar!');
          </script>";
    return false;
  }

  // cek jika ukurannya terlalu besar
  if ($ukuranFile > 10000000) {
        echo "<script>
          alert('Ukuran Gambar terlalu besar!');
          </script>";
    return false;
  }

  // lolos pengecekan, gambar siap diupload
  // generate nama file baru
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiGambar;


  move_uploaded_file($tmpName, './assets/img/produk/' . $namaFileBaru);

  return $namaFileBaru;

}

function hapus($id) {
  global $conn;
  mysqli_query($conn, "DELETE FROM produk WHERE id_produk = $id");
  return mysqli_affected_rows($conn);
}

// function ubah
function edit($data) {
    global $conn;
    
  $id_produk = $data["id_produk"];
  $nama_produk = htmlspecialchars($data ["nama_produk"]);
  $id_kategori = htmlspecialchars($data["id_kategori"]);
  $harga = htmlspecialchars($data["harga"]);
  $id_merek = htmlspecialchars($data["id_merek"]);
  $gambarLama = htmlspecialchars($data["gambarLama"]);

  // cek apakah user pilih gambar baru / tidak
  if ($_FILES['gambar']['error'] === 4) {
    $gambar = $gambarLama;
  } else {
  $gambar = upload();
  }


  // query insert data
$query = "UPDATE produk
          SET
          nama_produk = '$nama_produk',
          id_kategori = '$id_kategori',
          harga = '$harga',
          gambar = '$gambar',
          id_merek = '$id_merek'
          WHERE id_produk = $id_produk
          ";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn); 

}

// function cari
    function cari($keyword) {
      $query = "SELECT * FROM produk 
                  WHERE 
                nama_produk LIKE '%$keyword%'
      ";
      return query($query);
    }

?>