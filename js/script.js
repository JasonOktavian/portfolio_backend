$(document).ready(function () {
  $("#sidebar").mCustomScrollbar({
    theme: "minimal",
  });

  $("#sidebarCollapse").on("click", function () {
    $("#sidebar, #content").toggleClass("active");
    $(".collapse.in").toggleClass("in");
    $("a[aria-expanded=true]").attr("aria-expanded", "false");
  });
});

// let keyword = document.getElementById("keyword");
// let btnCari = document.getElementById("btnCari");
// let containers = document.getElementById("ajaxcon");

// //tambah event ketika keyword ditulis
// keyword.addEventListener("keyup", function () {
//   //buat objek ajax
//   let xhr = new XMLHttpRequest();

//   //cek kesiapan ajax
//   xhr.onreadystatechange = function () {
//     if (xhr.readyState == 4 && xhr.status == 200) {
//       containers.innerHTML = xhr.responseText;
//     }
//   };
//   xhr.open("GET", "ajax/produk.php?keyword=" + keyword.value, true);
//   xhr.send();
// });

$(document).ready(function () {
  // hilangkan tombol cari
  $("#btnCari").hide();

  // event ketika keyword ditulis
  $("#keyword").on("keyup", function () {
    // munculkan icon loading
    $(".loader").show();

    // ajax menggunakan load
    // $('#container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());

    // $.get()
    $.get("ajax/produk.php?keyword=" + $("#keyword").val(), function (data) {
      $("#container").html(data);
      $(".loader").hide();
    });
  });
});
