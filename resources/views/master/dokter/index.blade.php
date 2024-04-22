@extends('adminlte::page')

@section('title', 'Data Dokter')
@section('plugins.Datatables', true)
@section('plugins.TempusDominus', true)
@section('plugins.Select2', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('content_header')
    <div class="row mb-0">
        <div class="col-sm-6">
            <h4 class="text-bold text-black">Data Dokter</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right text-xs">
                <li class="breadcrumb-item"><a href="../../dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="../../dashboard">Master</a></li>
                <li class="breadcrumb-item active">Data Dokter</li>
            </ol>
        </div>
    </div>
@stop
@section('content')
    <div class="card card-danger card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="tabDataDokter" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-dokter" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true"><h6 class="text-bold m-0">Data Dokter</h6></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="tabDataDokterContent">
                <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="tab-dokter">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header p-1">
                                    <div class="row">
                                        <div class="col-md-12 input-group input-group-md">
                                            <input type="text" id="searchbox_dokter" name="searchbox_dokter" class="form-control form-control-md float-right" placeholder="Search Data Dokter">
                                            <div class="input-group-append mr-1">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>

                                            <button type="button" class="btn btn-default btn-md text-bold float-right mr-1" id="refreshDokterBtn"><i class="fas fa-sync-alt text-primary mr-2"></i>Refresh</button>
                                            <button onclick="addFormDokter('{{ route('dokter.store') }}')" type="button" class="btn btn-default btn-md text-bold float-right" id="addDokBtn"><i class="fas fa-plus text-success mr-2"></i>Tambah</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-1 mb-0">
                                    <table id="table-dokter" class="table table-bordered table-xs table-hover text-sm" style="width:150%">
                                        <thead>
                                            <tr class="text-center bg-gradient-info">
                                                <th width="2%">No</th>
                                                <th width="6%">Action</th>
                                                <th width="23%">Nama</th>
                                                <th width="10%">NIK</th>
                                                <th width="6%">Status</th>
                                                <th width="8%">ID Satu Sehat</th>
                                                <th width="16%">Spesialis</th>
                                                <th width="22%">Alamat</th>
                                                <th width="7%">Tgl. Masuk</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-table-dokter">
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
@includeIf('master.dokter.form')

<div class="modal fade" id="previewImage">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-body img-preview">
                <div class="row">
                    <img id="modalImage">
                </div>
            </div>
        </div>
    </div>
</div>

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
    <link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet">
    <style>

        .foto {
            position: relative;
            border: 3px dashed #ccc; 
            border-radius: 5px;
            padding: 10px;
            text-align: center;
        }

        .centered-image {
            max-width: 100%;
            max-height: 100%;
            display: block;
            margin: auto;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .modal-body .img-preview {
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
var idDokter = "";

var tableSp = null;
var tableDokter = null;
var varOpenedTab = 0;
var strProses = '';
var hiddenFoto = document.getElementById('hidden_foto');
var hiddenTdt = document.getElementById('hidden_tdt');
var hiddenStamp = document.getElementById('hidden_stamp');
var cb_status = document.getElementById('cb_status');
var status_aktif = document.getElementById('status_aktif');
var statusLabel = document.getElementById('statusLabel');

$(document).ready(function(){
    status_aktif.value = 1;
    statusLabel.textContent = 'AKTIF';
    $('[data-toggle="tooltip"]').tooltip();
    $("#id_spesialis").select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Spesialisasi Dokter",
        allowClear: true
    })
    $("#id_spesialis").val('').trigger('change');
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

    $('#path_tdt').change(function() {
        var btnDelTdt = document.getElementById('btn_del_tdt');
        let reader = new FileReader();
        reader.onload = (e) => {
            hiddenTdt.value = '';
            $('#preview_img_tdt_add').attr('src', e.target.result);
            btnDelTdt.style.display = 'inline';
        }
        reader.readAsDataURL(this.files[0]);
    });

    $('#path_stamp').change(function() {
        var btnDelStamp = document.getElementById('btn_del_stamp');
        let reader = new FileReader();
        reader.onload = (e) => {
            hiddenStamp.value = '';
            $('#preview_img_stamp_add').attr('src', e.target.result);
            btnDelStamp.style.display = 'inline';
        }
        reader.readAsDataURL(this.files[0]);
    });

    cb_status.addEventListener('change', function() {
        status_aktif.value = this.checked ? 1 : 0;
        statusLabel.textContent = this.checked ? 'AKTIF' : 'NON AKTIF';
    });
});

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

document.getElementById('btn_del_tdt').addEventListener('click', function() {
    event.preventDefault();
    var previewImg = document.getElementById('preview_img_tdt_add');
    var fileInput = document.getElementById('path_tdt');
    var btnDelTdt = document.getElementById('btn_del_tdt');

    previewImg.src = "{{ asset('img/no-photo.png') }}"; // Mengganti gambar menjadi default
    btnDelTdt.style.display = 'none'; // Menyembunyikan tombol hapus
    fileInput.value = ''; // Mengosongkan input file

    if(strProses == 'add'){
        hiddenTdt.value = '';
    } else {
        hiddenTdt.value = 'reset';
    }
});

document.getElementById('btn_del_stamp').addEventListener('click', function() {
    event.preventDefault();
    var previewImg = document.getElementById('preview_img_stamp_add');
    var fileInput = document.getElementById('path_stamp');
    var btnDelStamp = document.getElementById('btn_del_stamp');

    previewImg.src = "{{ asset('img/no-photo.png') }}"; // Mengganti gambar menjadi default
    btnDelStamp.style.display = 'none'; // Menyembunyikan tombol hapus
    fileInput.value = ''; // Mengosongkan input file

    if(strProses == 'add'){
        hiddenStamp.value = '';
    } else {
        hiddenStamp.value = 'reset';
    }
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
                document.getElementById('addDokBtn').click();
                document.getElementById('nik').focus();
                return false;
            }
        }
    });
});

