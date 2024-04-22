@extends('adminlte::page')

@section('title', 'Data Pabrik')
@section('plugins.Datatables', true)
{{-- @section('plugins.TempusDominus', true)
@section('plugins.Select2', true) --}}
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('content_header')
    <div class="row mb-0">
        <div class="col-sm-6">
            <h4 class="text-bold text-black">Data Pabrik</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right text-xs">
                <li class="breadcrumb-item"><a href="../../dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="../../dashboard">Master</a></li>
                <li class="breadcrumb-item active">Data Pabrik</li>
            </ol>
        </div>
    </div>
@stop
@section('content')
    <div class="card card-danger card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="tabDataPabrik" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-pabrik" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true"><h6 class="text-bold m-0">Data Pabrik</h6></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="tabDataPabrikContent">
                <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="tab-pabrik">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header p-1">
                                    <div class="row">
                                        <div class="col-md-12 input-group input-group-md">
                                            <input type="text" id="searchbox_pabrik" name="searchbox_pabrik" class="form-control form-control-md float-right" placeholder="Search Data Pabrik">
                                            <div class="input-group-append mr-1">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>

                                            <button type="button" class="btn btn-default btn-md text-bold float-right mr-1" id="refreshPabrikBtn"><i class="fas fa-sync-alt text-primary mr-2"></i>Refresh</button>
                                            <button onClick="copyPabrikConfirm('{{ route('pabrik.copypreset') }}')" type="button" class="btn btn-default btn-md text-bold float-right mr-1" id="copyPabrikBtn"><i class="fas fa-copy text-danger mr-2"></i>Copy Preset</button>
                                            <button onclick="addFormPabrik('{{ route('pabrik.store') }}')" type="button" class="btn btn-default btn-md text-bold float-right" id="addPabBtn"><i class="fas fa-plus text-success mr-2"></i>Tambah</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-1 mb-0">
                                    <table id="table-pabrik" class="table table-bordered table-xs table-hover text-sm" style="width:100%">
                                        <thead>
                                            <tr class="text-center bg-gradient-info">
                                                <th width="2%">No</th>
                                                <th width="8%">Action</th>
                                                <th width="6%">Kode</th>
                                                <th width="23%">Nama</th>
                                                <th width="6%">Status</th>
                                                <th width="16%">Telepon</th>
                                                <th width="29%">Alamat</th>
                                                <th width="10%">Kota</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-table-pabrik">
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
@includeIf('master.pabrik.form')

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
var idPabrik = "";
var tablePabrik = null;
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
                document.getElementById('addPabBtn').click();
                document.getElementById('nama').focus();
                return false;
            }
        }
    });
});

