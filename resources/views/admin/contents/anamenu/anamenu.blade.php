@extends('admin.layouts.app')
@section('title')
    ANA MENÜ
@endsection
@section('topheader')
    ANA MENÜ
@endsection
@section('contents')
    <style>
     /* Genel Container */
.custom-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 1px;
}

/* Responsive Grid */
@media screen and (min-width: 640px) {
    .custom-container {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media screen and (min-width: 768px) {
    .custom-container {
        grid-template-columns: repeat(6, 1fr);
    }
}

/* İkon Kutusu */
.icon-box-content {
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.icon-box-content:hover {
    transform: translateY(-5px);
}

/* Box İçindeki İkon */
.box-img {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    box-shadow: 0px 10px 20px rgba(106, 17, 203, 0.3);
    border-radius: 16px;
    width: 90px;
    height: 90px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    transition: all 0.3s ease;
}

.icon-box-content:hover .box-img {
    background: linear-gradient(135deg, #2575fc, #6a11cb);
    box-shadow: 0px 15px 25px rgba(37, 117, 252, 0.4);
}

/* İkon */
.icon {
    width: 52px;
    height: 52px;
    filter: brightness(1.2);
}

/* Yazı */
.text {
    margin-top: 10px;
    font-size: 16px;
    font-weight: bold;
    color: #333;
    letter-spacing: 0.5px;
    transition: color 0.3s ease;
}

.icon-box-content:hover .text {
    color: #2575fc;
}

    </style>
    <div class="custom-container">
       <a href="{{ route('cariler.index') }}"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/cariler.svg') }}">
            </div>
            <p class="text">Cariler</p>
        </div>
        </a>
       <a href="{{ route('teklifler.index') }}"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/teklifler.svg') }}">
            </div>
            <p class="text">Teklifler</p>
        </div>
        </a>
       {{-- <a href="{{ route('muhasebemenu') }}"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/muhasebe.svg') }}">
            </div>
            <p class="text">Muhasebe</p>
        </div>
        </a> --}}
       <a href="{{ route('ikmenu') }}"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/insankaynaklari.svg') }}">
            </div>
            <p class="text">İnsan Kaynakları</p>
        </div>
        </a>
       <a href="{{ route('idariislermenu') }}"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/idariisler.svg') }}">
            </div>
            <p class="text">İdari İşler</p>
        </div>
        </a>
       <a href="{{ route('entegrasyonmenu') }}"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/entegrasyonlar.svg') }}">
            </div>
            <p class="text">Entegrasyonlar</p>
        </div>
        </a>
       <a href="{{route('kargotakip.index')}}"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/kargotakip.svg') }}">
            </div>
            <p class="text">Kargo Takip</p>
        </div>
        </a>
       <a href="{{route('resmievraklarr.index')}}"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/resmievraklar.svg') }}">
            </div>
            <p class="text">Resmi Evraklar</p>
        </div>
        </a>
       <a href="#"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/formlar.svg') }}">
            </div>
            <p class="text">Formlar</p>
        </div>
        </a>
       <a href="{{route('markatakip.index')}}"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/markatakip.svg') }}">
            </div>
            <p class="text">Marka Takip</p>
        </div>
        </a>
       <a href=""> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/itiraztakip.svg') }}">
            </div>
            <p class="text">İtiraz Takip</p>
        </div>
        </a>
       <a href=""> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/makine.svg') }}">
            </div>
            <p class="text">Makine Bakım Onarım</p>
        </div>
        </a>
        <a href="{{route('bankalar.index')}}"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/kasalar.svg') }}">
            </div>
            <p class="text">Banka</p>
        </div>
        </a>
        <a href="{{route('kasalar.index')}}"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/banka.svg') }}">
            </div>
            <p class="text">Kasa</p>
        </div>
        </a>
        <a href="{{route('satislar.index')}}"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/satis.svg') }}">
            </div>
            <p class="text">Satış</p>
        </div>
        </a>
        <a href="{{route('alislar.index')}}"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/alis.svg') }}">
            </div>
            <p class="text">Satın Alma</p>
        </div>
        </a>
        <a href="{{route('tahsilat.index')}}"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/tahsilat.svg') }}">
            </div>
            <p class="text">Tahsilat</p>
        </div>
        </a>
        <a href="{{route('odemeler.index')}}"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/odeme.svg') }}">
            </div>
            <p class="text">Ödeme</p>
        </div>
        </a>
        <a href="{{route('ceksenet.index')}}"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/ceksenet.svg') }}">
            </div>
            <p class="text">Çek/Senet</p>
        </div>
        </a>
        <a href="{{route('personell.index')}}"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/personel.svg') }}">
            </div>
            <p class="text">Personel</p>
        </div>
        </a>
        <a href="{{route('izinler.index')}}"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/izinler.svg') }}">
            </div>
            <p class="text">İzinler</p>
        </div>
        </a>
    </div>

{{--
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
    </style> --}}
    {{-- <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
                <a href="{{ route('cariler.index') }}" type="button">
                    <div class="card">
                        <img src="{{ asset('resim/1.png') }}" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title">Cariler</h5>

                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
                <a href="{{ route('teklifler.index') }}" type="button">
                    <div class="card">
                        <img src="{{ asset('resim/2.png') }}" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title">Teklifler</h5>

                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
                <a href="{{ route('muhasebemenu') }}" type="button">
                    <div class="card">
                        <img src="{{ asset('resim/3.png') }}" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title">Muhasebe</h5>

                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
                <a href="{{ route('ikmenu') }}" type="button">
                    <div class="card">
                        <img src="{{ asset('resim/4.png') }}" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title">İnsan Kaynakları</h5>

                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
                <a href="{{ route('idariislermenu') }}" type="button">
                    <div class="card">
                        <img src="{{ asset('resim/5.png') }}" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title">İdari İşler</h5>

                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
                <a href="{{ route('entegrasyonmenu') }}" type="button">
                    <div class="card">
                        <img src="{{ asset('resim/6.png') }}" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title">Entegrasyonlar</h5>

                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
                <a href="#" type="button">
                    <div class="card">
                        <img src="{{ asset('resim/7.png') }}" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title">Kargo Takip</h5>

                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
                <a href="{{ route('resmievraklarr.index') }}" type="button">
                    <div class="card">
                        <img src="{{ asset('resim/8.png') }}" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title">Resmi Evraklar</h5>

                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
                <a href="#" type="button">
                    <div class="card">
                        <img src="{{ asset('resim/9.png') }}" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title">Formlar</h5>

                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
                <a href="{{ route('markatakip.index') }}" type="button">
                    <div class="card">
                        <img src="{{ asset('resim/10.png') }}" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title">Marka Takip</h5>

                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
                <a href="{{ route('itiraztakipp.index') }}" type="button">
                    <div class="card">
                        <img src="{{ asset('resim/11.png') }}" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title">İtiraz Takip</h5>

                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
                <a href="{{ route('makinemenu') }}" type="button">
                    <div class="card">
                        <img src="{{ asset('resim/12.png') }}" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title">Makine Bak. Onarım</h5>

                        </div>
                    </div>
                </a>
            </div>


        </div>
    </div> --}}
@endsection
