@extends('adminlte::page')

@section('title', 'Data Petugas Medis')
@section('plugins.Datatables', true)
@section('plugins.TempusDominus', true)
@section('plugins.Select2', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('content_header')
    <div class="row mb-0">
        <div class="col-sm-6">
            <h4 class="text-bold text-black">Data Petugas Medis</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right text-xs">
                <li class="breadcrumb-item"><a href="../../dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="../../dashboard">Master</a></li>
                <li class="breadcrumb-item active">Data Petugas Medis</li>
            </ol>
        </div>
    </div>
@stop
@section('content')
    <div class="card card-danger card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="tabDataPetugas" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-petugas" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true"><h6 class="text-bold m-0">Data Petugas Medis</h6></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-bagian-spesialisasi" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false"><h6 class="text-bold m-0">Bagian/Spesialisasi</h6></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="tabDataPetugasContent">
                <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="tab-petugas">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header p-1">
                                    <div class="row">
                                        <div class="col-md-12 input-group input-group-md">
                                            <input type="text" id="searchbox_petugas" name="searchbox_petugas" class="form-control form-control-md float-right" placeholder="Search Data Petugas Medis">
                                            <div class="input-group-append mr-1">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>

                                            <button type="button" class="btn btn-default btn-md text-bold float-right mr-1" id="refreshPetugasBtn"><i class="fas fa-sync-alt text-primary mr-2"></i>Refresh</button>
                                            <button onclick="addFormPetugas('{{ route('petugas.store') }}')" type="button" class="btn btn-default btn-md text-bold float-right" id="addPetugasBtn"><i class="fas fa-plus text-success mr-2"></i>Tambah</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-1 mb-1">
                                    <table id="table-petugas" class="table table-bordered table-xs table-hover text-sm" style="width:150%">
                                        <thead>
                                            <tr class="text-center bg-gradient-info">
                                                <th width="2%">No</th>
                                                <th width="6%">Action</th>
                                                <th width="23%">Nama</th>
                                                <th width="10%">NIK</th>
                                                <th width="8%">ID Satu Sehat</th>
                                                <th width="16%">Bagian</th>
                                                <th width="22%">Alamat</th>
                                                <th width="7%">Tgl. Masuk</th>
                                                <th width="6%">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-table-petugas">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="tab-bagian-spesialisasi">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header p-1">
                                    <div class="row">
                                        <div class="col-md-12 input-group input-group-md">
                                            <input type="text" id="searchbox_bagian" name="searchbox_bagian" class="form-control form-control-md float-right" placeholder="Search Data Bagian/Spesialisasi">
                                            <div class="input-group-append mr-1">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>

                                            <button type="button" class="btn btn-default btn-md text-bold float-right mr-1" id="refreshBagianBtn"><i class="fas fa-sync-alt text-primary mr-2"></i>Refresh</button>
                                            <button onclick="addFormBagian('{{ route('bagianspesialisasi.store') }}')" type="button" class="btn btn-default btn-md text-bold float-right" id="addBagianBtn"><i class="fas fa-plus text-success mr-2"></i>Tambah</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-1 mb-0">
                                    <table id="table-bagian" class="table table-bordered table-xs table-hover text-sm" style="width:100%">
                                        <thead>
                                            <tr class="bg-gradient-info">
                                                <th width="5%" class="text-center">No.</th>
                                                <th>Bagian/Spesialisasi</th>
                                                <th width="10%" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-table-bagian">
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
@includeIf('master.petugas.form')

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
    <style>
        .foto {
            position: relative;
            border: 3px dashed #ccc; 
            border-radius: 5px;
            padding: 10px;
            text-align: center;
        }

        .hapus_gambar {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 1;
        }
    </style>
@stop
@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js" integrity="sha512-dTu0vJs5ndrd3kPwnYixvOCsvef5SGYW/zSSK4bcjRBcZHzqThq7pt7PmCv55yb8iBvni0TSeIDV8RYKjZL36A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
var tableSp = null;
var tablePetugas = null;
var varOpenedTab = 0;
var strProses = '';
var hiddenFoto = document.getElementById('hidden_foto');
var cb_status = document.getElementById('cb_status');
var status_aktif = document.getElementById('status_aktif');
var statusLabel = document.getElementById('statusLabel');

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $("#id_bagian").select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Bagian/Spesialisasi",
        allowClear: true
    })
    $('#tgl_masuk').datetimepicker({
        format: 'DD MMMM YYYY'
    });
    
    $('#path_foto').change(function() {
        var btnDelFoto = document.getElementById('btn_del_foto');
        let reader = new FileReader();
        reader.onload = (e) => {
            hiddenFoto.value = '';
            $('#preview_img_foto_add').attr('src', e.target.result);
            btnDelFoto.style.display = 'inline';
        }
        reader.readAsDataURL(this.files[0]);
    });

    cb_status.addEventListener('change', function() {
        status_aktif.value = this.checked ? 1 : 0;
        statusLabel.textContent = this.checked ? 'AKTIF' : 'NON AKTIF';
    });

    getDataBagian();
    
});