$('#searchbox_pabrik').keyup(function() {
    tablePabrik.search($(this).val()).draw();
    tablePabrik.columns.adjust().draw();
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

    tablePabrik = $('#table-pabrik').DataTable({
        processing: true,
        serverSide: false,
        dom: 'rt<"row text-xs p-1"<"float-right"p>><"clear">',
        autowidth: false,
        columnDefs: [
            { width: '2%', targets: 0 },
            { width: '8%', targets: 1 },
            { width: '6%', targets: 2 },
            { width: '23%', targets: 3 },
            { width: '6%', targets: 4 },
            { width: '16%', targets: 5 },
            { width: '29%', targets: 6 },
            { width: '10%', targets: 7 },
        ],
        ajax: {
            url: "{{ route('pabrik.data') }}",
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
                name: 'pabrik.kode',
                class: 'pl-2 pr-2',
            },
            {
                data: 'nama',
                name: 'pabrik.nama',
                class: 'pl-2 pr-2',
            },
            {
                data: 'status_aktif',
                name: 'pabrik.status_aktif',
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
            //     name: 'pabrik.telepon',
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
                name: 'pabrik.alamat',
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
                name: 'pabrik.kota',
                class: 'pl-2 pr-2',
            },
        ]
    });

    tablePabrik.columns.adjust().draw();

    $('#addDataPabrik').validator().on('submit', function(e) {
        e.preventDefault();
        $('#savePabrik').prop('disabled', true).html('<span class="spinner-grow spinner-grow-sm mr-3" role="status" aria-hidden="true"></span>Sending...');
        $('#resetPabrik').prop('disabled', true);
        var formData = new FormData($('#addDataPabrik form')[0]);

        $.ajax({
            url: $('#addDataPabrik form').attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#savePabrik').prop('disabled', false).html('<i class="fas fa-save text-success mr-2"></i>Simpan Data');
                $('#resetPabrik').prop('disabled', false);
                toastr["success"](response.success, "Data Tersimpan");
                $('#addDataPabrik').modal('hide');
                tablePabrik.ajax.reload();
                tablePabrik.columns.adjust().draw();
            },
            error: function(error) {
                $('#savePabrik').prop('disabled', false).html('<i class="fas fa-save text-success mr-2"></i>Simpan Data');
                $('#resetPabrik').prop('disabled', false);
                var errorMessage = error.responseJSON ? error.responseJSON.error : 'Terjadi kesalahan saat menyimpan data';
                toastr["error"](errorMessage, "Data Gagal Disimpan");
                $('#addDataPabrik').addClass('shake'); 
                    setTimeout(function() {
                        $('#addDataPabrik').removeClass('shake'); 
                    }, 500);
            }
        });
    });

});

// FORM MODAL TIPE LOKASI POLI

function addFormPabrik(url) {
    $("#addDataPabrik").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataPabrik .modal-title').text('Tambah Pabrik');
    $('#addDataPabrik form')[0].reset();
    $('#addDataPabrik form').attr('action', url);
    $('#addDataPabrik [name=_method]').val('post');
    $('#addDataPabrik [name=_enctype]').val('multipart/form-data');
    $('#addDataPabrik [name=id_spesialis]').val('').trigger('change');
    cb_status.checked = true;
    status_aktif.value = 1;
    statusLabel.textContent = 'AKTIF';
    strProses = 'add';
    console.log(strProses);
}

function editFormPabrik(url) {
    $("#addDataPabrik").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataPabrik .modal-title').text('Edit Pabrik');
    $('#addDataPabrik form')[0].reset();
    $('#addDataPabrik form').attr('action', url);
    $('#addDataPabrik [name=_method]').val('put');
    $('#addDataPabrik [name=_enctype]').val('multipart/form-data');
    strProses = 'edit';
    console.log(strProses);

    $.get(url)
        .done((response) => {
            idPabrik = response.id;
            $('#addDataPabrik [name=kode]').val(response.kode);
            $('#addDataPabrik [name=nama]').val(response.nama);
            $('#addDataPabrik [name=alamat]').val(response.alamat);
            $('#addDataPabrik [name=email]').val(response.email);
            $('#addDataPabrik [name=telepon]').val(response.telepon);
            $('#addDataPabrik [name=no_hp]').val(response.no_hp);
            $('#addDataPabrik [name=rekening]').val(response.rekening);
            $('#addDataPabrik [name=npwp]').val(response.npwp);
            $('#addDataPabrik [name=kota]').val(response.kota);
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

function deleteDataPabrik(url) {
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
                tablePabrik.ajax.reload();
                tablePabrik.columns.adjust().draw();
            })
            .fail((errors) => {
                Swal.fire('Error', 'Tidak dapat menghapus data', 'error');
            });
        }
    });
}

function copyPabrikConfirm(url) {
    Swal.fire({
        title: 'Konfirmasi Copy Data Preset',
        text: 'Apakah Anda yakin untuk menambahkan data Pabrik dari data Preset?',
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
                Swal.fire('Berhasil', 'Data Preset berhasil dicopy ke dalam data Pabrik', 'success');
                tablePabrik.ajax.reload();
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