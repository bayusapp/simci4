// window.setTimeout(function () {
//   $(".alert")
//     .fadeTo(500, 0)
//     .slideUp(500, function () {
//       $(this).remove();
//     });
// }, 5000);
function hanyaAngka(event) {
  if ("01234567890".indexOf(event.key.toLowerCase()) < 0)
    return event.preventDefault();
}

function hapus_prodi(id) {
  swal({
    title: "Apakah Anda yakin?",
    text: "Data Program Studi Akan Dihapus",
    icon: "warning",
    buttons: true,
    dangerMode: true,
    buttons: ["Tidak", "Ya"],
  }).then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: window.location.origin + "/DataMaster/deleteProdi",
        method: "POST",
        data: { id: id },
        success: function (response) {
          swal({
            text: "Data Program Studi Sukses Dihapus",
            icon: "success",
            timer: 2000,
            buttons: false,
          }).then(function () {
            location.reload();
          });
        },
      });
    }
  });
}

function hapus_dosen(id) {
  swal({
    title: "Apakah Anda yakin?",
    text: "Data Dosen akan dihapus",
    icon: "warning",
    buttons: true,
    dangerMode: true,
    buttons: ["Tidak", "Ya"],
  }).then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: window.location.origin + "/DataMaster/deleteDosen",
        method: "POST",
        data: { id, id },
        success: function (response) {
          swal({
            text: "Data Dosen Sukses Dihapus",
            icon: "success",
            timer: 2000,
            buttons: false,
          }).then(function () {
            location.reload();
          });
        },
      });
    }
  });
}

function hapus_mk(id) {
  swal({
    title: "Apakah Anda yakin?",
    text: "Data Mata Kuliah akan dihapus",
    icon: "warning",
    buttons: true,
    dangerMode: true,
    buttons: ["Tidak", "Ya"],
  }).then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: window.location.origin + "/DataMaster/deleteMK",
        method: "POST",
        data: { id, id },
        success: function (response) {
          swal({
            text: "Data Mata Kuliah Sukses Dihapus",
            icon: "success",
            timer: 2000,
            buttons: false,
          }).then(function () {
            location.reload();
          });
        },
      });
    }
  });
}

function hapus_laboran(id) {
  swal({
    title: "Apakah Anda yakin?",
    text: "Data Laboran akan dihapus",
    icon: "warning",
    buttons: true,
    dangerMode: true,
    buttons: ["Tidak", "Ya"],
  }).then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: window.location.origin + "/DataMaster/deleteLaboran",
        method: "POST",
        data: { id, id },
        success: function (response) {
          swal({
            text: "Data Laboran Sukses Dihapus",
            icon: "success",
            timer: 2000,
            buttons: false,
          }).then(function () {
            location.reload();
          });
        },
      });
    }
  });
}

function hapus_lab(id) {
  swal({
    itle: "Apakah Anda yakin?",
    text: "Data Laboratorium akan dihapus",
    icon: "warning",
    buttons: true,
    dangerMode: true,
    buttons: ["Tidak", "Ya"],
  }).then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: window.location.origin + "/Laboratorium/deleteLab",
        method: "POST",
        data: { id, id },
        success: function (response) {
          swal({
            text: "Data Laboratorium Sukses Dihapus",
            icon: "success",
            timer: 2000,
            buttons: false,
          }).then(function () {
            location.reload();
          });
        },
      });
    }
  });
}

function hapus_mk_semester(id) {
  swal({
    title: "Apakah Anda yakin?",
    text: "Data Mata Kuliah Semester akan dihapus",
    icon: "warning",
    buttons: true,
    dangerMode: true,
    buttons: ["Tidak", "Ya"],
  }).then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: window.location.origin + "/Praktikum/deleteMK",
        method: "POST",
        data: { id, id },
        success: function (response) {
          swal({
            text: "Data Mata Kuliah Semester Sukses Dihapus",
            icon: "success",
            timer: 2000,
            buttons: false,
          }).then(function () {
            location.reload();
          });
        },
      });
    }
  });
}

function cek_bank(id) {
  $.ajax({
    url: window.location.origin + "/Praktikum/cekBank",
    method: "POST",
    data: { id: id },
    success: function (response) {
      document.getElementById("data_bank_" + id).innerHTML = response;
    },
  });
}

function verif_bank(id) {
  $.ajax({
    url: window.location.origin + "/Praktikum/verifBank",
    method: "POST",
    data: { id: id },
    success: function (response) {
      if (response == "sukses") {
        var label = document.getElementById("verif_bank_" + id);
        document.getElementById("disetujui_" + id).style.display = "none";
        label.innerHTML =
          '<span class="badge badge-success"><i class="feather icon-check-circle"></i> Rekening Bank</span>';
      }
    },
  });
}

