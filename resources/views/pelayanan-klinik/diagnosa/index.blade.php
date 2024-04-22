@extends('adminlte::page')

@section('title', 'Data Diagnosa')
@section('plugins.Datatables', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('content_header')
    <div class="row mb-0">
        <div class="col-sm-6">
            <h4 class="text-bold text-black">Data Diagnosa</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right text-xs">
                <li class="breadcrumb-item"><a href="../../dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="../../dashboard">Master</a></li>
                <li class="breadcrumb-item active">Data Diagnosa</li>
            </ol>
        </div>
    </div>
@stop
@section('content')
    <div class="card card-danger card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="tabDataDiagnosa" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-diagnosa" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true"><h6 class="text-bold m-0">Data Diagnosa</h6></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="tabDataDiagnosaContent">
                <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="tab-diagnosa">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header p-1">
                                    <div class="row">
                                        <div class="col-md-12 input-group input-group-md">
                                            <input type="text" id="searchbox_diagnosa" name="searchbox_diagnosa" class="form-control form-control-md float-right" placeholder="Search Data Diagnosa">
                                            <div class="input-group-append mr-1">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>

                                            <button type="button" class="btn btn-default btn-md text-bold float-right mr-1" id="refreshDiagnosaBtn"><i class="fas fa-sync-alt text-primary mr-2"></i>Refresh</button>
                                            <button onClick="copyDiagnosaConfirm('{{ route('diagnosa.copypreset') }}')" type="button" class="btn btn-default btn-md text-bold float-right mr-1" id="copyDiagnosaBtn"><i class="fas fa-copy text-danger mr-2"></i>Copy Preset</button>
                                            <button onclick="addFormDiagnosa('{{ route('diagnosa.store') }}')" type="button" class="btn btn-default btn-md text-bold float-right" id="addDiagnosaBtn"><i class="fas fa-plus text-success mr-2"></i>Tambah</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-1 mb-0">
                                    <table id="table-diagnosa" class="table table-bordered table-xs table-hover text-sm" style="width:100%">
                                        <thead>
                                            <tr class="text-center bg-gradient-info">
                                                <th width="2%">No</th>
                                                <th width="8%">Action</th>
                                                <th width="6%">Kode</th>
                                                <th width="39%">Nama Diagnosa (EN)</th>
                                                <th width="39%">Nama Diagnosa (ID)</th>
                                                <th width="6%">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-table-diagnosa">
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
@includeIf('pelayanan-klinik.diagnosa.form')

<div class="modal fade" id="modal-generate">
    <div class="modal-dialog modal-sm">
         <div class="modal-content">
              <div class="modal-body">
                   <div class="text-center">
                        <br>
                        <div class="spinner-border text-primary" role="status">
                             <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-secondary" role="status">
                             <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-success" role="status">
                             <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-danger" role="status">
                             <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-warning" role="status">
                             <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-info" role="status">
                             <span class="sr-only">Loading...</span>
                        </div>
                        <br>
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
    <link href="{{ asset('css/admin_custom.css') }}" rel="stylesheet">
@stop
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js" integrity="sha512-dTu0vJs5ndrd3kPwnYixvOCsvef5SGYW/zSSK4bcjRBcZHzqThq7pt7PmCv55yb8iBvni0TSeIDV8RYKjZL36A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
var idDiagnosa = "";
var tableDiagnosa = null;
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
                document.getElementById('addDiagnosaBtn').click();
                document.getElementById('nama_en').focus();
                return false;
            }
        }
    });
});

