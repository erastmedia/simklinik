@extends('adminlte::page')
 
@section('content_top_nav_right')
    <li class="nav-item dropdown">
        <div id="inbox-notif-container">
                
        </div>
    </li>
@endsection

@section('title', 'Dashboard')
 
@section('content_header')
    <h1>Dashboard</h1>
@stop
 
@section('plugins.DateRangePicker', true)
@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('plugins.Toastr', true)

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title text-bold">Track Your Order</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @if (Auth::user()->kodebuyer == 'adm')
                    <input type="hidden" id="kodebuyer_user" name="kodebuyer_user" value="adm">
                    <div class="col-md-5">
                        <p class="text-bold">Buyer</p>
                        <div class="form-group">
                            <select class="form-control select2 select2-hidden-accessible text-md" style="width: 100%;" tabindex="1" aria-hidden="true" id="buyer_ID" name="buyer_ID">
                                @foreach ($buyer as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @else
                           
                            <input type="hidden" id="kodebuyer_user" name="kodebuyer_user" value="{{ Auth::user()->kodebuyer }}">
                        @endif      
                        <div class="col-md-7">
                            <p><b>Custom Number</b></p>
                            <div class="input-group form-group">
                                <input id="searchByName" type="text" class="form-control" placeholder="Insert your Custom Number ...">
                                <span class="input-group-append">
                                    <button id="btnSearch" type="button" class="btn bg-gradient-primary"><b>Track this Order!</b></button>
                                    <button id="btnShowAll" type="button" class="btn bg-gradient-pink"><b>Show All Data</b></button>
                                    <button id="btnFilter" type="button" class="btn bg-gradient-secondary"><b>Advanced Filter</b></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="divorderlist" class="card card-danger" id="divorderlist">
               <div class="card-header m-0">
                    <h3 class="card-title text-bold">Your Order List</h3>
                    <div class="card-tools">
                         <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
               </div>
               
               <div class="card-body pt-0 pr-2 pl-2 pb-2">
                    <table id="example" class="table table-bordered table-hover table-stripped table-sm text-sm data-table display" style="width:100%">
                      <thead>
                        <tr class="text-center bg-gradient-info">
                          <th style="width: 12%;">CUSTOM NUMBER</th>
                          <th style="width: 13%;">CUSTOMER NAME</th>
                          <th style="width: 5%;">QTY</th>
                          <th style="width: 10%;">TYPE</th>
                          <th style="width: 10%;">ORDER DATE<br>(mm/dd/yy)</th>
                          <th style="width: 10%;">RECEIVE DATE<br>(mm/dd/yy)</th>
                          <th style="width: 10%;">STATUS</th>
                          <th style="width: 30%;">NOTES</th>
                        </tr>
                      </thead>
                      <tbody id="examplebody">
                      </tbody>
                    </table>
               </div>
            </div>
    </div>
</div>

<div class="modal fade" id="modal-cost">
     <div class="modal-dialog modal-md">
          <div class="modal-content">
               <div class="modal-header pt-1 pb-1 item-center bg-gradient-info">
                    <h5 class="modal-title text-bold">Invoice Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="false">&times;</span>
                    </button>
               </div>
               <div class="modal-body">
                    <table id="invoice" class="table table-bordered table-hover text-xs table-sm table-stripped data-table display" style="width: 100%;">
                         <thead>
                              <tr class="text-center bg-gradient-secondary">
                                   <th style="width: 4%;">No.</th>
                                   <th style="width: 76%;">Notes</th>
                                   <th style="width: 20%;">Charge ($)</th>
                              </tr>
                         </thead>
                         <tbody id="invoicebody">
                         </tbody>
                         <tfoot>
                              <tr>
                                   <th colspan="2" class="text-right"><b></b>TOTAL</b></th>
                                   <th></th>
                              </tr>
                         </tfoot>
                    </table>
               </div>
          </div>
     </div>
</div>

<div class="modal fade" id="modal-filter">
     <div class="modal-dialog modal-md">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title">Advanced Data Filter</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-body">
                    <div class="row">
                         <div class="col-sm-12">
                              <div class="card card-danger collapsed-card">
                                   <div class="card-header">
                                        <h3 class="card-title">Order Date Range</h3>
                                        <div class="card-tools">
                                             <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                        </div>
                                   </div>
                                   <div class="card-body" style="display: none;">
                                        <div class="row">
                                             <div class="col-sm-6">
                                                  <div class="form-group">
                                                       <label>From : </label>
                                                       <input type="date" class="form-control" data-date-format="Y-m-d" name="tglawalform" id="tglawalform">
                                                  </div>
                                             </div>
                                             <div class="col-sm-6">
                                                  <div class="form-group">
                                                       <label>To : </label>
                                                       <input type="date" class="form-control" data-date-format="Y-m-d" name="tglakhirform" id="tglakhirform">
                                                  </div>
                                             </div>
                                             <div class="col-sm-12">
                                                  <button id="btnFilterDate" type="button" class="btn btn-block bg-gradient-primary btn-lg">Show By Order Date Range</button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="card card-danger">
                                   <div class="card-header">
                                        <h3 class="card-title">All Order</h3>
                                        <div class="card-tools">
                                             <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>
                                   </div>
                                   <div class="card-body" style="display: block;">
                                        <div class="row">
                                             <div class="col-sm-12">
                                                  <label>Status : </label>
                                             </div>
                                             <div class="col-sm-3">
                                                  <div class="custom-control custom-radio">
                                                       <input class="custom-control-input" type="radio" id="customRadio1" value="1" name="statusprod" checked>
                                                       <label for="customRadio1" class="custom-control-label">On Process</label>
                                                  </div>
                                             </div>
                                             <div class="col-sm-3">
                                                  <div class="custom-control custom-radio">
                                                       <input class="custom-control-input" type="radio" id="customRadio2" value="2" name="statusprod">
                                                       <label for="customRadio2" class="custom-control-label">Pending</label>
                                                  </div>
                                             </div>
                                             <div class="col-sm-3">
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="customRadio3" value="4" name="statusprod">
                                                    <label for="customRadio3" class="custom-control-label">Shipped</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="customRadio4" value="3" name="statusprod">
                                                    <label for="customRadio4" class="custom-control-label">Cancel</label>
                                                </div>
                                            </div>
                                            </div>
                                        <div class="row">&nbsp;<br /></div>
                                        <div class="row">
                                             <div class="col-sm-12">
                                                  <button id="btnFilterAll" type="button" class="btn btn-block bg-gradient-primary btn-lg">Show All Order Data</button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

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

<div class="modal fade" id="previewImage">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <img id="modalImage" src="" alt="Preview Image">
                </div>
            </div>
        </div>
    </div>
</div>

@php
    $currentUser = json_encode(['kodebuyer' => auth()->user()->kodebuyer]);
@endphp

@stop

@section('footer')
    <!-- Main Footer -->
    <footer class="main-footer text-xs">
        <div class="float-right d-none d-xs-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2022 <a href="https://indokores.com">PT INDOKORES SAHABAT</a>.</strong> All rights
        reserved.
    </footer>
@stop
 
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css" />
<link rel="stylesheet" href="vendor/lightbox/css/lightbox.min.css" />
  <style>
  
    .table > tbody > tr > td {
        vertical-align: middle;
    }
    .table > thead > tr > th {
        vertical-align: middle;
    }
    .text-xs {
        font-weight: 600;
    }
    .nav-tabs {
        border-bottom: none;
    }

    .select2-container--bootstrap4 .select2-selection--single {
        font-size: 1rem !important;
        height: calc(1.5em + 0.75rem + 2px) !important;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .nav-tabs {
        flex-grow: 1;
    }

    .card-tools {
        margin-left: auto;
    }
    
    /*.modal-dialog {*/
    /*  position: absolute;*/
    /*  top: 100px;*/
    /*  right: 100px;*/
    /*  bottom: 0;*/
    /*  left: 0;*/
    /*  z-index: 10040;*/
    /*  overflow: auto;*/
    /*  overflow-y: auto;*/
    /*}*/
    /*.card-header {*/
    /*  height: 35px;*/
    /*}*/
    .scrollable-tab {
        overflow-x: auto;
        max-width: 100%;
    }
    
    .drop-zone {
    border: 2px dashed #ccc;
    border-radius: 4px;
    padding: 20px;
    text-align: center;
}

.drop-zone__input {
    display: none;
}

.drop-zone__prompt {
    font-size: 16px;
}

.file-preview {
    margin: 10px 0;
}

/*#myModal {*/
/*        margin-top: -50px; */
/*    }*/
    

.colored-toast.swal2-icon-success {
  background-color: #a5dc86 !important;
}

.colored-toast.swal2-icon-error {
  background-color: #f27474 !important;
}

.colored-toast.swal2-icon-warning {
  background-color: #f8bb86 !important;
}

.colored-toast.swal2-icon-info {
  background-color: #1975f7 !important;
}

.colored-toast.swal2-icon-question {
  background-color: #87adbd !important;
}

.colored-toast .swal2-title {
  color: white;
}

.colored-toast .swal2-close {
  color: white;
}

.colored-toast .swal2-html-container {
  color: white;
}

.bg-notif-msg {
    background-color: #17a2b8!important;
}

.toast.bg-notif-msg {
    background-color: rgb(230 255 208 / 90%)!important;
}

.bg-notif-msg, .bg-notif-msg>a {
    color: #343a40!important;
}

.toast-header {
    color: #ffffff;
    background-color: rgb(141 138 106);
}

.toast-body {
    font-size: .775rem!important;
}

.loader {
  width: 50px;
  aspect-ratio: 1;
  display: grid;
  border: 4px solid #0000;
  border-radius: 50%;
  border-color: #ccc #0000;
  animation: l16 1s infinite linear;
}
.loader::before,
.loader::after {    
  content: "";
  grid-area: 1/1;
  margin: 2px;
  border: inherit;
  border-radius: 50%;
}
.loader::before {
  border-color: #f03355 #0000;
  animation: inherit; 
  animation-duration: .5s;
  animation-direction: reverse;
}
.loader::after {
  margin: 8px;
}
@keyframes l16 { 
  100%{transform: rotate(1turn)}
}

#detail-table-container {
    margin-top: 5px;
    margin-bottom: 5px;
    margin-left: 5px;
    margin-right: 5px;
}

#detail-table {
    width: 100%; 
}

