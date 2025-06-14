<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "toko_gadget");



function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = []; // Kotak kosong untuk menampung data
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row; // Menampung data ke dalam kotak
  }
  return $rows;
}



// Function tambah produk
function tambahProduk($data)
{
  global $conn;

  $nama_produk = htmlspecialchars($data["nama_produk"]);
  $id_kategori = htmlspecialchars($data["id_kategori"]);
  $harga = htmlspecialchars($data["harga"]);
  $id_merek = htmlspecialchars($data["id_merek"]);
  $stok = htmlspecialchars($data["stok"]);

  // upload gambar
  $gambar = upload();
  if (!$gambar) {
    return false;
  }

  // query insert data Produk
  $query = "INSERT INTO produk 
          VALUES
          ('', '$gambar', '$nama_produk', '$harga', '$stok', '$id_kategori', '$id_merek')";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

// function upload
function upload()
{
  $namaFile = $_FILES['gambar']['name'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

  // cek apakah adakah ada / tidak gambat yg diupload
  if ($error === 4) {
    echo "<script>
          alert('Pilih gambar!');
          </script>
          ";
    return false;
  }

  // Cek apakah yang diupload adalah gambar
  $ekstensiValid  = ['jpg', 'jpeg', 'png', 'webp'];
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

function hapusProduk($id)
{
  global $conn;
  // Hapus dulu detail transaksi yang terkait produk ini
  mysqli_query($conn, "DELETE FROM detail_transaksi WHERE id_produk = $id");
  // Baru hapus produk
  mysqli_query($conn, "DELETE FROM produk WHERE id_produk = $id");
  return mysqli_affected_rows($conn);
}

// function ubah
function editProduk($data)
{
  global $conn;

  $id_produk = $data["id_produk"];
  $nama_produk = htmlspecialchars($data["nama_produk"]);
  $id_kategori = htmlspecialchars($data["id_kategori"]);
  $harga = htmlspecialchars($data["harga"]);
  $id_merek = htmlspecialchars($data["id_merek"]);
  $gambarLama = htmlspecialchars($data["gambarLama"]);
  $stok = htmlspecialchars($data["stok"]);

  // cek apakah user pilih gambar baru / tidak
  if ($_FILES['gambar']['error'] === 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = upload();
  }

  // query update data
  $query = "UPDATE produk
          SET
          nama_produk = '$nama_produk',
          id_kategori = '$id_kategori',
          harga = '$harga',
          gambar = '$gambar',
          id_merek = '$id_merek',
          stok = '$stok'
          WHERE id_produk = $id_produk
          ";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

// function cari
function cari($keyword)
{
  $query = "SELECT * FROM produk 
                  WHERE 
                nama_produk LIKE '%$keyword%'
      ";
  return query($query);
}
