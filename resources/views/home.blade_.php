@extends('adminlte::page')

@section('title', 'Dashboard')
@section('plugins.Select2', true)
@section('plugins.paceProgress', true)

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

@stop

@section('js')
<script> 
$(document).ready(function() {
    var srcImgLogo = $('.brand-image');
    srcImgLogo.attr('src', 'img/' + '{{ $klinik->file_logo ?? '' }}');
});

</script>
@stop