.child-row {
    background-color: #ffeeba; 
}

#comments-container {
    max-height: 50vh;
    overflow-y: auto;
    position: relative;
}

#comments-container::-webkit-scrollbar {
    display: none;
}

.callout a {
    color: #495057;
    text-decoration: none;
}
</style>
@stop
 
@section('js')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.24/dataRender/datetime.js"></script>
<script src="vendor/lightbox/js/lightbox.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


<script type="text/javascript">

lightbox.option({
  'resizeDuration': 200,
  'wrapAround': true,
})
    
var idmfReceiveActive = 0;
var currentUser = {!! $currentUser !!};
var table = null;
var tableprogress = null;
var tableinvoice = null;
var kodebuyer = '';
var nomororder = $('#searchByName').text();
var nomororderdetail = '';
var kodeitem = '';
var kodebuyerdetail = '';
var tglawalform = $("#tglawalform").val();
var tglakhirform = $("#tglakhirform").val();
var stat_prod = '';
var field_id = $("#idmfreceive");
var nilai_field_id = '';

const Toast = Swal.mixin({
  toast: true,
  position: 'bottom-right',
  iconColor: 'white',
  customClass: {
    popup: 'colored-toast',
  },
  showConfirmButton: false,
  timer: 15000,
  timerProgressBar: true,
});

var kodeBuyerCom = $('#kodebuyer_com');
var kodeBuyerValue = $('#kodebuyer_user').val();
var pusher = new Pusher('cb70f39dab3818157a14', { cluster: 'ap1' });
    
var channel = pusher.subscribe('my-channel');
var channel_delete = pusher.subscribe('channel-delete');
var channel_unread = pusher.subscribe('channel-unread');

$(document).ready(function () {
    kodeBuyerValue = $('#kodebuyer_user').val();
    $("#buyer_ID").select2({
        theme: 'bootstrap4',
        placeholder: "Choose Buyer",
        allowClear: true
    })

    $("#buyer_ID").val('').trigger('change');
    kodeBuyerCom.val(currentUser.kodebuyer);
    stat_prod = $("input[name='statusprod']:checked").val();
    console.log(currentUser.kodebuyer);

    if (table != null) {
        table.destroy();
    }

    if (tableprogress != null) {
        tableprogress.destroy();
    }

    Promise.all([
        new Promise(initNotif),
        new Promise(showEmptyList),
        new Promise(loadEmptyProduksi)
    ])
    .then(function() {
        console.log("Ketiga fungsi telah selesai dijalankan secara bersamaan.");
        table.columns.adjust().draw();
    })
    .catch(function(error) {
        console.error("Terjadi kesalahan saat menjalankan salah satu dari ketiga fungsi:", error);
    });
});

