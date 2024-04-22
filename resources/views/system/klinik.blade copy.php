@extends('adminlte::page')

@section('title', 'Identitas Klinik')
@section('plugins.Select2', true)
@section('plugins.TempusDominus', true)
@section('plugins.BsCustomFileInput', true)
@section('plugins.Toastr', true)
@section('content_header')
    <!-- <h1>Identitas Klinik</h1> -->
@stop

@section('content')
<div class="container-fluid">
    <form id="klinikForm" name="klinikForm" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="card card-danger card-outline">
            <div class="card-header text-center">
                <h5 class="text-bold m-0">DATA IDENTITAS KLINIK</h5>
            </div> 
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row mb-1">
                            <label for="nama_klinik" class="col-sm-3 col-form-label text-sm">Nama FasKes</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="nama_klinik" name="nama_klinik" value="{{ $klinik->nama_klinik }}" placeholder="Nama Klinik/Faskes" tabindex="0">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="prov_id" class="col-sm-3 col-form-label text-sm">Provinsi</label>
                            <div class="col-sm-9">
                                <select class="form-control form-control-sm select2 select2-hidden-accessible" style="width: 100%;" tabindex="1" aria-hidden="true" data-placeholder="Pilih Provinsi" id="prov_id" name="prov_id">
                                @foreach ($provinsi as $key => $item)
                                        <option value="{{ $key }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                                <label for="city_id" class="col-sm-3 col-form-label text-sm">Kota/Kabupaten</label>
                                <div class="col-sm-9">
                                    <select class="form-control form-control-sm select2 select2-hidden-accessible"  style="width: 100%;" tabindex="2" aria-hidden="true" data-placeholder="Pilih Kota" id="city_id" name="city_id">
                                    </select>
                                </div>
                            </div>
                        
                            <div class="form-group row mb-1">
                            <label for="dis_id" class="col-sm-3 col-form-label text-sm">Kecamatan</label>
                            <div class="col-sm-9">
                            <select class="form-control form-control-sm select2 select2-hidden-accessible"  style="width: 100%;" tabindex="3" aria-hidden="true" data-placeholder="Pilih Kecamatan" id="dis_id" name="dis_id"></select>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label for="subdis_id" class="col-sm-3 col-form-label text-sm">Kelurahan/Desa</label>
                            <div class="col-sm-9">
                            <select class="form-control form-control-sm select2 select2-hidden-accessible"  style="width: 100%;" tabindex="4" aria-hidden="true" data-placeholder="Pilih Kelurahan/Desa" id="subdis_id" name="subdis_id"></select>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label for="kode_pos" class="col-sm-3 col-form-label text-sm">Kode POS</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control form-control-sm" id="kode_pos" name="kode_pos" placeholder="Kode POS" tabindex="5" value="{{ $klinik->kode_pos }}">
                            </div>
                            <label for="rt" class="col-sm-1 col-form-label text-sm text-left">RT</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control form-control-sm" id="rt" name="rt" placeholder="RT" tabindex="6" value="{{ $klinik->rt }}">
                            </div>
                            <label for="rw" class="col-sm-1 col-form-label text-sm">RW</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control form-control-sm" id="rw" name="rw" placeholder="RW" tabindex="7" value="{{ $klinik->rw }}">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="alamat" class="col-sm-3 col-form-label text-sm">Alamat Lengkap</label>
                            <div class="col-sm-9">
                                <textarea class="form-control form-control-sm" id="alamat" name="alamat" rows="3" placeholder="Alamat" tabindex="8">{{ $klinik->alamat }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group row mb-1">
                            {{-- <label for="id_tipe" class="col-sm-5 col-form-label text-sm-right text-left" id="rl-label">Tipe FasKes</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" id="id_tipe" name="id_tipe" placeholder="Tipe Faskes" tabindex="9" value="{{ $klinik->id_tipe }}">
                            </div> --}}
                            <label for="id_tipe" class="col-sm-5 col-form-label text-sm-right text-left" id="rl-label">Tipe FasKes</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select2 select2-hidden-accessible" style="width: 100%;" tabindex="1" aria-hidden="true" data-placeholder="Pilih Tipe Faskes" id="id_tipe" name="id_tipe">
                                @foreach ($tipeklinik as $key => $item)
                                        <option value="{{ $key }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="nama_pemilik" class="col-sm-5 col-form-label text-sm-right text-left">Nama Pemilik</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" id="nama_pemilik" name="nama_pemilik" placeholder="Nama Pemilik" tabindex="10" value="{{ $klinik->nama_pemilik }}">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="penanggung_jawab" class="col-sm-5 col-form-label text-sm-right text-left">Penanggung Jawab</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" id="penanggung_jawab" name="penanggung_jawab" placeholder="Penanggung Jawab" tabindex="11" value="{{ $klinik->penanggung_jawab }}">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="penanggung_jawab_lab" class="col-sm-5 col-form-label text-sm-right text-left">Penanggung Jawab Lab.</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" id="penanggung_jawab_lab" name="penanggung_jawab_lab" placeholder="Penanggung Jawab Lab." tabindex="12" value="{{ $klinik->penanggung_jawab_lab }}">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="telepon" class="col-sm-5 col-form-label text-sm-right text-left">Telepon</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" id="telepon" name="telepon" placeholder="Telepon" tabindex="13" value="{{ $klinik->telepon }}">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="email" class="col-sm-5 col-form-label text-sm-right text-left">Email</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="Email" tabindex="14" value="{{ $klinik->email }}">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="website" class="col-sm-5 col-form-label text-sm-right text-left">Website</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" id="website" name="website" placeholder="Website" tabindex="15" value="{{ $klinik->website }}">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="npwp" class="col-sm-5 col-form-label text-sm-right text-left">NPWP</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" id="npwp" name="npwp" placeholder="NPWP" tabindex="16" value="{{ $klinik->npwp }}">
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
        <div class="card card-danger card-outline">
            <div class="card-header text-center">
                <h5 class="text-bold m-0">DATA APOTEK & APOTEKER</h5>
            </div> 
            <div class="card-body">
                <div class="row mb-0">
                    <div class="col-sm-6">
                        <div class="form-group row mb-0">
                            <label for="no_register" class="col-sm-5 col-form-label text-sm">No. Registrasi</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" id="no_register" name="no_register" placeholder="No. Registrasi" tabindex="17" value="{{ $klinik->no_register }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row mb-0">
                            <label for="tgl_berlaku_register" class="col-sm-5 col-form-label text-sm text-lg-right">Tgl. Berlaku Registrasi</label>
                            <div class="col-sm-7">
                                <div class="input-group input-group-sm date" id="tgl_berlaku_register" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#tgl_berlaku_register" name="tgl_berlaku_register" tabindex="18" value="{{ $klinik->tgl_berlaku_register }}">
                                    <div class="input-group-append" data-target="#tgl_berlaku_register" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-0">
                    <label class="col-sm-12 col-form-label text-xs">Klik atau Drag & drop file photo untuk upload dokumen Registrasi disini :</label>
                </div>
                <div id="drop-area-register" class="drop-zone-register needsclick dropzone">
                        <input type="file" name="attachments_register[]" id="attachments_register" class="drop-zone-register__input" multiple>
                    <div id="file-list-register" class="mb-0"></div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row mb-0">
                            <label for="nama_apj" class="col-sm-5 col-form-label text-sm">Apoteker Penanggung Jawab</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" id="nama_apj" name="nama_apj" placeholder="Apoteker Penanggung Jawab" tabindex="19" value="{{ $klinik->nama_apj }}">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="no_stra" class="col-sm-5 col-form-label text-sm">Nomor STRA</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" id="no_stra" name="no_stra" placeholder="Nomor STRA" tabindex="20" value="{{ $klinik->no_stra }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row mb-0">
                            <label for="tgl_berlaku_stra" class="col-sm-5 col-form-label text-sm text-lg-right">Tgl. Berlaku STRA</label>
                            <div class="col-sm-7">
                                <div class="input-group input-group-sm date" id="tgl_berlaku_stra" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#tgl_berlaku_stra" name="tgl_berlaku_stra" tabindex="21" value="{{ $klinik->tgl_berlaku_stra }}">
                                    <div class="input-group-append" data-target="#tgl_berlaku_stra" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-0">
                    <label class="col-sm-12 col-form-label text-xs">Klik atau Drag & drop file photo untuk upload dokumen STRA disini :</label>
                </div>
                <div id="drop-area-stra" class="drop-zone-stra needsclick dropzone">
                        <input type="file" name="attachments_stra[]" id="attachments_stra" class="drop-zone-stra__input" multiple>
                    <div id="file-list-stra" class="mb-0"></div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row mb-1">
                            <label for="no_sipa" class="col-sm-5 col-form-label text-sm">Nomor SIPA</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" id="no_sipa" name="no_sipa" placeholder="Nomor SIPA" tabindex="22" value="{{ $klinik->no_sipa }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row mb-1">
                            <label for="tgl_berlaku_sipa" class="col-sm-5 col-form-label text-sm text-lg-right">Tgl. Berlaku SIPA</label>
                            <div class="col-sm-7">
                                <div class="input-group input-group-sm date" id="tgl_berlaku_sipa" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#tgl_berlaku_sipa" name="tgl_berlaku_sipa" tabindex="23" value="{{ $klinik->tgl_berlaku_sipa }}">
                                    <div class="input-group-append" data-target="#tgl_berlaku_sipa" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-0">
                    <label class="col-sm-12 col-form-label text-xs">Klik atau Drag & drop file photo untuk upload dokumen SIPA disini :</label>
                </div>
                <div id="drop-area-sipa" class="drop-zone-sipa needsclick dropzone">
                        <input type="file" name="attachments_sipa[]" id="attachments_sipa" class="drop-zone-sipa__input" multiple>
                    <div id="file-list-sipa" class="mb-0"></div>
                </div>
            </div>
            <div class="card-footer">
            <button type="button" class="btn bg-gradient-success float-right text-sm" id="saveBtn">Simpan Data</button>
            </div>
        </div>
    </form>
</div>

@includeIf('system.modal')
  
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
    <link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet">
    <style>
        .input-group>.custom-file {
            height: calc(2.25rem + 2px)!important;
        }

        .drop-zone-register--over {
            background-color: #f0f0f0; /* ubah warna latar belakang saat area drop dihover */
        }

        .drop-zone-register {
            position: relative;
            border: 2px dashed #ccc; /* tambahkan garis dashed di sekitar drop area */
            border-radius: 5px;
            padding: 20px;
            text-align: center;
        }
        .drop-zone-register__input {
            display: none;
        }
        .drop-zone-register__prompt {
            font-size: 16px;
        }

        #file-list-register {
            display: flex;
            flex-wrap: wrap;
            padding: 5px; 
        }

        .drop-zone-stra--over {
            background-color: #f0f0f0; /* ubah warna latar belakang saat area drop dihover */
        }

        .drop-zone-stra {
            position: relative;
            border: 2px dashed #ccc; /* tambahkan garis dashed di sekitar drop area */
            border-radius: 5px;
            padding: 20px;
            text-align: center;
        }
        .drop-zone-stra__input {
            display: none;
        }
        .drop-zone-stra__prompt {
            font-size: 16px;
        }

        #file-list-stra {
            display: flex;
            flex-wrap: wrap;
            padding: 5px; 
        }

        .drop-zone-sipa--over {
            background-color: #f0f0f0; /* ubah warna latar belakang saat area drop dihover */
        }

        .drop-zone-sipa {
            position: relative;
            border: 2px dashed #ccc; /* tambahkan garis dashed di sekitar drop area */
            border-radius: 5px;
            padding: 20px;
            text-align: center;
        }
        .drop-zone-sipa__input {
            display: none;
        }
        .drop-zone-sipa__prompt {
            font-size: 16px;
        }

        #file-list-sipa {
            display: flex;
            flex-wrap: wrap;
            padding: 5px; 
        }

        .file-preview {
            margin-right: 15px;
            margin-bottom: 15px;
            position: relative; /* membuat posisi relatif untuk thumbnail agar bisa diatur ulang */
        }

        .thumbnail-container {
            position: relative;
            width: 100px;
            height: 100px;
        }

        .thumbnail {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 6px;
        }

        .delete-button {
            position: absolute;
            top: 80%;
            left: 80%;
            transform: translate(-50%, -50%);
        }

        .file-size {
            position: absolute;
            top: 5px;
            left: 5px;
            background-color: rgba(20, 150, 0, 0.6);
            color: #fff;
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
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

        .modal-body {
            text-align: center; /* Mengatur posisi teks menjadi tengah */
        }

        .modal-body img {
            max-width: 100%; /* Maksimum lebar gambar adalah 100% dari modal-body */
            max-height: 100%; /* Maksimum tinggi gambar adalah 100% dari modal-body */
            margin: auto; /* Memberikan margin otomatis untuk memposisikan gambar ke tengah */
        }

    </style>
@stop

@section('js')
<script type='text/javascript' src="{{ asset('js/dropzone.min.js') }}"></script>
<script> 

// Dropzone.autoDiscover = false
$(document).ready(function() {
    bsCustomFileInput.init();
    
    $("#prov_id").select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Provinsi",
        allowClear: true
    })

    $("#city_id").select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Kota",
        allowClear: true
    })

    $("#dis_id").select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Kecamatan",
        allowClear: true
    })
    
    $("#subdis_id").select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Kelurahan/Desa",
        allowClear: true
    })

    $("#id_tipe").select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Tipe Klinik",
        allowClear: false
    })

    var default_id_tipe = '{{ $klinik->id_tipe ?? '' }}';
    if (default_id_tipe) {
        $("#id_tipe").val(default_id_tipe).trigger('change');
    }

    $("#prov_id").val('{{ $klinik->prov_id ?? '' }}').trigger('change');
    $("#city_id").val('').trigger('change');
    $("#dis_id").val('').trigger('change');
    $("#subdis_id").val('').trigger('change');

    $('#tgl_berlaku_register').datetimepicker({
        // format: 'L'
        format: 'YYYY-MM-DD'
    });

    $('#tgl_berlaku_stra').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('#tgl_berlaku_sipa').datetimepicker({
        format: 'YYYY-MM-DD'
    });
});

