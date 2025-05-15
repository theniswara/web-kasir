<?php 
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "toko_gadget");

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>