channel_unread.bind('event-unread', function(data) {
    initNotif();
});

channel.bind(
    'my-event', 
    function(data) {
    var statusValue = data.message.status;
    var nameValue = data.message.name;
    var notifValue = data.message.comment;
    var kdbuyerValue = data.message.kodebuyer;
    
    if (statusValue===0 && kodeBuyerValue!='adm'){
        console.log("kdbuyerValue : " + kdbuyerValue);
        console.log("currentUser.kodebuyer : " + currentUser.kodebuyer);
        // loadComment(idmfreceive);
        loadComment(idmfReceiveActive);
        initNotif();
        if (kdbuyerValue==currentUser.kodebuyer){
            $(document).Toasts('create', {
                class: 'bg-notif-msg m-4',
                delay: 30000,
                autohide: true,
                title: nameValue,
                subtitle: '<i class="fas fa-envelope"></i>',
                position: 'bottomRight',
                body: notifValue
            });
        };
    };
    
    if (statusValue===1 && kodeBuyerValue=='adm'){
        // loadComment(idmfreceive);
        loadComment(idmfReceiveActive);
        initNotif();
        $(document).Toasts('create', {
            class: 'bg-notif-msg m-4',
            delay: 30000,
            autohide: true,
            title: nameValue,
            subtitle: '<i class="fas fa-envelope"></i>',
            position: 'bottomRight',
            body: notifValue
        });
    };
});

channel_delete.bind('event-delete', function(data) {
    // loadComment(idmfreceive);
    loadCommentAfterDelete(idmfReceiveActive);
    initNotif();
});

function formatBytes(bytes) {
    if (bytes === 0) return '0 Bytes';

    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    const i = parseInt(Math.floor(Math.log(bytes) / Math.log(k)));

    return Math.round(bytes / Math.pow(k, i)) + ' ' + sizes[i];
}

function deleteComment(commentId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to recover the deleted comment',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/deletecomment/' + commentId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data.success) {
                        $('#comment-' + commentId).remove();
                        loadCommentAfterDelete(idmfReceiveActive);
                    } else {
                        toastr["error"]("Gagal menghapus komentar.", "Gagal");
                    }
                },
                error: function() {
                    toastr["error"]("Terjadi kesalahan dalam permintaan penghapusan.", "Error");
                }
            });
        }
    });
}

function loadCommentAfterDelete(idmfreceive){
    $.ajax({
            url: '/comment/' + idmfreceive,
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                // toastr["success"]("Komentar telah dihapus.", "Berhasil");
                $('#comments-container').html(response);
                $('#comments-container').animate({ scrollTop: $('#comments-container')[0].scrollHeight }, 1000);
            }
        });
}

function initNotif() {
    return new Promise(function(resolve, reject) {
        $.ajax({
            url: '/get-notif/',
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                $('#inbox-notif-container').html(response);
                resolve(); 
            },
            error: function(xhr, status, error) {
                reject(error); 
            }
        });
    });
}


$(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
});

$('#buyer_ID').change(function () {
    kodebuyer = $(this).val();
    if(!kodebuyer){
        kodebuyer = "";
    }
    console.log(kodebuyer);
});

$("#fileInput").change(function() {
        var fileList = $("#fileInput")[0].files;
        var fileListContainer = $("#fileList");

        fileListContainer.empty();

        for (var i = 0; i < fileList.length; i++) {
            fileListContainer.append("<li>" + fileList[i].name + "</li>");
        }
    });

$("#btnFilterDate").click(function(event){
    event.preventDefault();
    
    tglawalform = $('#tglawalform').val();
    tglakhirform = $('#tglakhirform').val();
    console.log(tglawalform);
    console.log(tglakhirform);
    
    if(!kodebuyer){
        toastr["error"]("You have not specified Buyer data as a filter.", "Invalid Data Filter");
        return false;
    }
    
    if(tglawalform==''){
        toastr["error"]("You have not specified the date range filter correctly.", "Invalid Data Filter");
        return false;
    }
    
    if(tglakhirform==''){
        toastr["error"]("You have not specified the date range filter correctly.", "Invalid Data Filter");
        return false;
    }
    
    $("#modal-filter").modal('toggle');
    $('#modal-generate').modal({backdrop: 'static', keyboard: false})
    if (table != null) {
        table.destroy();
    }
    if (tableprogress != null) {
        tableprogress.destroy();
    }
    loadEmptyProduksi();
    filterByDate(tglawalform, tglakhirform);
});

$("#btnFilterAll").click(function(event){
    event.preventDefault();
    
    if(!kodebuyer){
        toastr["error"]("You have not specified Buyer data as a filter.", "Invalid Data Filter");
        return false;
    }
    
    $("#modal-filter").modal('toggle');
    $('#modal-generate').modal({backdrop: 'static', keyboard: false})
    if (table != null) {
        table.destroy();
    }
    if (tableprogress != null) {
        tableprogress.destroy();
    }
    loadEmptyProduksi();
    filterAll(stat_prod);
});

$("#btnSearch").click(function(event){
    event.preventDefault();
    nomororderdetail = $('#searchByName').val();
    nomororder = $('#searchByName').val();
    kodebuyerdetail = kodebuyer;
    console.log('Nomor Order Detail : ' + nomororderdetail);
    console.log('Nomor Order : ' + nomororder);
    console.log('Kode Buyer Detail : ' + kodebuyerdetail);
    if (currentUser.kodebuyer=='adm'){
        if(kodebuyer==''){
            toastr["error"]("You have not specified Buyer data as a filter.", "Invalid Data Filter");
            return false;
        } else {
            $('#kodebuyer_com').val(kodebuyerdetail);
        }
    } else {
        kodeBuyerCom.val(currentUser.kodebuyer);
    }
    if(nomororder==''){
        toastr["error"]("You have not specified Custom Number as a filter.", "Invalid Data Filter");
        return false;
    }
    if (nomororder != '') {
        $('#modal-generate').modal({backdrop: 'static', keyboard: false})
        if (table != null) {
            table.destroy();
        }
        if (tableprogress != null) {
            tableprogress.destroy();
        }
        searchData(nomororder, kodebuyer);
        // loadProduksi(nomororderdetail, kodebuyerdetail);
    }
});

