<?php 

require '../config/functions.php';

function hapus($id) {
  global $conn;
  mysqli_query($conn, "DELETE FROM produk WHERE id_produk = $id");
  return mysqli_affected_rows($conn);
}

$id = $_GET["id"];

if ( hapus($id) > 0 ) {
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