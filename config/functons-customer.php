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

function hapus($id) {
  global $conn;
  mysqli_query($conn, "DELETE FROM customer WHERE id = $id");
  return mysqli_affected_rows($conn);
}

