@extends('adminlte::page')

@section('title', 'Integrasi Satu Sehat')
@section('plugins.Toastr', true)
@section('content_header')
    <div class="row mb-0">
        <div class="col-sm-6">
            <h4 class="text-bold text-black">Integrasi Satu Sehat</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right text-xs">
                <li class="breadcrumb-item"><a href="../../dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="../../dashboard">System</a></li>
                <li class="breadcrumb-item">Integrasi Satu Sehat</li>
            </ol>
        </div>
    </div>
@stop

@section('content')

<div class="container text-center">
    <div class="row justify-content-md-center">
        <div class="col col-lg-8">
            <form id="satuSehatForm" name="satuSehatForm" enctype="multipart/form-data">
                {{ csrf_field() }}
            
                <div class="card card-danger card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true"><h6 class="text-bold m-0">Integrasi Satu Sehat</h6></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group row mb-1">
                                        <label for="organization_id" class="col-sm-3 col-form-label text-sm text-left pr-0">Organization ID <span class="float-right">:</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="organization_id" name="organization_id" value="{{ $satusehat->organization_id }}" placeholder="Organization ID" tabindex="0">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                        <label for="client_key" class="col-sm-3 col-form-label text-sm text-left pr-0">Client Key <span class="float-right">:</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="client_key" name="client_key" value="{{ $satusehat->client_key }}" placeholder="Client Key" tabindex="0">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                        <label for="secret_key" class="col-sm-3 col-form-label text-sm text-left pr-0">Secret Key <span class="float-right">:</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="secret_key" name="secret_key" value="{{ $satusehat->secret_key }}" placeholder="Secret Key" tabindex="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer row bg-white">
                        <div class="col-sm-5">
                            <button type="button" class="btn btn-block btn-default btn-md text-bold" id="testBtn"><i class="fas fa-plug text-danger mr-3"></i>Test Koneksi</button>
                        </div>
                        <div class="col-sm-7">
                            <button type="button" class="btn btn-block btn-default btn-md text-bold" id="saveBtn"><i class="fas fa-save text-primary mr-3"></i>Simpan Konfigurasi</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
  
@stop

@section('footer')
    <!-- Main Footer -->
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

<script> 

$(document).ready(function() {

});

$('#saveBtn').click(function (e) {
    e.preventDefault();
    $(this).prop('disabled', true).html('<span class="spinner-grow spinner-grow-sm mr-3" role="status" aria-hidden="true"></span>Sending...');

    var formData = new FormData($('#satuSehatForm')[0]);

    $.ajax({
        data: formData,
        url: "{{ route('satusehat.update') }}",
        type: "POST",
        processData: false, 
        contentType: false, 
        success: function (data) {
            if($.isEmptyObject(data.error)){
                $('#saveBtn').prop('disabled', false).html('<i class="fas fa-save text-primary mr-3"></i>Simpan Konfigurasi');
                toastr["success"]("Data Klinik berhasil diperbaharui.", "Updated!");
            }else{
                // printErrorMsg(data.error);
                toastr["error"](data.error, "Terjadi Kesalahan");
            }
        },
        error: function (data) {
            $('#saveBtn').prop('disabled', false).html('<i class="fas fa-save text-primary mr-3"></i>Simpan Konfigurasi');
            toastr["error"](data.error, "Terjadi Kesalahan");
        }
    });
});

$('#testBtn').click(function (e) {
    e.preventDefault();
    $(this).prop('disabled', true).html('<span class="spinner-grow spinner-grow-sm mr-3" role="status" aria-hidden="true"></span>Testing...');

    var formData = new FormData($('#satuSehatForm')[0]);

    $.ajax({
            url: "/get-access-token",
            type: "GET",
            success: function(response){
                console.log(response);
                // alert("Access Token: " + response.access_token);
                toastr["success"](response.success + '. Access Token : ' + response.access_token, "Sukses");
                $('#testBtn').prop('disabled', false).html('<i class="fas fa-plug text-danger mr-3"></i>Test Koneksi');
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText);
                // alert("Error: " + xhr.responseText);
                toastr["error"](xhr.responseText, "Terjadi Kesalahan");
                $('#testBtn').prop('disabled', false).html('<i class="fas fa-plug text-danger mr-3"></i>Test Koneksi');
            }
        });
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