$("#btnShowAll").click(function(event){
    event.preventDefault();
    if (currentUser.kodebuyer=='adm'){
        if(kodebuyer==''){
            toastr["error"]("You have not specified Buyer data as a filter.", "Invalid Data Filter");
            return false;
        }
    }
    
    kodebuyerdetail = kodebuyer;
    if (currentUser.kodebuyer=='adm'){
        $('#kodebuyer_com').val(kodebuyerdetail);
    } else {
        kodeBuyerCom.val(currentUser.kodebuyer);
    }
    $('#modal-generate').modal({backdrop: 'static', keyboard: false})
    if (table != null) {
        table.destroy();
    }
    if (tableprogress != null) {
        tableprogress.destroy();
    }
    loadEmptyProduksi();
    filterAll(stat_prod);
    table.columns.adjust().draw();
});

$("#btnFilter").click(function(event){
    event.preventDefault();
    $('#modal-filter').modal({backdrop: 'static', keyboard: false})
});

$('input[type=radio][name=statusprod]').change(function() {
    stat_prod = $("input[name='statusprod']:checked").val();
});

function loadComment(idmfreceive){
    $.ajax({
            url: '/comment/' + idmfreceive,
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                $('#comments-container').html(response);
                $('#comments-container').animate({ scrollTop: $('#comments-container')[0].scrollHeight }, 1000);
            }
        });
}

function loadDK(idmfreceive){
    $.ajax({
        url: '/getdk/' + idmfreceive,
        type: 'GET',
        dataType: 'html',
        success: function(response) {
            $('#dk-container').html(response);
        }
    });
}

function showInvoice(kodeitem){
  tableinvoice = $('#invoice').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      paging: false,
      bFilter: false,
      autowidth: false,
      info: false,
      columnDefs: [
        { width: '4%', targets: 0 },
        { width: '76%', targets: 1 },
        { width: '20%', targets: 2 },
      ],
      footerCallback: function (row, data, start, end, display) {
        var api = this.api();
        var intVal = function (i) {
            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
        };
        
        totalHarga = api
        .column(2)
        .data()
        .reduce(function (a, b) {
            return intVal(a) + intVal(b);
        }, 0);
        
        totalHarga = $.fn.dataTable.render.number(',', '.', 2, '').display( totalHarga );
        $(api.column(2).footer()).html(totalHarga);
    },
      lengthMenu: [
        [-1, 15, 20, 25, 50, 100, 200],
          ['All', 15, 20, 25, 50, 100, 200],
      ],
      ajax: {
          url: "{{ route('loadinvoice') }}",
          data: {
            kodeitem:kodeitem
          }
        },
      columns: [
          {data: 'kode', name: 'datawebinvoice.kode', className: "text-center"},
          {data: 'nama', name: 'datawebinvoice.nama', className: "text-left"},
          {data: 'harga', name: 'datawebinvoice.harga', render: $.fn.dataTable.render.number('.', ',', 0, ''), className: "text-right"},
      ]
  });
  tableinvoice.columns.adjust().draw();
}

function loadEmptyProduksi(){
    return new Promise(function(resolve, reject) {
        tableprogress = $('#progress').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autowidth: false,
            scrollX: true,
            bPaginate: false,
            bFilter: false,
            paging: false,
            info: false,
            columnDefs: [
                { width: 120, targets: 0 },
                { width: 150, targets: 1 },
                { width: 80, targets: 2 },
                { width: 80, targets: 3 },
                { width: 120, targets: 4 },
                { width: 120, targets: 5 },
                { width: 120, targets: 6 },
                { width: 120, targets: 7 },
                { width: 70, targets: 8 },
                { width: 70, targets: 9 },
                { width: 70, targets: 10 },
                { width: 70, targets: 11 },
                { width: 80, targets: 12 },
                { width: 60, targets: 13 },
                {
                        targets: 13,
                        data: null,
                        defaultContent: '<button type="button" class="btn btn-block bg-gradient-info btn-xs">Detail</button>',
                },
            ],
            fixedColumns: true,
            bLengthChange: false,
            lengthMenu: [
                [-1, 15, 20, 25, 50, 100, 200],
                ['All', 15, 20, 25, 50, 100, 200],
            ],
            ajax: {
                url: "{{ route('loademptyprogress') }}",
                data: {},
                },
            columns: [
                {data: 'nomororder', name: 'nomororder', className: "text-center"},
                    {data: 'kodeitem', name: 'kodeitem', className: "text-center"},
                    {data: 'jenis', name: 'jenis', className: "text-center"},
                    {data: 'pcs', name: 'pcs', className: "text-center"},
                    {data: 'tglreceive', name: 'tglreceive', className: "text-center"},
                    {data: 'tglkirim', name: 'tglkirim', className: "text-center"},
                    {data: 'tglkirimbed', name: 'tglkirimbed', className: "text-center"},
                    {data: 'tgldelivery', name: 'tgldelivery', className: "text-center"},
                    {data: 'hair', name: 'hair', className: "text-center"},
                    {data: 'base', name: 'base', className: "text-center"},
                    {data: 'venting', name: 'venting', className: "text-center"},
                    {data: 'final', name: 'final', className: "text-center"},
                    {data: 'cost', name: 'cost', className: "text-center"},
            ]
        });
        tableprogress.columns.adjust().draw();
    });
}



var openedChildRow = null;

$('#example tbody').on('click', 'td.details-control', function () {
    $('#example tr').removeClass("table-warning");
    var tr = $(this).closest('tr');
    var row = table.row( tr );
    
    if (openedChildRow !== null && openedChildRow[0] !== tr[0]) {
        var openedRow = table.row(openedChildRow);
        destroyChild(openedRow);
        openedChildRow.removeClass('shown');
        console.log('Closed previously opened child row');
    }
 
    if (row.child.isShown()) {
        tr.removeClass("table-warning");
        destroyChild(row);
        tr.removeClass('shown');
        openedChildRow = null; 
        console.log('Click on table opened tr');
    } else {
        tr.toggleClass("table-warning");
        createChild(row);
        tr.addClass('shown');
        openedChildRow = tr; 
        console.log('Click on table closed tr');
    }
});

