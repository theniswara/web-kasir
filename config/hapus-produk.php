<?php 

require '../config/functions-produk.php';

$id = $_GET["id"];

if ( hapusProduk($id) > 0 ) {
  echo "
  <script>
    alert('Data berhasil dihapus');
    document.location.href = '../admin/list-produk.php';
  </script>";
} else {
  echo "
  <script>
    alert('Data gagal dihapus');
    document.location.href = '../admin/list-produk.php';
  </script>";
}

?>