function hapus_asprak(id) {
  swal({
    title: "Apakah Anda yakin?",
    text: "Daftar Asisten Praktikum akan dihapus",
    icon: "warning",
    buttons: true,
    dangerMode: true,
    buttons: ["Tidak", "Ya"],
  }).then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: window.location.origin + "/Praktikum/deleteAsprakList",
        method: "POST",
        data: { id, id },
        success: function (response) {
          swal({
            text: "Data Asisten Praktikum Sukses Dihapus",
            icon: "success",
            timer: 2000,
            buttons: false,
          }).then(function () {
            location.reload();
          });
        },
      });
    }
  });
}

function hapus_kalender(id) {
  swal({
    title: "Apakah Anda yakin?",
    text: "Kalender Libur akan dihapus",
    icon: "warning",
    buttons: true,
    dangerMode: true,
    buttons: ["Tidak", "Ya"],
  }).then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: window.location.origin + "/Kalender/deleteKalender",
        method: "POST",
        data: { id, id },
        success: function (response) {
          swal({
            text: "Data Kalender Libur Sukses Dihapus",
            icon: "success",
            timer: 2000,
            buttons: false,
          }).then(function () {
            location.reload();
          });
        },
      });
    }
  });
}

function hapus_kehadiran(id) {
  swal({
    title: "Apakah Anda yakin?",
    text: "Data kehadiran Anda akan dihapus",
    icon: "warning",
    buttons: true,
    dangerMode: true,
    buttons: ["Tidak", "Ya"],
  }).then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: window.location.origin + "/Kehadiran/hapusKehadiran",
        method: "POST",
        data: { id, id },
        success: function (response) {
          swal({
            text: "Data kehadiran Anda sukses dihapus",
            icon: "success",
            timer: 2000,
            buttons: false,
          }).then(function () {
            location.reload();
          });
        },
      });
    }
  });
}

function jam_praktikum(event) {
  if ("01234567890:".indexOf(event.key.toLowerCase()) < 0)
    return event.preventDefault();
}

