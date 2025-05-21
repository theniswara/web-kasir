// console.log('ok');

// Ambil elemen yang dibutuhkan
var keyword = document.getElementById("keyword");
var container = document.getElementById("container");

// tambahkan event ketika keyword ditulis
keyword.addEventListener("keyup", function () {


  // buat objek ajax
  var xhr = new XMLHttpRequest();

  // cek kesiapan ajax
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      // milai ada readyState 0 - 4, status 200 artinya ok
      console.log(xhr.responseText);
      container.innerHTML = xhr.responseText; // menampilkan hasil ajax ke dalam container
    }
  };

  // eksekusi ajax
  xhr.open('GET', './assets/ajax/list-produk.php?keyword=' + keyword.value, true); // reqest method, sumbernya, async
  xhr.send(); // kirim request
});
