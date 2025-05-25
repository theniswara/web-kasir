<?php 

require '../config/functions-pelanggan.php';

$id = $_GET["id"];

if ( hapusPelanggan($id) > 0 ) {
  echo "
  <script>
    alert('Data berhasil dihapus');
    document.location.href = '../admin/list-pelanggan.php';
  </script>";
} else {
  echo "
  <script>
    alert('Data gagal dihapus');
    document.location.href = '../admin/list-pelanggan.php';
  </script>";
}

?>