function createChild ( row ) {
    var rowData = row.data();
    idmfReceiveActive = rowData.idmfreceive;
    console.log('idmfReceiveActive : ' + idmfReceiveActive);
    var cardTabs = $('<div class="card card-secondary card-tabs mt-1 mb-1 mr-1 ml-1"></div>');
    var cardHeader = $('<div class="card-header p-1 pt-1 m-0"></div>');
    var tabHeaderList = $( 
        '<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">' +
            '<li class="nav-item">' +
                '<a class="nav-link active text-bold" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Detailed Progress</a>' +
            '</li>' +
            '<li class="nav-item">' +
                '<a class="nav-link text-bold" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Comments</a>' +
            '</li>' +
            '<li class="nav-item">' +
                '<a class="nav-link text-bold" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Order Form</a>' +
            '</li>' +
        '</ul>');
    var containerTabContent = $('<div class="tab-content" id="custom-tabs-one-tabContent"></div>');
    var tabContentTabel = $('<div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab"></div>');
    var tabContentComment = $('<div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab"></div>');
    var tabContentDK = $('<div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab"></div>');
    var dkDisplay = $('<div id="dk-container" class="mt-2"></div>');
    var containerCommentSection = $('<div class="row"></div>');
    var commentDisplay = $('<div id="comments-container" class="col-md-6 mt-2"></div>');
    var commentFormSection = $('<div id="kolom_komentar" class="col-md-6"><form id="commentForm" name="commentForm" enctype="multipart/form-data"><input type="hidden" id="idmfreceive" name="idmfreceive"><div class="mt-2"><textarea id="summernote" name="message"></textarea></div>{{ csrf_field() }}<input type="hidden" id="kodebuyer_com" name="kodebuyer_com" value=""><br /><label for="attachments">Attachment (.jpg, .png, .pdf, .xls, .xlsx, .doc, .docx):</label><div id="drop-area" class="drop-zone"><span class="drop-zone__prompt">Drag files here or click to select.</span><input type="file" name="attachments[]" id="attachments" class="drop-zone__input" multiple></div><div id="file-list"></div><br /><button type="button" class="btn bg-gradient-success" id="saveBtn">Submit Comment</button></form></div>');
    var cardBody = $('<div class="card-body pt-0 pr-2 pl-2 pb-2"></div>');
    var detailTable = $('<table id="tblprogress" class="table table-bordered table-hover table-sm text-sm data-table display" width="100%"/>');
    var headerStructure = '<thead>' +
        '<tr class="text-center bg-gradient-secondary">' +
        '<th rowspan="2" style="width: 150px;">ITEM CODE</th>' +
        '<th rowspan="2" style="width: 80px;">TYPE</th>' +
        '<th rowspan="2" style="width: 80px;">PCS</th>' +
        '<th rowspan="2" style="width: 120px;">RECEIVE DATE</th>' +
        '<th rowspan="2" style="width: 120px;">ESTIMATE<br>DELIVERY DATE</th>' +
        '<th rowspan="2" style="width: 120px;">REVISED<br>DELIVERY DATE</th>' +
        '<th rowspan="2" style="width: 120px;">SHIPPED DATE</th>' +
        '<th colspan="4" style="width: 320px;">PRODUCTION PROCESS</th>' +
        '<th rowspan="2" style="width: 80px;">COST ($)</th>' +
        '<th rowspan="2" style="width: 60px;">COST DETAIL</th>' +
        '</tr>' +
        '<tr class="text-center bg-gradient-secondary">' +
        '<th style="width: 70px;">HAIR</th>' +
        '<th style="width: 70px;">BASE</th>' +
        '<th style="width: 70px;">VENTING</th>' +
        '<th style="width: 70px;">FINAL</th>' +
        '</tr>' +
        '</thead><tbody id="tblprogressbody"></tbody>';

    detailTable.append(headerStructure);
    tabContentTabel.append(detailTable);
    tabContentDK.append(dkDisplay);
    containerCommentSection.append(commentDisplay);
    containerCommentSection.append(commentFormSection);
    tabContentComment.append(containerCommentSection);
    containerTabContent.append(tabContentTabel);
    containerTabContent.append(tabContentComment);
    containerTabContent.append(tabContentDK);
    cardBody.append(containerTabContent);
    cardHeader.append(tabHeaderList);
    cardTabs.append(cardHeader);
    cardTabs.append(cardBody);
    
    row.child( cardTabs ).show();
    
    $('#summernote').summernote({
      toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
      ]
    });
    
    $('#summernote').each(function(){
        var summernote = $(this);
        $('form').on('submit',function(){
            if (summernote.summernote('isEmpty')) {
                summernote.val('');
            } else if(summernote.val()=='<p><br></p>'){
               summernote.val('');
            }
        });
    });
        
    
    window.addEventListener('resize', function() {
        var container = document.getElementById('comments-container');
        container.style.maxHeight = '300px';
    });
    
    window.dispatchEvent(new Event('resize'));
    
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('attachments');
    const fileList = document.getElementById('file-list');
    
    dropArea.addEventListener('click', () => {
      fileInput.click();
    });
    
    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.classList.add('drop-zone--over');
    });
    
    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('drop-zone--over');
    });
    
    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        dropArea.classList.remove('drop-zone--over');
        const files = e.dataTransfer.files;
    
        for (const file of files) {
            fileInput.files = files; 
            displayFile(file);
        }
    });
    
    fileInput.addEventListener('change', () => {
        const files = fileInput.files;
        for (const file of files) {
            displayFile(file);
        }
    });
    
    function displayFile(file) {
        const fileItem = document.createElement('div');
        fileItem.classList.add('file-preview');
    
        const deleteButton = document.createElement('button');
        deleteButton.innerText = 'Hapus';
        deleteButton.addEventListener('click', () => {
            removeFile(file, fileItem);
        });
    
        fileItem.innerHTML = `
            <strong>${file.name}</strong> (${formatBytes(file.size)})
        `;
    
        fileItem.appendChild(deleteButton);
        fileList.appendChild(fileItem);
    }
    
    function removeFile(file, fileItem) {
        fileInput.value = ''; 
        fileItem.parentNode.removeChild(fileItem); 
    }
    
    var field_id = $("#idmfreceive");
    field_id.val(idmfReceiveActive);
    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $('#kodebuyer_com').val(kodebuyerdetail);
        $(this).prop('disabled', true).html('<span class="spinner-grow spinner-grow-sm mr-3" role="status" aria-hidden="true"></span>Sending...');
    
        var formData = new FormData($('#commentForm')[0]);
    
        $.ajax({
            data: formData,
            url: "{{ route('comment.store') }}",
            type: "POST",
            processData: false, 
            contentType: false, 
            success: function (data) {
                if($.isEmptyObject(data.error)){
                    loadComment(idmfReceiveActive);
                    $('#summernote').summernote('reset');
                    $("#fileInput").val('');
                    $("#file-list").empty();
                    $(".print-error-msg").css('display','none');
                    $('#saveBtn').prop('disabled', false).html('Submit Comment');
                }else{
                    printErrorMsg(data.error);
                }
            },
            error: function (data) {
                $('#saveBtn').prop('disabled', false).html('Submit Comment');
            }
        });
    });
    
    row.child().addClass('child-row');
    var usersTable = detailTable.DataTable( {
        pageLength: 100,
        bLengthChange: false,
        bPaginate: false,
        bFilter: false,
        paging: false,
        info: false,
        autoWidth: false,
        ajax: {
            url: "{{ route('loadprogress') }}",
            data: {
                nomororderdetail:rowData.nomororder,
                kodebuyerdetail:kodebuyer,
             },
        },
        columnDefs: [
            { width: 150, targets: 0 },
            { width: 80, targets: 1 },
            { width: 80, targets: 2 },
            { width: 120, targets: 3 },
            { width: 120, targets: 4 },
            { width: 120, targets: 5 },
            { width: 120, targets: 6 },
            { width: 70, targets: 7 },
            { width: 70, targets: 8 },
            { width: 70, targets: 9 },
            { width: 70, targets: 10 },
            { width: 80, targets: 11 },
            { width: 60, targets: 12 },
            {
                    targets: 12,
                    data: null,
                    defaultContent: '<button type="button" class="btn btn-block bg-gradient-info btn-xs">Detail</button>',
            },
          ],
          fixedColumns: true,
        columns: [
                { title: 'ITEM CODE', data: 'kodeitem', name: 'datawebproduksi.kodeitem', className: "text-center listprogress"},
                { title: 'TYPE', data: 'jenis', name: 'mfjenisorder.jenis', className: "text-center"},
                { title: 'PCS', data: 'pcs', name: 'datawebproduksi.pcs', className: "text-center"},
                {
                    type: 'RECEIVE DATE',
                    data: 'tglreceive',
                    name: 'datawebproduksi.tglreceive',
                    render: function (data, type, full, meta) {
                        if (data === '1900-01-01') {
                            return '-';
                        }
                        return moment(data).format('MM/DD/YY');
                    },
                    className: "text-center"
                },
                {
                    type: 'ESTIMATE DELIVERY DATE',
                    data: 'tglkirim',
                    name: 'datawebproduksi.tglkirim',
                    render: function (data, type, full, meta) {
                        if (data === '1900-01-01') {
                            return '-';
                        }
                        return moment(data).format('MM/DD/YY');
                    },
                    className: "text-center"
                },
                {
                    type: 'REVISED DELIVERY DATE',
                    data: 'tglkirimbed',
                    name: 'datawebproduksi.tglkirimbed',
                    render: function (data, type, full, meta) {
                        if (data === '1900-01-01') {
                            return '-';
                        }
                        return moment(data).format('MM/DD/YY');
                    },
                    className: "text-center"
                },
                {
                    type: 'SHIPPED DELIVERY DATE',
                    data: 'tgldelivery',
                    name: 'datawebproduksi.tgldelivery',
                    render: function (data, type, full, meta) {
                        if (data === '1900-01-01') {
                            return '-';
                        }
                        return moment(data).format('MM/DD/YY');
                    },
                    className: "text-center"
                },
                {
                    title: 'HAIR',
                    data: 'hair',
                    name: 'datawebproduksi.hair',
                    className: "text-center",
                    render: function(data, type, full, meta) {
                        if (data === 'READY') {
                            return '<span class="badge bg-success pt-1 pb-1 pl-2 pr-2">' + data + '</span>';
                        } else if (data === 'PACKING') {
                            return '<span class="badge bg-primary pt-1 pb-1 pl-2 pr-2">' + data + '</span>';
                        } else if (data === 'IN PROGRESS') {
                            return '<span class="badge bg-secondary pt-1 pb-1 pl-2 pr-2">' + data + '</span>';
                        } else {
                            return data;
                        }
                    }
                },
                {
                    title: 'BASE',
                    data: 'base',
                    name: 'datawebproduksi.base',
                    className: "text-center",
                    render: function(data, type, full, meta) {
                        if (data === 'READY') {
                            return '<span class="badge bg-success pt-1 pb-1 pl-2 pr-2">' + data + '</span>';
                        } else if (data === 'PACKING') {
                            return '<span class="badge bg-primary pt-1 pb-1 pl-2 pr-2">' + data + '</span>';
                        } else if (data === 'IN PROGRESS') {
                            return '<span class="badge bg-secondary pt-1 pb-1 pl-2 pr-2">' + data + '</span>';
                        } else {
                            return data;
                        }
                    }
                },
                {
                    title: 'VENTING',
                    data: 'venting',
                    name: 'datawebproduksi.venting',
                    className: "text-center",
                    render: function(data, type, full, meta) {
                        if (data === 'READY') {
                            return '<span class="badge bg-success pt-1 pb-1 pl-2 pr-2">' + data + '</span>';
                        } else if (data === 'PACKING') {
                            return '<span class="badge bg-primary pt-1 pb-1 pl-2 pr-2">' + data + '</span>';
                        } else if (data === 'WAITING') {
                            return '<span class="badge bg-warning pt-1 pb-1 pl-2 pr-2">' + data + '</span>';
                        } else if (data === 'IN PROGRESS') {
                            return '<span class="badge bg-secondary pt-1 pb-1 pl-2 pr-2">' + data + '</span>';
                        } else {
                            return data;
                        }
                    }
                },
                {
                    title: 'FINAL',
                    data: 'final',
                    name: 'datawebproduksi.final',
                    className: "text-center",
                    render: function(data, type, full, meta) {
                        if (data === 'SHIPPED') {
                            return '<span class="badge bg-success pt-1 pb-1 pl-2 pr-2">' + data + '</span>';
                        } else if (data === 'PACKING') {
                            return '<span class="badge bg-primary pt-1 pb-1 pl-2 pr-2">' + data + '</span>';
                        } else if (data === 'IN PROGRESS') {
                            return '<span class="badge bg-secondary pt-1 pb-1 pl-2 pr-2">' + data + '</span>';
                        } else {
                            return data;
                        }
                    }
                },
                { title: 'COST', data: 'cost', name: 'datawebproduksi.cost', className: "text-center"},
          ],
        select: true,
    } );
    usersTable.columns.adjust().draw();
    loadComment(idmfReceiveActive);
    loadDK(idmfReceiveActive);
    $('#tblprogress tbody').on('click', 'button', function () {
        var trDetail = $(this).closest('tr');
        var kodeitem = trDetail.find('td:first').text();
        console.log('Kode Item : ' + kodeitem); 
        if (tableinvoice != null) {
            tableinvoice.destroy();
        }
        $('#modal-cost .modal-title').text('Invoice Details For ' + kodeitem);
        $('#modal-cost').modal({backdrop: 'static', keyboard: false})
        showInvoice(kodeitem);
        tableinvoice.columns.adjust().draw();
    });
}

