@extends('admin.layouts.app')
@section('title')
İNSAN KAYNAKLARI
@endsection
@section('topheader')
İNSAN KAYNAKLARI
@endsection
@section('contents')

<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
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
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
            <a href="{{route('personell.index')}}" type="button"  >
            <div class="card">
                <img src="{{ asset('resim/1.png') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Personel Özlük</h5>

                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
            <a href="#" type="button"  >
            <div class="card">
                <img src="{{ asset('resim/2.png') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">İzinler</h5>

                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
            <a href="#" type="button"  >
            <div class="card">
                <img src="{{ asset('resim/3.png') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Personel Ödemeleri</h5>

                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
            <a href="#" type="button"  >
            <div class="card">
                <img src="{{ asset('resim/4.png') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Zimmetler</h5>

                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
            <a href="#" type="button"  >
            <div class="card">
                <img src="{{ asset('resim/5.png') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">İş Başvuruları</h5>

                    </div>
                </div>
            </a>
        </div>



    </div>
</div>



@endsection
