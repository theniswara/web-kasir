<?php
require_once '../config/dbcon.php';

// Function tambah pelanggan  
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
  // Hapus detail_transaksi yang berelasi dengan transaksi milik customer ini
  $result = mysqli_query($conn, "SELECT id_transaksi FROM transaksi WHERE id_customer = $id");
  while ($row = mysqli_fetch_assoc($result)) {
    $id_transaksi = $row['id_transaksi'];
    mysqli_query($conn, "DELETE FROM detail_transaksi WHERE id_transaksi = $id_transaksi");
  }
  // Hapus transaksi milik customer ini
  mysqli_query($conn, "DELETE FROM transaksi WHERE id_customer = $id");
  // Baru hapus customer
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

// Hapus function cari() di sini, gunakan yang dari functions-produk.php saja