$(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
});

$('#prov_id').change(function () {
    var id = $(this).val();
    // console.log(id);
    

    if(!id) {
        id = 0;
        $("#prov_id").val('');
        $("#city_id").val('').trigger('change');
        $("#dis_id").val('').trigger('change');
        $("#subdis_id").val('').trigger('change');
        // $("#city_id").empty();
        // $("#dis_id").empty();
        // $("#subdis_id").empty();
    }

    $.get('/kota/' + id, function (data) {
        $("#city_id").empty();
        $.each(data, function (index, kota) {
            $('#city_id').append('<option value="' + kota.city_id + '">' + kota.city_name + '</option>');
        });
        if (id) {
            var default_city_id = '{{ $klinik->city_id ?? '' }}';
            if (default_city_id) {
                $("#city_id").val(default_city_id).trigger('change');
            }
        }
    });
    
});

$('#city_id').change(function () {
    var id = $(this).val();
    // console.log(id);
    

    if(!id) {
        id = 0;
    }

    // $("#dis_id").val('').trigger('change')

    $.get('/kecamatan/' + id, function (data) {
        $("#dis_id").empty();
        $.each(data, function (index, kecamatan) {
            $('#dis_id').append('<option value="' + kecamatan.dis_id + '">' + kecamatan.dis_name + '</option>');
        });
        if (id) {
            var default_dis_id = '{{ $klinik->dis_id ?? '' }}';
            if (default_dis_id) {
                $("#dis_id").val(default_dis_id).trigger('change');
            }
        }
    });
    
});