function getDataBagian() {
    $.get('bagian', function (data) {
        $("#id_bagian").empty();
        $.each(data, function (index, bagian) {
            $('#id_bagian').append('<option value="' + bagian.id + '">' + bagian.nama_bagian + '</option>');
        });
        $("#id_bagian").val('').trigger('change');
    });
}

document.getElementById('btn_del_foto').addEventListener('click', function() {
    event.preventDefault();
    var previewImg = document.getElementById('preview_img_foto_add');
    var fileInput = document.getElementById('path_foto');
    var btnDelFoto = document.getElementById('btn_del_foto');

    previewImg.src = "{{ asset('img/no-photo.png') }}"; // Mengganti gambar menjadi default
    btnDelFoto.style.display = 'none'; // Menyembunyikan tombol hapus
    fileInput.value = ''; // Mengosongkan input file

    if(strProses == 'add'){
        hiddenFoto.value = '';
    } else {
        hiddenFoto.value = 'reset';
    }
});

$(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
});

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.nav-link').forEach(function(tab) {
        tab.addEventListener('click', function(event) {
            if (tab.id === 'tab-bagian-spesialisasi') {
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
                document.getElementById('addPetugasBtn').click();
                document.getElementById('nik').focus();
                return false;
            }
        }
        if (varOpenedTab === 1) {
            if (event.ctrlKey && event.altKey && event.key === 'n') {
                event.preventDefault();
                document.getElementById('addBagianBtn').click();
                document.getElementById('nama_bagian').focus();
                return false;
            }
        }
    });
});

