@extends('admin.layouts.app')
@section('title')
    Raporlar
@endsection
@section('contents')
@section('topheader')
    Raporlar
@endsection
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
        font-size: 13px;
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
            <div class="card">
                <img src="{{ asset('resim/1.png') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Cari Hesap Ekstresi</h5>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#carihesapmodal">
                        Rapor Al
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
            <div class="card">
                <img src="{{ asset('resim/2.png') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Satış Rapor</h5>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#satisraporModal">
                        Rapor Al
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
            <div class="card">
                <img src="{{ asset('resim/3.png') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Alış Rapor</h5>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#alisraporModal">
                        Rapor Al
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
            <div class="card">
                <img src="{{ asset('resim/4.png') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Tahsilat Rapor</h5>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tahsilatraporModal">
                        Rapor Al
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
            <div class="card">
                <img src="{{ asset('resim/5.png') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Ödeme Rapor</h5>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#odemeraporModal">
                        Rapor Al
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
            <div class="card">
                <img src="{{ asset('resim/6.png') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Gider Rapor</h5>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#giderraporModal">
                        Rapor Al
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
            <div class="card">
                <img src="{{ asset('resim/7.png') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Kasa Rapor</h5>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kasaraporModal">
                        Rapor Al
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
            <div class="card">
                <img src="{{ asset('resim/8.png') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Banka Rapor</h5>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#bankaraporModal">
                        Rapor Al
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
            <div class="card">
                <img src="{{ asset('resim/9.png') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Borç Takip Rapor</h5>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#borctakipmodal">
                        Rapor Al
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
            <div class="card">
                <img src="{{ asset('resim/10.png') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Hizmet Bazlı Per. Raporu</h5>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#personelhizmetModal">
                        Rapor Al
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
            <div class="card">
                <img src="{{ asset('resim/11.png') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">KDV Rapor</h5>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kdvraporModal">
                        Rapor Al
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-3">
            <div class="card">
                <img src="{{ asset('resim/12.png') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Arama Rapor</h5>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#aramaraporModal">
                        Rapor Al
                    </button>
                </div>
            </div>
        </div>

        <!-- Diğer kartlar buraya benzer şekilde eklenir -->

    </div>