$('#dis_id').change(function () {
    var id = $(this).val();
    // console.log(id);
    

    if(!id) {
        id = 0;
    }

    // $("#subdis_id").val('').trigger('change')

    $.get('/kelurahan/' + id, function (data) {
        $("#subdis_id").empty();
        $.each(data, function (index, kelurahan) {
            $('#subdis_id').append('<option value="' + kelurahan.subdis_id + '">' + kelurahan.subdis_name + '</option>');
        });
        if (id) {
            var default_subdis_id = '{{ $klinik->subdis_id ?? '' }}';
            if (default_subdis_id) {
                $("#subdis_id").val(default_subdis_id).trigger('change');
            }
        }
    });

});

$('#saveBtn').click(function (e) {
    e.preventDefault();
    $(this).prop('disabled', true).html('<span class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></span>Sending...');

    var formData = new FormData($('#klinikForm')[0]);

    $.ajax({
        data: formData,
        url: "{{ route('klinik.update') }}",
        type: "POST",
        processData: false, 
        contentType: false, 
        success: function (data) {
            if($.isEmptyObject(data.error)){
                $('#saveBtn').prop('disabled', false).html('Simpan Data');
                toastr["success"]("Data Klinik berhasil diperbaharui.", "Updated!");
            }else{
                // printErrorMsg(data.error);
                toastr["error"](data.error, "Terjadi Kesalahan");
            }
        },
        error: function (data) {
            $('#saveBtn').prop('disabled', false).html('Simpan Data');
            toastr["error"](data.error, "Terjadi Kesalahan");
        }
    });
});