$('#searchbox_dokter').keyup(function() {
    tableDokter.search($(this).val()).draw();
    tableDokter.columns.adjust().draw();
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

    tableDokter = $('#table-dokter').DataTable({
        processing: true,
        serverSide: false,
        dom: 'rt<"row text-xs p-1"<"float-right"p>><"clear">',
        autowidth: false,
        columnDefs: [
            { width: '2%', targets: 0 },
            { width: '6%', targets: 1 },
            { width: '23%', targets: 2 },
            { width: '10%', targets: 3 },
            { width: '6%', targets: 4 },
            { width: '8%', targets: 5 },
            { width: '16%', targets: 6 },
            { width: '22%', targets: 7 },
            { width: '7%', targets: 8 },
            
        ],
        ajax: {
            url: "{{ route('dokter.data') }}",
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
                name: 'dokter.nama',
                class: 'pl-2 pr-2',
            },
            {
                data: 'nik',
                name: 'dokter.nik',
                class: 'pl-2 pr-2',
            },
            {
                data: 'status_aktif',
                name: 'dokter.status_aktif',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    if (data == 1) {
                        return '<span class="badge bg-success pt-1 pb-1 pl-2 pr-2">AKTIF</span>';
                    } else if (data == 0) {
                        return '<span class="badge bg-danger pt-1 pb-1 pl-2 pr-2">NON AKTIF</span>';
                    }
                }
            },
            {
                data: 'id_satu_sehat',
                name: 'dokter.id_satu_sehat',
                class: 'pl-2 pr-2',
            },
            {
                data: 'nama_spesialisasi',
                name: 'spesialisasi_dokter.nama_spesialisasi',
                class: 'pl-2 pr-2',
            },
            {
                data: 'alamat',
                name: 'dokter.alamat',
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
            // {
            //     data: 'alamat',
            //     name: 'dokter.alamat',
            //     class: 'pl-2 pr-2',
            //     render: function(data, type, full, meta) {
            //         var maxChar = 35;
            //         if (data.length > maxChar) {
            //             var truncatedText = data.substr(0, maxChar) + '...';
            //             return '<span title="' + data + '">' + truncatedText + '</span>';
            //         } else {
            //             return data;
            //         }
            //     }
            // },
            {
                data: 'tgl_masuk',
                name: 'dokter.tgl_masuk',
                className: 'text-center pl-2 pr-2',
                render: function(data, type, full, meta) {
                    var date = new Date(data);
                    var options = { year: 'numeric', month: 'short', day: '2-digit' };
                    return date.toLocaleDateString('id-ID', options);
                }
            },
        ]
    });

    tableDokter.columns.adjust().draw();

    $('#addDataDokter').validator().on('submit', function(e) {
        e.preventDefault();
        $('#saveDokter').prop('disabled', true).html('<span class="spinner-grow spinner-grow-sm mr-3" role="status" aria-hidden="true"></span>Sending...');
        $('#resetDokter').prop('disabled', true);
        var formData = new FormData($('#addDataDokter form')[0]);

        $.ajax({
            url: $('#addDataDokter form').attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#saveDokter').prop('disabled', false).html('<i class="fas fa-save text-success mr-2"></i>Simpan Data');
                $('#resetDokter').prop('disabled', false);
                toastr["success"](response.success, "Data Tersimpan");
                $('#addDataDokter').modal('hide');
                tableDokter.ajax.reload();
                tableDokter.columns.adjust().draw();
            },
            error: function(error) {
                $('#saveDokter').prop('disabled', false).html('<i class="fas fa-save text-success mr-2"></i>Simpan Data');
                $('#resetDokter').prop('disabled', false);
                var errorMessage = error.responseJSON ? error.responseJSON.error : 'Terjadi kesalahan saat menyimpan data';
                toastr["error"](errorMessage, "Data Gagal Disimpan");
                $('#addDataDokter').addClass('shake'); 
                    setTimeout(function() {
                        $('#addDataDokter').removeClass('shake'); 
                    }, 500);
            }
        });
    });

});

