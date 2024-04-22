@extends('adminlte::page')

@section('title', 'Data Poli')
@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('content_header')
    <div class="row mb-0">
        <div class="col-sm-6">
            <h4 class="text-bold text-black">Data Poli</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right text-xs">
                <li class="breadcrumb-item"><a href="../../dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="../../dashboard">Master</a></li>
                <li class="breadcrumb-item active">Data Poli</li>
            </ol>
        </div>
    </div>
@stop
@section('content')
    <div class="card card-danger card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="tabDataPoli" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-poli" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true"><h6 class="text-bold m-0">Data Poli</h6></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-tipe-poli" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false"><h6 class="text-bold m-0">Tipe Lokasi Poli</h6></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="tabDataPoliContent">
                <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="tab-poli">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header p-1">
                                    <div class="row">
                                        <div class="col-md-12 input-group input-group-md">
                                            <input type="text" id="searchbox_poli" name="searchbox_poli" class="form-control form-control-md float-right" placeholder="Search Data Poli">
                                            <div class="input-group-append mr-1">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>

                                            <button type="button" class="btn btn-default btn-md text-bold float-right mr-1" id="refreshPoliBtn"><i class="fas fa-sync-alt text-primary mr-2"></i>Refresh</button>
                                            <button onclick="addFormPoli('{{ route('poli.store') }}')" type="button" class="btn btn-default btn-md text-bold float-right" id="addPoliBtn"><i class="fas fa-plus text-success mr-2"></i>Tambah</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-1 mb-1">
                                    <table id="table-poli" class="table table-bordered table-xs table-hover text-sm" style="width:100%">
                                        <thead>
                                            <tr class="bg-gradient-info">
                                                <th width="5%">No</th>
                                                <th width="20%">Nama Poli</th>
                                                <th>Keterangan</th>
                                                <th width="15%">Tipe Lokasi Poli</th>
                                                <th width="10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-poli">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="tab-tipe-poli">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header p-1">
                                    <div class="row">
                                        <div class="col-md-12 input-group input-group-md">
                                            <input type="text" id="searchbox_tipe" name="searchbox_tipe" class="form-control form-control-md float-right" placeholder="Search Data Tipe Poli">
                                            <div class="input-group-append mr-1">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>

                                            <button type="button" class="btn btn-default btn-md text-bold float-right mr-1" id="refreshTipeBtn"><i class="fas fa-sync-alt text-primary mr-2"></i>Refresh</button>
                                            <button onClick="copyTipeConfirm('{{ route('tipelokasipoli.copypreset') }}')" type="button" class="btn btn-default btn-md text-bold float-right mr-1" id="copyPoliBtn"><i class="fas fa-copy text-danger mr-2"></i>Copy Preset</button>
                                            <button onclick="addFormTipe('{{ route('tipelokasipoli.store') }}')" type="button" class="btn btn-default btn-md text-bold float-right" id="addTipeBtn"><i class="fas fa-plus text-success mr-2"></i>Tambah</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-1 mb-0">
                                    <table id="table-tipe" class="table table-bordered table-xs table-hover text-sm" style="width:100%">
                                        <thead>
                                            <tr class="bg-gradient-info">
                                                <th width="5%" class="text-center">No.</th>
                                                <th>Tipe Lokasi Poli</th>
                                                <th width="10%" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-table-tipe">
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
@includeIf('master.poli.form')

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <link href="{{ asset('css/admin_custom.css') }}" rel="stylesheet">
@stop
@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js" integrity="sha512-dTu0vJs5ndrd3kPwnYixvOCsvef5SGYW/zSSK4bcjRBcZHzqThq7pt7PmCv55yb8iBvni0TSeIDV8RYKjZL36A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
var tableTipe = null;
var tablePoli = null;
var varOpenedTab = 0;

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $("#id_tipe_lokasi_poli").select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Tipe Lokasi Poli",
        allowClear: true
    })
    getDataTipe();
});

function getDataTipe() {
    $.get('get-tipe-poli', function (data) {
        $("#id_tipe_lokasi_poli").empty();
        $.each(data, function (index, tipelokasipoli) {
            $('#id_tipe_lokasi_poli').append('<option value="' + tipelokasipoli.id + '">' + tipelokasipoli.nama_tipe + '</option>');
        });
        $("#id_tipe_lokasi_poli").val('').trigger('change');
    });
}

