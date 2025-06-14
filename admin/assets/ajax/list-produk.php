<?php

require '/xampp/htdocs/COLLEGE/uas_sm2/web-kasir/config/functions-produk.php';
$keyword = $_GET['keyword'];

$query = "SELECT * FROM produk 
            WHERE 
          nama_produk LIKE '%$keyword%'
      ";
$produk = query($query);
?>

<table class="table table-bordered table-hover align-middle">
  <thead class="table-primary text-white align-middle">
    <tr>
      <th class="text-center" style="width:5%">No</th>
      <th style="width:12%">Gambar</th>
      <th style="width:22%">Nama Produk</th>
      <th style="width:13%">Kategori</th>
      <th style="width:13%">Merek</th>
      <th style="width:8%">Stok</th>
      <th style="width:14%">Harga</th>
      <th class="text-center" style="width:13%">Action</th>
    </tr>
  </thead>
  <tbody class="table-border-bottom-0">
    <?php $i = 1; ?>
    <?php foreach ($produk as $row) : ?>
      <tr>
        <td class="text-center fw-bold"> <?= $i ?> </td>
        <td>
          <div class="d-flex align-items-center justify-content-center">
            <img src="assets/img/produk/<?= $row['gambar'] ?>" alt="" style="width: 70px; height: 70px; object-fit: cover;" class="rounded shadow-sm mx-auto d-block" />
          </div>
        </td>
        <td class="align-middle">
          <span class="fw-semibold text-dark"><?= htmlspecialchars($row['nama_produk']) ?></span>
        </td>
        <td class="text-center align-middle">
          <?php
          if ($row['id_kategori'] == 1) {
            echo '<a title="Smartphone"><span class="badge bg-label-info"><i class="menu-icon tf-icons bx bxs-smartphone mx-auto"></i></span></a>';
          } elseif ($row['id_kategori'] == 2) {
            echo '<a title="Laptop"><span class="badge bg-label-warning"><i class="menu-icon tf-icons bx bx-laptop mx-auto"></i></span></a>';
          } else {
            echo '<span class="badge bg-secondary rounded-pill d-inline"><i class="bx bx-question-mark"></i> Lainnya</span>';
          }
          ?>
        </td>
        <td class="align-middle">
          <span class="fw-semibold text-dark">
            <?php
            if ($row['id_merek'] == 1) {
              echo 'Samsung';
            } else if ($row['id_merek'] == 2) {
              echo 'Apple';
            } else if ($row['id_merek'] == 3) {
              echo 'Asus';
            } else if ($row['id_merek'] == 4) {
              echo 'Lenovo';
            } else if ($row['id_merek'] == 5) {
              echo 'Xiaomi';
            } else if ($row['id_merek'] == 6) {
              echo 'HP';
            } else if ($row['id_merek'] == 7) {
              echo 'Realme';
            } else if ($row['id_merek'] == 8) {
              echo 'Infinix';
            } else if ($row['id_merek'] == 9) {
              echo 'Acer';
            } else if ($row['id_merek'] == 10) {
              echo 'OPPO';
            } else if ($row['id_merek'] == 11) {
              echo 'Nokia';
            } else {
              echo '<span class="badge bg-secondary rounded-pill d-inline"><i class="bx bx-question-mark"></i> Lainnya</span>';
            } ?>
          </span>
        </td>
        <td class="align-middle text-center">
          <span class="badge bg-label-primary fs-6 px-3 py-2"><i class="bx bx-cube me-1"></i><?= htmlspecialchars($row['stok']) ?></span>
        </td>
        <td class="align-middle text-end">
          <span class="fw-bold">Rp. <?= number_format($row['harga'], 0, ',', '.') ?></span>
        </td>
        <td>
          <div class="d-flex justify-content-center gap-2">
            <a href="edit-produk.php?id=<?= $row["id_produk"] ?>" class="btn btn-success btn-sm btn-rounded" title="Edit">
              <i class="bx bx-edit"></i>
            </a>
            <a href="../config/hapus-produk.php?id=<?= $row["id_produk"] ?>" class="btn btn-danger btn-sm btn-rounded" title="Hapus" onclick="return confirm('Yakin ingin menghapus produk ini?');">
              <i class="bx bx-trash"></i>
            </a>
          </div>
        </td>
      </tr>
      <?php $i++; ?>
    <?php endforeach; ?>
  </tbody>
</table>