// DROPZONE'S CODES ===================================================================================================

var uploadedRegisterMap = {};
var minFilesReg = 0;
var maxFilesReg = 10;

var uploadedSTRAMap = {};
var minFilesSTRA = 0;
var maxFilesSTRA = 10;

var uploadedSIPAMap = {};
var minFilesSIPA = 0;
var maxFilesSIPA = 10;

var myDZRegister = Dropzone.options.dropAreaRegister = {
    url: "{{ route('upload-reg') }}",
    minFiles: minFilesReg,
    maxFiles: maxFilesReg,
    autoProcessQueue: true,
    maxFilesize: 1, // MB
    addRemoveLinks: true,
    acceptedFiles: ".jpeg,.jpg,.png",
    timeout: 5000,
    createImageThumbnails: true,
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    renameFile: function(file) {
        var dt = new Date();
        var time = dt.getTime();
        return time+file.name;
    },
    success: function(file, response) {
        $('form').append('<input type="hidden" name="attachments_register[]" value="' + response.name + '">')
        uploadedRegisterMap[file.name] = response.name
        var thumbnail = $(file.previewElement).find('.dz-image img');
        thumbnail.addClass('centered-image');
    },
    removedfile: function(file) {
        var filename = ''
        if (file.hasOwnProperty('upload')) {
            filename = file.upload.filename;
        }else{
            filename = file.name;
        }
        $.ajax({
            type: 'POST',
            url: "{{ url('image/delete-reg') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                filename: filename,                        
            },
            sucess: function(data) {
                console.log('removed success: ' + data);
            }
        });
        Reflect.deleteProperty(uploadedRegisterMap, file.name);
        file.previewElement.remove();
        $('form').find('input[name="attachments_register[]"][value="' + filename + '"]').remove()
    },
    maxfilesexceeded: function(file) {
    },
    init: function() {
        myDZRegister = this;
        $.ajax({
            url: "{{ url('readRegFiles') }}/{{ $klinik->id }}",
            type: 'get',
            dataType: 'json',
            success: function (response) {
                $.each(response, function (key, value) {
                    var mockFile = {
                        name: value.name,
                        size: value.size,
                        accepted: true,
                        kind: 'image'
                    };
                    myDZRegister.emit("addedfile", mockFile);
                    myDZRegister.files.push(mockFile);
                    myDZRegister.emit("thumbnail", mockFile, value.path);
                    myDZRegister.emit("complete", mockFile);
                    $('form').append('<input type="hidden" name="attachments_register[]" value="' + value.name + '">');
                    uploadedRegisterMap[value.name] = value.name;
                    var thumbnail = $(mockFile.previewElement).find('.dz-image img');
                    thumbnail.addClass('centered-image');
                })
            }
        })

        this.on("maxfilesexceeded", function(file) { 
            toastr["error"]("Maximum " + maxFilesReg + " files are allowed to upload...!", "Max Files Exceeded")
            return false;
        });
        var submitButton = document.querySelector("#saveBtn");
        myDZRegister = this;
        submitButton.addEventListener("click", function(e) {
            e.preventDefault();
            var imagelength = Object.keys(uploadedRegisterMap).length;
            if(imagelength < minFilesReg ){
                toastr["error"]("Minimum "+minFilesReg+" file needs to upload...!")
                return false;
            }else{
                $('#form-create').submit();
            }
        });
    },
    error: function(file, response) {
        if (file.size > this.options.maxFilesize * 1024 * 1024) {
            toastr["error"]("Ukuran file " + file.name + " terlalu besar (" + file.size + "MiB). Ukuran maksimum yang diperbolehkan: 5 MiB", "Max File Size Exceeded");
        } else {
            toastr["error"](response, "Terjadi Kesalahan");
        }
        $(file.previewElement).remove(); // removed files if validation fails
        return false;
    }
}

