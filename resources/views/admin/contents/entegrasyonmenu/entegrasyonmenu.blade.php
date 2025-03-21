@extends('admin.layouts.app')
@section('title')
    Entegrasyonlar
@endsection
@section('contents')
@section('topheader')
    Entegrasyonlar
@endsection
<style>
    .card {


        border-radius: 10px;
        /* Köşeleri yuvarla */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Hafif gölge efekti */
        overflow: hidden;
        /* Köşelerden taşmaları engelle */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        /* Üzerine gelince hafif yukarı kaydır */
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        /* Daha belirgin gölge */
    }




    .card-title {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    .btn-primary {
        font-size: 14px;
        padding: 8px 15px;
        border-radius: 20px;
        /* Butonu yuvarla */
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        /* Üzerine gelince rengi değiştir */
    }
</style>
<div class="container">
    <div class="row justify-content-center ">
        <style>
            .custom-col {
                flex: 0 0 calc(20% - 10px);
                /* 20% genişlik ve aralar için boşluk */
                max-width: calc(20% - 10px);
                margin: 5px;
                /* Kartlar arası boşluk */
            }
        </style>
        <div class="custom-col">
            <a href="{{route('smsapi')}}">
                <div class="card">
                    <img src="{{ asset('resim/1.png') }}" class="card-img-top">
                    <div class="card-body d-flex flex-column align-items-stretch">
                        <h5 class="card-title" style="font-size: 15px">Öztek SMS Entegrasyonu</h5>
                        {{-- <a  style="border-radius: 0px" class="btn btn-sm btn-primary " href="">
                        Rapor Al
                    </a> --}}
                        {{-- <a href="#" class="btn btn-primary">Rapor Al</a> --}}
                    </div>
                </div>
            </a>
        </div>
        <div class="custom-col">
            <a href="{{route('smtp')}}">
            <div class="card">
                <img src="{{ asset('resim/2.png') }}" class="card-img-top">
                <div class="card-body d-flex flex-column align-items-stretch">
                    <h5 class="card-title" style="font-size: 15px">SMTP Mail Entegrasyonu</h5>
                    {{-- <button type="button" style="border-radius: 0px" class="btn btn-sm btn-primary"
                        data-bs-toggle="modal" data-bs-target="#satisraporModal">
                        Rapor Al
                    </button> --}}
                </div>
            </div>
        </a>

        </div>
        <div class="custom-col">
            <a href="{{route('efaturaapi')}}">

            <div class="card">
                <img src="{{ asset('resim/3.png') }}" class="card-img-top">
                <div class="card-body d-flex flex-column align-items-stretch">
                    <h5 class="card-title" style="font-size: 15px">Rahat Fatura Entegrasyonu</h5>
                    {{-- <button type="button" style="border-radius: 0px" class="btn btn-sm btn-primary"
                        data-bs-toggle="modal" data-bs-target="#alisraporModal">
                        Rapor Al
                    </button> --}}
                </div>
            </div>
        </a>

        </div>



    </div>
@endsection