function destroyChild(row) {
    var tableDetail = $("detailTable", row.child());
    tableDetail.detach();
    tableDetail.DataTable().destroy();
    row.child.hide();
}

function searchData(nomororder, kodebuyer){
  table = $('#example').DataTable({
      "initComplete": function(settings, json) {
        $("#modal-generate").modal('toggle');
      },
      processing: true,
      serverSide: true,
      responsive: true,
      autowidth: false,
      bPaginate: false,
      bFilter: false,
      info: false,
      columnDefs: [
        { width: '12%', targets: 0 },
        { width: '13%', targets: 1 },
        { width: '5%', targets: 2 },
        { width: '10%', targets: 3 },
        { width: '10%', targets: 4 },
        { width: '10%', targets: 5 },
        { width: '10%', targets: 6 },
        { width: '30%', targets: 7 },
      ],
      fixedColumns: true,
      bLengthChange: false,
      lengthMenu: [
        [-1, 15, 20, 25, 50, 100, 200],
          ['All', 15, 20, 25, 50, 100, 200],
      ],
      ajax: {
          url: "{{ route('testsearchbynumber') }}",
          data: {
            nomororder:nomororder,
            kodebuyer:kodebuyer
          }
        },
      columns: [
        {
            data: 'nomororder',
            name: 'datawebreceive.nomororder',
            className: "text-center details-control",
            render: function(data, type, row, meta) {
                if (type === 'display') {
                    var htmlContent = '';
    
                    if (currentUser.kodebuyer == 'adm' && row.unreadadm == 1) {
                        htmlContent = '<div class="float-right text-danger "><i class="far fa-comments"></i></div>';
                    } else if (currentUser.kodebuyer != 'adm' && row.unreadbuy == 1) {
                        htmlContent = '<div class="float-right text-danger "><i class="far fa-comments"></i></div>';
                    }
                    return data + ' ' + htmlContent;
                } else {
                    return data;
                }
            }
        },
          {data: 'customer_name', name: 'datawebreceive.customer_name', className: "text-center details-control"},
          {data: 'qty', name: 'datawebreceive.qty', render: $.fn.dataTable.render.number('.', ',', 0, ''), className: "text-right details-control"},
          {data: 'namaorder', name: 'datawebreceive.namaorder', className: "text-center details-control"},
          {data: 'tglorder', name: 'datawebreceive.tglorder', render: $.fn.dataTable.render.moment('MM/DD/YY'), className: "text-center details-control"},
          {data: 'tglmasuk', name: 'datawebreceive.tglmasuk', render: $.fn.dataTable.render.moment('MM/DD/YY'), className: "text-center details-control"},
        {
            data: 'status',
            name: 'datawebreceive.status',
            className: "text-center details-control",
            searchable: false,
            render: function(data, type, full, meta) {
                if (data == 4) {
                    return '<span class="badge bg-success pt-1 pb-1 pl-2 pr-2">SHIPPED<i class="fas fa-truck ml-1"></i></span>';
                } else if (data == 1) {
                    return '<span class="badge bg-primary pt-1 pb-1 pl-2 pr-2">PROCESS<i class="fas fa-cogs ml-1"></i></span>';
                } else if (data == 2) {
                    return '<span class="badge bg-secondary pt-1 pb-1 pl-2 pr-2">PENDING<i class="fas fa-hourglass-half ml-1"></i></span>';
                } else if (data == 3) {
                    return '<span class="badge bg-danger pt-1 pb-1 pl-2 pr-2">CANCEL<i class="fas fa-ban ml-1"></i></span>';
                } else {
                    return data;
                }
            }
        },
          {data: 'notes', name: 'datawebketerangan.notes', className: "text-left details-control"},
      ]
  });
  table.columns.adjust().draw();
}

