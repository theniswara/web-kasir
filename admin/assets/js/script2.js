$(document).ready(function () {
  // event ketika keyword2 ditulis
  $('#keyword2').on('keyup', function() {
    $('#container2').load('assets/ajax/list-pelanggan.php?keyword2=' + encodeURIComponent($('#keyword2').val()));
  });
});