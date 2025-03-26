@extends('admin.layouts.app')
@section('title')
    ANA MENÜ
@endsection
@section('topheader')
    ANA MENÜ
@endsection
@section('contents')



<style>
    .abc{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
</style>


    <div class="card">
        <div class="card-header py-3">
            <div class="row g-3 d-flex align-items-center">
                <div class="col-12 col-lg-4 col-md-6 me-auto">
                    <h5 class="mb-1">Modüller 2</h5>
                </div>
                <div class="col-12 col-lg-3 col-6 col-md-3 d-flex">

                <div class="ms-auto position-relative">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3 "></div>
                    <input style="height: 27px; border-radius: 5px; border-color:#293445 " class="form-control ps-5" type="text" placeholder="Search...">
                  </div>
                </div>
                {{-- <div class="d-flex align-items-center" >
                    <form class="position-relative" id="searchForm" action="{{ route('tekliflersearch') }}" method="GET">
                      <div class="position-absolute top-50 translate-middle-y search-icon px-3 " ><i class="bi bi-search"></i></div>
                      <input   id="searchInput" class="form-control ps-5" type="text" placeholder="Search">
                    </form>
                </div> --}}

            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mt-4 mb-4">
                    <h5 style="text-align: center">
                        Çukurova Modüller
                    </h5>
                    <p style="text-align: center; ">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto, reprehenderit eveniet. Id voluptates eligendi quas sunt ab magni accusamus officiis molestias nostrum ipsum qui nihil laudantium, hic quos .</p>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-xl-2 row-cols-xxl-6" style="padding: 0 40px">
                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow "  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-pink border-0">
                                    <svg style="color: darkpink" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">Cariler</h6>
                                </div>
                                <div>
                                    <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow"  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-purple border-0" style="border-radius: 10px;">
                                    <i class="lni lni-files" style="color: purple"></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">Teklifler</h6>
                                </div>
                                <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow"  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-primary border-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">İnsan Kaynakları</h6>
                                </div>
                                <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow"  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-primary border-0">
                                    <i class="bi bi-person text-primary" ></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">İdari İşler</h6>
                                </div>
                                <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow"  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-primary border-0">
                                    <i class="bi bi-person text-primary" ></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">Entegrasyonlar</h6>
                                </div>
                                <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow"  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-primary border-0">
                                    <i class="bi bi-person text-primary" ></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">Kargo Takip</h6>
                                </div>
                                <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow"  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-primary border-0">
                                    <i class="bi bi-person text-primary" ></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">Resmi Evraklar</h6>
                                </div>
                                <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow"  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-primary border-0">
                                    <i class="bi bi-person text-primary" ></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">Formlar</h6>
                                </div>
                                <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow"  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-primary border-0">
                                    <i class="bi bi-person text-primary" ></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">Marka Takip</h6>
                                </div>
                                <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow"  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-primary border-0">
                                    <i class="bi bi-person text-primary" ></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">İtiraz Takip</h6>
                                </div>
                                <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow"  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-primary border-0">
                                    <i class="bi bi-person text-primary" ></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">Makine Bakım</h6>
                                </div>
                                <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow"  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-primary border-0">
                                    <i class="bi bi-person text-primary" ></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">Banka</h6>
                                </div>
                                <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow"  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-primary border-0">
                                    <i class="bi bi-person text-primary" ></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">Kasa</h6>
                                </div>
                                <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow"  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-primary border-0">
                                    <i class="bi bi-person text-primary" ></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">Satış</h6>
                                </div>
                                <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow"  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-primary border-0">
                                    <i class="bi bi-person text-primary" ></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">Satın Alma</h6>
                                </div>
                                <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow"  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-primary border-0">
                                    <i class="bi bi-person text-primary" ></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">Tahsilat</h6>
                                </div>
                                <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow"  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-primary border-0">
                                    <i class="bi bi-person text-primary" ></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">Ödeme</h6>
                                </div>
                                <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow"  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-primary border-0">
                                    <i class="bi bi-person text-primary" ></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">Çek/Senet</h6>
                                </div>
                                <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow"  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-primary border-0">
                                    <i class="bi bi-person text-primary" ></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">Personel</h6>
                                </div>
                                <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card ads border shadow-none radius-10">
                        <div class="card-body box-shadow"  style="padding: 5px">
                            <div class="d-flex abc">
                                <div class="icon-box bg-light-primary border-0">
                                    <i class="bi bi-person text-primary" ></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">İzinler</h6>
                                </div>
                                <i class="fadeIn animated bx bx-caret-right" style="background: rgb(234, 232, 232); padding: 10px 1px; color:gray; border-radius:5px; "></i>
                            </div>
                        </div>
                    </div>
                </div>



            </div><!--end row-->
































            {{-- <div class="custom-container">
                <a href="{{ route('cariler.index') }}">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/cariler.svg') }}">
                        </div>
                        <p class="text">Cariler</p>
                    </div>
                </a>
                <a href="{{ route('teklifler.index') }}">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/teklifler.svg') }}">
                        </div>
                        <p class="text">Teklifler</p>
                    </div>
                </a>
                <a href="{{ route('muhasebemenu') }}"> <div class="icon-box-content">
            <div class="box-img">
                <img class="icon" src="{{ asset('resim/muhasebe.svg') }}">
            </div>
            <p class="text">Muhasebe</p>
        </div>
        </a>
                <a href="{{ route('ikmenu') }}">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/insankaynaklari.svg') }}">
                        </div>
                        <p class="text">İnsan Kaynakları</p>
                    </div>
                </a>
                <a href="{{ route('idariislermenu') }}">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/idariisler.svg') }}">
                        </div>
                        <p class="text">İdari İşler</p>
                    </div>
                </a>
                <a href="{{ route('entegrasyonmenu') }}">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/entegrasyonlar.svg') }}">
                        </div>
                        <p class="text">Entegrasyonlar</p>
                    </div>
                </a>
                <a href="{{ route('kargotakip.index') }}">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/kargotakip.svg') }}">
                        </div>
                        <p class="text">Kargo Takip</p>
                    </div>
                </a>
                <a href="{{ route('resmievraklarr.index') }}">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/resmievraklar.svg') }}">
                        </div>
                        <p class="text">Resmi Evraklar</p>
                    </div>
                </a>
                <a href="#">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/formlar.svg') }}">
                        </div>
                        <p class="text">Formlar</p>
                    </div>
                </a>
                <a href="{{ route('markatakip.index') }}">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/markatakip.svg') }}">
                        </div>
                        <p class="text">Marka Takip</p>
                    </div>
                </a>
                <a href="">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/itiraztakip.svg') }}">
                        </div>
                        <p class="text">İtiraz Takip</p>
                    </div>
                </a>
                <a href="">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/makine.svg') }}">
                        </div>
                        <p class="text">Makine Bakım Onarım</p>
                    </div>
                </a>
                <a href="{{ route('bankalar.index') }}">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/kasalar.svg') }}">
                        </div>
                        <p class="text">Banka</p>
                    </div>
                </a>
                <a href="{{ route('kasalar.index') }}">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/banka.svg') }}">
                        </div>
                        <p class="text">Kasa</p>
                    </div>
                </a>
                <a href="{{ route('satislar.index') }}">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/satis.svg') }}">
                        </div>
                        <p class="text">Satış</p>
                    </div>
                </a>
                <a href="{{ route('alislar.index') }}">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/alis.svg') }}">
                        </div>
                        <p class="text">Satın Alma</p>
                    </div>
                </a>
                <a href="{{ route('tahsilat.index') }}">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/tahsilat.svg') }}">
                        </div>
                        <p class="text">Tahsilat</p>
                    </div>
                </a>
                <a href="{{ route('odemeler.index') }}">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/odeme.svg') }}">
                        </div>
                        <p class="text">Ödeme</p>
                    </div>
                </a>
                <a href="{{ route('ceksenet.index') }}">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/ceksenet.svg') }}">
                        </div>
                        <p class="text">Çek/Senet</p>
                    </div>
                </a>
                <a href="{{ route('personell.index') }}">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/personel.svg') }}">
                        </div>
                        <p class="text">Personel</p>
                    </div>
                </a>
                <a href="{{ route('izinler.index') }}">
                    <div class="icon-box-content">
                        <div class="box-img">
                            <img class="icon" src="{{ asset('resim/izinler.svg') }}">
                        </div>
                        <p class="text">İzinler</p>
                    </div>
                </a>
            </div> --}}

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