var myDZSTRA = Dropzone.options.dropAreaStra = {
    url: "{{ route('upload-stra') }}",
    minFiles: minFilesSTRA,
    maxFiles: maxFilesSTRA,
    autoProcessQueue: true,
    maxFilesize: 1, // MB
    addRemoveLinks: true,
    acceptedFiles: ".jpeg,.jpg,.png",
    timeout: 5000,
    createImageThumbnails: true,
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    renameFile: function(file) {
        var dt = new Date();
        var time = dt.getTime();
        return time+file.name;
    },
    success: function(file, response) {
        $('form').append('<input type="hidden" name="attachments_stra[]" value="' + response.name + '">')
        uploadedSTRAMap[file.name] = response.name
        var thumbnail = $(file.previewElement).find('.dz-image img');
        thumbnail.addClass('centered-image');
    },
    removedfile: function(file) {
        var filename = ''
        if (file.hasOwnProperty('upload')) {
            filename = file.upload.filename;
        }else{
            filename = file.name;
        }
        $.ajax({
            type: 'POST',
            url: "{{ url('image/delete-stra') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                filename: filename,                        
            },
            sucess: function(data) {
                console.log('removed success: ' + data);
            }
        });
        Reflect.deleteProperty(uploadedSTRAMap, file.name);
        file.previewElement.remove();
        $('form').find('input[name="attachments_stra[]"][value="' + filename + '"]').remove()
    },
    maxfilesexceeded: function(file) {
    },
    init: function() {
        myDZSTRA = this;
        $.ajax({
            url: "{{ url('readStraFiles') }}/{{ $klinik->id }}",
            type: 'get',
            dataType: 'json',
            success: function (response) {
                $.each(response, function (key, value) {
                    var mockFile = {
                        name: value.name,
                        size: value.size,
                        accepted: true,
                        kind: 'image'
                    };
                    myDZSTRA.emit("addedfile", mockFile);
                    myDZSTRA.files.push(mockFile);
                    myDZSTRA.emit("thumbnail", mockFile, value.path);
                    myDZSTRA.emit("complete", mockFile);
                    $('form').append('<input type="hidden" name="attachments_stra[]" value="' + value.name + '">');
                    uploadedSTRAMap[value.name] = value.name;
                    var thumbnail = $(mockFile.previewElement).find('.dz-image img');
                    thumbnail.addClass('centered-image');
                })
            }
        })

        this.on("maxfilesexceeded", function(file) { 
            toastr["error"]("Maximum " + maxFilesSTRA + " files are allowed to upload...!", "Max Files Exceeded")
            return false;
        });
        var submitButton = document.querySelector("#saveBtn");
        myDZSTRA = this;
        submitButton.addEventListener("click", function(e) {
            e.preventDefault();
            var imagelength = Object.keys(uploadedSTRAMap).length;
            if(imagelength < minFilesSTRA ){
                toastr["error"]("Minimum "+minFilesSTRA+" file needs to upload...!")
                return false;
            }else{
                $('#form-create').submit();
            }
        });
    },
    error: function(file, response) {
        if (file.size > this.options.maxFilesize * 1024 * 1024) {
            toastr["error"]("Ukuran file " + file.name + " terlalu besar (" + file.size + "MiB). Ukuran maksimum yang diperbolehkan: 5 MiB", "Max File Size Exceeded");
        } else {
            toastr["error"](response, "Terjadi Kesalahan");
        }
        $(file.previewElement).remove(); // removed files if validation fails
        return false;
    }
}