$(document).ready(function () {
  setTimeout(function () {
    $("#prodi").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "12%", targets: [4] },
      ],
    });

    $("#dosen").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "10%", targets: [1] },
        { width: "12%", targets: [3] },
      ],
    });

    $("#matkul").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "10%", targets: [1] },
        { width: "12%", targets: [4] },
      ],
    });

    $("#lab-Praktikum").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "12%", targets: [5] },
      ],
    });

    $("#lab-Riset").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "12%", targets: [4] },
      ],
    });

    $("#lab-Workshop").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "12%", targets: [4] },
      ],
    });

    $("#mk_si").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "40%", targets: [2] },
        { width: "12%", targets: [3] },
      ],
    });

    $("#mk_tk").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "40%", targets: [2] },
        { width: "12%", targets: [3] },
      ],
    });

    $("#mk_sia").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "40%", targets: [2] },
        { width: "12%", targets: [3] },
      ],
    });

    $("#mk_mp").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "40%", targets: [2] },
        { width: "12%", targets: [3] },
      ],
    });

    $("#mk_tt").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "40%", targets: [2] },
        { width: "12%", targets: [3] },
      ],
    });

    $("#mk_rpla").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "40%", targets: [2] },
        { width: "12%", targets: [3] },
      ],
    });

    $("#mk_ph").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "40%", targets: [2] },
        { width: "12%", targets: [3] },
      ],
    });

    $("#mk_trm").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "40%", targets: [2] },
        { width: "12%", targets: [3] },
      ],
    });

    $("#mk_sikc").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "40%", targets: [2] },
        { width: "12%", targets: [3] },
      ],
    });

    $("#asprak_si").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "10%", targets: [1] },
        { width: "27%", targets: [2] },
        { width: "27%", targets: [3] },
        { width: "10%", targets: [4] },
        { width: "11%", targets: [5] },
        { width: "10%", targets: [6] },
      ],
    });

    $("#asprak_tk").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "10%", targets: [1] },
        { width: "27%", targets: [2] },
        { width: "27%", targets: [3] },
        { width: "10%", targets: [4] },
        { width: "11%", targets: [5] },
        { width: "10%", targets: [6] },
      ],
    });

    $("#asprak_sia").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "10%", targets: [1] },
        { width: "27%", targets: [2] },
        { width: "27%", targets: [3] },
        { width: "10%", targets: [4] },
        { width: "11%", targets: [5] },
        { width: "10%", targets: [6] },
      ],
    });

    $("#asprak_mp").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "10%", targets: [1] },
        { width: "27%", targets: [2] },
        { width: "27%", targets: [3] },
        { width: "10%", targets: [4] },
        { width: "11%", targets: [5] },
        { width: "10%", targets: [6] },
      ],
    });

    $("#asprak_tt").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "10%", targets: [1] },
        { width: "27%", targets: [2] },
        { width: "27%", targets: [3] },
        { width: "10%", targets: [4] },
        { width: "11%", targets: [5] },
        { width: "10%", targets: [6] },
      ],
    });

    $("#asprak_rpla").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "10%", targets: [1] },
        { width: "27%", targets: [2] },
        { width: "27%", targets: [3] },
        { width: "10%", targets: [4] },
        { width: "11%", targets: [5] },
        { width: "10%", targets: [6] },
      ],
    });

    $("#asprak_ph").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "10%", targets: [1] },
        { width: "27%", targets: [2] },
        { width: "27%", targets: [3] },
        { width: "10%", targets: [4] },
        { width: "11%", targets: [5] },
        { width: "10%", targets: [6] },
      ],
    });

    $("#asprak_trm").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "10%", targets: [1] },
        { width: "27%", targets: [2] },
        { width: "27%", targets: [3] },
        { width: "10%", targets: [4] },
        { width: "11%", targets: [5] },
        { width: "10%", targets: [6] },
      ],
    });

    $("#asprak_sikc").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "10%", targets: [1] },
        { width: "27%", targets: [2] },
        { width: "27%", targets: [3] },
        { width: "10%", targets: [4] },
        { width: "11%", targets: [5] },
        { width: "10%", targets: [6] },
      ],
    });

    $("#laboran").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "10%", targets: [3] },
        { width: "12%", targets: [5] },
      ],
    });

    $("#kalender_libur").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "12%", targets: [3] },
      ],
    });

    $("#riwayat_login").DataTable();

    $("#kehadiran").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        { width: "10%", targets: [1] },
        { width: "7%", targets: [2], className: "text-center" },
        { width: "7%", targets: [3], className: "text-center" },
        { width: "7%", targets: [4], className: "text-center" },
        { width: "10%", targets: [5] },
        { width: "9%", targets: [7], className: "text-center" },
        { width: "12%", targets: [8], className: "text-center" },
        { width: "10%", targets: [9], className: "text-center" },
      ],
    });

    $("#surat_perjanjian").DataTable({
      bAutoWidth: false,
      columnDefs: [
        { width: "5%", targets: [0] },
        // { width: "10%", targets: [1] },
        // { width: "7%", targets: [2], className: "text-center" },
        // { width: "7%", targets: [3], className: "text-center" },
        // { width: "7%", targets: [4], className: "text-center" },
        { width: "12%", targets: [5] },
      ],
    });
  }, 0);

  $(".kontak").mask("(00) 0000-0000-0000");

  $(".bank").select2({
    placeholder: "Pilih Nama Bank",
    allowClear: true,
  });

  $(".prodi").select2({
    placeholder: "Pilih Program Studi",
    allowClear: true,
  });

  $(".matakuliah").select2({
    placeholder: "Pilih Mata Kuliah",
    allowClear: true,
  });

  $(".tahun_ajaran").select2({
    placeholder: "Pilih Tahun Ajaran",
    allowClear: true,
  });

  $(".dosen").select2({
    placeholder: "Pilih Data Dosen",
    allowClear: true,
  });

  $(".tahun").select2({
    placeholder: "Pilih Tahun",
    allowClear: true,
  });

  $(".mk_asprak").select2({
    placeholder: "Pilih Mata Kuliah",
    allowClear: true,
  });

  var masuk = $("#jam_masuk");
  var keluar = $("#jam_keluar");
  var hours = [
    "6",
    "7",
    "8",
    "9",
    "10",
    "11",
    "12",
    "13",
    "14",
    "15",
    "16",
    "17",
    "18",
  ];
  var minutes = ["00", "30"];

  masuk.clockpicker({
    autoclose: true,
    afterShow: function () {
      $(".clockpicker-minutes")
        .find(".clockpicker-tick")
        .filter(function (index, element) {
          return !($.inArray($(element).text(), minutes) != -1);
        })
        .remove();
      $(".clockpicker-hours")
        .find(".clockpicker-tick")
        .filter(function (index, element) {
          return !($.inArray($(element).text(), hours) != -1);
        })
        .remove();
    },
  });

  keluar.clockpicker({
    autoclose: true,
    afterShow: function () {
      $(".clockpicker-minutes")
        .find(".clockpicker-tick")
        .filter(function (index, element) {
          return !($.inArray($(element).text(), minutes) != -1);
        })
        .remove();
      $(".clockpicker-hours")
        .find(".clockpicker-tick")
        .filter(function (index, element) {
          return !($.inArray($(element).text(), hours) != -1);
        })
        .remove();
    },
  });

  document
    .getElementById("jam_masuk")
    .addEventListener("keypress", function (event) {
      if ("01234567890:".indexOf(event.key.toLowerCase()) < 0)
        event.preventDefault();
    });

  document
    .getElementById("jam_keluar")
    .addEventListener("keypress", function (event) {
      if ("01234567890:".indexOf(event.key.toLowerCase()) < 0)
        event.preventDefault();
    });
});
