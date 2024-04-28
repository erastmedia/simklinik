@extends('adminlte::page')

@section('title', 'Dashboard')
@section('plugins.Select2', true)
@section('plugins.paceProgress', true)

@section('content_header')
    <div class="row mb-0">
        <div class="col-sm-6">
            <h4 class="text-bold text-black">Dashboard</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right text-xs">
                <li class="breadcrumb-item"><a href="../../dashboard">Dashboard</a></li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    
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
    <link rel="stylesheet" href="/css/admin_custom.css">

@stop

@section('js')
<script> 
$(document).ready(function() {
    // var srcImgLogo = $('.brand-image');
    // srcImgLogo.attr('src', 'img/' + '{{ $klinik->file_logo ?? '' }}');
});

</script>
@stop