<?php
session_start();
require '../config/dbcon.php';

if (!isset($_GET['id'])) {
  echo '<div class="alert alert-danger">ID transaksi tidak ditemukan.</div>';
  exit;
}
$id_transaksi = intval($_GET['id']);

// Ambil data transaksi
$q = mysqli_query($conn, "SELECT t.*, c.nama as customer_nama, c.no_hp, c.email, u.username as kasir_nama FROM transaksi t LEFT JOIN customer c ON t.id_customer = c.id_customer LEFT JOIN user u ON t.id_user = u.id_user WHERE t.id_transaksi='$id_transaksi' LIMIT 1");
$transaksi = mysqli_fetch_assoc($q);
if (!$transaksi) {
  echo '<div class="alert alert-danger">Transaksi tidak ditemukan.</div>';
  exit;
}
// Ambil detail produk
$detail = mysqli_query($conn, "SELECT d.*, p.nama_produk FROM detail_transaksi d LEFT JOIN produk p ON d.id_produk = p.id_produk WHERE d.id_transaksi='$id_transaksi'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Struk Transaksi #<?= $id_transaksi ?></title>
  <link rel="stylesheet" href="assets/css/demo.css">
  <link rel="stylesheet" href="assets/vendor/css/core.css">
  <style>
    body {
      background: #f8f9fa;
    }

    .struk-box {
      max-width: 500px;
      margin: 30px auto;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 8px #0001;
      padding: 32px;
    }

    .struk-box h4 {
      margin-bottom: 16px;
    }

    .struk-box table {
      width: 100%;
      margin-bottom: 16px;
    }

    .struk-box th,
    .struk-box td {
      padding: 6px 8px;
    }

    .struk-box .total {
      font-weight: bold;
      font-size: 1.1em;
    }

    .struk-box .text-end {
      text-align: right;
    }

    .struk-box .text-center {
      text-align: center;
    }

    @media print {
      .btn-print {
        display: none;
      }
    }
  </style>
</head>

<body>
  <div class="struk-box">
    <h4 class="text-center">Struk Transaksi</h4>
    <div><b>No. Transaksi:</b> <?= $id_transaksi ?></div>
    <div><b>Tanggal:</b> <?= htmlspecialchars($transaksi['tanggal']) ?></div>
    <div><b>Customer:</b> <?= htmlspecialchars($transaksi['customer_nama']) ?> (<?= htmlspecialchars($transaksi['no_hp']) ?>)</div>
    <div><b>Kasir:</b> <?= htmlspecialchars($transaksi['kasir_nama']) ?></div>
    <hr>
    <table border="1" cellpadding="4" cellspacing="0">
      <thead>
        <tr>
          <th>Produk</th>
          <th>Harga</th>
          <th>Qty</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php $grandTotal = 0;
        while ($row = mysqli_fetch_assoc($detail)): $sub = $row['harga_satuan'] * $row['qty'];
          $grandTotal += $sub; ?>
          <tr>
            <td><?= htmlspecialchars($row['nama_produk']) ?></td>
            <td class="text-end">Rp <?= number_format($row['harga_satuan'], 0, ',', '.') ?></td>
            <td class="text-center"><?= $row['qty'] ?></td>
            <td class="text-end">Rp <?= number_format($sub, 0, ',', '.') ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="3" class="text-end">Total</th>
          <th class="text-end">Rp <?= number_format($grandTotal, 0, ',', '.') ?></th>
        </tr>
      </tfoot>
    </table>
    <div class="text-center mt-3">
      <button class="btn btn-primary btn-print" onclick="window.print()">Cetak Struk</button>
      <a href="pesanan.php" class="btn btn-secondary btn-print">Kembali</a>
    </div>
  </div>
</body>

</html>