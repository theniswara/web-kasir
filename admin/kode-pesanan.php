<?php
session_start();
require("../config/dbcon.php");
require("../config/functions-produk.php");
require("../config/functions-pelanggan.php");

// Inisialisasi session array jika belum ada
if (!isset($_SESSION['produkItem'])) $_SESSION['produkItem'] = [];
if (!isset($_SESSION['produkItemId'])) $_SESSION['produkItemId'] = [];

// Tambah produk ke keranjang
if (isset($_POST['tambahItem'])) {
  $productId = htmlspecialchars($_POST['id_produk']);
  $jumlah = (int) htmlspecialchars($_POST['jumlah']);
  if ($jumlah < 1) $jumlah = 1;

  $cekProduk = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$productId' LIMIT 1");
  if ($cekProduk && mysqli_num_rows($cekProduk) > 0) {
    $row = mysqli_fetch_assoc($cekProduk);
    if ($row['stok'] < $jumlah) {
      $_SESSION['error'] = 'Stok hanya tersedia ' . $row['stok'];
      header('Location: buat-pesanan.php');
      exit;
    }
    // Cek apakah produk sudah ada di keranjang
    $found = false;
    foreach ($_SESSION['produkItem'] as $key => $item) {
      if ($item['id_produk'] == $productId) {
        // Update qty
        $newQty = $item['jumlah'] + $jumlah;
        if ($row['stok'] < $newQty) {
          $_SESSION['error'] = 'Stok hanya tersedia ' . $row['stok'];
          header('Location: buat-pesanan.php');
          exit;
        }
        $_SESSION['produkItem'][$key]['jumlah'] = $newQty;
        $found = true;
        break;
      }
    }
    if (!$found) {
      $_SESSION['produkItem'][] = [
        'id_produk' => $row['id_produk'],
        'gambar' => $row['gambar'],
        'nama_produk' => $row['nama_produk'],
        'harga' => $row['harga'],
        'jumlah' => $jumlah
      ];
    }
    $_SESSION['success'] = 'Item berhasil ditambahkan!';
    header('Location: buat-pesanan.php');
    exit;
  } else {
    $_SESSION['error'] = 'Produk tidak ditemukan!';
    header('Location: buat-pesanan.php');
    exit;
  }
}

// Tambah qty
if (isset($_POST['tambahQty'])) {
  $key = (int)$_POST['itemKey'];
  if (isset($_SESSION['produkItem'][$key])) {
    $id_produk = $_SESSION['produkItem'][$key]['id_produk'];
    $cekProduk = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id_produk' LIMIT 1");
    $row = mysqli_fetch_assoc($cekProduk);
    if ($_SESSION['produkItem'][$key]['jumlah'] < $row['stok']) {
      $_SESSION['produkItem'][$key]['jumlah']++;
    } else {
      $_SESSION['error'] = 'Stok hanya tersedia ' . $row['stok'];
    }
  }
  header('Location: buat-pesanan.php');
  exit;
}
// Kurangi qty
if (isset($_POST['kurangQty'])) {
  $key = (int)$_POST['itemKey'];
  if (isset($_SESSION['produkItem'][$key])) {
    if ($_SESSION['produkItem'][$key]['jumlah'] > 1) {
      $_SESSION['produkItem'][$key]['jumlah']--;
    }
  }
  header('Location: buat-pesanan.php');
  exit;
}
// Hapus item
if (isset($_POST['hapusItem'])) {
  $key = (int)$_POST['itemKey'];
  if (isset($_SESSION['produkItem'][$key])) {
    unset($_SESSION['produkItem'][$key]);
    $_SESSION['produkItem'] = array_values($_SESSION['produkItem']);
  }
  header('Location: buat-pesanan.php');
  exit;
}

// Simpan transaksi
if (isset($_POST['simpanTransaksi'])) {
  if (empty($_SESSION['produkItem'])) {
    $_SESSION['error'] = 'Tidak ada item dalam pesanan!';
    header('Location: buat-pesanan.php');
    exit;
  }
  $id_user = $_SESSION['id_user'] ?? 1; // Ganti dengan session login user
  $id_customer = $_POST['id_customer'] ?? null;
  if (!$id_customer) {
    $_SESSION['error'] = 'Pilih customer terlebih dahulu!';
    header('Location: buat-pesanan.php');
    exit;
  }
  $tanggal = date('Y-m-d');
  $total = 0;
  foreach ($_SESSION['produkItem'] as $item) {
    $total += $item['harga'] * $item['jumlah'];
  }
  // Simpan ke tabel transaksi
  $query = "INSERT INTO transaksi (id_user, id_customer, tanggal, total) VALUES ('$id_user', '$id_customer', '$tanggal', '$total')";
  if (mysqli_query($conn, $query)) {
    $id_transaksi = mysqli_insert_id($conn);
    // Simpan detail transaksi
    foreach ($_SESSION['produkItem'] as $item) {
      $id_produk = $item['id_produk'];
      $qty = $item['jumlah'];
      $harga = $item['harga'];
      mysqli_query($conn, "INSERT INTO detail_transaksi (id_transaksi, id_produk, qty, harga_satuan) VALUES ('$id_transaksi', '$id_produk', '$qty', '$harga')");
      // Update stok produk
      mysqli_query($conn, "UPDATE produk SET stok = stok - $qty WHERE id_produk = '$id_produk'");
    }
    unset($_SESSION['produkItem']);
    $_SESSION['success'] = 'Transaksi berhasil disimpan!';
    header('Location: buat-pesanan.php');
    exit;
  } else {
    $_SESSION['error'] = 'Gagal menyimpan transaksi!';
    header('Location: buat-pesanan.php');
    exit;
  }
}

// Set customer ke session saat dipilih
if (isset($_POST['set_customer']) && isset($_POST['id_customer'])) {
  $id_customer = $_POST['id_customer'];
  $_SESSION['id_customer'] = $id_customer;
  // Ambil nama customer untuk ditampilkan
  $q = mysqli_query($conn, "SELECT nama FROM customer WHERE id_customer='$id_customer' LIMIT 1");
  $row = mysqli_fetch_assoc($q);
  $_SESSION['customer_nama'] = $row ? $row['nama'] : '';
  header('Location: buat-pesanan.php');
  exit;
}
