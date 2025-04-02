<!doctype html>
<html lang="tr" class="minimal-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" href="{{asset('logintemp/favicon.ico')}}" type="image/png" />
  <!--plugins-->
  <link href="{{asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />

  <link href="{{asset('assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
  <!-- Bootstrap CSS -->
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet" />

  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link href="https://db.onlinewebfonts.com/c/390289fedd068780e28c0f9f259c3782?family=ITC+Bauhaus+Medium" rel="stylesheet">
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap');
    </style>
  {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" /> --}}


{{-- <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">--}}
<!-- DataTables Buttons CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
  {{-- <!-- datatable-->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"> --}}

  <!-- loader-->
	<link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" />


  <!--Theme Styles-->
  <link href="{{asset('assets/css/dark-theme.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/light-theme.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/semi-dark.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/header-colors.css')}}" rel="stylesheet" />

  <title>@yield('title') - ÇUKUROVA ERP</title>
  <!-- CSS: DataTable'ın default stilini kapatmak için -->
<style>
    /* DataTable'ın varsayılan stilini tamamen kaldırmak */
    .dataTables_wrapper {
        width: 100%;
        margin: 0;
    }

    .dataTables_length, .dataTables_filter, .dataTables_info, .dataTables_paginate {
        display: none; /* Sayfa uzunluğu, arama kutusu, vb. gizlenir */
    }

    /* Tabloyu kendi tasarımınıza göre özelleştirin */
    table.dataTable {
        width: 100%;
        border-collapse: collapse;
    }


</style>

  <style>

    /* input:invalid{
        border-color: red;
    }
    input:valid{
        border-color: green;
    } */
    @media print {
        body {
            font-size: 6px;
            font-family: "DejaVu Sans Mono", monospace;
            padding-left: 30px;
            padding-right: 30px; /* Sağ boşluk */
            padding-top: 30px;
            padding-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 1px;
        }

        th,
        td {
            font-size: 6px;
            word-wrap: break-word;
            padding: 1px;
            text-align: center;
        }

        h1 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 7px;
        }

        th {
            background-color: #f2f2f2;
        }

        table th:first-child,
        table td:first-child {
            width: 7px !important;
            word-wrap: break-word;
        }

        table th {
            background-color: #f8f9fa;
            color: #333;
        }


    }
    </style>
</head>

<body>
<!--start wrapper-->
<div class="wrapper">