var myDZSIPA = Dropzone.options.dropAreaSipa = {
    url: "{{ route('upload-sipa') }}",
    minFiles: minFilesSIPA,
    maxFiles: maxFilesSIPA,
    autoProcessQueue: true,
    maxFilesize: 1, // MB
    addRemoveLinks: true,
    acceptedFiles: ".jpeg,.jpg,.png",
    timeout: 5000,
    createImageThumbnails: true,
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    renameFile: function(file) {
        var dt = new Date();
        var time = dt.getTime();
        return time+file.name;
    },
    success: function(file, response) {
        $('form').append('<input type="hidden" name="attachments_sipa[]" value="' + response.name + '">')
        uploadedSIPAMap[file.name] = response.name
        var thumbnail = $(file.previewElement).find('.dz-image img');
        thumbnail.addClass('centered-image');
    },
    removedfile: function(file) {
        var filename = ''
        if (file.hasOwnProperty('upload')) {
            filename = file.upload.filename;
        }else{
            filename = file.name;
        }
        $.ajax({
            type: 'POST',
            url: "{{ url('image/delete-sipa') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                filename: filename,                        
            },
            sucess: function(data) {
                console.log('removed success: ' + data);
            }
        });
        Reflect.deleteProperty(uploadedSIPAMap, file.name);
        file.previewElement.remove();
        $('form').find('input[name="attachments_sipa[]"][value="' + filename + '"]').remove()
    },
    maxfilesexceeded: function(file) {
    },
    init: function() {
        myDZSIPA = this;
        $.ajax({
            url: "{{ url('readSipaFiles') }}/{{ $klinik->id }}",
            type: 'get',
            dataType: 'json',
            success: function (response) {
                $.each(response, function (key, value) {
                    var mockFile = {
                        name: value.name,
                        size: value.size,
                        accepted: true,
                        kind: 'image'
                    };
                    myDZSIPA.emit("addedfile", mockFile);
                    myDZSIPA.files.push(mockFile);
                    myDZSIPA.emit("thumbnail", mockFile, value.path);
                    myDZSIPA.emit("complete", mockFile);
                    $('form').append('<input type="hidden" name="attachments_sipa[]" value="' + value.name + '">');
                    uploadedSIPAMap[value.name] = value.name;
                    var thumbnail = $(mockFile.previewElement).find('.dz-image img');
                    thumbnail.addClass('centered-image');
                })
            }
        })

        this.on("maxfilesexceeded", function(file) { 
            toastr["error"]("Maximum " + maxFilesSIPA + " files are allowed to upload...!", "Max Files Exceeded")
            return false;
        });
        var submitButton = document.querySelector("#saveBtn");
        myDZSIPA = this;
        submitButton.addEventListener("click", function(e) {
            e.preventDefault();
            var imagelength = Object.keys(uploadedSIPAMap).length;
            if(imagelength < minFilesSIPA ){
                toastr["error"]("Minimum "+minFilesSIPA+" file needs to upload...!")
                return false;
            }else{
                $('#form-create').submit();
            }
        });
    },
    error: function(file, response) {
        if (file.size > this.options.maxFilesize * 1024 * 1024) {
            toastr["error"]("Ukuran file " + file.name + " terlalu besar (" + file.size + "MiB). Ukuran maksimum yang diperbolehkan: 5 MiB", "Max File Size Exceeded");
        } else {
            toastr["error"](response, "Terjadi Kesalahan");
        }
        $(file.previewElement).remove(); // removed files if validation fails
        return false;
    }
}

$('#drop-area-register').on('click', '.dz-preview', function() {
    var imageUrl = $(this).find('img').attr('src');
    // console.log(imageUrl);
    $('#previewImage').modal('show');
    $('#modalImage').attr('src', imageUrl);
});

$('#drop-area-stra').on('click', '.dz-preview', function() {
    var imageUrl = $(this).find('img').attr('src');
    // console.log(imageUrl);
    $('#previewImage').modal('show');
    $('#modalImage').attr('src', imageUrl);
});

$('#drop-area-sipa').on('click', '.dz-preview', function() {
    var imageUrl = $(this).find('img').attr('src');
    // console.log(imageUrl);
    $('#previewImage').modal('show');
    $('#modalImage').attr('src', imageUrl);
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