$(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
});

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.nav-link').forEach(function(tab) {
        tab.addEventListener('click', function(event) {
            if (tab.id === 'tab-tipe-poli') {
                varOpenedTab = 1;
            } else {
                varOpenedTab = 0;
            }
        });
    });

    document.addEventListener('keydown', function(event) {
        if (varOpenedTab === 0) {
            if (event.ctrlKey && event.altKey && event.key === 'n') {
                event.preventDefault();
                document.getElementById('addPoliBtn').click();
                document.getElementById('nama_poli').focus();
                return false;
            }
        }
        if (varOpenedTab === 1) {
            if (event.ctrlKey && event.altKey && event.key === 'n') {
                event.preventDefault();
                document.getElementById('addTipeBtn').click();
                document.getElementById('nama_tipe').focus();
                return false;
            }
        }
    });
});

$('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href");
    if (target === "#custom-tabs-four-home") {
        if (! $.fn.DataTable.isDataTable('#table-poli')) {
            tablePoli = $('#table-poli').DataTable({
                processing: true,
                serverSide: false,
                dom: 'rt<"row text-xs p-1"<"float-right"p>><"clear">',
                ajax: {
                    url: "{{ route('poli.data') }}",
                    dataSrc: "data",
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center',
                    },
                    {
                        data: 'nama_poli',
                        name: 'poli.nama_poli',
                        class: 'pl-2',
                    },
                    {
                        data: 'deskripsi',
                        name: 'poli.deskripsi',
                        class: 'pl-2',
                    },
                    {
                        data: 'nama_tipe',
                        name: 'tipe_lokasi_poli.nama_tipe',
                        class: 'pl-2',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        class: 'text-center',
                    }, 
                ]
            });
        } else {
            tablePoli.columns.adjust();
        }
    }
    if (target === "#custom-tabs-four-profile") {
        if (! $.fn.DataTable.isDataTable('#table-tipe')) {
            tableTipe = $('#table-tipe').DataTable({
                processing: true,
                serverSide: false,
                dom: 'rt<"row text-xs p-1"<"float-right"p>><"clear">',
                ajax: {
                    url: "{{ route('tipelokasipoli.data') }}",
                    dataSrc: "data",
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center',
                    },
                    {
                        data: 'nama_tipe',
                        name: 'nama_tipe',
                        class: 'pl-2',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        class: 'text-center',
                    }, 
                ]
            });
        } else {
            tableTipe.columns.adjust();
        }
    }
});

$('#searchbox_tipe').keyup(function() {
    tableTipe.search($(this).val()).draw();
});

$('#searchbox_poli').keyup(function() {
    tablePoli.search($(this).val()).draw();
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

    tablePoli = $('#table-poli').DataTable({
        processing: true,
        serverSide: false,
        dom: 'rt<"row text-xs p-1"<"float-right"p>><"clear">',
        ajax: {
            url: "{{ route('poli.data') }}",
            dataSrc: "data",
        },
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                class: 'text-center',
            },
            {
                data: 'nama_poli',
                name: 'poli.nama_poli',
                class: 'pl-2',
            },
            {
                data: 'deskripsi',
                name: 'poli.deskripsi',
                class: 'pl-2',
            },
            {
                data: 'nama_tipe',
                name: 'tipe_lokasi_poli.nama_tipe',
                class: 'pl-2',
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                class: 'text-center',
            }, 
        ]
    });

    $('#addDataTipe').validator().on('submit', function(e) {
        if (!e.preventDefault()) {
            $.post($('#addDataTipe form').attr('action'), $('#addDataTipe form').serialize())
                .done((response) => {
                    $('#addDataTipe').modal('hide');
                    tableTipe.ajax.reload();
                    toastr["success"](response.success, "Data Baru Tersimpan");
                })
                .fail((error) => {
                    var errorMessage = error.responseJSON ? error.responseJSON.error : 'Terjadi kesalahan saat menyimpan data';
                    toastr["error"](errorMessage, "Data Gagal Disimpan")
                    $('#addDataTipe').addClass('shake'); 
                    setTimeout(function() {
                        $('#addDataTipe').removeClass('shake'); 
                    }, 500);
                    return;
                });
        }
    })

    $('#addDataPoli').validator().on('submit', function(e) {
        if (!e.preventDefault()) {
            $.post($('#addDataPoli form').attr('action'), $('#addDataPoli form').serialize())
                .done((response) => {
                    $('#addDataPoli').modal('hide');
                    tablePoli.ajax.reload();
                    toastr["success"](response.success, "Data Baru Tersimpan");
                })
                .fail((error) => {
                    var errorMessage = error.responseJSON ? error.responseJSON.error : 'Terjadi kesalahan saat menyimpan data';
                    toastr["error"](errorMessage, "Data Gagal Disimpan")
                    $('#addDataPoli').addClass('shake'); 
                    setTimeout(function() {
                        $('#addDataPoli').removeClass('shake'); 
                    }, 500);
                    return;
                });
        }
    })

});

