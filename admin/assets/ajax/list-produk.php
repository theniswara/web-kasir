<?php

require '/xampp/htdocs/COLLEGE/uas_sm2/web-kasir/config/functions-produk.php';
$keyword = $_GET['keyword'];

$query = "SELECT * FROM produk 
            WHERE 
          nama_produk LIKE '%$keyword%'
      ";
$produk = query($query);
?>

<table class="table table-bordered">
  <thead class="fw-bold">
    <tr>
      <th>No</th>
      <th>Gambar</th>
      <th>Nama Produk</th>
      <th>Kategori</th>
      <th>Harga</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1; ?>
    <?php foreach ($produk as $row) : ?>
      <tr>
        <td class="text-center">
          <?= $i ?>
        </td>
        <td>
          <div class="d-flex align-items-center">
            <img
              src="assets/img/produk/<?= $row['gambar'] ?>"
              alt=""
              style="width: 80px; height: 80px; object-fit: cover;"
              class="rounded mx-auto d-block" />
          </div>
        </td>
        <td class="align-middle">
          <span class="fw-semibold text-dark"><?= htmlspecialchars($row['nama_produk']) ?></span>
        </td>
        <td class="text-center align-middle">
          <?php
          // Ganti dengan id_kategori yang sesuai
          if ($row['id_kategori'] == 1) {
            // Misal kategori 1: Makanan
            echo '<a title="Smartphone">
                        <span class="badge bg-label-info"> <i class="menu-icon tf-icons bx bxs-smartphone mx-auto"></i></span></a>';
          } elseif ($row['id_kategori'] == 2) {
            // Misal kategori 2: Minuman
            echo '<a title="Laptop">
                        <span class="badge bg-label-warning"> <i class="menu-icon tf-icons bx bx-laptop mx-auto"></i></span></a>';
          } else {
            // Kategori lain
            echo '<span class="badge badge-secondary rounded-pill d-inline"><i class="bx bx-question-mark"></i> Lainnya</span>';
          }
          ?>
        </td>
        <td class="align-middle text-end">
          <span class="fw-bold"">Rp. <?= number_format($row['harga'], 0, ',', '.') ?></span>
                  </td>
                  <td>
                    <div class=" d-flex justify-content-center gap-2">
            <a href="edit-produk.php?id=<?= $row["id_produk"] ?>" class="btn btn-success btn-sm btn-rounded" title="Edit">
              <i class="bx bx-edit"></i>
            </a>
            <a href="../../../config/hapus-produk.php?id=<?= $row["id_produk"] ?>" class="btn btn-danger btn-sm btn-rounded" title="Hapus" onclick="return confirm('Yakin ingin menghapus produk ini?');">
              <i class="bx bx-trash"></i>
            </a>
            </div>
        </td>
      </tr>
      <?php $i++; ?>
    <?php endforeach; ?>
  </tbody>
</table>