function filterAll(stat_prod){
  table = $('#example').DataTable({
      "initComplete": function(settings, json) {
        $("#modal-generate").modal('toggle');
      },
      processing: true,
      serverSide: true,
      responsive: true,
      autowidth: false,
      bPaginate: false,
      bFilter: false,
      info: false,
      columnDefs: [
        { width: '12%', targets: 0 },
        { width: '13%', targets: 1 },
        { width: '5%', targets: 2 },
        { width: '10%', targets: 3 },
        { width: '10%', targets: 4 },
        { width: '10%', targets: 5 },
        { width: '10%', targets: 6 },
        { width: '30%', targets: 7 },
      ],
      fixedColumns: true,
      bLengthChange: false,
      lengthMenu: [
        [-1, 15, 20, 25, 50, 100, 200],
          ['All', 15, 20, 25, 50, 100, 200],
      ],
      ajax: {
          url: "{{ route('testfilterall') }}",
          data: {
            kodebuyer:kodebuyer,
            stat_prod:stat_prod
          }
        },
      columns: [
        {
            data: 'nomororder',
            name: 'datawebreceive.nomororder',
            className: "text-center details-control",
            render: function(data, type, row, meta) {
                if (type === 'display') {
                    var htmlContent = '';
    
                    if (currentUser.kodebuyer == 'adm' && row.unreadadm == 1) {
                        htmlContent = '<div class="float-right text-danger "><i class="far fa-comments"></i></div>';
                    } else if (currentUser.kodebuyer != 'adm' && row.unreadbuy == 1) {
                        htmlContent = '<div class="float-right text-danger "><i class="far fa-comments"></i></div>';
                    }
                    return data + ' ' + htmlContent;
                } else {
                    return data;
                }
            }
        },
        {data: 'customer_name', name: 'datawebreceive.customer_name', className: "text-center details-control"},
          {data: 'qty', name: 'datawebreceive.qty', render: $.fn.dataTable.render.number('.', ',', 0, ''), className: "text-right details-control"},
          {data: 'namaorder', name: 'datawebreceive.namaorder', className: "text-center details-control"},
          {data: 'tglorder', name: 'datawebreceive.tglorder', render: $.fn.dataTable.render.moment('MM/DD/YY'), className: "text-center details-control"},
          {data: 'tglmasuk', name: 'datawebreceive.tglmasuk', render: $.fn.dataTable.render.moment('MM/DD/YY'), className: "text-center details-control"},
        {
            data: 'status',
            name: 'datawebreceive.status',
            className: "text-center details-control",
            searchable: false,
            render: function(data, type, full, meta) {
                if (data == 4) {
                    return '<span class="badge bg-success pt-1 pb-1 pl-2 pr-2">SHIPPED<i class="fas fa-truck ml-1"></i></span>';
                } else if (data == 1) {
                    return '<span class="badge bg-primary pt-1 pb-1 pl-2 pr-2">PROCESS<i class="fas fa-cogs ml-1"></i></span>';
                } else if (data == 2) {
                    return '<span class="badge bg-secondary pt-1 pb-1 pl-2 pr-2">PENDING<i class="fas fa-hourglass-half ml-1"></i></span>';
                } else if (data == 3) {
                    return '<span class="badge bg-danger pt-1 pb-1 pl-2 pr-2">CANCEL<i class="fas fa-ban ml-1"></i></span>';
                } else {
                    return data;
                }
            }
        },
          {data: 'notes', name: 'datawebketerangan.notes', className: "text-left details-control"},
      ]
  });
  table.columns.adjust().draw();
}

