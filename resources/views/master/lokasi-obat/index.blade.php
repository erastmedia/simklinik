@extends('adminlte::page')

@section('title', 'Data Lokasi Obat')
@section('plugins.Datatables', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('content_header')
    <div class="row mb-0">
        <div class="col-sm-6">
            <h4 class="text-bold text-black">Data Lokasi Obat</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right text-xs">
                <li class="breadcrumb-item"><a href="../../dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="../../dashboard">Master</a></li>
                <li class="breadcrumb-item active">Data Lokasi Obat</li>
            </ol>
        </div>
    </div>
@stop
@section('content')
    <div class="card card-danger card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="tabDataLokasi" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-lok-obat" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true"><h6 class="text-bold m-0">Data Lokasi Obat</h6></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="tabDataLokasiContent">
                <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="tab-lok-obat">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header p-1">
                                    <div class="row">
                                        <div class="col-md-12 input-group input-group-md">
                                            <input type="text" id="searchbox_lokasi" name="searchbox_lokasi" class="form-control form-control-md float-right" placeholder="Search Data Lokasi Obat">
                                            <div class="input-group-append mr-1">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>

                                            <button type="button" class="btn btn-default btn-md text-bold float-right mr-1" id="refresfLokasiBtn"><i class="fas fa-sync-alt text-primary mr-2"></i>Refresh</button>
                                            <button onclick="addFormLokasi('{{ route('lokasiobat.store') }}')" type="button" class="btn btn-default btn-md text-bold float-right" id="addLokasiBtn"><i class="fas fa-plus text-success mr-2"></i>Tambah</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-1 mb-0">
                                    <table id="table-lokasi" class="table table-bordered table-xs table-hover text-sm" style="width:100%">
                                        <thead>
                                            <tr class="text-center bg-gradient-info">
                                                <th width="2%">No</th>
                                                <th width="10%">Action</th>
                                                <th width="78%">Nama Lokasi</th>
                                                <th width="10%">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-table-lokasi">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@includeIf('master.lokasi-obat.form')

@stop
@section('footer')
    <footer class="main-footer text-xs">
        <div class="float-right d-block d-xs-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2023 erastmedia.</strong> All rights reserved.
    </footer>
@stop
@section('css')
    <link href="{{ asset('css/admin_custom.css') }}" rel="stylesheet">
@stop
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js" integrity="sha512-dTu0vJs5ndrd3kPwnYixvOCsvef5SGYW/zSSK4bcjRBcZHzqThq7pt7PmCv55yb8iBvni0TSeIDV8RYKjZL36A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
var idLokasi = "";
var tableLokasi = null;
var varOpenedTab = 0;
var strProses = '';
var cb_status = document.getElementById('cb_status');
var status_aktif = document.getElementById('status_aktif');
var statusLabel = document.getElementById('statusLabel');

$(document).ready(function(){
    status_aktif.value = 1;
    statusLabel.textContent = 'AKTIF';
    $('[data-toggle="tooltip"]').tooltip();

    cb_status.addEventListener('change', function() {
        status_aktif.value = this.checked ? 1 : 0;
        statusLabel.textContent = this.checked ? 'AKTIF' : 'NON AKTIF';
    });
});

$(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
});

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.nav-link').forEach(function(tab) {
        tab.addEventListener('click', function(event) {
            if (tab.id === 'tab-sp') {
                varOpenedTab = 1;
            } 
        });
    });

    document.addEventListener('keydown', function(event) {
        if (varOpenedTab === 0) {
            if (event.ctrlKey && event.altKey && event.key === 'n') {
                event.preventDefault();
                document.getElementById('addLokasiBtn').click();
                document.getElementById('nama').focus();
                return false;
            }
        }
    });
});

$('#searchbox_lokasi').keyup(function() {
    tableLokasi.search($(this).val()).draw();
    tableLokasi.columns.adjust().draw();
});

