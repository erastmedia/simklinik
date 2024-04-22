@extends('adminlte::page')

@section('title', 'Data Gudang')
@section('plugins.Datatables', true)
{{-- @section('plugins.TempusDominus', true)
@section('plugins.Select2', true) --}}
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('content_header')
    <div class="row mb-0">
        <div class="col-sm-6">
            <h4 class="text-bold text-black">Data Gudang</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right text-xs">
                <li class="breadcrumb-item"><a href="../../dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="../../dashboard">Master</a></li>
                <li class="breadcrumb-item active">Data Gudang</li>
            </ol>
        </div>
    </div>
@stop
@section('content')
    <div class="card card-danger card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="tabDataGudang" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-gudang" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true"><h6 class="text-bold m-0">Data Gudang</h6></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="tabDataGudangContent">
                <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="tab-gudang">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header p-1">
                                    <div class="row">
                                        <div class="col-md-12 input-group input-group-md">
                                            <input type="text" id="searchbox_gudang" name="searchbox_gudang" class="form-control form-control-md float-right" placeholder="Search Data Gudang">
                                            <div class="input-group-append mr-1">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>

                                            <button type="button" class="btn btn-default btn-md text-bold float-right mr-1" id="refreshGudangBtn"><i class="fas fa-sync-alt text-primary mr-2"></i>Refresh</button>
                                            <button onclick="addFormGudang('{{ route('gudang.store') }}')" type="button" class="btn btn-default btn-md text-bold float-right" id="addGdgBtn"><i class="fas fa-plus text-success mr-2"></i>Tambah</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-1 mb-0">
                                    <table id="table-gudang" class="table table-bordered table-xs table-hover text-sm" style="width:100%">
                                        <thead>
                                            <tr class="text-center bg-gradient-info">
                                                <th width="2%">No</th>
                                                <th width="10%">Action</th>
                                                <th width="6%">Kode</th>
                                                <th width="23%">Nama</th>
                                                <th width="6%">Status</th>
                                                <th width="16%">Telepon</th>
                                                <th width="27%">Alamat</th>
                                                <th width="10%">Kota</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-table-gudang">
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
@includeIf('master.gudang.form')

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
var idGudang = "";
var tableGudang = null;
var varOpenedTab = 0;
var strProses = '';
var cb_status = document.getElementById('cb_status');
// var cb_default = document.getElementById('cb_default');
var status_aktif = document.getElementById('status_aktif');
// var as_default = document.getElementById('as_default');
var statusLabel = document.getElementById('statusLabel');
// var defaultLabel = document.getElementById('defaultLabel');

$(document).ready(function(){
    status_aktif.value = 1;
    // as_default.vaue = 0;
    statusLabel.textContent = 'AKTIF';
    // defaultLabel.textContent = 'NOT DEFAULT';
    $('[data-toggle="tooltip"]').tooltip();

    cb_status.addEventListener('change', function() {
        status_aktif.value = this.checked ? 1 : 0;
        statusLabel.textContent = this.checked ? 'AKTIF' : 'NON AKTIF';
    });

    // cb_default.addEventListener('change', function() {
    //     as_default.value = this.checked ? 1 : 0;
    //     defaultLabel.textContent = this.checked ? 'DEFAULT' : 'NOT DEFAULT';
    // });
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
                document.getElementById('addGdgBtn').click();
                document.getElementById('nama').focus();
                return false;
            }
        }
    });
});

