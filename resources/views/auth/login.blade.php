@extends('adminlte::auth.login')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .card-title {
            float: left;
            font-size: 0.9rem;
            font-weight: 600;
            margin: 0;
        }
        .card-footer {
            display: none!important;
        }
        label {
            margin-left: .3rem!important;
        }
        .btn.btn-block.btn-flat.btn-primary .fas.fa-sign-in-alt::before {
            /* Menambahkan margin kanan pada ikon */
            margin-right: .3rem;
        }

    </style>
@stop