$(function() {
    $.ajaxSetup({
        statusCode: {
            422: function() {
                return false;
            }
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    tableLokasi = $('#table-lokasi').DataTable({
        processing: true,
        serverSide: false,
        dom: 'rt<"row text-xs p-1"<"float-right"p>><"clear">',
        autowidth: false,
        columnDefs: [
            { width: '2%', targets: 0 },
            { width: '10%', targets: 1 },
            { width: '78%', targets: 2 },
            { width: '10%', targets: 3 },
        ],
        ajax: {
            url: "{{ route('lokasiobat.data') }}",
            dataSrc: "data",
        },
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                className: 'text-center',
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                className: 'text-center',
            }, 
            {
                data: 'nama',
                name: 'lokasi_obat.nama',
                class: 'pl-2 pr-2',
            },
            {
                data: 'status_aktif',
                name: 'lokasi_obat.status_aktif',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    if (data == 1) {
                        return '<span class="badge bg-success pt-1 pb-1 pl-2 pr-2">AKTIF</span>';
                    } else if (data == 0) {
                        return '<span class="badge bg-danger pt-1 pb-1 pl-2 pr-2">NON AKTIF</span>';
                    }
                }
            },
        ]
    });

    tableLokasi.columns.adjust().draw();

    $('#addDataLokasi').validator().on('submit', function(e) {
        e.preventDefault();
        $('#saveLokasi').prop('disabled', true).html('<span class="spinner-grow spinner-grow-sm mr-3" role="status" aria-hidden="true"></span>Sending...');
        $('#resetLokasi').prop('disabled', true);
        var formData = new FormData($('#addDataLokasi form')[0]);

        $.ajax({
            url: $('#addDataLokasi form').attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#saveLokasi').prop('disabled', false).html('<i class="fas fa-save text-success mr-2"></i>Simpan Data');
                $('#resetLokasi').prop('disabled', false);
                toastr["success"](response.success, "Data Tersimpan");
                $('#addDataLokasi').modal('hide');
                tableLokasi.ajax.reload();
                tableLokasi.columns.adjust().draw();
            },
            error: function(error) {
                $('#saveLokasi').prop('disabled', false).html('<i class="fas fa-save text-success mr-2"></i>Simpan Data');
                $('#resetLokasi').prop('disabled', false);
                var errorMessage = error.responseJSON ? error.responseJSON.error : 'Terjadi kesalahan saat menyimpan data';
                toastr["error"](errorMessage, "Data Gagal Disimpan");
                $('#addDataLokasi').addClass('shake'); 
                    setTimeout(function() {
                        $('#addDataLokasi').removeClass('shake'); 
                    }, 500);
            }
        });
    });

});

// FORM MODAL TIPE LOKASI POLI

function addFormLokasi(url) {
    $("#addDataLokasi").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataLokasi .modal-title').text('Tambah Lokasi Obat');
    $('#addDataLokasi form')[0].reset();
    $('#addDataLokasi form').attr('action', url);
    $('#addDataLokasi [name=_method]').val('post');
    $('#addDataLokasi [name=_enctype]').val('multipart/form-data');
    cb_status.checked = true;
    status_aktif.value = 1;
    statusLabel.textContent = 'AKTIF';
    strProses = 'add';
    console.log(strProses);
}

function editFormLokasi(url) {
    $("#addDataLokasi").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataLokasi .modal-title').text('Edit Lokasi Obat');
    $('#addDataLokasi form')[0].reset();
    $('#addDataLokasi form').attr('action', url);
    $('#addDataLokasi [name=_method]').val('put');
    $('#addDataLokasi [name=_enctype]').val('multipart/form-data');
    strProses = 'edit';
    console.log(strProses);

    $.get(url)
        .done((response) => {
            idLokasi = response.id;
            $('#addDataLokasi [name=nama]').val(response.nama);
            if(response.status_aktif == 1){
                cb_status.checked = true;
                status_aktif.value = 1;
                statusLabel.textContent = 'AKTIF';
            } else {
                cb_status.checked = false;
                status_aktif.value = 0;
                statusLabel.textContent = 'NON AKTIF';
            }
        })
        .fail((errors) => {
            toastr["error"]("Tidak dapat menampilkan data", "Terjadi Kesalahan")
            return;
        });
}

function deleteDataLokasi(url) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Apakah Anda yakin ingin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    '_token': $('[name=csrf-token]').attr('content')
                },
                success: function(response) {
                    Swal.fire('Berhasil', 'Data berhasil dihapus', 'success');
                    tableLokasi.ajax.reload();
                    tableLokasi.columns.adjust().draw();
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMessage = xhr.responseJSON.error;
                    }
                    Swal.fire('Error', errorMessage, 'error');
                }
            });
        }
    });
}

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

</script>
@stop