</div>



    <!--CARİHESAPEKSTRE Modal -->
    <div class="modal fade" id="carihesapmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-form" action="{{ route('carihesaprapor.index') }}" method="GET">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Cari Hesap Ekstresi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 3%; ">
                            <div class="row">
                                <div class="col-md-12 select2-sm">
                                    <label for="cari_id">Firma</label>
                                    <select name="cari_id" id="cari_id_modal1"
                                        style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                        <!-- Dinamik veriler buraya yüklenecek -->
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="ilk_tarih">İlk Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="ilk_tarih" id="ilk_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="son_tarih">Son Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="son_tarih" id="son_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" id="submit-form"
                            class="btn btn-outline-primary btn-sm ">Sorgula</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--SATİSRAPOR Modal -->
    <div class="modal fade" id="satisraporModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-form" action="{{ route('satisrapor.index') }}" method="GET">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Satış Rapor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 3%; ">
                            <div class="row">
                                <div class="col-md-12 select2-sm">
                                    <label for="cari_id">Firma</label>
                                    <select name="cari_id" id="cari_id_modal2"
                                        style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                        <!-- Dinamik veriler buraya yüklenecek -->
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="islem_yapan">Satış Temsilcisi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <select name="islem_yapan" id="islem_yapan" class="form-select form-select-sm" >
                                            <option value="">Lütfen Seçim Yapınız</option>
                                            @foreach ($user as $useritem)
                                                <option value="{{ $useritem->id }}">{{ $useritem->ad_soyad }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="ilk_tarih">İlk Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="ilk_tarih" id="ilk_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="son_tarih">Son Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="son_tarih" id="son_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" id="submit-form"
                            class="btn btn-outline-primary btn-sm ">Sorgula</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- ALIŞŞRAPOR MODALL --}}
    <div class="modal fade" id="alisraporModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-form" action="{{ route('alisrapor.index') }}" method="GET">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Alış Rapor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 3%; ">
                            <div class="row">
                                <div class="col-md-12 select2-sm">
                                    <label for="cari_id">Firma</label>
                                    <select name="cari_id" id="cari_id_modal3"
                                        style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                        <!-- Dinamik veriler buraya yüklenecek -->
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="ilk_tarih">İlk Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="ilk_tarih" id="ilk_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="son_tarih">Son Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="son_tarih" id="son_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" id="submit-form"
                            class="btn btn-outline-primary btn-sm ">Sorgula</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- TAHSİLATRAPOR MODALL --}}
    <div class="modal fade" id="tahsilatraporModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-form" action="{{ route('tahsilatrapor.index') }}" method="GET">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Tahsilat Rapor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 3%; ">
                            <div class="row">
                                <div class="col-md-12 select2-sm">
                                    <label for="cari_id">Firma</label>
                                    <select name="cari_id" id="cari_id_modal4"
                                        style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                        <!-- Dinamik veriler buraya yüklenecek -->
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="ilk_tarih">İlk Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="ilk_tarih" id="ilk_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="son_tarih">Son Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="son_tarih" id="son_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" id="submit-form"
                            class="btn btn-outline-primary btn-sm ">Sorgula</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- ÖDEMERAPOR MODALL --}}
    <div class="modal fade" id="odemeraporModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-form" action="{{ route('odemerapor.index') }}" method="GET">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Ödeme Rapor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 3%; ">
                            <div class="row">
                                <div class="col-md-12 select2-sm">
                                    <label for="cari_id">Firma</label>
                                    <select name="cari_id" id="cari_id_modal5"
                                        style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                        <!-- Dinamik veriler buraya yüklenecek -->
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="ilk_tarih">İlk Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="ilk_tarih" id="ilk_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="son_tarih">Son Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="son_tarih" id="son_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" id="submit-form"
                            class="btn btn-outline-primary btn-sm ">Sorgula</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- GİDERRAPOR MODALL --}}
    <div class="modal fade" id="giderraporModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-form" action="{{ route('giderrapor.index') }}" method="GET">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Gider Rapor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 3%; ">
                            <div class="row">
                                <div class="col-md-12 select2-sm">
                                    <label for="cari_id">Firma</label>
                                    <select name="cari_id" id="cari_id_modal6"
                                        style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                        <!-- Dinamik veriler buraya yüklenecek -->
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="ilk_tarih">İlk Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="ilk_tarih" id="ilk_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="son_tarih">Son Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="son_tarih" id="son_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" id="submit-form"
                            class="btn btn-outline-primary btn-sm ">Sorgula</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- KASARAPOR MODALL --}}
    <div class="modal fade" id="kasaraporModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-form" action="{{ route('kasarapor.index') }}" method="GET">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Kasa Rapor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 3%; ">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="kasa_id">Kasalar</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-money-bill-wave"></i>
                                        </span>
                                        <select class="form-select form-select-sm" name="kasa_id" id="kasa_id">
                                            <option value="">Tüm Kasalar</option>
                                            @foreach ($kasalar as $item)
                                                <option value="{{ $item->id }}">{{ $item->kasa_adi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="ilk_tarih">İlk Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="ilk_tarih" id="ilk_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="son_tarih">Son Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="son_tarih" id="son_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" id="submit-form"
                            class="btn btn-outline-primary btn-sm ">Sorgula</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- BANKARAPOR MODALL --}}
    <div class="modal fade" id="bankaraporModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-form" action="{{ route('bankarapor.index') }}" method="GET">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Banka Rapor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 3%; ">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="kasa_id">Bankalar</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-money-bill-wave"></i>
                                        </span>
                                        <select class="form-select form-select-sm" name="banka_id" id="banka_id">
                                            <option value="">Tüm Banklar</option>
                                            @foreach ($bankalar as $item)
                                                <option value="{{ $item->id }}">{{ $item->banka_adi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="ilk_tarih">İlk Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="ilk_tarih" id="ilk_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="son_tarih">Son Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="son_tarih" id="son_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" id="submit-form"
                            class="btn btn-outline-primary btn-sm ">Sorgula</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
      <!--BORÇ TAKİP Modal -->
      <div class="modal fade" id="borctakipmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-form" action="{{ route('borctakiprapor.index') }}" method="GET">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Borç Takip Rapor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 3%; ">
                            <div class="row">
                                <div class="col-md-12 select2-sm">
                                    <label for="cari_id">Firma</label>
                                    <select name="cari_id" id="cari_id_modal7"
                                        style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                        <!-- Dinamik veriler buraya yüklenecek -->
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="ilk_tarih">İlk Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="ilk_tarih" id="ilk_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="son_tarih">Son Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="son_tarih" id="son_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" id="submit-form"
                            class="btn btn-outline-primary btn-sm ">Sorgula</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
      <!--PERSONEL HİZMET Modal -->
      <div class="modal fade" id="personelhizmetModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-form" action="{{ route('hizmetbazlipersonelrapor.index') }}" method="GET">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Hizmet Bazlı Personel Rapor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 3%; ">
                            <div class="row">
                                <div class="col-md-12 select2-sm">
                                    <label for="cari_id">Firma</label>
                                    <select name="cari_id" id="cari_id_modal9"
                                        style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                        <!-- Dinamik veriler buraya yüklenecek -->
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="islem_yapan">Satış Temsilcisi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <select name="islem_yapan" id="islem_yapan" class="form-select form-select-sm" >
                                            <option value="">Lütfen Seçim Yapınız</option>
                                            @foreach ($user as $useritem)
                                                <option value="{{ $useritem->id }}">{{ $useritem->ad_soyad }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="satis_temsilcisi">Hizmet Türü</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-check-circle"></i>
                                        </span>
                                        <select name="hizmet_kategori" id="hizmet_kategori" class="form-select form-select-sm hizmetlerkategori-select" >
                                            <option value="">Lütfen Seçim Yapınız</option>
                                            @foreach ($hizmetkategori as $hizmetkategoriitem)
                                                <option value="{{ $hizmetkategoriitem->id }}">{{ $hizmetkategoriitem->kategori_ad }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="satis_temsilcisi">Hizmet Adı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-check-circle"></i>
                                        </span>
                                        <select name="hizmet_adi" id="hizmet_adi" class="form-select form-select-sm hizmet_id-select" >
                                            <option value="">Hizmet Seçin</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="il">İl</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-city"></i>
                                        </span>
                                        <select name="il" id="il" class="form-select form-select-sm"
                                             onchange="firma_ilceListele()">
                                            <option value="">İl Seçin</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <label for="ilk_tarih">İlk Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="ilk_tarih" id="ilk_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="son_tarih">Son Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="son_tarih" id="son_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" id="submit-form"
                            class="btn btn-outline-primary btn-sm ">Sorgula</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
     <!--KDV Modal -->
     <div class="modal fade" id="kdvraporModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-form" action="{{ route('kdvrapor.index') }}" method="GET">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">KDV Rapor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 3%; ">
                            <div class="row">
                                <div class="col-md-12 select2-sm">
                                    <label for="cari_id">Firma</label>
                                    <select name="cari_id" id="cari_id_modal8"
                                        style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                        <!-- Dinamik veriler buraya yüklenecek -->
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="ilk_tarih">İlk Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="ilk_tarih" id="ilk_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="son_tarih">Son Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="son_tarih" id="son_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" id="submit-form"
                            class="btn btn-outline-primary btn-sm ">Sorgula</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--ARAMARapor Modal -->
    <div class="modal fade" id="aramaraporModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-form" action="{{ route('aramarapor.index') }}" method="GET">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Arama Rapor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 3%; ">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="arama_tipi">Arama Tipi<code>*</code></label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-phone"></i>
                                        </span>
                                        <select name="arama_tipi" id="arama_tipi" class="form-select form-select-sm" >
                                            <option value="">Lütfen Seçim Yapınız</option>
                                            <option value="Gelen Arama">Gelen Arama</option>
                                            <option value="Giden Arama">Giden Arama</option>
                                            <option value="Müşteri Ziyareti">Müşteri Ziyareti</option>
                                            <option value="İnternet">İnternet</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="islem_yapan">Arama Yapan</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <select name="islem_yapan" id="islem_yapan" class="form-select form-select-sm" >
                                            <option value="">Lütfen Seçim Yapınız</option>
                                            @foreach ($user as $useritem)
                                                <option value="{{ $useritem->id }}">{{ $useritem->ad_soyad }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="il">İl</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-city"></i>
                                        </span>
                                        <select name="il" id="firma_il" class="form-select form-select-sm"
                                             onchange="firma_ilceListele()">
                                            <option value="">İl Seçin</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="ilk_tarih">İlk Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="ilk_tarih" id="ilk_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="son_tarih">Son Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="son_tarih" id="son_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" id="submit-form"
                            class="btn btn-outline-primary btn-sm ">Sorgula</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<script src="{{ asset('custom/customjs/city.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('change', '.hizmetlerkategori-select', function() {
    var hizmetlerkategoriId = $(this).val();
    var selectElement = $('#hizmet_adi'); // Doğrudan ID ile seçiyoruz

    if (hizmetlerkategoriId) {
        $.ajax({
            url: '/get-hizmetler-by-kategori/' + hizmetlerkategoriId,
            type: 'GET',
            success: function(data) {
                selectElement.empty();
                selectElement.append('<option value="">Hizmet Seçin</option>');
                data.forEach(function(hizmet) {
                    selectElement.append('<option value="' + hizmet.id + '">' + hizmet.hizmet_ad + '</option>');
                });
            },
            error: function() {
                alert('Hizmet listesi yüklenirken bir hata oluştu.');
            }
        });
    } else {
        selectElement.empty();
        selectElement.append('<option value="">Hizmet Seçin</option>');
    }
});


    </script>
    <script>
        $(document).ready(function() {
            // Birinci modal için Select2
            $('#cari_id_modal1').select2({
                theme: 'bootstrap4',
                placeholder: "Firma Seçiniz",
                allowClear: true,
                minimumInputLength: 3,
                width: '100%',
                ajax: {
                    url: '/cari-search',
                    type: 'GET',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.firma_unvan
                                };
                            })
                        };
                    },
                    cache: true
                },
                dropdownParent: $('#carihesapmodal'),
                language: {
                    inputTooShort: function() {
                        return "Lütfen en az 3 karakter girin.";
                    },
                    noResults: function() {
                        return "Sonuç bulunamadı.";
                    }
                }
            });
            // Select2 açıldığında arama inputuna otomatik odaklanma
        $('#cari_id_modal1').on('select2:open', function() {
            setTimeout(() => {
                let searchField = $('.select2-container--open .select2-search__field');
                if (searchField.length) {
                    searchField[0].focus();
                }
            }, 150); // 50 yerine 150 ms bekleyelim
        });

            // İkinci modal için Select2
            $('#cari_id_modal2').select2({
                theme: 'bootstrap4',
                placeholder: "Firma Seçiniz",
                allowClear: true,
                minimumInputLength: 3,
                width: '100%',
                ajax: {
                    url: '/cari-search',
                    type: 'GET',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.firma_unvan
                                };
                            })
                        };
                    },
                    cache: true
                },
                dropdownParent: $('#satisraporModal'),
                language: {
                    inputTooShort: function() {
                        return "Lütfen en az 3 karakter girin.";
                    },
                    noResults: function() {
                        return "Sonuç bulunamadı.";
                    }
                }
            });
    // Select2 açıldığında arama inputuna otomatik odaklanma
    $('#cari_id_modal2').on('select2:open', function() {
            setTimeout(() => {
                let searchField = $('.select2-container--open .select2-search__field');
                if (searchField.length) {
                    searchField[0].focus();
                }
            }, 150); // 50 yerine 150 ms bekleyelim
        });
            $('#cari_id_modal3').select2({
                theme: 'bootstrap4',
                placeholder: "Firma Seçiniz",
                allowClear: true,
                minimumInputLength: 3,
                width: '100%',
                ajax: {
                    url: '/cari-search',
                    type: 'GET',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.firma_unvan
                                };
                            })
                        };
                    },
                    cache: true
                },
                dropdownParent: $('#alisraporModal'),
                language: {
                    inputTooShort: function() {
                        return "Lütfen en az 3 karakter girin.";
                    },
                    noResults: function() {
                        return "Sonuç bulunamadı.";
                    }
                }
            });
             // Select2 açıldığında arama inputuna otomatik odaklanma
    $('#cari_id_modal3').on('select2:open', function() {
            setTimeout(() => {
                let searchField = $('.select2-container--open .select2-search__field');
                if (searchField.length) {
                    searchField[0].focus();
                }
            }, 150); // 50 yerine 150 ms bekleyelim
        });
            $('#cari_id_modal4').select2({
                theme: 'bootstrap4',
                placeholder: "Firma Seçiniz",
                allowClear: true,
                minimumInputLength: 3,
                width: '100%',
                ajax: {
                    url: '/cari-search',
                    type: 'GET',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.firma_unvan
                                };
                            })
                        };
                    },
                    cache: true
                },
                dropdownParent: $('#tahsilatraporModal'),
                language: {
                    inputTooShort: function() {
                        return "Lütfen en az 3 karakter girin.";
                    },
                    noResults: function() {
                        return "Sonuç bulunamadı.";
                    }
                }
            });
             // Select2 açıldığında arama inputuna otomatik odaklanma
    $('#cari_id_modal4').on('select2:open', function() {
            setTimeout(() => {
                let searchField = $('.select2-container--open .select2-search__field');
                if (searchField.length) {
                    searchField[0].focus();
                }
            }, 150); // 50 yerine 150 ms bekleyelim
        });
            $('#cari_id_modal5').select2({
                theme: 'bootstrap4',
                placeholder: "Firma Seçiniz",
                allowClear: true,
                minimumInputLength: 3,
                width: '100%',
                ajax: {
                    url: '/cari-search',
                    type: 'GET',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.firma_unvan
                                };
                            })
                        };
                    },
                    cache: true
                },
                dropdownParent: $('#odemeraporModal'),
                language: {
                    inputTooShort: function() {
                        return "Lütfen en az 3 karakter girin.";
                    },
                    noResults: function() {
                        return "Sonuç bulunamadı.";
                    }
                }
            });
             // Select2 açıldığında arama inputuna otomatik odaklanma
    $('#cari_id_modal5').on('select2:open', function() {
            setTimeout(() => {
                let searchField = $('.select2-container--open .select2-search__field');
                if (searchField.length) {
                    searchField[0].focus();
                }
            }, 150); // 50 yerine 150 ms bekleyelim
        });
            $('#cari_id_modal6').select2({
                theme: 'bootstrap4',
                placeholder: "Firma Seçiniz",
                allowClear: true,
                minimumInputLength: 3,
                width: '100%',
                ajax: {
                    url: '/cari-search',
                    type: 'GET',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.firma_unvan
                                };
                            })
                        };
                    },
                    cache: true
                },
                dropdownParent: $('#giderraporModal'),
                language: {
                    inputTooShort: function() {
                        return "Lütfen en az 3 karakter girin.";
                    },
                    noResults: function() {
                        return "Sonuç bulunamadı.";
                    }
                }
            });
             // Select2 açıldığında arama inputuna otomatik odaklanma
    $('#cari_id_modal6').on('select2:open', function() {
            setTimeout(() => {
                let searchField = $('.select2-container--open .select2-search__field');
                if (searchField.length) {
                    searchField[0].focus();
                }
            }, 150); // 50 yerine 150 ms bekleyelim
        });
            $('#cari_id_modal7').select2({
                theme: 'bootstrap4',
                placeholder: "Firma Seçiniz",
                allowClear: true,
                minimumInputLength: 3,
                width: '100%',
                ajax: {
                    url: '/cari-search',
                    type: 'GET',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.firma_unvan
                                };
                            })
                        };
                    },
                    cache: true
                },
                dropdownParent: $('#borctakipmodal'),
                language: {
                    inputTooShort: function() {
                        return "Lütfen en az 3 karakter girin.";
                    },
                    noResults: function() {
                        return "Sonuç bulunamadı.";
                    }
                }
            });
             // Select2 açıldığında arama inputuna otomatik odaklanma
    $('#cari_id_modal7').on('select2:open', function() {
            setTimeout(() => {
                let searchField = $('.select2-container--open .select2-search__field');
                if (searchField.length) {
                    searchField[0].focus();
                }
            }, 150); // 50 yerine 150 ms bekleyelim
        });
            $('#cari_id_modal8').select2({
                theme: 'bootstrap4',
                placeholder: "Firma Seçiniz",
                allowClear: true,
                minimumInputLength: 3,
                width: '100%',
                ajax: {
                    url: '/cari-search',
                    type: 'GET',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.firma_unvan
                                };
                            })
                        };
                    },
                    cache: true
                },
                dropdownParent: $('#kdvraporModal'),
                language: {
                    inputTooShort: function() {
                        return "Lütfen en az 3 karakter girin.";
                    },
                    noResults: function() {
                        return "Sonuç bulunamadı.";
                    }
                }
            });
             // Select2 açıldığında arama inputuna otomatik odaklanma
    $('#cari_id_modal8').on('select2:open', function() {
            setTimeout(() => {
                let searchField = $('.select2-container--open .select2-search__field');
                if (searchField.length) {
                    searchField[0].focus();
                }
            }, 150); // 50 yerine 150 ms bekleyelim
        });
            $('#cari_id_modal9').select2({
                theme: 'bootstrap4',
                placeholder: "Firma Seçiniz",
                allowClear: true,
                minimumInputLength: 3,
                width: '100%',
                ajax: {
                    url: '/cari-search',
                    type: 'GET',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.firma_unvan
                                };
                            })
                        };
                    },
                    cache: true
                },
                dropdownParent: $('#personelhizmetModal'),
                language: {
                    inputTooShort: function() {
                        return "Lütfen en az 3 karakter girin.";
                    },
                    noResults: function() {
                        return "Sonuç bulunamadı.";
                    }
                }
            });
             // Select2 açıldığında arama inputuna otomatik odaklanma
    $('#cari_id_modal9').on('select2:open', function() {
            setTimeout(() => {
                let searchField = $('.select2-container--open .select2-search__field');
                if (searchField.length) {
                    searchField[0].focus();
                }
            }, 150); // 50 yerine 150 ms bekleyelim
        });

        });
    </script>


@endsection