$('#searchbox_diagnosa').keyup(function() {
    tableDiagnosa.search($(this).val()).draw();
    tableDiagnosa.columns.adjust().draw();
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

    tableDiagnosa = $('#table-diagnosa').DataTable({
        processing: true,
        serverSide: false,
        dom: 'rt<"row text-xs p-1"<"float-right"p>><"clear">',
        autowidth: false,
        columnDefs: [
            { width: '2%', targets: 0 },
            { width: '8%', targets: 1 },
            { width: '6%', targets: 2 },
            { width: '39%', targets: 3 },
            { width: '39%', targets: 4 },
            { width: '6%', targets: 5 },
        ],
        ajax: {
            url: "{{ route('diagnosa.data') }}",
            dataSrc: "data",
        },
        rowCallback: function(row, data) {
            $(row).attr('data-id', data.id);
        },
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                className: 'text-center details-control',
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
                name: 'diagnosa.kode',
                class: 'pl-2 pr-2 details-control kode',
            },
            {
                data: 'nama_en',
                name: 'diagnosa.nama_en',
                class: 'pl-2 pr-2 details-control nama_en',
            },
            {
                data: 'nama_id',
                name: 'diagnosa.nama_id',
                class: 'pl-2 pr-2 details-control nama_id',
            },
            {
                data: 'status_aktif',
                name: 'diagnosa.status_aktif',
                className: 'text-center details-control status_aktif',
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

    tableDiagnosa.columns.adjust().draw();

    $('#addDataDiagnosa').validator().on('submit', function(e) {
        e.preventDefault();
        $('#saveDiagnosa').prop('disabled', true).html('<span class="spinner-grow spinner-grow-sm mr-3" role="status" aria-hidden="true"></span>Sending...');
        $('#resetDiagnosa').prop('disabled', true);
        var formData = new FormData($('#addDataDiagnosa form')[0]);
        var kode = $('#kode').val();
        var nama_en = $('#nama_en').val();
        var nama_id = $('#nama_id').val();
        var status_aktif = $('#status_aktif').val();
        var statusAktifRendered = '';
        if (status_aktif == 1){
            statusAktifRendered = '<span class="badge bg-success pt-1 pb-1 pl-2 pr-2">AKTIF</span>';
        } else {
            statusAktifRendered = '<span class="badge bg-danger pt-1 pb-1 pl-2 pr-2">NON AKTIF</span>';
        }

        $.ajax({
            url: $('#addDataDiagnosa form').attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#saveDiagnosa').prop('disabled', false).html('<i class="fas fa-save text-success mr-2"></i>Simpan Data');
                $('#resetDiagnosa').prop('disabled', false);
                toastr["success"](response.success, "Data Tersimpan");

                if(strProses=='edit'){
                    var $row = $('#table-diagnosa').find('[data-id="' + idDiagnosa + '"]').closest('tr');
                    var $rowDetail = $('#tableprogress').find('[data-id="' + idDiagnosa + '"]').closest('tr');
                    $row.find('.kode').text(kode);
                    $rowDetail.find('.kode').text(kode);
                    $row.find('.nama_en').text(nama_en);
                    $rowDetail.find('.nama_en').text(nama_en);
                    $row.find('.nama_id').text(nama_id);
                    $rowDetail.find('.nama_id').text(nama_id);
                    $row.find('.status_aktif').html(statusAktifRendered);
                    $rowDetail.find('.status_aktif').html(statusAktifRendered);
                    $('#addDataDiagnosa').modal('hide');
                }

                if(strProses=='add'){
                    $('#addDataDiagnosa').modal('hide');
                    tableDiagnosa.ajax.reload();
                    tableDiagnosa.columns.adjust().draw();
                }
            },
            error: function(error) {
                $('#saveDiagnosa').prop('disabled', false).html('<i class="fas fa-save text-success mr-2"></i>Simpan Data');
                $('#resetDiagnosa').prop('disabled', false);
                var errorMessage = error.responseJSON ? error.responseJSON.error : 'Terjadi kesalahan saat menyimpan data';
                toastr["error"](errorMessage, "Data Gagal Disimpan");
                $('#addDataDiagnosa').addClass('shake'); 
                    setTimeout(function() {
                        $('#addDataDiagnosa').removeClass('shake'); 
                    }, 500);
            }
        });
    });

});

// FORM MODAL TIPE LOKASI POLI
function addFormDiagnosa(url) {
    $("#addDataDiagnosa").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataDiagnosa .modal-title').text('Tambah Diagnosa');
    $('#addDataDiagnosa form')[0].reset();
    $('#addDataDiagnosa form').attr('action', url);
    $('#addDataDiagnosa [name=_method]').val('post');
    $('#addDataDiagnosa [name=_enctype]').val('multipart/form-data');
    $('#addDataDiagnosa [name=id_spesialis]').val('').trigger('change');
    cb_status.checked = true;
    status_aktif.value = 1;
    statusLabel.textContent = 'AKTIF';
    strProses = 'add';
    console.log(strProses);
}

function editFormDiagnosa(url) {
    $("#addDataDiagnosa").modal({ 
        backdrop: "static", 
        keyboard: false, 
    }); 
    $('#addDataDiagnosa .modal-title').text('Edit Diagnosa');
    $('#addDataDiagnosa form')[0].reset();
    $('#addDataDiagnosa form').attr('action', url);
    $('#addDataDiagnosa [name=_method]').val('put');
    $('#addDataDiagnosa [name=_enctype]').val('multipart/form-data');
    strProses = 'edit';
    console.log(strProses);

    $.get(url)
        .done((response) => {
            idDiagnosa = response.id;
            console.log(idDiagnosa);
            $('#addDataDiagnosa [name=kode]').val(response.kode);
            $('#addDataDiagnosa [name=nama_en]').val(response.nama_en);
            $('#addDataDiagnosa [name=nama_id]').val(response.nama_id);
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

function deleteDataDiagnosa(url) {
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
                tableDiagnosa.ajax.reload();
                tableDiagnosa.columns.adjust().draw();
            })
            .fail((errors) => {
                Swal.fire('Error', 'Tidak dapat menghapus data', 'error');
            });
        }
    });
}

