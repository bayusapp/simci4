function hapus_prodi(id) {
  swal({
      title: "Apakah Anda yakin?",
      text: "Data Laboratorium akan dihapus",
      icon: "warning",
      buttons: true,
      dangerMode: true,
      buttons: ["Tidak", "Ya"],
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: window.location.origin+'/DataMaster/deleteProdi',
          method: 'POST',
          data: {id: id},
          success: function(response) {
            swal({
              text: "Data Program Studi Sukses Dihapus",
              icon: "success",
              timer: 2000,
              buttons: false
            }).then(function() {
              location.reload();
            });
          }
        });
      }
    });
}

$(document).ready(function() {
  setTimeout(function() {

    $('#prodi').DataTable({
      bAutoWidth: false,
      columnDefs: [
        {"width": "5%", "targets": [0]},
        {"width": "12%", "targets": [4]}
      ]
    });

    $('#dosen').DataTable({
      bAutoWidth: false,
      columnDefs: [
        {"width": "5%", "targets": [0]},
        {"width": "10%", "targets": [1]},
        {"width": "12%", "targets": [3]}
      ]
    });

    $('#lab-Praktikum').DataTable({
      bAutoWidth: false,
      columnDefs: [
        {"width": "5%", "targets": [0]},
        {"width": "12%", "targets": [5]}
      ]
    });

    $('#lab-Riset').DataTable({
      bAutoWidth: false,
      columnDefs: [
        {"width": "5%", "targets": [0]},
        {"width": "12%", "targets": [4]}
      ]
    });

    $('#lab-Workshop').DataTable({
      bAutoWidth: false,
      columnDefs: [
        {"width": "5%", "targets": [0]},
        {"width": "12%", "targets": [4]}
      ]
    });

    $('#mk_si').DataTable({
      bAutoWidth: false,
      columnDefs: [
        {"width": "5%", "targets": [0]},
        {"width": "15%", "targets": [1]},
        {"width": "12%", "targets": [3]},
      ]
    });

    $('#mk_tk').DataTable({
      bAutoWidth: false,
      columnDefs: [
        {"width": "5%", "targets": [0]},
        {"width": "15%", "targets": [1]},
        {"width": "12%", "targets": [3]},
      ]
    });

    $('#mk_sia').DataTable({
      bAutoWidth: false,
      columnDefs: [
        {"width": "5%", "targets": [0]},
        {"width": "15%", "targets": [1]},
        {"width": "12%", "targets": [3]},
      ]
    });

    $('#mk_mp').DataTable({
      bAutoWidth: false,
      columnDefs: [
        {"width": "5%", "targets": [0]},
        {"width": "15%", "targets": [1]},
        {"width": "12%", "targets": [3]},
      ]
    });

    $('#mk_tt').DataTable({
      bAutoWidth: false,
      columnDefs: [
        {"width": "5%", "targets": [0]},
        {"width": "15%", "targets": [1]},
        {"width": "12%", "targets": [3]},
      ]
    });

    $('#mk_rpla').DataTable({
      bAutoWidth: false,
      columnDefs: [
        {"width": "5%", "targets": [0]},
        {"width": "15%", "targets": [1]},
        {"width": "12%", "targets": [3]},
      ]
    });

    $('#mk_ph').DataTable({
      bAutoWidth: false,
      columnDefs: [
        {"width": "5%", "targets": [0]},
        {"width": "15%", "targets": [1]},
        {"width": "12%", "targets": [3]},
      ]
    });

    $('#mk_trm').DataTable({
      bAutoWidth: false,
      columnDefs: [
        {"width": "5%", "targets": [0]},
        {"width": "15%", "targets": [1]},
        {"width": "12%", "targets": [3]},
      ]
    });

    $('#riwayat_login').DataTable();
  }, 0);

  $(".id_prodi").select2({
    placeholder: "Pilih Program Studi"
  });
});