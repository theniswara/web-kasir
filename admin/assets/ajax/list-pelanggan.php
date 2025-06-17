<?php
require '/xampp/htdocs/COLLEGE/uas_sm2/web-kasir/config/functions-pelanggan.php';
$keyword2 = isset($_GET['keyword2']) ? $_GET['keyword2'] : '';

$query = "SELECT * FROM customer 
            WHERE 
          nama LIKE '%$keyword2%' 
          OR email LIKE '%$keyword2%' 
          OR no_hp LIKE '%$keyword2%'
      ";
$customer = query($query);

?>

<table class="table table-bordered table-striped table-hover align-middle">
  <thead class="table-primary text-white align-middle">
    <tr>
      <th class="text-center" style="width:5%">No</th>
      <th style="width:30%">Nama</th>
      <th style="width:20%">Nomor HP</th>
      <th style="width:30%">Email</th>
      <th class="text-center" style="width:15%">Action</th>
    </tr>
  </thead>
  <tbody class="table-border-bottom-0">
    <?php $i = 1; ?>
    <?php foreach ($customer as $row) : ?>
      <tr>
        <td class="text-center fw-bold"><?= $i ?></td>
        <td>
          <span class="fw-semibold text-dark"><i class="bx bx-user me-2 text-primary"></i><?= htmlspecialchars($row['nama']) ?></span>
        </td>
        <td>
          <span class="text-dark"><i class="bx bx-phone me-2 text-success"></i><?= htmlspecialchars($row['no_hp']) ?></span>
        </td>
        <td>
          <span class="text-dark"><i class="bx bx-envelope me-2 text-info"></i><?= htmlspecialchars($row['email']) ?></span>
        </td>
        <td>
          <div class="d-flex justify-content-center gap-2">
            <a href="edit-pelanggan.php?id=<?= $row['id_customer'] ?>" class="btn btn-success btn-sm btn-rounded" title="Edit">
              <i class="bx bx-edit"></i>
            </a>
            <a href="../config/hapus-pelanggan.php?id=<?= $row['id_customer'] ?>" class="btn btn-danger btn-sm btn-rounded" title="Hapus" onclick="return confirm('Yakin ingin menghapus pelanggan ini?');">
              <i class="bx bx-trash"></i>
            </a>
          </div>
        </td>
      </tr>
      <?php $i++; ?>
    <?php endforeach; ?>
  </tbody>
</table>