function copyDiagnosaConfirm(url) {
    Swal.fire({
        title: 'Konfirmasi Copy Data Preset',
        text: 'Apakah Anda yakin untuk menambahkan data Diagnosa dari data Preset?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Tambahkan',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#modal-generate').modal({backdrop: 'static', keyboard: false});
            $.post(url, {
                '_token': $('[name=csrf-token]').attr('content'),
                '_method': 'post'
            })
            .done((response) => {
                $("#modal-generate").modal('toggle');
                Swal.fire('Berhasil', 'Data Preset berhasil dicopy ke dalam data Diagnosa', 'success');
                tableDiagnosa.ajax.reload();
            })
            .fail((errors) => {
                $("#modal-generate").modal('toggle');
                Swal.fire('Error', 'Tidak dapat menambahkan data dari Preset', 'error');
            });
        }
    });
}

var openedChildRow = null;

$('#table-diagnosa tbody').on('click', 'td.details-control', function () {
    $('#table-diagnosa tr').removeClass("table-primary");
    var tr = $(this).closest('tr');
    var row = tableDiagnosa.row( tr );
    
    if (openedChildRow !== null && openedChildRow[0] !== tr[0]) {
        var openedRow = tableDiagnosa.row(openedChildRow);
        destroyChild(openedRow);
        openedChildRow.removeClass('shown');
        console.log('Closed previously opened child row');
    }
 
    if (row.child.isShown()) {
        tr.removeClass("table-primary");
        destroyChild(row);
        tr.removeClass('shown');
        openedChildRow = null; 
        console.log('Click on table opened tr');
    } else {
        tr.toggleClass("table-primary");
        createChild(row);
        tr.addClass('shown');
        openedChildRow = tr; 
        console.log('Click on table closed tr');
    }
});

var kodeAktif = '';
var idAktif = 0;
function createChild ( row ) {
    var rowData = row.data();
    idAktif = rowData.id;
    kodeAktif = rowData.kode;
    console.log('Kode Diagnosa : ' + kodeAktif);
    console.log('ID Diagnosa : ' + idAktif);
    var detailTable = $('<table id="tblprogress" class="table table-bordered table-info table-hover table-sm text-sm data-table display" width="100%"/>');
    var headerStructure = '<thead>' +
        '<tr class="text-center bg-gradient-secondary">' +
        '<th width="11%">Action</th>' +
        '<th width="6%">Kode</th>' +
        '<th width="38%">Nama Diagnosa (EN)</th>' +
        '<th width="38%">Nama Diagnosa (ID)</th>' +
        '<th width="7%">Status</th>' +
        '</tr>' +
        '</thead><tbody id="tblprogressbody"></tbody>';

    detailTable.append(headerStructure);
    // tabContentTabel.append(detailTable);
    row.child( detailTable ).show();

    row.child().addClass('child-row');

    var usersTable = detailTable.DataTable({
        processing: true,
        serverSide: false,
        pageLength: 100,
        bLengthChange: false,
        bPaginate: false,
        bFilter: false,
        paging: false,
        info: false,
        autoWidth: false,
        columnDefs: [
            { width: '11%', targets: 0 },
            { width: '6%', targets: 1 },
            { width: '38%', targets: 2 },
            { width: '38%', targets: 3 },
            { width: '7%', targets: 4 },
        ],
        ajax: {
            url: "{{ route('diagnosa.detail') }}",
            // dataSrc: "data",
            data: {
                kode_aktif:rowData.kode,
            },
        },
        rowCallback: function(row, data) {
            $(row).attr('data-id', data.id);
        },
        columns: [
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                className: 'text-center',
            }, 
            {
                data: 'kode',
                name: 'diagnosa.kode',
                class: 'pl-2 pr-2 kode',
            },
            {
                data: 'nama_en',
                name: 'diagnosa.nama_en',
                class: 'pl-2 pr-2 nama_en',
            },
            {
                data: 'nama_id',
                name: 'diagnosa.nama_id',
                class: 'pl-2 pr-2 nama_id',
            },
            {
                data: 'status_aktif',
                name: 'diagnosa.status_aktif',
                className: 'text-center status_aktif',
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
}

function destroyChild(row) {
    var tableDetail = $("detailTable", row.child());
    tableDetail.detach();
    tableDetail.DataTable().destroy();
    row.child.hide();
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