// FORM MODAL TIPE LOKASI POLI

function addFormTipe(url) {
    $("#addDataTipe").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataTipe .modal-title').text('Tambah Kategori');
    $('#addDataTipe form')[0].reset();
    $('#addDataTipe form').attr('action', url);
    $('#addDataTipe [name=_method]').val('post');
    $('#addDataTipe [name=_enctype]').val('multipart/form-data');
}

function editFormTipe(url) {
    $("#addDataTipe").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataTipe').modal('show');
    $('#addDataTipe .modal-title').text('Edit Kategori');
    $('#addDataTipe form')[0].reset();
    $('#addDataTipe form').attr('action', url);
    $('#addDataTipe [name=_method]').val('put');
    $('#addDataTipe [name=_enctype]').val('multipart/form-data');

    $.get(url)
        .done((response) => {
            $('#addDataTipe [name=nama_tipe]').val(response.nama_tipe);
        })
        .fail((errors) => {
            toastr["error"]("Tidak dapat menampilkan data", "Terjadi Kesalahan")
            return;
        });
}

function deleteData(url) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Apakah Anda yakin ingin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(url, {
                '_token': $('[name=csrf-token]').attr('content'),
                '_method': 'delete'
            })
            .done((response) => {
                Swal.fire('Berhasil', 'Data berhasil dihapus', 'success');
                tableTipe.ajax.reload();
            })
            .fail((errors) => {
                Swal.fire('Error', 'Tidak dapat menghapus data', 'error');
            });
        }
    });
}

// FORM MODAL POLI

function addFormPoli(url) {
    $("#addDataPoli").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataPoli .modal-title').text('Tambah Poli');
    $('#addDataPoli form')[0].reset();
    $('#addDataPoli form').attr('action', url);
    $('#addDataPoli [name=_method]').val('post');
    $('#addDataPoli [name=_enctype]').val('multipart/form-data');
    $('#addDataPoli [name=id_tipe_lokasi_poli]').val('').trigger('change');
}

function editFormPoli(url) {
    $("#addDataPoli").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataPoli .modal-title').text('Edit Poli');
    $('#addDataPoli form')[0].reset();
    $('#addDataPoli form').attr('action', url);
    $('#addDataPoli [name=_method]').val('put');
    $('#addDataPoli [name=_enctype]').val('multipart/form-data');

    $.get(url)
        .done((response) => {
            $('#addDataPoli [name=nama_poli]').val(response.nama_poli);
            $('#addDataPoli [name=deskripsi]').val(response.deskripsi);
            $('#addDataPoli [name=id_tipe_lokasi_poli]').val(response.id_tipe_lokasi_poli).trigger('change');
        })
        .fail((errors) => {
            toastr["error"]("Tidak dapat menampilkan data", "Terjadi Kesalahan")
            return;
        });
}

function deleteDataPoli(url) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Apakah Anda yakin ingin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(url, {
                '_token': $('[name=csrf-token]').attr('content'),
                '_method': 'delete'
            })
            .done((response) => {
                Swal.fire('Berhasil', 'Data berhasil dihapus', 'success');
                tablePoli.ajax.reload();
            })
            .fail((errors) => {
                Swal.fire('Error', 'Tidak dapat menghapus data', 'error');
            });
        }
    });
}

function copyTipeConfirm(url) {
    Swal.fire({
        title: 'Konfirmasi Copy Data Preset',
        text: 'Apakah Anda yakin untuk menambahkan data Tipe Poli dari data Preset?',
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
                Swal.fire('Berhasil', 'Data Preset berhasil dicopy ke dalam data Tipe Poli', 'success');
                getDataTipe();
                tableTipe.ajax.reload();
            })
            .fail((errors) => {
                Swal.fire('Error', 'Tidak dapat menambahkan data dari Preset', 'error');
            });
        }
    });
}

$('#addDataTipe').on('shown.bs.modal', function () {
    $('#nama_tipe').focus();
});

$('#addDataPoli').on('shown.bs.modal', function () {
    $('#nama_poli').focus();
});

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