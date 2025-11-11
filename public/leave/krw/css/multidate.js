// define var
let tanggalan = document.querySelector(".date");
let totalInput = document.querySelector("#total");
let totalTanggalan = 0;
let arrTanggalan = [];

// init plugin datepicker
$(".date")
  .datepicker({
    multidate: true,
    format: "dd-mm-yyyy",
  })
  .on("changeDate", generateTotalTanggal);

// function hitung total tanggal terpilih
function generateTotalTanggal() {
  if (tanggalan.value.length === 0) {
    // jika field tanggal tidak ada isi reset
    totalTanggalan = [];
    totalInput.value = 0;
  } else {
    arrTanggalan = tanggalan.value.split(","); // explode string jadi array
    totalTanggalan = arrTanggalan.length; // replace isi variable
    totalInput.value = totalTanggalan; // ganti isi field total
  }
}
