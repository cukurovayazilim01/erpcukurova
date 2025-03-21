@extends('admin.layouts.app')
@section('title')
    Firma Karnesi
@endsection
@section('contents')
@section('topheader')
    Firma Karnesi
@endsection
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="pill" href="#iletisim" role="tab"
                            aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-microphone font-18 me-1'></i>
                                </div>
                                <div class="tab-title">İletişim</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="pill" href="#teklifler" role="tab"
                            aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-file font-18 me-1'></i>
                                </div>
                                <div class="tab-title">Teklifler</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="pill" href="#satislar" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-file font-18 me-1'></i>
                                </div>
                                <div class="tab-title">Satışlar</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="pill" href="#tahsilat" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-file font-18 me-1'></i>
                                </div>
                                <div class="tab-title">Tahsilatlar</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="pill" href="#alislar" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-file font-18 me-1'></i>
                                </div>
                                <div class="tab-title">Alışlar</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="pill" href="#odemeler" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-file font-18 me-1'></i>
                                </div>
                                <div class="tab-title">Ödemeler</div>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="text-end">
                    <a type="button" target="_blank"
                        href="https://wa.me/+90{{$cariler->yetkili_kisi_tel}}?text=Merhaba, işte vekaletname belgeniz: {{ asset('gereklidosyalar/Cukurova_Vekaletname_Turkce.pdf') }}"
                        class="btn btn-sm btn-success">
                        <i class="fa-solid fa-file-pdf" style="font-size: 18px"></i> Vekaletname Gönder
                    </a>

                    <a type="button"
                        href="{{ route('carihesaprapor.al', ['_token' => csrf_token(), 'cari_id' => $cariler]) }}"
                        class="btn btn-sm btn-danger ">
                        <i class="fa-solid fa-file-pdf" style="font-size: 18px"></i> Hesap Ekstresi Al
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="card" style="background: transparent; box-shadow: none;">
    <div class="card-body">
        <div class="tab-content" id="pills-tabContent">


            <div class="tab-pane fade show active" id="iletisim" role="tabpanel">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card " style="margin-top: -1.5rem; box-shadow: none">
                            <div class="card shadow-sm border-0 overflow-hidden">
                                <div class="card-body">

                                    <div class="text-center mt-4">
                                        <h4 class="mb-1" style="font-size: 20px">{{ $cariler->firma_unvan }}</h4>
                                        <p class="mb-0 text-secondary">{{ $cariler->yetkili_kisi }}</p>
                                        <div class="mt-4"></div>

                                        {{-- <h6 class="mb-1">HR Manager - Codervent Technology</h6>
                                        <p class="mb-0 text-secondary">University of Information Technology</p> --}}
                                    </div>
                                    <hr>
                                    <div class="text-start">
                                        <h5 class="">Adres</h5>
                                        <p class="mb-0">{{ $cariler->adres }}
                                        </p>
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-top">
                                        Telefon
                                        <span>{{ $cariler->yetkili_kisi_tel }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        E-Posta
                                        <span>{{ $cariler->eposta }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Müşteri Temsilcisi
                                        <span>{{ $cariler->musteri_temsilcisi }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Vergi No
                                        <span>{{ $cariler->vergi_no }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Vergi Dairesi
                                        <span>{{ $cariler->vergi_dairesi }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        T.C Kimlik No
                                        <span>{{ $cariler->tc_kimlik }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        İl
                                        <span>{{ $cariler->il }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        İlçe
                                        <span>{{ $cariler->ilce }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Firma Tipi
                                        <span>{{ $cariler->firma_tipi }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Firma Durumu
                                        <span>{{ $cariler->firma_durumu }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Web Adresi
                                        <span>{{ $cariler->web_adres }}</span>
                                    </li>
                                    @php
                                        $borc_toplam = 0;
                                        $alacak_toplam = 0;
                                        $sonuc = 0;
                                    @endphp
                                    @foreach ($firmahrkt as $firmahrktitem)
                                        @php
                                            $borc_toplam += $firmahrktitem->borc;
                                            $alacak_toplam += $firmahrktitem->alacak;
                                            $sonuc = $borc_toplam - $alacak_toplam;
                                        @endphp
                                    @endforeach

                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Kalan Bakiye
                                        <span>{{ number_format($sonuc, 2, ',', '.') }} <b
                                                style="color: red">₺</b></span>
                                    </li>

                                </ul>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card" style="margin-top: -1.5rem">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Arama Listesi</h5>
                                <button type="button" class="btn btn-sm btn-outline-primary px-5"
                                    data-bs-toggle="modal" data-bs-target="#carilershowaramamodal">
                                    <i class="fa-solid fa-plus"></i> Yeni Ekle
                                </button>
                            </div>
                            <!-- Modal Yapısı -->
                            <div class="modal fade" id="carilershowaramamodal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">{{ $cariler->firma_unvan }} Arama Ekleme Ekranı
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="modal-body">
                                            <form id="add-form" action="{{ route('aramaEkle', ['id' => $cariler->id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <!-- Left Side -->
                                                <div class="col-md-12" style=" padding: 1%; ">
                                                    <div class="row">
                                                        <div class="col-md-12" style="display: none">
                                                            <label for="hatirlat_tarihi">url</label>
                                                            <div class="form-group input-with-icon">
                                                                <span class="icon">
                                                                    <i class="fa-solid fa-location-dot"></i>
                                                                </span>
                                                                <input type="text" name="url" id="url"
                                                                    class="form-control form-control-sm"
                                                                    value="{{ url()->current() }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12" style="display: none">
                                                            <label for="hatirlat_tarihi">Cariid</label>
                                                            <div class="form-group input-with-icon">
                                                                <span class="icon">
                                                                    <i class="fa-solid fa-location-dot"></i>
                                                                </span>
                                                                <input type="text" name="cari_id" id="cari_id"
                                                                    class="form-control form-control-sm"
                                                                    value="{{ $cariler->id }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="hizmet_turu">Hizmet Türü<code>*</code></label>
                                                            <div class="form-group input-with-icon">
                                                                <span class="icon">
                                                                    <i class="fa-solid fa-phone"></i>
                                                                </span>
                                                                <select name="hizmet_turu" id="hizmet_turu"
                                                                    class="form-select form-select-sm">
                                                                    <option value="">Lütfen Seçim Yapınız
                                                                    </option>
                                                                    <option value="Marka">Marka</option>
                                                                    <option value="ISO">ISO</option>
                                                                    <option value="WEB">WEB</option>
                                                                    <option value="Domain">Domain</option>
                                                                    <option value="ERP">ERP</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="arama_tipi">Arama Tipi</label>
                                                            <div class="form-group input-with-icon">
                                                                <span class="icon">
                                                                    <i class="fa-solid fa-phone"></i>
                                                                </span>
                                                                <select name="arama_tipi" id="arama_tipi"
                                                                    class="form-select form-select-sm">
                                                                    <option value="">Lütfen Seçim Yapınız
                                                                    </option>
                                                                    <option value="Gelen Arama">Gelen Arama</option>
                                                                    <option value="Giden Arama">Giden Arama</option>
                                                                    <option value="Müşteri Ziyareti">Müşteri Ziyareti
                                                                    </option>
                                                                    <option value="İnternet">İnternet</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="hatirlat_durumu">Hatırlatma Durumu</label>
                                                            <div class="form-group input-with-icon">
                                                                <span class="icon">
                                                                    <i class="fa fa-check"></i>
                                                                </span>
                                                                <select name="hatirlat_durumu" id="hatirlat_durumu"
                                                                    class="form-select form-select-sm">
                                                                    <option value="">Lütfen Seçim Yapınız
                                                                    </option>
                                                                    <option value="Olumlu">Olumlu</option>
                                                                    <option value="Olumsuz">Olumsuz</option>
                                                                    <option value="Düşünüyor">Düşünüyor</option>
                                                                    <option value="Standart Kayıt">Standart Kayıt
                                                                    </option>
                                                                    <option value="Ziyaret Bekliyor">Ziyaret Bekliyor
                                                                    </option>
                                                                    <option value="Aranacak">Aranacak</option>
                                                                    <option value="Kara Liste">Kara Liste</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="hatirlat_tarihi">Hatırlatma Tarihi</label>
                                                            <div class="form-group input-with-icon">
                                                                <span class="icon">
                                                                    <i class="fa-solid fa-calendar-days"></i>
                                                                </span>
                                                                <input type="date" name="hatirlat_tarihi"
                                                                    id="hatirlat_tarihi"
                                                                    class="form-control form-control-sm" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="not">Görüşme Notu</label>
                                                            <textarea name="not" id="not" class="form-control" rows="4"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal Footer -->
                                                <div class="modal-footer bg-light">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary"
                                                        data-bs-dismiss="modal">Vazgeç</button>
                                                    <button type="submit" id="submit-form"
                                                        class="btn btn-outline-primary btn-sm ">Kaydet</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="row">
                                    @foreach ($aramalar as $aramaitem)
                                        <div class="col-md-3">
                                            <div class="card shadow-sm border-0 rounded"
                                                style="border-radius: 15px; overflow: hidden; background-color: #f9f9f9;">
                                                <div class="card-body border-bottom d-flex justify-content-between align-items-center"
                                                    style="padding: 5px 10px;">
                                                    <h5 class="card-title d-flex align-items-center"
                                                        style="font-size: 13px; font-weight: bold; color: #333; margin: 0;">
                                                        @if ($aramaitem->arama_tipi === 'Gelen Arama')
                                                            <i class="fa fa-arrow-down text-primary me-2"
                                                                style="font-size: 13px;" aria-hidden="true"></i>
                                                        @elseif ($aramaitem->arama_tipi === 'Giden Arama')
                                                            <i class="fa fa-arrow-up text-success me-2"
                                                                style="font-size: 13px;" aria-hidden="true"></i>
                                                        @elseif ($aramaitem->arama_tipi === 'Müşteri Ziyareti')
                                                            <i class="fa-solid fa-user text-warning me-2"
                                                                style="font-size: 13px;" aria-hidden="true"></i>
                                                        @elseif ($aramaitem->arama_tipi === 'İnternet')
                                                            <i class="fa-solid fa-globe text-info me-2"
                                                                style="font-size: 13px;" aria-hidden="true"></i>
                                                        @endif
                                                        {{ $aramaitem->arama_tipi }}
                                                    </h5>
                                                    <form
                                                        action="{{ route('aramaSilshow', ['id' => $aramaitem->id]) }}"
                                                        method="POST" style="margin: 0;">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm show_confirm"
                                                            style="font-size: 11px; padding: 5px 15px; border-radius: 5px;">
                                                            <i class="fa fa-trash me-1" aria-hidden="true"
                                                                style="font-size: 16px;"></i> Sil
                                                        </button>
                                                    </form>
                                                </div>

                                                <ul class="list-group list-group-flush" style="padding: 0 20px;">
                                                    <li class="list-group-item"
                                                        style="border: none; padding: 1px 0; background-color: transparent; padding-top: 15px">
                                                        <textarea name="aciklama" id="aciklama" cols="20" rows="5"
                                                            class="form-control form-control-sm border-0 shadow-sm rounded-3" readonly
                                                            style="background-color: #f0f0f0; font-size: 11px; color: #333; resize: none;">{{ $aramaitem->not }}</textarea>
                                                    </li>
                                                    <li class="list-group-item"
                                                        style="border: none; padding: 5px 0; background-color: #f9f9f9;">
                                                        <div class="row text-left">
                                                            <div class="col-12">
                                                                <p class="mb-1"
                                                                    style="color: #555; font-size: 11px; font-weight: 500;">
                                                                    <i class="fa fa-calendar-alt mr-2"
                                                                        aria-hidden="true"
                                                                        style="font-size: 11px; color: #007bff;"></i>
                                                                    {{ $aramaitem->islem_tarihi }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="mb-1"
                                                                    style="color: #555; font-size: 11px; font-weight: 500;">
                                                                    <i class="fa fa-user mr-2" aria-hidden="true"
                                                                        style="font-size: 11px; color: #28a745;"></i>
                                                                    {{ $aramaitem->adsoyad->ad_soyad }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="mb-1"
                                                                    style="color: #555; font-size: 11px; font-weight: 500;">
                                                                    <i class="fa fa-check-circle mr-2"
                                                                        aria-hidden="true"
                                                                        style="font-size: 11px; color: #ffc107;"></i>
                                                                    {{ $aramaitem->hatirlat_durumu }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="mb-1"
                                                                    style="color: #555; font-size: 11px; font-weight: 500;">
                                                                    <i class="fa fa-bell mr-2" aria-hidden="true"
                                                                        style="font-size: 11px; color: #17a2b8;"></i>
                                                                    {{ $aramaitem->hatirlat_tarihi }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>

                        <div style="height: 20px;"></div>


                        <div class="card" style="margin-top: -1.5rem">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Kontak Listesi</h5>
                                <button type="button" class="btn btn-sm btn-outline-primary px-5"
                                    data-bs-toggle="modal" data-bs-target="#carilerkontakeklemodal"><i
                                        class="fa-solid fa-plus"></i>Yeni Ekle</button>
                            </div>


                            <div class="card-body">
                                <div class="row">
                                    @foreach ($kontak as $kontakitem)
                                        <div class="col-md-4 mb-4">
                                            <div class="card bg-secondary text-white border-0 shadow-lg radius-10"
                                                style="background: linear-gradient(to bottom right, #6C757D, #f8f9fa );">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <h5 class="mb-1 ">{{ $kontakitem->yetkili_isim }}</h5>
                                                            <p class="mb-0">{{ $kontakitem->telefon }}</p>
                                                        </div>
                                                        <div class="ms-auto">
                                                            <i class="fa-solid fa-user fs-4"></i>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3 d-flex justify-content-end gap-2">
                                                        <button type="button" class="btn btn-sm btn-outline-light"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#carilerkontakguncellemodal{{ $kontakitem->id }}">
                                                            <i class="fa fa-pencil-alt"></i> Güncelle
                                                        </button>
                                                        <!-- KONTAKGÜNCELLE Modal -->
                                                        <div class="modal fade"
                                                            id="carilerkontakguncellemodal{{ $kontakitem->id }}"
                                                            tabindex="-1" aria-labelledby="updateModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-primary text-white">
                                                                        <h5 class="modal-title">
                                                                            {{ $cariler->firma_unvan }} Kontak
                                                                            Güncelleme Ekranı</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('kontakGuncelle', $kontakitem->id) }}"
                                                                            method="POST"
                                                                            enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('put')

                                                                            <!-- Left Side -->
                                                                            <div class="col-md-12"
                                                                                style=" padding: 1%; ">
                                                                                <div class="row">
                                                                                    <div class="col-md-12"
                                                                                        style="display: none">
                                                                                        <label
                                                                                            for="hatirlat_tarihi">url</label>
                                                                                        <div
                                                                                            class="form-group input-with-icon">
                                                                                            <span class="icon">
                                                                                                <i
                                                                                                    class="fa-solid fa-location-dot"></i>
                                                                                            </span>
                                                                                            <input type="text"
                                                                                                name="url"
                                                                                                id="url"
                                                                                                class="form-control form-control-sm"
                                                                                                value="{{ url()->current() }}"
                                                                                                required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12"
                                                                                        style="display: none">
                                                                                        <label
                                                                                            for="hatirlat_tarihi">Cariid</label>
                                                                                        <div
                                                                                            class="form-group input-with-icon">
                                                                                            <span class="icon">
                                                                                                <i
                                                                                                    class="fa-solid fa-location-dot"></i>
                                                                                            </span>
                                                                                            <input type="text"
                                                                                                name="cari_id"
                                                                                                id="cari_id"
                                                                                                class="form-control form-control-sm"
                                                                                                value="{{ $cariler->id }}"
                                                                                                required>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-12">
                                                                                        <label for="yetkili_isim"
                                                                                            style="color: #333">Yetkili
                                                                                            Kişi
                                                                                            İsim</label>
                                                                                        <div
                                                                                            class="form-group input-with-icon">
                                                                                            <span class="icon">
                                                                                                <i
                                                                                                    class="fa-solid fa-user"></i>
                                                                                            </span>
                                                                                            <input type="text"
                                                                                                name="yetkili_isim"
                                                                                                id="yetkili_isim"
                                                                                                class="form-control form-control-sm"
                                                                                                required
                                                                                                value="{{ $kontakitem->yetkili_isim }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label for="telefon"
                                                                                            style="color: #333">Yetkili
                                                                                            Kişi Telefon</label>
                                                                                        <div
                                                                                            class="form-group input-with-icon">
                                                                                            <span class="icon">
                                                                                                <i
                                                                                                    class="fa-solid fa-phone"></i>
                                                                                            </span>
                                                                                            <input type="number"
                                                                                                name="telefon"
                                                                                                id="telefon"
                                                                                                class="form-control form-control-sm no-zero"
                                                                                                required
                                                                                                value="{{ $kontakitem->telefon }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label for="telefon"
                                                                                            style="color: #333">Yetkili
                                                                                            Kişi E-Posta</label>
                                                                                        <div
                                                                                            class="form-group input-with-icon">
                                                                                            <span class="icon">
                                                                                                <i
                                                                                                    class="fa-solid fa-envelope"></i>
                                                                                            </span>
                                                                                            <input type="email"
                                                                                                name="eposta"
                                                                                                id="eposta"
                                                                                                class="form-control form-control-sm no-zero"
                                                                                                required  oninput="this.value = this.value.toLowerCase()"
                                                                                                value="{{ $kontakitem->eposta }}">
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            <!-- Modal Footer -->
                                                                            <div class="modal-footer bg-light">
                                                                                <button type="button"
                                                                                    class="btn btn-sm btn-outline-secondary"
                                                                                    data-bs-dismiss="modal">Vazgeç</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-outline-primary btn-sm ">Kaydet</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form
                                                            action="{{ route('kontakSilme', ['id' => $kontakitem->id]) }}"
                                                            method="POST" style="margin: 0;">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger">
                                                                <i class="fa fa-trash"></i> Sil
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Kontakekle Modal -->
                            <div class="modal fade" id="carilerkontakeklemodal" tabindex="-1"
                                aria-labelledby="updateModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">{{ $cariler->firma_unvan }} Kontak Ekleme Ekranı
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('kontakEkle', ['id' => $cariler->id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <!-- Left Side -->
                                                <div class="col-md-12" style=" padding: 1%; ">
                                                    <div class="row">
                                                        <div class="col-md-12" style="display: none">
                                                            <label for="hatirlat_tarihi">url</label>
                                                            <div class="form-group input-with-icon">
                                                                <span class="icon">
                                                                    <i class="fa-solid fa-location-dot"></i>
                                                                </span>
                                                                <input type="text" name="url" id="url"
                                                                    class="form-control form-control-sm"
                                                                    value="{{ url()->current() }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12" style="display: none">
                                                            <label for="hatirlat_tarihi">Cariid</label>
                                                            <div class="form-group input-with-icon">
                                                                <span class="icon">
                                                                    <i class="fa-solid fa-location-dot"></i>
                                                                </span>
                                                                <input type="text" name="cari_id" id="cari_id"
                                                                    class="form-control form-control-sm"
                                                                    value="{{ $cariler->id }}" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label for="yetkili_isim">Yetkili Kişi İsim</label>
                                                            <div class="form-group input-with-icon">
                                                                <span class="icon">
                                                                    <i class="fa-solid fa-user"></i>
                                                                </span>
                                                                <input type="text" name="yetkili_isim"
                                                                    id="yetkili_isim"
                                                                    class="form-control form-control-sm" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="telefon">Yetkili Kişi Telefon</label>
                                                            <div class="form-group input-with-icon">
                                                                <span class="icon">
                                                                    <i class="fa-solid fa-phone"></i>
                                                                </span>
                                                                <input type="number" name="telefon" id="telefon"
                                                                    class="form-control form-control-sm no-zero"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="telefon">Yetkili Kişi E-Posta</label>
                                                            <div class="form-group input-with-icon">
                                                                <span class="icon">
                                                                    <i class="fa-solid fa-envelope"></i>
                                                                </span>
                                                                <input type="email" name="eposta" id="eposta"
                                                                    class="form-control form-control-sm no-zero"
                                                                    oninput="this.value = this.value.toLowerCase()" required>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- Modal Footer -->
                                                <div class="modal-footer bg-light">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary"
                                                        data-bs-dismiss="modal">Vazgeç</button>
                                                    <button type="submit"
                                                        class="btn btn-outline-primary btn-sm ">Kaydet</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Doküman Listesi</h5>
                                <button type="button" class="btn btn-sm btn-outline-primary px-5"
                                    data-bs-toggle="modal" data-bs-target="#carilerdokumaneklemodal"><i
                                        class="fa-solid fa-plus"></i>Yeni Ekle</button>
                            </div>
                            <div class="card-body">
                                <table class="table align-middle mb-0 dataTable" id="example2" role="grid"
                                    aria-describedby="example_info">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th>Tarih</th>
                                            <th>Dokümanı Ekleyen</th>
                                            <th>Doküman Adı</th>
                                            <th>Doküman</th>
                                            <th>Açıklama</th>
                                            <th>Sil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dokuman as $sn => $dokumanitem)
                                            <tr>
                                                <th scope="row">{{ $sn + 1 }}</th>
                                                <td>{{ $dokumanitem->islem_tarihi }}</td>
                                                <td>{{ $dokumanitem->user->ad_soyad }}</td>
                                                <td>{{ $dokumanitem->dosya_adi }}</td>
                                                <td>
                                                    @if ($dokumanitem->dosya_yolu)
                                                        @php
                                                            $fileExtension = pathinfo(
                                                                $dokumanitem->dosya_yolu,
                                                                PATHINFO_EXTENSION,
                                                            );
                                                        @endphp

                                                        @if (strtolower($fileExtension) === 'pdf')
                                                            <a href="{{ asset($dokumanitem->dosya_yolu) }}"
                                                                target="_blank" style="color: red">
                                                                <i class="bi bi-file-earmark-pdf"
                                                                    style="color: red;"></i> Görüntüle
                                                            </a>
                                                        @else
                                                            <a href="{{ asset($dokumanitem->dosya_yolu) }}"
                                                                target="_blank">
                                                                <i class="bi bi-image"></i> Görüntüle
                                                            </a>
                                                        @endif
                                                    @else
                                                        <span class="text-muted">Resim Yok</span>
                                                    @endif
                                                </td>
                                                <td class="text-wrap " style="max-width: 400px">
                                                    {{ $dokumanitem->aciklama }}</td>
                                                <td class="text-right">
                                                    <div class="databutton">
                                                        <div class="d-flex align-items-center fs-6">
                                                            <form
                                                                action="{{ route('cariler.destroy', ['cariler' => $dokumanitem->id]) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-link text-danger p-0 m-0 show_confirm">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Doküman EKLE Modal -->
                            <div class="modal fade" id="carilerdokumaneklemodal" tabindex="-1"
                                aria-labelledby="updateModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">{{ $cariler->firma_unvan }} Doküman Ekleme Ekranı
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('dokumanEkle', ['id' => $cariler->id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <!-- Left Side -->
                                                <div class="col-md-12" style=" padding: 1%; ">
                                                    <div class="row">
                                                        <div class="col-md-12" style="display: none">
                                                            <label for="hatirlat_tarihi">Cariid</label>
                                                            <div class="form-group input-with-icon">
                                                                <span class="icon">
                                                                    <i class="fa-solid fa-location-dot"></i>
                                                                </span>
                                                                <input type="text" name="cari_id" id="cari_id"
                                                                    class="form-control form-control-sm"
                                                                    value="{{ $cariler->id }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="dosya_adi">Doküman Adı</label>
                                                            <div class="form-group input-with-icon">
                                                                <span class="icon">
                                                                    <i class="fa-solid fa-file"></i>
                                                                </span>
                                                                <input type="text" name="dosya_adi" id="dosya_adi"
                                                                    class="form-control form-control-sm" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="dosya_yolu">Doküman</label>
                                                            <div class="form-group input-with-icon">
                                                                <span class="icon">
                                                                    <i class="fa-solid fa-file"></i>
                                                                </span>
                                                                <input type="file" name="dosya_yolu"
                                                                    id="dosya_yolu"
                                                                    class="form-control form-control-sm" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="not">Doküman Açıklaması</label>
                                                            <textarea name="aciklama" id="aciklama" cols="20" rows="2" class="form-control form-control-sm "></textarea>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- Modal Footer -->
                                                <div class="modal-footer bg-light">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary"
                                                        data-bs-dismiss="modal">Vazgeç</button>
                                                    <button type="submit"
                                                        class="btn btn-outline-primary btn-sm ">Kaydet</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="teklifler" role="tabpanel">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card " style="margin-top: -1.5rem; box-shadow: none">
                            <div class="card shadow-sm border-0 overflow-hidden">
                                <div class="card-body">

                                    <div class="text-center mt-4">
                                        <h4 class="mb-1" style="font-size: 20px">{{ $cariler->firma_unvan }}</h4>
                                        <p class="mb-0 text-secondary">{{ $cariler->yetkili_kisi }}</p>
                                        <div class="mt-4"></div>

                                        {{-- <h6 class="mb-1">HR Manager - Codervent Technology</h6>
                                        <p class="mb-0 text-secondary">University of Information Technology</p> --}}
                                    </div>
                                    <hr>
                                    <div class="text-start">
                                        <h5 class="">Adres</h5>
                                        <p class="mb-0">{{ $cariler->adres }}
                                        </p>
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-top">
                                        Telefon
                                        <span>{{ $cariler->yetkili_kisi_tel }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        E-Posta
                                        <span>{{ $cariler->eposta }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Müşteri Temsilcisi
                                        <span>{{ $cariler->musteri_temsilcisi }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Vergi No
                                        <span>{{ $cariler->vergi_no }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Vergi Dairesi
                                        <span>{{ $cariler->vergi_dairesi }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        T.C Kimlik No
                                        <span>{{ $cariler->tc_kimlik }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        İl
                                        <span>{{ $cariler->il }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        İlçe
                                        <span>{{ $cariler->ilce }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Firma Tipi
                                        <span>{{ $cariler->firma_tipi }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Firma Durumu
                                        <span>{{ $cariler->firma_durumu }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Web Adresi
                                        <span>{{ $cariler->web_adres }}</span>
                                    </li>
                                    @php
                                        $borc_toplam = 0;
                                        $alacak_toplam = 0;
                                        $sonuc = 0;
                                    @endphp
                                    @foreach ($firmahrkt as $firmahrktitem)
                                        @php
                                            $borc_toplam += $firmahrktitem->borc;
                                            $alacak_toplam += $firmahrktitem->alacak;
                                            $sonuc = $borc_toplam - $alacak_toplam;
                                        @endphp
                                    @endforeach

                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Kalan Bakiye
                                        <span>{{ number_format($sonuc, 2, ',', '.') }} <b
                                                style="color: red">₺</b></span>
                                    </li>

                                </ul>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card" style="margin-top: -1.5rem">
                            <div class="card-body">

                                <div class="row">
                                    @foreach (['Bekleyen', 'Onaylanan', 'Reddedilen', 'Toplam'] as $item)
                                        @php
                                            $teklifListesi = $item == 'Toplam' ? $durumlar['Toplam'] : $durumlar[$item];
                                            $teklifSayisi = $teklifListesi->count();
                                            $renk = match ($item) {
                                                'Bekleyen' => 'warning',
                                                'Onaylanan' => 'success',
                                                'Reddedilen' => 'danger',
                                                'Toplam' => 'primary',
                                            };
                                        @endphp

                                        <div class="col-md-3">
                                            <div class="card radius-10 bg-{{ $renk }}">
                                                <div class="card-body">
                                                    <p class="mb-1 text-white">{{ $item }} Teklifler</p>
                                                    <h4 class="mb-0 text-white">
                                                        ₺{{ number_format($teklifListesi->sum('teklif_kdvli_toplam'), 2) }}
                                                    </h4>
                                                    {{-- <h4 class="mb-0 text-white">{{ $teklifSayisi }} Teklif</h4> --}}
                                                    <div class="mt-2">
                                                        <i class="bi bi-eye text-white"></i>
                                                        <span class="text-white"> {{ $item }} Teklif Sayısı:
                                                            {{ $teklifSayisi }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="card-header bg-transparent">
                                    <div class="row g-3 align-items-center">
                                        <div class="col">
                                            <div class="d-flex align-items-center justify-content-between gap-3">
                                                <div class="col-lg-2 col-6 col-md-3 text-start">
                                                    <h6>FİRMA TEKLİFLERİ</h6>
                                                </div>

                                                <div class="ms-auto">
                                                    <a type="button"
                                                        href="{{ route('teklifler.create', ['cari_id' => $cariler->id]) }}"
                                                        class="btn btn-sm btn-outline-primary px-5"><i
                                                            class="fa-solid fa-plus"></i>Teklif Ekle</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table align-middle mb-0" id="example2">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th>Teklif Kodu</th>
                                                    <th>Firma</th>
                                                    <th>Tarih</th>
                                                    <th>Toplam İskonto</th>
                                                    <th>KDV Tutar</th>
                                                    <th>Ara Toplam</th>
                                                    <th>Ödenecek Tutar</th>
                                                    <th>Teklif Durumu</th>
                                                    <th>Aksiyon</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($teklifler as $sn => $teklifleritem)
                                                    <tr>
                                                        <th scope="row">{{ $sn + 1 }}</th>
                                                        <th scope="row">
                                                            {{ $teklifleritem->teklif_kodu_text }}-{{ $teklifleritem->teklif_kodu }}
                                                        </th>
                                                        <td>{{ $teklifleritem->firmaadi->firma_unvan }}</td>
                                                        <td>{{ $teklifleritem->islem_tarihi }}</td>
                                                        <td>{{ number_format($teklifleritem->teklif_iskonto_toplam, 2, ',', '.') }}₺
                                                        </td>
                                                        <td>{{ number_format($teklifleritem->teklif_kdv_toplam, 2, ',', '.') }}₺
                                                        </td>
                                                        <td>{{ number_format($teklifleritem->teklif_ara_toplam, 2, ',', '.') }}₺
                                                        </td>
                                                        <td>{{ number_format($teklifleritem->teklif_kdvli_toplam, 2, ',', '.') }}₺
                                                        </td>
                                                        @if ($teklifleritem->durum === '0')
                                                            <td>Bekleyen Teklif</td>
                                                        @elseif ($teklifleritem->durum === '1')
                                                            <td>Onaylanan Teklif</td>
                                                        @elseif ($teklifleritem->durum === '2')
                                                            <td>Reddedilen Teklif</td>
                                                        @endif



                                                        <td class="text-right">
                                                            <div class="databutton">
                                                                <div class="d-flex align-items-center fs-6">
                                                                    {{-- @if (!Request::is('teklifler') && !Request::is('onaylananteklifler') && !Request::is('onaylanmayanteklifler'))
                                                                        <button class="btn btn-sm btn-outline-success open-modal-btn"
                                                                            style="margin-right: 3px" data-bs-toggle="modal"
                                                                            data-bs-target="#teklifislemmodal-{{ $teklifleritem->id }}">İşlemler</button>
                                                                        @include('admin.contents.teklifler.tekliflerdurum.teklifler-islem')
                                                                    @endif
                                                                    @if (Request::is('onaylananteklifler') || Request::is('onaylanmayanteklifler'))
                                                                        <button class="btn btn-sm btn-outline-danger open-modal-btn"
                                                                            style="margin-right: 3px" data-bs-toggle="modal"
                                                                            data-bs-target="#teklifislemmodal-{{ $teklifleritem->id }}">İptal Et</button>
                                                                        @include('admin.contents.teklifler.tekliflerdurum.teklifler-islem')

                                                                    @endif --}}

                                                                    <a href="{{ route('teklifler.show', ['teklifler' => $teklifleritem->id]) }}"
                                                                        class="text-primary btn btn-link p-0 m-0 ">
                                                                        <i class="bi bi-eye-fill"></i>
                                                                    </a>
                                                                    {{-- <a href="{{ route('teklifler.edit', ['teklifler' => $teklifleritem->id]) }}"
                                                                        class="text-warning btn btn-link p-0 m-0 ">
                                                                        <i class="bi bi-pencil-fill"></i>
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('teklifler.destroy', ['teklifler' => $teklifleritem->id]) }}"
                                                                        method="POST" style="display: inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-link text-danger p-0 m-0 show_confirm">
                                                                            <i class="bi bi-trash-fill"></i>
                                                                        </button>
                                                                    </form> --}}
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="satislar" role="tabpanel">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card " style="margin-top: -1.5rem; box-shadow: none">
                            <div class="card shadow-sm border-0 overflow-hidden">
                                <div class="card-body">

                                    <div class="text-center mt-4">
                                        <h4 class="mb-1" style="font-size: 20px">{{ $cariler->firma_unvan }}</h4>
                                        <p class="mb-0 text-secondary">{{ $cariler->yetkili_kisi }}</p>
                                        <div class="mt-4"></div>

                                        {{-- <h6 class="mb-1">HR Manager - Codervent Technology</h6>
                                        <p class="mb-0 text-secondary">University of Information Technology</p> --}}
                                    </div>
                                    <hr>
                                    <div class="text-start">
                                        <h5 class="">Adres</h5>
                                        <p class="mb-0">{{ $cariler->adres }}
                                        </p>
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-top">
                                        Telefon
                                        <span>{{ $cariler->yetkili_kisi_tel }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        E-Posta
                                        <span>{{ $cariler->eposta }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Müşteri Temsilcisi
                                        <span>{{ $cariler->musteri_temsilcisi }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Vergi No
                                        <span>{{ $cariler->vergi_no }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Vergi Dairesi
                                        <span>{{ $cariler->vergi_dairesi }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        T.C Kimlik No
                                        <span>{{ $cariler->tc_kimlik }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        İl
                                        <span>{{ $cariler->il }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        İlçe
                                        <span>{{ $cariler->ilce }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Firma Tipi
                                        <span>{{ $cariler->firma_tipi }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Firma Durumu
                                        <span>{{ $cariler->firma_durumu }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Web Adresi
                                        <span>{{ $cariler->web_adres }}</span>
                                    </li>
                                    @php
                                        $borc_toplam = 0;
                                        $alacak_toplam = 0;
                                        $sonuc = 0;
                                    @endphp
                                    @foreach ($firmahrkt as $firmahrktitem)
                                        @php
                                            $borc_toplam += $firmahrktitem->borc;
                                            $alacak_toplam += $firmahrktitem->alacak;
                                            $sonuc = $borc_toplam - $alacak_toplam;
                                        @endphp
                                    @endforeach

                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Kalan Bakiye
                                        <span>{{ number_format($sonuc, 2, ',', '.') }} <b
                                                style="color: red">₺</b></span>
                                    </li>

                                </ul>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card" style="margin-top: -1.5rem">
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="card radius-10 bg-primary">
                                            <div class="card-body" style="text-align: center">
                                                <p class="mb-1 text-white">Toplam Satışlar</p>
                                                <!-- Toplam Satış Tutarı -->
                                                <h4 class="mb-0 text-white">
                                                    <h4 class="mb-0 text-white">
                                                        ₺{{ number_format($satistutari, 2) }}
                                                    </h4>

                                                </h4>
                                                <!-- Toplam Satış Sayısı -->
                                                <div class="mt-2">
                                                    <i class="bi bi-eye text-white"></i>
                                                    <span class="text-white">Satış Sayısı: {{ $satissayisi }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header bg-transparent">
                                        <div class="row g-3 align-items-center">
                                            <div class="col">
                                                <div class="d-flex align-items-center justify-content-between gap-3">
                                                    <div class="col-lg-2 col-6 col-md-3 text-start">
                                                        <h6>FİRMA SATIŞLARI</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <table class="table align-middle mb-0" id="example2">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th>Satış Kodu</th>
                                                    <th>Firma</th>
                                                    <th>Tarih</th>
                                                    <th>Toplam İskonto</th>
                                                    <th>KDV Tutar</th>
                                                    <th>Ara Toplam</th>
                                                    <th>Ödenecek Tutar</th>
                                                    <th>Aksiyon</th>

                                                    {{-- <th>Aksiyon</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($satislar as $sn => $satislaritem)
                                                    <tr>
                                                        <th scope="row">{{ $sn + 1 }}</th>
                                                        <th scope="row">
                                                            {{ $satislaritem->satis->satis_kodu_text }}-{{ $satislaritem->satis->satis_kodu }}
                                                        </th>
                                                        <td>{{ $satislaritem->firmaadi->firma_unvan }}</td>
                                                        <td>{{ $satislaritem->satis->islem_tarihi }}</td>
                                                        <td>{{ number_format($satislaritem->satis->satis_iskonto_toplam, 2, ',', '.') }}₺
                                                        </td>
                                                        <td>{{ number_format($satislaritem->satis->satis_kdv_toplam, 2, ',', '.') }}₺
                                                        </td>
                                                        <td>{{ number_format($satislaritem->satis->satis_ara_toplam, 2, ',', '.') }}₺
                                                        </td>
                                                        <td>{{ number_format($satislaritem->satis->satis_kdvli_toplam, 2, ',', '.') }}₺
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="databutton">
                                                                <div class="d-flex align-items-center fs-6">

                                                                    <a href="{{ route('satislar.show', ['satislar' => $satislaritem->satis->id]) }}"
                                                                        class="text-primary btn btn-link p-0 m-0 ">
                                                                        <i class="bi bi-eye-fill"></i>
                                                                    </a>

                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="tab-pane fade" id="tahsilat" role="tabpanel">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card " style="margin-top: -1.5rem; box-shadow: none">
                            <div class="card shadow-sm border-0 overflow-hidden">
                                <div class="card-body">

                                    <div class="text-center mt-4">
                                        <h4 class="mb-1" style="font-size: 20px">{{ $cariler->firma_unvan }}</h4>
                                        <p class="mb-0 text-secondary">{{ $cariler->yetkili_kisi }}</p>
                                        <div class="mt-4"></div>

                                        {{-- <h6 class="mb-1">HR Manager - Codervent Technology</h6>
                                        <p class="mb-0 text-secondary">University of Information Technology</p> --}}
                                    </div>
                                    <hr>
                                    <div class="text-start">
                                        <h5 class="">Adres</h5>
                                        <p class="mb-0">{{ $cariler->adres }}
                                        </p>
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-top">
                                        Telefon
                                        <span>{{ $cariler->yetkili_kisi_tel }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        E-Posta
                                        <span>{{ $cariler->eposta }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Müşteri Temsilcisi
                                        <span>{{ $cariler->musteri_temsilcisi }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Vergi No
                                        <span>{{ $cariler->vergi_no }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Vergi Dairesi
                                        <span>{{ $cariler->vergi_dairesi }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        T.C Kimlik No
                                        <span>{{ $cariler->tc_kimlik }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        İl
                                        <span>{{ $cariler->il }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        İlçe
                                        <span>{{ $cariler->ilce }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Firma Tipi
                                        <span>{{ $cariler->firma_tipi }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Firma Durumu
                                        <span>{{ $cariler->firma_durumu }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Web Adresi
                                        <span>{{ $cariler->web_adres }}</span>
                                    </li>
                                    @php
                                        $borc_toplam = 0;
                                        $alacak_toplam = 0;
                                        $sonuc = 0;
                                    @endphp
                                    @foreach ($firmahrkt as $firmahrktitem)
                                        @php
                                            $borc_toplam += $firmahrktitem->borc;
                                            $alacak_toplam += $firmahrktitem->alacak;
                                            $sonuc = $borc_toplam - $alacak_toplam;
                                        @endphp
                                    @endforeach

                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Kalan Bakiye
                                        <span>{{ number_format($sonuc, 2, ',', '.') }} <b
                                                style="color: red">₺</b></span>
                                    </li>

                                </ul>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card" style="margin-top: -1.5rem">
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="card radius-10 bg-success">
                                            <div class="card-body" style="text-align: center">
                                                <p class="mb-1 text-white">Toplam Tahsilat</p>
                                                <!-- Toplam Satış Tutarı -->
                                                <h4 class="mb-0 text-white">
                                                    <h4 class="mb-0 text-white">
                                                        ₺{{ number_format($tahsilattutari, 2) }}
                                                    </h4>

                                                </h4>
                                                <!-- Toplam Satış Sayısı -->
                                                <div class="mt-2">
                                                    <i class="bi bi-eye text-white"></i>
                                                    <span class="text-white">Kalan Borç: ₺
                                                        {{ number_format($sonuc, 2) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header bg-transparent">
                                        <div class="row g-3 align-items-center">
                                            <div class="col">
                                                <div class="d-flex align-items-center justify-content-between gap-3">
                                                    <div class="col-lg-2 col-6 col-md-3 text-start">
                                                        <h6>FİRMA TAHSİLATLARI</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <table class="table align-middle mb-0" id="example2">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th>Tahsilat Kodu</th>
                                                    <th>Firma</th>
                                                    <th>Tarih</th>
                                                    <th>Ödeme Türü</th>
                                                    <th>Tahsilat Tutar</th>
                                                    <th>Aksiyon</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tahsilat as $sn => $tahsilatitem)
                                                    <tr>
                                                        <th scope="row">{{ $sn + 1 }}</th>
                                                        <th scope="row">
                                                            {{ $tahsilatitem->tahsilat->tahsilat_kodu_text }}-{{ $tahsilatitem->tahsilat->tahsilat_kodu }}
                                                        </th>
                                                        <td>{{ $tahsilatitem->firmaadi->firma_unvan }}</td>
                                                        <td>{{ $tahsilatitem->tahsilat->islem_tarihi }}</td>
                                                        <td>{{ $tahsilatitem->tahsilat->odeme_turu }}</td>

                                                        <td>{{ number_format($tahsilatitem->tahsilat->tahsilat_tutar, 2, ',', '.') }}
                                                            ₺
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="databutton">
                                                                <div class="d-flex align-items-center fs-6">

                                                                    <a href="{{ route('tahsilat.show', ['tahsilat' => $tahsilatitem->tahsilat->id]) }}"
                                                                        class="text-primary btn btn-link p-0 m-0 ">
                                                                        <i class="bi bi-eye-fill"></i>
                                                                    </a>

                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="alislar" role="tabpanel">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card " style="margin-top: -1.5rem; box-shadow: none">
                            <div class="card shadow-sm border-0 overflow-hidden">
                                <div class="card-body">

                                    <div class="text-center mt-4">
                                        <h4 class="mb-1" style="font-size: 20px">{{ $cariler->firma_unvan }}</h4>
                                        <p class="mb-0 text-secondary">{{ $cariler->yetkili_kisi }}</p>
                                        <div class="mt-4"></div>

                                        {{-- <h6 class="mb-1">HR Manager - Codervent Technology</h6>
                                        <p class="mb-0 text-secondary">University of Information Technology</p> --}}
                                    </div>
                                    <hr>
                                    <div class="text-start">
                                        <h5 class="">Adres</h5>
                                        <p class="mb-0">{{ $cariler->adres }}
                                        </p>
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-top">
                                        Telefon
                                        <span>{{ $cariler->yetkili_kisi_tel }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        E-Posta
                                        <span>{{ $cariler->eposta }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Müşteri Temsilcisi
                                        <span>{{ $cariler->musteri_temsilcisi }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Vergi No
                                        <span>{{ $cariler->vergi_no }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Vergi Dairesi
                                        <span>{{ $cariler->vergi_dairesi }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        T.C Kimlik No
                                        <span>{{ $cariler->tc_kimlik }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        İl
                                        <span>{{ $cariler->il }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        İlçe
                                        <span>{{ $cariler->ilce }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Firma Tipi
                                        <span>{{ $cariler->firma_tipi }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Firma Durumu
                                        <span>{{ $cariler->firma_durumu }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Web Adresi
                                        <span>{{ $cariler->web_adres }}</span>
                                    </li>
                                    @php
                                        $borc_toplam = 0;
                                        $alacak_toplam = 0;
                                        $sonuc = 0;
                                    @endphp
                                    @foreach ($firmahrkt as $firmahrktitem)
                                        @php
                                            $borc_toplam += $firmahrktitem->borc;
                                            $alacak_toplam += $firmahrktitem->alacak;
                                            $sonuc = $borc_toplam - $alacak_toplam;
                                        @endphp
                                    @endforeach

                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Kalan Bakiye
                                        <span>{{ number_format($sonuc, 2, ',', '.') }} <b
                                                style="color: red">₺</b></span>
                                    </li>

                                </ul>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card" style="margin-top: -1.5rem">
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="card radius-10 bg-primary">
                                            <div class="card-body" style="text-align: center">
                                                <p class="mb-1 text-white">Toplam Alışlar</p>
                                                <!-- Toplam Satış Tutarı -->
                                                <h4 class="mb-0 text-white">
                                                    <h4 class="mb-0 text-white">
                                                        ₺{{ number_format($alistutari, 2) }}
                                                    </h4>

                                                </h4>
                                                <!-- Toplam Satış Sayısı -->
                                                <div class="mt-2">
                                                    <i class="bi bi-eye text-white"></i>
                                                    <span class="text-white">Alış Sayısı: {{ $alissayisi }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header bg-transparent">
                                        <div class="row g-3 align-items-center">
                                            <div class="col">
                                                <div class="d-flex align-items-center justify-content-between gap-3">
                                                    <div class="col-lg-2 col-6 col-md-3 text-start">
                                                        <h6>FİRMA ALIŞLARI</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <table class="table align-middle mb-0" id="example2">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th>Alış Kodu</th>
                                                    <th>Firma Ünvanı</th>
                                                    <th>Tarih</th>
                                                    <th>Toplam İskonto</th>
                                                    <th>KDV Tutar</th>
                                                    <th>Ara Toplam</th>
                                                    <th>Ödenecek Tutar</th>
                                                    <th>Aksiyon</th>

                                                    {{-- <th>Aksiyon</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($alislar as $sn => $alislaritem)
                                                <tr>
                                                    <th scope="row">{{ $sn + 1 }}</th>
                                                    <th scope="row">
                                                        {{ $alislaritem->alis->alis_kodu_text }}-{{ $alislaritem->alis->alis_kodu }}
                                                    </th>
                                                    <td>{{ $alislaritem->firmaadi->firma_unvan }}</td>
                                                    <td>{{ $alislaritem->alis->islem_tarihi }}</td>
                                                    <td>{{ number_format($alislaritem->alis->toplam_iskonto, 2, ',', '.') }}₺
                                                    </td>
                                                    <td>{{ number_format($alislaritem->alis->toplam_kdv_tutar, 2, ',', '.') }}₺
                                                    </td>
                                                    <td>{{ number_format($alislaritem->alis->toplam_ara_toplam, 2, ',', '.') }}₺
                                                    </td>
                                                    <td>{{ number_format($alislaritem->alis->toplam_tutar, 2, ',', '.') }}₺
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="databutton">
                                                            <div class="d-flex align-items-center fs-6">

                                                                <a href="{{ route('alislar.show', ['alislar' => $alislaritem->alis->id]) }}"
                                                                    class="text-primary btn btn-link p-0 m-0 ">
                                                                    <i class="bi bi-eye-fill"></i>
                                                                </a>

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="odemeler" role="tabpanel">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card " style="margin-top: -1.5rem; box-shadow: none">
                            <div class="card shadow-sm border-0 overflow-hidden">
                                <div class="card-body">

                                    <div class="text-center mt-4">
                                        <h4 class="mb-1" style="font-size: 20px">{{ $cariler->firma_unvan }}</h4>
                                        <p class="mb-0 text-secondary">{{ $cariler->yetkili_kisi }}</p>
                                        <div class="mt-4"></div>

                                        {{-- <h6 class="mb-1">HR Manager - Codervent Technology</h6>
                                        <p class="mb-0 text-secondary">University of Information Technology</p> --}}
                                    </div>
                                    <hr>
                                    <div class="text-start">
                                        <h5 class="">Adres</h5>
                                        <p class="mb-0">{{ $cariler->adres }}
                                        </p>
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-top">
                                        Telefon
                                        <span>{{ $cariler->yetkili_kisi_tel }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        E-Posta
                                        <span>{{ $cariler->eposta }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Müşteri Temsilcisi
                                        <span>{{ $cariler->musteri_temsilcisi }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Vergi No
                                        <span>{{ $cariler->vergi_no }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Vergi Dairesi
                                        <span>{{ $cariler->vergi_dairesi }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        T.C Kimlik No
                                        <span>{{ $cariler->tc_kimlik }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        İl
                                        <span>{{ $cariler->il }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        İlçe
                                        <span>{{ $cariler->ilce }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Firma Tipi
                                        <span>{{ $cariler->firma_tipi }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Firma Durumu
                                        <span>{{ $cariler->firma_durumu }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Web Adresi
                                        <span>{{ $cariler->web_adres }}</span>
                                    </li>
                                    @php
                                        $borc_toplam = 0;
                                        $alacak_toplam = 0;
                                        $sonuc = 0;
                                    @endphp
                                    @foreach ($firmahrkt as $firmahrktitem)
                                        @php
                                            $borc_toplam += $firmahrktitem->borc;
                                            $alacak_toplam += $firmahrktitem->alacak;
                                            $sonuc = $borc_toplam - $alacak_toplam;
                                        @endphp
                                    @endforeach

                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Kalan Bakiye
                                        <span>{{ number_format($sonuc, 2, ',', '.') }} <b
                                                style="color: red">₺</b></span>
                                    </li>

                                </ul>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card" style="margin-top: -1.5rem">
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="card radius-10 bg-warning">
                                            <div class="card-body" style="text-align: center">
                                                <p class="mb-1 text-white">Toplam Ödeme</p>
                                                <!-- Toplam Satış Tutarı -->
                                                <h4 class="mb-0 text-white">
                                                    <h4 class="mb-0 text-white">
                                                        ₺{{ number_format($odemetutari, 2) }}
                                                    </h4>
                                                </h4>
                                                <!-- Toplam Satış Sayısı -->
                                                <div class="mt-2">
                                                    <i class="bi bi-eye text-white"></i>
                                                    <span class="text-white">Kalan Borç: ₺
                                                        {{ number_format($sonuc, 2) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header bg-transparent">
                                        <div class="row g-3 align-items-center">
                                            <div class="col">
                                                <div class="d-flex align-items-center justify-content-between gap-3">
                                                    <div class="col-lg-2 col-6 col-md-3 text-start">
                                                        <h6>FİRMA ÖDEMELERİ</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <table class="table align-middle mb-0" id="example2">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th>Ödeme Kodu</th>
                                                    <th>Tarih</th>
                                                    <th>Firma</th>
                                                    <th>Ödeme Türü</th>
                                                    <th>Ödeme Tutar</th>
                                                    <th>Aksiyon</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($odeme as $sn => $odemeitem)
                                                    <tr>
                                                        <th scope="row">{{ $sn + 1 }}</th>
                                                        <th scope="row">
                                                            {{ $odemeitem->odeme->odeme_kodu_text }}-{{ $odemeitem->odeme->odeme_kodu }}
                                                        </th>
                                                        <td>{{ $odemeitem->firmaadi->firma_unvan }}</td>
                                                        <td>{{ $odemeitem->odeme->islem_tarihi }}</td>
                                                        <td>{{ $odemeitem->odeme->odeme_turu }}</td>

                                                        <td>{{ number_format($odemeitem->odeme->odeme_tutar, 2, ',', '.') }}
                                                            ₺
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="databutton">
                                                                <div class="d-flex align-items-center fs-6">

                                                                    <a href="{{ route('odemeler.show', ['odemeler' => $odemeitem->odeme->id]) }}"
                                                                        class="text-primary btn btn-link p-0 m-0 ">
                                                                        <i class="bi bi-eye-fill"></i>
                                                                    </a>

                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    @include('session.session')
@endsection
