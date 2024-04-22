@extends('adminlte::page')

@section('title', 'Data Kategori Obat')
@section('plugins.Datatables', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('content_header')
    <div class="row mb-0">
        <div class="col-sm-6">
            <h4 class="text-bold text-black">Data Kategori Obat</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right text-xs">
                <li class="breadcrumb-item"><a href="../../dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="../../dashboard">Master</a></li>
                <li class="breadcrumb-item active">Data Kategori Obat</li>
            </ol>
        </div>
    </div>
@stop
@section('content')
    <div class="card card-danger card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="tabDataKatObat" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-kat-obat" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true"><h6 class="text-bold m-0">Data Kategori Obat</h6></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="tabDataKatObatContent">
                <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="tab-kat-obat">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header p-1">
                                    <div class="row">
                                        <div class="col-md-12 input-group input-group-md">
                                            <input type="text" id="searchbox_katobat" name="searchbox_katobat" class="form-control form-control-md float-right" placeholder="Search Data Kategori Obat">
                                            <div class="input-group-append mr-1">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>

                                            <button type="button" class="btn btn-default btn-md text-bold float-right mr-1" id="refresfKategoriBtn"><i class="fas fa-sync-alt text-primary mr-2"></i>Refresh</button>
                                            <button onClick="copyKategoriConfirm('{{ route('kategoriobat.copypreset') }}')" type="button" class="btn btn-default btn-md text-bold float-right mr-1" id="copyGolobatBtn"><i class="fas fa-copy text-danger mr-2"></i>Copy Preset</button>
                                            <button onclick="addFormKategori('{{ route('kategoriobat.store') }}')" type="button" class="btn btn-default btn-md text-bold float-right" id="addKategoriBtn"><i class="fas fa-plus text-success mr-2"></i>Tambah</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-1 mb-0">
                                    <table id="table-kategori" class="table table-bordered table-xs table-hover text-sm" style="width:100%">
                                        <thead>
                                            <tr class="text-center bg-gradient-info">
                                                <th width="2%">No</th>
                                                <th width="10%">Action</th>
                                                <th width="30%">Nama Kategori</th>
                                                <th width="48%">Keterangan</th>
                                                <th width="10%">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-table-kategori">
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
@includeIf('master.kategori-obat.form')

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
var idKategori = "";
var tableKategori = null;
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
                document.getElementById('addKategoriBtn').click();
                document.getElementById('nama').focus();
                return false;
            }
        }
    });
});

$('#searchbox_katobat').keyup(function() {
    tableKategori.search($(this).val()).draw();
    tableKategori.columns.adjust().draw();
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

    tableKategori = $('#table-kategori').DataTable({
        processing: true,
        serverSide: false,
        dom: 'rt<"row text-xs p-1"<"float-right"p>><"clear">',
        autowidth: false,
        columnDefs: [
            { width: '2%', targets: 0 },
            { width: '10%', targets: 1 },
            { width: '30%', targets: 2 },
            { width: '48%', targets: 3 },
            { width: '10%', targets: 3 },
        ],
        ajax: {
            url: "{{ route('kategoriobat.data') }}",
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
                name: 'kategori_obat.nama',
                class: 'pl-2 pr-2',
            },
            {
                data: 'keterangan',
                name: 'kategori_obat.keterangan',
                class: 'pl-2 pr-2',
            },
            {
                data: 'status_aktif',
                name: 'kategori_obat.status_aktif',
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

    tableKategori.columns.adjust().draw();

    $('#addDataKategori').validator().on('submit', function(e) {
        e.preventDefault();
        $('#saveKategori').prop('disabled', true).html('<span class="spinner-grow spinner-grow-sm mr-3" role="status" aria-hidden="true"></span>Sending...');
        $('#resetKategori').prop('disabled', true);
        var formData = new FormData($('#addDataKategori form')[0]);

        $.ajax({
            url: $('#addDataKategori form').attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#saveKategori').prop('disabled', false).html('<i class="fas fa-save text-success mr-2"></i>Simpan Data');
                $('#resetKategori').prop('disabled', false);
                toastr["success"](response.success, "Data Tersimpan");
                $('#addDataKategori').modal('hide');
                tableKategori.ajax.reload();
                tableKategori.columns.adjust().draw();
            },
            error: function(error) {
                $('#saveKategori').prop('disabled', false).html('<i class="fas fa-save text-success mr-2"></i>Simpan Data');
                $('#resetKategori').prop('disabled', false);
                var errorMessage = error.responseJSON ? error.responseJSON.error : 'Terjadi kesalahan saat menyimpan data';
                toastr["error"](errorMessage, "Data Gagal Disimpan");
                $('#addDataKategori').addClass('shake'); 
                    setTimeout(function() {
                        $('#addDataKategori').removeClass('shake'); 
                    }, 500);
            }
        });
    });

});

// FORM MODAL TIPE LOKASI POLI

function addFormKategori(url) {
    $("#addDataKategori").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataKategori .modal-title').text('Tambah Kategori Obat');
    $('#addDataKategori form')[0].reset();
    $('#addDataKategori form').attr('action', url);
    $('#addDataKategori [name=_method]').val('post');
    $('#addDataKategori [name=_enctype]').val('multipart/form-data');
    cb_status.checked = true;
    status_aktif.value = 1;
    statusLabel.textContent = 'AKTIF';
    strProses = 'add';
    console.log(strProses);
}

function editFormKategori(url) {
    $("#addDataKategori").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataKategori .modal-title').text('Edit Kategori Obat');
    $('#addDataKategori form')[0].reset();
    $('#addDataKategori form').attr('action', url);
    $('#addDataKategori [name=_method]').val('put');
    $('#addDataKategori [name=_enctype]').val('multipart/form-data');
    strProses = 'edit';
    console.log(strProses);

    $.get(url)
        .done((response) => {
            idKategori = response.id;
            $('#addDataKategori [name=nama]').val(response.nama);
            $('#addDataKategori [name=keterangan]').val(response.keterangan);
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

function deleteDataKategori(url) {
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
                    tableKategori.ajax.reload();
                    tableKategori.columns.adjust().draw();
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

function copyKategoriConfirm(url) {
    Swal.fire({
        title: 'Konfirmasi Copy Data Preset',
        text: 'Apakah Anda yakin untuk menambahkan data Kategori Obat dari data Preset?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Tambahkan',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(url, {
                '_token': $('[name=csrf-token]').attr('content'),
                '_method': 'post'
            })
            .done((response) => {
                Swal.fire('Berhasil', 'Data Preset berhasil dicopy ke dalam data Kategori Obat', 'success');
                tableKategori.ajax.reload();
            })
            .fail((errors) => {
                Swal.fire('Error', 'Tidak dapat menambahkan data dari Preset', 'error');
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