$('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href");
    if (target === "#custom-tabs-four-home") {
        if (! $.fn.DataTable.isDataTable('#table-petugas')) {
            tablePetugas = $('#table-petugas').DataTable({
                processing: true,
                serverSide: false,
                dom: 'rt<"row text-xs p-1"<"float-right"p>><"clear">',
                autowidth: false,
                columnDefs: [
                    { width: '2%', targets: 0 },
                    { width: '6%', targets: 1 },
                    { width: '23%', targets: 2 },
                    { width: '10%', targets: 3 },
                    { width: '8%', targets: 4 },
                    { width: '16%', targets: 5 },
                    { width: '22%', targets: 6 },
                    { width: '7%', targets: 7 },
                    { width: '6%', targets: 8 },
                ],
                ajax: {
                    url: "{{ route('petugas.data') }}",
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
                        name: 'petugas.nama',
                        class: 'pl-2 pr-2',
                    },
                    {
                        data: 'nik',
                        name: 'petugas.nik',
                        class: 'pl-2 pr-2',
                    },
                    {
                        data: 'id_satu_sehat',
                        name: 'petugas.id_satu_sehat',
                        class: 'pl-2 pr-2',
                    },
                    {
                        data: 'nama_bagian',
                        name: 'bagian_spesialisasi.nama_bagian',
                        class: 'pl-2 pr-2',
                    },
                    {
                        data: 'alamat',
                        name: 'petugas.alamat',
                        class: 'pl-2 pr-2',
                        render: function(data, type, full, meta) {
                            var maxChar = 35;
                            if (data.length > maxChar) {
                                var truncatedText = data.substr(0, maxChar) + '...';
                                return '<span title="' + data + '">' + truncatedText + '</span>';
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        data: 'tgl_masuk',
                        name: 'petugas.tgl_masuk',
                        className: 'text-center pl-2 pr-2',
                        render: function(data, type, full, meta) {
                            var date = new Date(data);
                            var options = { year: 'numeric', month: 'short', day: '2-digit' };
                            return date.toLocaleDateString('id-ID', options);
                        }
                    },
                    {
                        data: 'status_aktif',
                        name: 'petugas.status_aktif',
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

            tablePetugas.columns.adjust();
        } else {
            tablePetugas.columns.adjust();
        }
    }
    if (target === "#custom-tabs-four-profile") {
        if (! $.fn.DataTable.isDataTable('#table-bagian')) {
            tableSp = $('#table-bagian').DataTable({
                processing: true,
                serverSide: false,
                dom: 'rt<"row text-xs p-1"<"float-right"p>><"clear">',
                ajax: {
                    url: "{{ route('bagianspesialisasi.data') }}",
                    dataSrc: "data",
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center',
                    },
                    {
                        data: 'nama_bagian',
                        name: 'nama_bagian',
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
            tableSp.columns.adjust();
        }
    }
});

$('#searchbox_bagian').keyup(function() {
    tableSp.search($(this).val()).draw();
});

$('#searchbox_petugas').keyup(function() {
    tablePetugas.search($(this).val()).draw();
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

    tablePetugas = $('#table-petugas').DataTable({
        processing: true,
        serverSide: false,
        dom: 'rt<"row text-xs p-1"<"float-right"p>><"clear">',
        autowidth: false,
        columnDefs: [
            { width: '2%', targets: 0 },
            { width: '6%', targets: 1 },
            { width: '23%', targets: 2 },
            { width: '10%', targets: 3 },
            { width: '8%', targets: 4 },
            { width: '16%', targets: 5 },
            { width: '22%', targets: 6 },
            { width: '7%', targets: 7 },
            { width: '6%', targets: 8 },
        ],
        ajax: {
            url: "{{ route('petugas.data') }}",
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
                name: 'petugas.nama',
                class: 'pl-2 pr-2',
            },
            {
                data: 'nik',
                name: 'petugas.nik',
                class: 'pl-2 pr-2',
            },
            {
                data: 'id_satu_sehat',
                name: 'petugas.id_satu_sehat',
                class: 'pl-2 pr-2',
            },
            {
                data: 'nama_bagian',
                name: 'bagian_spesialisasi.nama_bagian',
                class: 'pl-2 pr-2',
            },
            {
                data: 'alamat',
                name: 'petugas.alamat',
                class: 'pl-2 pr-2',
                render: function(data, type, full, meta) {
                    var maxChar = 35;
                    if (data.length > maxChar) {
                        var truncatedText = data.substr(0, maxChar) + '...';
                        return '<span title="' + data + '">' + truncatedText + '</span>';
                    } else {
                        return data;
                    }
                }
            },
            {
                data: 'tgl_masuk',
                name: 'petugas.tgl_masuk',
                className: 'text-center pl-2 pr-2',
                render: function(data, type, full, meta) {
                    var date = new Date(data);
                    var options = { year: 'numeric', month: 'short', day: '2-digit' };
                    return date.toLocaleDateString('id-ID', options);
                }
            },
            {
                data: 'status_aktif',
                name: 'petugas.status_aktif',
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

    tablePetugas.columns.adjust();

    $('#addDataBagian').validator().on('submit', function(e) {
        if (!e.preventDefault()) {
            $('#saveBtn').prop('disabled', true).html('<span class="spinner-grow spinner-grow-sm mr-3" role="status" aria-hidden="true"></span>Sending...');
            $('#resetBtn').prop('disabled', true);
            $.post($('#addDataBagian form').attr('action'), $('#addDataBagian form').serialize())
                .done((response) => {
                    $('#saveBtn').prop('disabled', false).html('<i class="fas fa-save text-success mr-2"></i>Simpan Data');
                    $('#resetBtn').prop('disabled', false);
                    getDataBagian();
                    $('#addDataBagian').modal('hide');
                    tableSp.ajax.reload();
                    toastr["success"](response.success, "Data Baru Tersimpan");
                })
                .fail((error) => {
                    $('#saveBtn').prop('disabled', false).html('<i class="fas fa-save text-success mr-2"></i>Simpan Data');
                    $('#resetBtn').prop('disabled', false);
                    var errorMessage = error.responseJSON ? error.responseJSON.error : 'Terjadi kesalahan saat menyimpan data';
                    toastr["error"](errorMessage, "Data Gagal Disimpan")
                    $('#addDataBagian').addClass('shake'); 
                    setTimeout(function() {
                        $('#addDataBagian').removeClass('shake'); 
                    }, 500);
                    return;
                });
        }
    })

    // $('#addDataPetugas').validator().on('submit', function(e) {
    //     if (!e.preventDefault()) {
    //         $('#savePetugas').prop('disabled', true).html('<span class="spinner-grow spinner-grow-sm mr-3" role="status" aria-hidden="true"></span>Sending...');
    //         $('#resetPetugas').prop('disabled', true);
    //         $.post($('#addDataPetugas form').attr('action'), $('#addDataPetugas form').serialize())
    //             .done((response) => {
    //                 $('#savePetugas').prop('disabled', false).html('<i class="fas fa-save text-success mr-2"></i>Simpan Data');
    //                 $('#resetPetugas').prop('disabled', false);
    //                 $('#addDataPetugas').modal('hide');
    //                 tablePetugas.ajax.reload();
    //                 toastr["success"](response.success, "Data Baru Tersimpan");
    //             })
    //             .fail((error) => {
    //                 $('#savePetugas').prop('disabled', false).html('<i class="fas fa-save text-success mr-2"></i>Simpan Data');
    //                 $('#resetPetugas').prop('disabled', false);
    //                 var errorMessage = error.responseJSON ? error.responseJSON.error : 'Terjadi kesalahan saat menyimpan data';
    //                 toastr["error"](errorMessage, "Data Gagal Disimpan")
    //                 $('#addDataPetugas').addClass('shake'); 
    //                 setTimeout(function() {
    //                     $('#addDataPetugas').removeClass('shake'); 
    //                 }, 500);
    //                 return;
    //             });
    //     }
    // })

    $('#addDataPetugas').validator().on('submit', function(e) {
        e.preventDefault();
        $('#savePetugas').prop('disabled', true).html('<span class="spinner-grow spinner-grow-sm mr-3" role="status" aria-hidden="true"></span>Sending...');
        $('#resetPetugas').prop('disabled', true);
        var formData = new FormData($('#addDataPetugas form')[0]);

        $.ajax({
            url: $('#addDataPetugas form').attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#savePetugas').prop('disabled', false).html('<i class="fas fa-save text-success mr-2"></i>Simpan Data');
                $('#resetPetugas').prop('disabled', false);
                toastr["success"](response.success, "Data Tersimpan");
                $('#addDataPetugas').modal('hide');
                tablePetugas.ajax.reload();
                tablePetugas.columns.adjust().draw();
            },
            error: function(error) {
                $('#savePetugas').prop('disabled', false).html('<i class="fas fa-save text-success mr-2"></i>Simpan Data');
                    $('#resetPetugas').prop('disabled', false);
                var errorMessage = error.responseJSON ? error.responseJSON.error : 'Terjadi kesalahan saat menyimpan data';
                toastr["error"](errorMessage, "Data Gagal Disimpan");
            }
        });
    });

});

// FORM MODAL Bagian/Spesialisasi

function addFormBagian(url) {
    $("#addDataBagian").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataBagian .modal-title').text('Tambah Bagian/Spesialisasi');
    $('#addDataBagian form')[0].reset();
    $('#addDataBagian form').attr('action', url);
    $('#addDataBagian [name=_method]').val('post');
    $('#addDataBagian [name=_enctype]').val('multipart/form-data');
}

function editFormBagian(url) {
    $("#addDataBagian").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataBagian').modal('show');
    $('#addDataBagian .modal-title').text('Edit Bagian/Spesialisasi');
    $('#addDataBagian form')[0].reset();
    $('#addDataBagian form').attr('action', url);
    $('#addDataBagian [name=_method]').val('put');
    $('#addDataBagian [name=_enctype]').val('multipart/form-data');

    $.get(url)
        .done((response) => {
            $('#addDataBagian [name=nama_bagian]').val(response.nama_bagian);
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
                tableSp.ajax.reload();
            })
            .fail((errors) => {
                Swal.fire('Error', 'Tidak dapat menghapus data', 'error');
            });
        }
    });
}

// FORM MODAL POLI

function addFormPetugas(url) {
    $("#addDataPetugas").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataPetugas .modal-title').text('Tambah Petugas Medis');
    $('#addDataPetugas form')[0].reset();
    $('#addDataPetugas form').attr('action', url);
    $('#addDataPetugas [name=preview_img_foto_add]').attr('src', '../../img/no-photo.png');
    $('#addDataPetugas [name=_method]').val('post');
    $('#addDataPetugas [name=_enctype]').val('multipart/form-data');
    $('#addDataPetugas [name=id_bagian]').val('').trigger('change');
    cb_status.checked = true;
    status_aktif.value = 1;
    statusLabel.textContent = 'AKTIF';
    strProses = 'add';
    console.log(strProses);
}

function editFormPetugas(url) {
    $("#addDataPetugas").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataPetugas .modal-title').text('Edit Dokter');
    $('#addDataPetugas form')[0].reset();
    $('#addDataPetugas form').attr('action', url);
    $('#addDataPetugas [name=_method]').val('put');
    $('#addDataPetugas [name=_enctype]').val('multipart/form-data');
    strProses = 'edit';
    console.log(strProses);

    $('#addDataPetugas [name=preview_img_foto_add]').attr('src', '../../img/spinner.gif');

    $.get(url)
        .done((response) => {
            idPetugas = response.id;
            $('#addDataPetugas [name=nik]').val(response.nik);
            $('#addDataPetugas [name=id_satu_sehat]').val(response.id_satu_sehat);
            $('#addDataPetugas [name=nama]').val(response.nama);
            $('#addDataPetugas [name=alamat]').val(response.alamat);
            $('#addDataPetugas [name=kota]').val(response.kota);
            $('#addDataPetugas [name=telepon]').val(response.telepon);
            $('#addDataPetugas [name=no_str]').val(response.no_str);
            $('#addDataPetugas [name=username]').val(response.username);
            $('#addDataPetugas [name=email]').val(response.email);
            $('#addDataPetugas [name=id_bagian]').val(response.id_bagian).trigger('change');
            var formattedDate = moment(response.tgl_masuk).format('DD MMMM YYYY');
            var btnDelFoto = document.getElementById('btn_del_foto');
            $('#addDataPetugas [name=tgl_masuk]').val(formattedDate);
            if(response.status_aktif == 1){
                cb_status.checked = true;
                status_aktif.value = 1;
                statusLabel.textContent = 'AKTIF';
            } else {
                cb_status.checked = false;
                status_aktif.value = 0;
                statusLabel.textContent = 'NON AKTIF';
            }
            if(response.path_foto=='no-photo.png'){
                btnDelFoto.style.display = 'none';
                $('#addDataPetugas [name=preview_img_foto_add]').attr('src', '../../img/' + response.path_foto);
            } else {
                btnDelFoto.style.display = 'inline';
                $('#addDataPetugas [name=preview_img_foto_add]').attr('src', '../../img/user/petugas/foto/' + response.path_foto);
            }
        })
        .fail((errors) => {
            toastr["error"]("Tidak dapat menampilkan data", "Terjadi Kesalahan")
            return;
        });
}

function deleteDataPetugas(url) {
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
                tablePetugas.ajax.reload();
                tablePetugas.columns.adjust().draw();
            })
            .fail((errors) => {
                Swal.fire('Error', 'Tidak dapat menghapus data', 'error');
            });
        }
    });
}

$('#addDataBagian').on('shown.bs.modal', function () {
    $('#nama_bagian').focus();
});

$('#addDataPetugas').on('shown.bs.modal', function () {
    $('#nik').focus();
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