$('#searchbox_gudang').keyup(function() {
    tableGudang.search($(this).val()).draw();
    tableGudang.columns.adjust().draw();
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

    tableGudang = $('#table-gudang').DataTable({
        processing: true,
        serverSide: false,
        dom: 'rt<"row text-xs p-1"<"float-right"p>><"clear">',
        autowidth: false,
        columnDefs: [
            { width: '2%', targets: 0 },
            { width: '12%', targets: 1 },
            { width: '6%', targets: 2 },
            { width: '23%', targets: 3 },
            { width: '6%', targets: 4 },
            { width: '16%', targets: 5 },
            { width: '25%', targets: 6 },
            { width: '10%', targets: 7 },
        ],
        ajax: {
            url: "{{ route('gudang.data') }}",
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
                data: 'kode',
                name: 'gudang.kode',
                class: 'pl-2 pr-2',
            },
            {
                data: 'nama',
                name: 'gudang.nama',
                class: 'pl-2 pr-2',
            },
            {
                data: 'status_aktif',
                name: 'gudang.status_aktif',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    if (data == 1) {
                        return '<span class="badge bg-success pt-1 pb-1 pl-2 pr-2">AKTIF</span>';
                    } else if (data == 0) {
                        return '<span class="badge bg-danger pt-1 pb-1 pl-2 pr-2">NON AKTIF</span>';
                    }
                }
            },
            // {
            //     data: 'telepon',
            //     name: 'gudang.telepon',
            //     class: 'pl-2 pr-2',
            // },
            {
                data: null,
                render: function(data, type, full, meta) {
                    var telepon = full.telepon ? full.telepon : '';
                    var no_hp = full.no_hp ? full.no_hp : '';
                    return telepon + (telepon && no_hp ? ', ' : '') + no_hp;
                },
                name: 'telepon_no_hp',
                class: 'pl-2 pr-2',
            },
            {
                data: 'alamat',
                name: 'gudang.alamat',
                class: 'pl-2 pr-2',
                render: function(data, type, full, meta) {
                    var maxChar = 35;
                    if (data !== null && data !== undefined) { // Tambahkan pengecekan untuk nilai null
                        if (data.length > maxChar) {
                            var truncatedText = data.substr(0, maxChar) + '...';
                            return '<span title="' + data + '">' + truncatedText + '</span>';
                        } else {
                            return data;
                        }
                    } else {
                        return ''; // Jika nilai alamat null, kembalikan string kosong
                    }
                }
            },
            {
                data: 'kota',
                name: 'gudang.kota',
                class: 'pl-2 pr-2',
            },
        ]
    });

    tableGudang.columns.adjust().draw();

    $('#addDataGudang').validator().on('submit', function(e) {
        e.preventDefault();
        $('#saveGudang').prop('disabled', true).html('<span class="spinner-grow spinner-grow-sm mr-3" role="status" aria-hidden="true"></span>Sending...');
        $('#resetGudang').prop('disabled', true);
        var formData = new FormData($('#addDataGudang form')[0]);

        $.ajax({
            url: $('#addDataGudang form').attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#saveGudang').prop('disabled', false).html('<i class="fas fa-save text-success mr-2"></i>Simpan Data');
                $('#resetGudang').prop('disabled', false);
                toastr["success"](response.success, "Data Tersimpan");
                $('#addDataGudang').modal('hide');
                tableGudang.ajax.reload();
                tableGudang.columns.adjust().draw();
            },
            error: function(error) {
                $('#saveGudang').prop('disabled', false).html('<i class="fas fa-save text-success mr-2"></i>Simpan Data');
                $('#resetGudang').prop('disabled', false);
                var errorMessage = error.responseJSON ? error.responseJSON.error : 'Terjadi kesalahan saat menyimpan data';
                toastr["error"](errorMessage, "Data Gagal Disimpan");
                $('#addDataGudang').addClass('shake'); 
                    setTimeout(function() {
                        $('#addDataGudang').removeClass('shake'); 
                    }, 500);
            }
        });
    });

});

// FORM MODAL TIPE LOKASI POLI

function addFormGudang(url) {
    $("#addDataGudang").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataGudang .modal-title').text('Tambah Gudang');
    $('#addDataGudang form')[0].reset();
    $('#addDataGudang form').attr('action', url);
    $('#addDataGudang [name=_method]').val('post');
    $('#addDataGudang [name=_enctype]').val('multipart/form-data');
    $('#addDataGudang [name=id_spesialis]').val('').trigger('change');
    cb_status.checked = true;
    // cb_default.checked = false;
    status_aktif.value = 1;
    // as_default.value = 0;
    statusLabel.textContent = 'AKTIF';
    // defaultLabel.textContent = 'NOT DEFAULT'
    strProses = 'add';
    console.log(strProses);
}

function editFormGudang(url) {
    $("#addDataGudang").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataGudang .modal-title').text('Edit Gudang');
    $('#addDataGudang form')[0].reset();
    $('#addDataGudang form').attr('action', url);
    $('#addDataGudang [name=_method]').val('put');
    $('#addDataGudang [name=_enctype]').val('multipart/form-data');
    strProses = 'edit';
    console.log(strProses);

    $.get(url)
        .done((response) => {
            idGudang = response.id;
            $('#addDataGudang [name=kode]').val(response.kode);
            $('#addDataGudang [name=nama]').val(response.nama);
            $('#addDataGudang [name=alamat]').val(response.alamat);
            $('#addDataGudang [name=email]').val(response.email);
            $('#addDataGudang [name=telepon]').val(response.telepon);
            $('#addDataGudang [name=no_hp]').val(response.no_hp);
            $('#addDataGudang [name=kota]').val(response.kota);
            if(response.status_aktif == 1){
                cb_status.checked = true;
                status_aktif.value = 1;
                statusLabel.textContent = 'AKTIF';
            } else {
                cb_status.checked = false;
                status_aktif.value = 0;
                statusLabel.textContent = 'NON AKTIF';
            }
            // if(response.as_default == 1){
            //     cb_default.checked = true;
            //     as_default.value = 1;
            //     defaultLabel.textContent = 'DEFAULT';
            // } else {
            //     cb_default.checked = false;
            //     as_default.value = 0;
            //     defaultLabel.textContent = 'NOT DEFAULT';
            // }
        })
        .fail((errors) => {
            toastr["error"]("Tidak dapat menampilkan data", "Terjadi Kesalahan")
            return;
        });
}

function deleteDataGudang(url) {
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
                    tableGudang.ajax.reload();
                    tableGudang.columns.adjust().draw();
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


function defaultDataGudang(url) {
    Swal.fire({
        title: 'Konfirmasi Set as Default',
        text: 'Apakah Anda yakin ingin menetapkan data ini menjadi Gudang default?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Tetapkan',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: url,
                type: 'PUT',
                data: {
                    '_token': $('[name=csrf-token]').attr('content')
                },
                success: function(response) {
                    Swal.fire('Berhasil', 'Data berhasil ditetapkan menjadi Gudang default', 'success');
                    tableGudang.ajax.reload();
                    tableGudang.columns.adjust().draw();
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMessage = xhr.responseJSON.error;
                    }
                    Swal.fire('Gagal', errorMessage, 'error');
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