function filterByDate(tglawalform, tglakhirform){
  table = $('#example').DataTable({
      "initComplete": function(settings, json) {
        $("#modal-generate").modal('toggle');
      },
      processing: true,
      serverSide: true,
      responsive: true,
      autowidth: false,
      bPaginate: false,
      bFilter: false,
      info: false,
      columnDefs: [
        { width: '12%', targets: 0 },
        { width: '13%', targets: 1 },
        { width: '5%', targets: 2 },
        { width: '10%', targets: 3 },
        { width: '10%', targets: 4 },
        { width: '10%', targets: 5 },
        { width: '10%', targets: 6 },
        { width: '30%', targets: 7 },
      ],
      fixedColumns: true,
      bLengthChange: false,
      lengthMenu: [
        [-1, 15, 20, 25, 50, 100, 200],
          ['All', 15, 20, 25, 50, 100, 200],
      ],
      ajax: {
          url: "{{ route('testfilterbydate') }}",
          data: {
            kodebuyer:kodebuyer,
            tglawalform:$('#tglawalform').val(),
            tglakhirform:$('#tglakhirform').val()
          }
        },
      columns: [
        {
            data: 'nomororder',
            name: 'datawebreceive.nomororder',
            className: "text-center details-control",
            render: function(data, type, row, meta) {
                if (type === 'display') {
                    var htmlContent = '';
    
                    if (currentUser.kodebuyer == 'adm' && row.unreadadm == 1) {
                        htmlContent = '<div class="float-right text-danger "><i class="far fa-comments"></i></div>';
                    } else if (currentUser.kodebuyer != 'adm' && row.unreadbuy == 1) {
                        htmlContent = '<div class="float-right text-danger "><i class="far fa-comments"></i></div>';
                    }
                    return data + ' ' + htmlContent;
                } else {
                    return data;
                }
            }
        },
        {data: 'customer_name', name: 'datawebreceive.customer_name', className: "text-center details-control"},
          {data: 'qty', name: 'datawebreceive.qty', render: $.fn.dataTable.render.number('.', ',', 0, ''), className: "text-right details-control"},
          {data: 'namaorder', name: 'datawebreceive.namaorder', className: "text-center details-control"},
          {data: 'tglorder', name: 'datawebreceive.tglorder', render: $.fn.dataTable.render.moment('MM/DD/YY'), className: "text-center details-control"},
          {data: 'tglmasuk', name: 'datawebreceive.tglmasuk', render: $.fn.dataTable.render.moment('MM/DD/YY'), className: "text-center details-control"},
        {
            data: 'status',
            name: 'datawebreceive.status',
            className: "text-center details-control",
            searchable: false,
            render: function(data, type, full, meta) {
                if (data == 4) {
                    return '<span class="badge bg-success pt-1 pb-1 pl-2 pr-2">SHIPPED<i class="fas fa-truck ml-1"></i></span>';
                } else if (data == 1) {
                    return '<span class="badge bg-primary pt-1 pb-1 pl-2 pr-2">PROCESS<i class="fas fa-cogs ml-1"></i></span>';
                } else if (data == 2) {
                    return '<span class="badge bg-secondary pt-1 pb-1 pl-2 pr-2">PENDING<i class="fas fa-hourglass-half ml-1"></i></span>';
                } else if (data == 3) {
                    return '<span class="badge bg-danger pt-1 pb-1 pl-2 pr-2">CANCEL<i class="fas fa-ban ml-1"></i></span>';
                } else {
                    return data;
                }
            }
        },
          {data: 'notes', name: 'datawebketerangan.notes', className: "text-left details-control"},
      ]
  });
  table.columns.adjust().draw();
}

function showEmptyList(stat_prod){
    return new Promise(function(resolve, reject) {
        table = $('#example').DataTable({
            "initComplete": function(settings, json) {
            },
            processing: true,
            serverSide: true,
            responsive: true,
            autowidth: false,
            // scrollX: true,
            bPaginate: false,
            bFilter: false,
            info: false,
            columnDefs: [
                { width: '12%', targets: 0 },
                { width: '13%', targets: 1 },
                { width: '5%', targets: 2 },
                { width: '10%', targets: 3 },
                { width: '10%', targets: 4 },
                { width: '10%', targets: 5 },
                { width: '10%', targets: 6 },
                { width: '30%', targets: 7 },
              ],
            fixedColumns: true,
            bLengthChange: false,
            lengthMenu: [
                [-1, 15, 20, 25, 50, 100, 200],
                ['All', 15, 20, 25, 50, 100, 200],
            ],
            ajax: {
                url: "{{ route('emptyorderlist') }}",
                data: {}
                },
            columns: [
                {data: 'nomororder', name: 'nomororder', className: "text-center"},
                {data: 'customer_name', name: 'customer_name', className: "text-center"},
                {data: 'qty', name: 'qty', className: "text-right"},
                {data: 'namaorder', name: 'namaorder', className: "text-center"},
                {data: 'tglorder', name: 'tglorder', className: "text-center"},
                {data: 'tglmasuk', name: 'tglmasuk', className: "text-center"},
                {data: 'status', name: 'status', className: "text-center"},
                {data: 'notes', name: 'notes', className: "text-left"},
            ]
        });
        table.columns.adjust().draw();
    });
}

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-bottom-right",
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