// FORM MODAL TIPE LOKASI POLI

function addFormDokter(url) {
    $("#addDataDokter").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataDokter .modal-title').text('Tambah Dokter');
    $('#addDataDokter form')[0].reset();
    $('#addDataDokter form').attr('action', url);
    $('#addDataDokter [name=preview_img_foto_add]').attr('src', '../../img/no-photo.png');
    $('#addDataDokter [name=preview_img_tdt_add]').attr('src', '../../img/no-photo.png');
    $('#addDataDokter [name=preview_img_stamp_add]').attr('src', '../../img/no-photo.png');
    $('#addDataDokter [name=_method]').val('post');
    $('#addDataDokter [name=_enctype]').val('multipart/form-data');
    $('#addDataDokter [name=id_spesialis]').val('').trigger('change');
    cb_status.checked = true;
    status_aktif.value = 1;
    statusLabel.textContent = 'AKTIF';
    strProses = 'add';
    console.log(strProses);
}

function editFormDokter(url) {
    $("#addDataDokter").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataDokter .modal-title').text('Edit Dokter');
    $('#addDataDokter form')[0].reset();
    $('#addDataDokter form').attr('action', url);
    $('#addDataDokter [name=_method]').val('put');
    $('#addDataDokter [name=_enctype]').val('multipart/form-data');
    strProses = 'edit';
    console.log(strProses);

    $('#addDataDokter [name=preview_img_foto_add]').attr('src', '../../img/spinner.gif');
    $('#addDataDokter [name=preview_img_tdt_add]').attr('src', '../../img/spinner.gif');
    $('#addDataDokter [name=preview_img_stamp_add]').attr('src', '../../img/spinner.gif');

    $.get(url)
        .done((response) => {
            idDokter = response.id;
            $('#addDataDokter [name=nik]').val(response.nik);
            $('#addDataDokter [name=id_satu_sehat]').val(response.id_satu_sehat);
            $('#addDataDokter [name=nama]').val(response.nama);
            $('#addDataDokter [name=alamat]').val(response.alamat);
            $('#addDataDokter [name=kota]').val(response.kota);
            $('#addDataDokter [name=telepon]').val(response.telepon);
            $('#addDataDokter [name=no_str]').val(response.no_str);
            $('#addDataDokter [name=username]').val(response.username);
            $('#addDataDokter [name=email]').val(response.email);
            $('#addDataDokter [name=id_spesialis]').val(response.id_spesialis).trigger('change');
            var formattedDate = moment(response.tgl_masuk).format('DD MMMM YYYY');
            var btnDelFoto = document.getElementById('btn_del_foto');
            var btnDelTdt = document.getElementById('btn_del_tdt');
            var btnDelStamp = document.getElementById('btn_del_stamp');
            $('#addDataDokter [name=tgl_masuk]').val(formattedDate);
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
                $('#addDataDokter [name=preview_img_foto_add]').attr('src', '../../img/' + response.path_foto);
            } else {
                btnDelFoto.style.display = 'inline';
                $('#addDataDokter [name=preview_img_foto_add]').attr('src', '../../img/user/dokter/foto/' + response.path_foto);
            }
            if(response.path_tdt=='no-photo.png'){
                btnDelTdt.style.display = 'none';
                $('#addDataDokter [name=preview_img_tdt_add]').attr('src', '../../img/' + response.path_tdt);
            } else {
                btnDelTdt.style.display = 'inline';
                $('#addDataDokter [name=preview_img_tdt_add]').attr('src', '../../img/user/dokter/tdt/' + response.path_tdt);
            }
            if(response.path_stamp=='no-photo.png'){
                btnDelStamp.style.display = 'none';
                $('#addDataDokter [name=preview_img_stamp_add]').attr('src', '../../img/' + response.path_stamp);
            } else {
                btnDelStamp.style.display = 'inline';
                $('#addDataDokter [name=preview_img_stamp_add]').attr('src', '../../img/user/dokter/stamp/' + response.path_stamp);
            }
        })
        .fail((errors) => {
            toastr["error"]("Tidak dapat menampilkan data", "Terjadi Kesalahan")
            return;
        });
}

function deleteDataDokter(url) {
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
                tableDokter.ajax.reload();
                tableDokter.columns.adjust().draw();
            })
            .fail((errors) => {
                Swal.fire('Error', 'Tidak dapat menghapus data', 'error');
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