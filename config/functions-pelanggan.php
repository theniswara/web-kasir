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
function tambahPelanggan($data)
{
  global $conn;

  $nama = htmlspecialchars($data["nama"]);
  $no_hp = htmlspecialchars($data["no_hp"]);
  $email = htmlspecialchars($data["email"]);

  // query insert data
  $query = "INSERT INTO customer 
          VALUES
          ('', '$nama', '$no_hp', '$email')";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}



function hapusPelanggan($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM customer WHERE id_customer = $id");
  return mysqli_affected_rows($conn);
}

// function ubah
function editPelanggan($data)
{
  global $conn;

  $id_customer = $data["id_customer"];
  $nama = htmlspecialchars($data["nama"]);
  $no_hp = htmlspecialchars($data["no_hp"]);
  $email = htmlspecialchars($data["email"]);

  // query insert data
  $query = "UPDATE customer
          SET
          nama = '$nama',
          no_hp = '$no_hp',
          email = '$email'
          WHERE id_customer = $id_customer
          ";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

// function cari
function cari($keyword)
{
  $query = "SELECT * FROM customer 
                  WHERE 
                nama LIKE '%$keyword%'
      ";
  return query($query);
}
