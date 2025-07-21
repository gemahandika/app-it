if (window.location.pathname.includes('/karyawan')) {
  Swal.fire({
    title: 'Memuat data...',
    html: 'Mohon tunggu sebentar',
    allowOutsideClick: false,
    showConfirmButton: false,
    didOpen: () => {
      Swal.showLoading();
    }
  });
}

$(document).ready(function () {
  // ========================================
  // 1. INISIALISASI DATATABLES
  // ========================================
  let table = $('#example').DataTable({
    scrollX: true,
    scrollCollapse: true,
    paging: true,
    // fixedColumns: {
    //     leftColumns: 3 // Kolom "Action" di sebelah kiri akan dibekukan
    // },
    initComplete: function () {
        if (window.location.pathname.includes('/counter')) {
            setTimeout(() => {
                Swal.close();
            }, 400);
        }
    }
  });
  table.columns.adjust().draw();

  // ========================================
  // 2. INISIALISASI SELECT2
  // ========================================
  $('.select2').select2();

  // ========================================
  // 3. HANDLER FILTER (Modular untuk Aktif & Resign)
  // ========================================
  function handleKaryawanFilter({
    statusResign = 'NO',
    usiaSelector,
    genSelector,
    sectionSelector,
    exportPrefix,
    tableId,
    resultContainer,
    endpoint = '/karyawan/filter'
  })
  {
    const dataFilter = {
      usia: $(usiaSelector).val(),
      gen: $(genSelector).val(),
      section: $(sectionSelector).val(),
      status_resign: statusResign
    };
  // Export
    $(`#${exportPrefix}_section`).val(dataFilter.section);
    $(`#${exportPrefix}_gen`).val(dataFilter.gen);
    $(`#${exportPrefix}_usia`).val(dataFilter.usia);

    $.ajax({
      url: BASE_URL + endpoint,
      method: 'POST',
      data: dataFilter,
      success: function (res) {
        if (res.trim() === 'EMPTY_DATA_MARKER') {
          Swal.fire({
            icon: 'info',
            title: 'Tidak ada data',
            text: 'Data tidak ditemukan untuk filter yang kamu pilih.'
          });
          $(`#${tableId}`).find(`tbody#${resultContainer}`).html('');
          return;
        }

        let dt = $(`#${tableId}`).DataTable();
        dt?.clear().draw();
        dt?.destroy();

        $(`#${tableId}`).find(`tbody#${resultContainer}`).html(res);

        setTimeout(() => {
          $(`#${tableId}`).DataTable({
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            // fixedColumns: { leftColumns: 3 }
          });
        }, 0);
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Oops!',
          text: 'Gagal memuat data berdasarkan filter.'
        });
      }
    });
  }

  // ========================================
  // 4. EVENT untuk halaman AKTIF
  // ========================================
  $('.filter-karyawan').on('change', function () {
    handleKaryawanFilter({
      statusResign: 'NO',
      usiaSelector: '#filter_usia',
      genSelector: '#filter_gen',
      sectionSelector: '#filter_section',
      exportPrefix: 'export',
      tableId: 'example',
      resultContainer: 'karyawanResult',
      endpoint: '/karyawan/filter'
    });
  });

  // ========================================
  // 5. EVENT untuk halaman RESIGN
  // ========================================
  $('.filter-karyawan-resign').on('change', function () {
    handleKaryawanFilter({
      statusResign: 'YES',
      usiaSelector: '#filter_usia_resign',
      genSelector: '#filter_gen_resign',
      sectionSelector: '#filter_section_resign',
      exportPrefix: 'export_resign',
      tableId: 'example',
      resultContainer: 'karyawanResult',
      endpoint: '/karyawan_resign/filter'
    });
  });

  // ========================================
  // 6. MODAL EDIT COUNTER
  // ========================================
  $(document).on('click', '.btn-editCounter', function () {
    const id = $(this).data('id');
    $.ajax({
      url: BASE_URL + '/counter/getCounterById',
      method: 'POST',
      data: { id_counter: id },
      dataType: 'json',
      success: function (data) {
        $('#edit-idCounter').val(data.id_counter );
        $('#edit-kategori').val(data.kategori);
        $('#edit-cabang').val(data.cabang_counter.trim()).trigger('change');
        $('#edit-counter').val(data.nama_counter);
        $('#edit-cust_id').val(data.cust_id);
        $('#edit-pic').val(data.pic);
        $('#edit-phone').val(data.phone);
        $('#edit-sistem').val(data.sistem);
        $('#edit-printer').val(data.printer);
        $('#edit-datekey').val(data.datekey);
        $('#edit-status').val(data.status);
        const modal = new bootstrap.Modal(document.getElementById('modalEditCounter'));
        modal.show();

        $('#modalEditCounter').on('shown.bs.modal', function () {
          $('#edit-cabang').select2({
            dropdownParent: $('#modalEditCounter'),
            width: '100%'
          });
        });
      },
     error: function (xhr, status, error) {
      console.error("Gagal ambil data:", error);
      console.log("Respon server:", xhr.responseText); // ⬅️ ini bantu lihat error PHP
    }

    });
  });

  // ========================================
  // 7. SUBMIT EDIT COUNTER
  // ========================================
  $(document).on('submit', '#formEditCounter', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
      url: BASE_URL + '/counter/edit',
      method: 'POST',
      data: formData,
      success: function () {
        $('#modalEditCounter').modal('hide');
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Data Counter berhasil diperbarui!'
        }).then(() => location.reload());
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: 'Terjadi kesalahan saat mengupdate data.'
        });
      }
    });
  });

  // ========================================
  // 8. MODAL TAMBAH COUNTER
  // ========================================
  $('#modalTambahCounter').on('shown.bs.modal', function () {
    $('#tambah-cabang').select2({
      dropdownParent: $('#modalTambahCounter'),
      width: '100%'
    });
  });

  // ========================================
  // 9. SUBMIT TAMBAH COUNTER
  // ========================================
  $(document).on('submit', '#formTambahCounter', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
      url: BASE_URL + '/counter/tambah',
      method: 'POST',
      data: formData,
      success: function (response) {
        try {
          const res = typeof response === 'string' ? JSON.parse(response) : response;
          if (res.status === 'success') {
            $('#modalTambahCounter').modal('hide');
            Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: res.message
            }).then(() => location.reload());
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Gagal',
              text: res.message || 'Gagal menyimpan data.'
            });
          }
        } catch (err) {
          console.error('Respon tidak valid JSON:', err);
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Respon dari server tidak dapat dibaca.'
          });
        }
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Server Error',
          text: 'Terjadi kesalahan saat mengirim data.'
        });
      }
    });
  });

   // ========================================
  // 10. MODAL TUTUP COUNTER
  // ========================================
  $(document).on('click', '.btn-tutupCounter', function () {
    const id = $(this).data('id');
    $.ajax({
      url: BASE_URL + '/counter/getCounterById',
      method: 'POST',
      data: { id_counter: id },
      dataType: 'json',
      success: function (data) {
        $('#tutup-idCounter').val(data.id_counter);
        $('#tutup-counter').val(data.nama_counter);
        $('#tutup-cabang').val(data.cabang_counter);
        $('#tutup-cust_id').val(data.cust_id);
        const modal = new bootstrap.Modal(document.getElementById('modalTutupCounter'));
        modal.show();

        $('#modalTutupCounter').on('shown.bs.modal', function () {
        });
      },
      error: function (xhr, status, error) {
        console.error("Gagal ambil data:", error);
      }
    });
  });
  // ========================================
  // 11. SUBMIT TUTUP COUNTER
  // ========================================
  $(document).on('submit', '#formTutupCounter', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
      url: BASE_URL + '/counter/tutup',
      method: 'POST',
      data: formData,
      success: function () {
        $('#modalTutupCounter').modal('hide');
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Counter Berhasil di Tutup'
        }).then(() => location.reload());
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: 'Terjadi kesalahan saat mengupdate data.'
        });
      }
    });
  });

  // ========================================
  // 12. MODAL EDIT COUNTER TUTUP
  // ========================================
  $(document).on('click', '.btn-counterTutup', function () {
    const id = $(this).data('id');
    $.ajax({
      url: BASE_URL + '/counter_tutup/getCounterTutupById',
      method: 'POST',
      data: { id_counter: id },
      dataType: 'json',
      success: function (data) {
        $('#edit-idCounterTutup').val(data.id_counter);
        $('#edit-nama_counter').val(data.nama_counter);
        $('#edit-cust_id').val(data.cust_id);
        $('#edit-tgl_tutup').val(data.tgl_tutup);
        $('#edit-ket_tutup').val(data.ket_tutup);
        $('#edit-status').val(data.status);

        const modal = new bootstrap.Modal(document.getElementById('modalCounterTutup'));
        modal.show();
      },
      error: function (xhr, status, error) {
        console.error("Gagal ambil data:", error);
      }
    });
  });

  // ========================================
  // 13. SUBMIT EDIT COUNTER TUTUP
  // ========================================
  $(document).on('submit', '#formCounterTutup', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
      url: BASE_URL + '/counter_tutup/editCounterTutup',
      method: 'POST',
      data: formData,
      success: function () {
        $('#modalCounterTutup').modal('hide');
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Data Counter berhasil diperbarui!'
        }).then(() => location.reload());
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: 'Terjadi kesalahan saat mengupdate data.'
        });
      }
    });
  });

   // ========================================
  // 14. MODAL CREATE USER HYBRID
  // ========================================
  $(document).on('click', '.btn-createUser', function () {
    const id = $(this).data('id');
    $.ajax({
      url: BASE_URL + '/counter/getCounterById',
      method: 'POST',
      data: { id_counter: id },
      dataType: 'json',
      success: function (data) {
        $('#create-idCounter').val(data.id_counter );
        $('#create-nama_counter').val(data.nama_counter);
        $('#create-cust_id').val(data.cust_id);
        $('#create-status').val(data.status);
        const modal = new bootstrap.Modal(document.getElementById('modalCreateUser'));
        modal.show();
      },
      error: function (xhr, status, error) {
        console.error("Gagal ambil data:", error);
      }
    });
  });

  // ========================================
  // 15. SUBMIT TAMBAH USER HYBRID
  // ========================================
  $(document).on('submit', '#formCreateUser', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
      url: BASE_URL + '/user_hybrid/create',
      method: 'POST',
      data: formData,
      success: function () {
        $('#modalCreateUser').modal('hide');
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Data User  berhasil ditambah!'
        }).then(() => location.reload());
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: 'Terjadi kesalahan saat menambah data.'
        });
      }
    });
  });

    // ========================================
  // 16. MODAL EDIT USER HYBRID
  // ========================================
  $(document).on('click', '.btn-editUserHybrid', function () {
    const id = $(this).data('id');
    $.ajax({
      url: BASE_URL + '/user_hybrid/getUserHybridById',
      method: 'POST',
      data: { id_hybrid: id },
      dataType: 'json',
      success: function (data) {
        $('#edit-idHybrid').val(data.id_hybrid);
        $('#edit-user_id').val(data.user_id);
        $('#edit-password').val(data.password);
        $('#edit-username').val(data.username);
        $('#edit-nik').val(data.nik);
        $('#edit-user_origin').val(data.user_origin);
        $('#edit-cust_id').val(data.cust_id);
        $('#edit-nama_counter').val(data.nama_counter.trim()).trigger('change');
        $('#edit-status').val(data.status);

        const modal = new bootstrap.Modal(document.getElementById('modalEditUserHybrid'));
        modal.show();

        $('#modalEditUserHybrid').on('shown.bs.modal', function () {
          $('#edit-nama_counter').select2({
            dropdownParent: $('#modalEditUserHybrid'),
            width: '100%'
          });
        });

      },
      error: function (xhr, status, error) {
      console.error("Gagal ambil data:", error);
      console.log("Respon server:", xhr.responseText); // ⬅️ ini bantu lihat error PHP
      }
    });
  });
   // ========================================
  // 17. SUBMIT EDIT USER HYBRID
  // ========================================
  $(document).on('submit', '#formEditUserHybrid', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
      url: BASE_URL + '/user_hybrid/editUserHybrid',
      method: 'POST',
      data: formData,
      success: function () {
        $('#modalEditUserHybrid').modal('hide');
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Data User Hybrid berhasil diperbarui!'
        }).then(() => location.reload());
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: 'Terjadi kesalahan saat mengupdate data.'
        });
      }
    });
  });



  // ========================================
  // 18. MODAL DISTRIBUSI PRINTER
  // ========================================
  $('#modalTambahPrinter').on('shown.bs.modal', function () {
    $('#tambah-nama_counter').select2({
      dropdownParent: $('#modalTambahPrinter'),
      width: '100%'
    });

    $('#tambah-nama_counter').on('change', function () {
      var namaCounter = $(this).val();

      $.ajax({
        url: BASE_URL + '/printer/getCounterByNama',
        type: 'POST',
        data: { nama_counter: namaCounter },
        dataType: 'json',
        success: function(response) {
          $('#tambah-cust_id').val(response.cust_id || '');
        },
        error: function() {
          Swal.fire({
            icon: 'error',
            title: 'Gagal Ambil Data',
            text: 'ID Counter tidak ditemukan atau server bermasalah.'
          });
        }
      });
    });
     $('#tambah-serial_number').on('change', function () {
      var serial_number = $(this).val();

      $.ajax({
        url: BASE_URL + '/printer/getPrinterBysn',
        type: 'POST',
        data: { serial_number: serial_number },
        dataType: 'json',
        success: function(response) {
          $('#tambah-type').val(response.type || '');
          $('#tambah-status').val(response.status || '');
        },
        error: function() {
          Swal.fire({
            icon: 'error',
            title: 'Gagal Ambil Data',
            text: 'Serial Number tidak ditemukan atau server bermasalah.'
          });
        }
      });
    });
  });

  // ========================================
  // 19. SUBMIT DISTRIBUSI PRINTER
  // ========================================
  $(document).on('submit', '#formTambahPrinter', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
      url: BASE_URL + '/printer/tambah',
      method: 'POST',
      data: formData,
      success: function () {
        $('#modalTambahPrinter').modal('hide');
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Data Printer berhasil diperbarui!'
        }).then(() => location.reload());
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: 'Terjadi kesalahan saat mengupdate data.'
        });
      }
    });
  });

  // ========================================
  // 20. MODAL EDIT PRINTER
  // ========================================
  $(document).on('click', '.btn-editPrinter', function () {
    const id = $(this).data('id');
    $.ajax({
      url: BASE_URL + '/printer/getPrinterById',
      method: 'POST',
      data: { id_printer: id },
      dataType: 'json',
      success: function (data) {
        $('#edit-id_printer').val(data.id_printer);
        $('#edit-type').val(data.type);
        $('#edit-serial_number').val(data.serial_number);
        $('#edit-nama_counter').val(data.nama_counter.trim()).trigger('change');
        $('#edit-cust_id').val(data.cust_id);
        $('#edit-status').val(data.status);
        $('#edit-keterangan').val(data.keterangan);
        $('#edit-date_distribusi').val(data.date_distribusi);
        $('#edit-remaks').val(data.remaks);

        const modal = new bootstrap.Modal(document.getElementById('modalEditPrinter'));
        modal.show();

        $('#modalEditPrinter').on('shown.bs.modal', function () {
          $('#edit-nama_counter').select2({
            dropdownParent: $('#modalEditPrinter'),
            width: '100%'
          });
        });

        // 🧠 Ganti counterMap → ambil langsung via AJAX
        $('#edit-nama_counter').off('change').on('change', function () {
          const namaCounter = $(this).val();

          $.ajax({
            url: BASE_URL + '/printer/getCounterByNama',
            type: 'POST',
            data: { nama_counter: namaCounter },
            dataType: 'json',
            success: function(response) {
              $('#edit-cust_id').val(response.cust_id || '');
            },
            error: function() {
              Swal.fire({
                icon: 'error',
                title: 'Gagal Ambil Data',
                text: 'ID Counter tidak ditemukan atau server bermasalah.'
              });
            }
          });
        });
      },
      error: function (xhr, status, error) {
        console.error("Gagal ambil data:", error);
        console.log("Respon server:", xhr.responseText);
      }
    });
  });


  // ========================================
  // 21. SUBMIT EDIT PRINTER
  // ========================================
  $(document).on('submit', '#formEditPrinter', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
      url: BASE_URL + '/printer/editPrinter',
      method: 'POST',
      data: formData,
      success: function () {
        $('#modalEditPrinter').modal('hide');
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Data Printer berhasil diperbarui!'
        }).then(() => location.reload());
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: 'Terjadi kesalahan saat mengupdate data.'
        });
      }
    });
  });

  // ========================================
  // 22. MODAL TAMBAH SERVICE PRINTER
  // ========================================
  $('#modalServicePrinter').on('shown.bs.modal', function () {
    $('#tambah-serial_number').select2({
      dropdownParent: $('#modalServicePrinter'),
      width: '100%'
    });

    $('#tambah-serial_number').on('change', function () {
      var serial_number = $(this).val();

      $.ajax({
        url: BASE_URL + '/print_service/getPrinterBysn',
        type: 'POST',
        data: { serial_number: serial_number },
        dataType: 'json',
        success: function(response) {
          $('#tambah-type').val(response.type || '');
          $('#tambah-nama_counter').val(response.nama_counter || '');
          $('#tambah-cust_id').val(response.cust_id || '');
          $('#tambah-status').val(response.status || '');
        },
        error: function() {
          Swal.fire({
            icon: 'error',
            title: 'Gagal Ambil Data',
            text: 'Serial Number tidak ditemukan atau server bermasalah.'
          });
        }
      });
    });
  });

   // ========================================
  // 21. SUBMIT TAMBAH PRINTER SERVICE
  // ========================================
  $(document).on('submit', '#formServicePrinter', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
      url: BASE_URL + '/print_service/tambah',
      method: 'POST',
      data: formData,
      success: function () {
        $('#modalServicePrinter').modal('hide');
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Data Berhasil ditambah!'
        }).then(() => location.reload());
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: 'Terjadi kesalahan saat mengupdate data.'
        });
      }
    });
  });


  // ========================================
  // 22. MODAL EDIT PRINTER SERVICE
  // ========================================
  $(document).on('click', '.btn-editPrintService', function () {
    const id = $(this).data('id');
    $.ajax({
      url: BASE_URL + '/print_service/getPrinterById',
      method: 'POST',
      data: { id_printer: id },
      dataType: 'json',
      success: function (data) {
        $('#edit-id_printer').val(data.id_printer);
        $('#edit-type').val(data.type);
        $('#edit-serial_number').val(data.serial_number);
        $('#edit-nama_counter').val(data.nama_counter.trim()).trigger('change');
        $('#edit-cust_id').val(data.cust_id);
        $('#edit-status').val(data.status);
        $('#edit-keterangan').val(data.keterangan);
        $('#edit-date_service').val(data.date_service);
        $('#edit-remaks').val(data.remaks);

        const modal = new bootstrap.Modal(document.getElementById('modalEditService'));
        modal.show();

        $('#modalEditService').on('shown.bs.modal', function () {
          $('#edit-nama_counter').select2({
            dropdownParent: $('#modalEditService'),
            width: '100%'
          });
        });

        // 🧠 Ganti counterMap → ambil langsung via AJAX
        $('#edit-nama_counter').off('change').on('change', function () {
          const namaCounter = $(this).val();

          $.ajax({
            url: BASE_URL + '/printer/getCounterByNama',  // ⬅️ ini ngambil dari controller printer
            type: 'POST',
            data: { nama_counter: namaCounter },
            dataType: 'json',
            success: function(response) {
              $('#edit-cust_id').val(response.cust_id || '');
            },
            error: function() {
              Swal.fire({
                icon: 'error',
                title: 'Gagal Ambil Data',
                text: 'ID Counter tidak ditemukan atau server bermasalah.'
              });
            }
          });
        });

      },
      error: function (xhr, status, error) {
      console.error("Gagal ambil data:", error);
      console.log("Respon server:", xhr.responseText); // ⬅️ ini bantu lihat error PHP
      }
    });
  });

  // ========================================
  // 23. SUBMIT EDIT PRINTER SERVICE
  // ========================================
  $(document).on('submit', '#formEditService', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
      url: BASE_URL + '/print_service/edit',
      method: 'POST',
      data: formData,
      success: function () {
        $('#modalEditService').modal('hide');
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Data Printer berhasil diperbarui!'
        }).then(() => location.reload());
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: 'Terjadi kesalahan saat mengupdate data.'
        });
      }
    });
  });




  // ========================================
  // 24. MODAL STOK PRINTER
  // ========================================

  // ========================================
  // 25. SUBMIT TAMBAH PRINTER
  // ========================================
  $(document).on('submit', '#formStokPrinter', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
      url: BASE_URL + '/print_stok/tambah',
      method: 'POST',
      data: formData,
      success: function (response) {
        try {
          const res = typeof response === 'string' ? JSON.parse(response) : response;
          if (res.status === 'success') {
            $('#modalStokPrinter').modal('hide');
            Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: res.message
            }).then(() => location.reload());
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Gagal',
              text: res.message || 'Gagal menyimpan data.'
            });
          }
        } catch (err) {
          console.error('Respon tidak valid JSON:', err);
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Respon dari server tidak dapat dibaca.'
          });
        }
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Server Error',
          text: 'Terjadi kesalahan saat mengirim data.'
        });
      }
    });
  });



});