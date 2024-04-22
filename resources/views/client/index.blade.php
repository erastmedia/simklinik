@extends('adminlte::page')

@section('title', 'Member Area')
@section('plugins.Select2', true)

@section('content_header')
    <h1>Member Area</h1>
@stop

@section('content')
    <p>Name: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

@stop

@section('js')
<script> 
$(document).ready(function() {
});
</script>
@stop