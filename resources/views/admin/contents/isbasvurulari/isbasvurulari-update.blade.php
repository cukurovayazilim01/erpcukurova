@extends('admin.layouts.app')
@section('title')
    {{$isbasvuru->ad_soyad}} İŞ BAŞVURUSU GÜNCELLE
@endsection
@section('contents')
    @section('topheader')
        {{$isbasvuru->ad_soyad}} İŞ BAŞVURUSU GÜNCELLE
    @endsection
    <style>
        th {
            color: white;
        }
    </style>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <form action="{{ route('isbasvurulari.update', ['isbasvurulari' => $isbasvuru->id]) }}" method="POST"
                    enctype="multipart/form-data" id="add-form">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-2">
                            <label for="tarih">Başvuru Tarihi</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <input type="date" name="tarih" id="tarih" class="form-control form-control-sm"
                                    value="{{$isbasvuru->tarih}}" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="ad_soyad">Ad Soyadı</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <input type="text" name="ad_soyad" id="ad_soyad" class="form-control form-control-sm"
                                    value="{{$isbasvuru->ad_soyad}}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="dogum_yeri">Doğum Yeri</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-city"></i>
                                </span>
                                <select name="dogum_yeri" id="firma_il" class="form-select form-select-sm" required
                                    onchange="firma_ilceListele()">
                                    <option value="">İl Seçin</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="dogum_tarihi">Doğum Tarihi</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <input type="date" name="dogum_tarihi" id="dogum_tarihi"
                                    class="form-control form-control-sm" value="{{$isbasvuru->dogum_tarihi}}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="basvuru_pozisyon">Başvurduğu Pozisyon</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <input type="text" name="basvuru_pozisyon" id="basvuru_pozisyon"
                                    class="form-control form-control-sm" value="{{$isbasvuru->basvuru_pozisyon}}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="telefon">Telefon</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </span>
                                <input type="number" name="telefon" id="telefon"
                                    class="form-control form-control-sm no-zero" value="{{$isbasvuru->telefon}}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="ev_telefon">Ev Telefon</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </span>
                                <input type="number" name="ev_telefon" id="ev_telefon"
                                    class="form-control form-control-sm no-zero" value="{{$isbasvuru->ev_telefon}}"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="meslek_kodu">Eposta</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <input type="email" name="email" id="email" class="form-control form-control-sm"
                                    value="{{$isbasvuru->email}}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="meslegi">Meslek</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <input type="text" name="meslegi" id="meslegi" class="form-control form-control-sm"
                                    value="{{$isbasvuru->meslegi}}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="mezuniyet">Mezuniyet</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <select name="mezuniyet" id="mezuniyet" class="form-select form-select-sm">
                                    <option value="Lisans" {{ $isbasvuru->mezuniyet == 'Lisans' ? 'selected' : '' }}>Lisans
                                    </option>
                                    <option value="Yüksek Lisans" {{ $isbasvuru->mezuniyet == 'Yüksek Lisans' ? 'selected' : '' }}>Yüksek Lisans</option>
                                    <option value="Ön Lisans" {{ $isbasvuru->mezuniyet == 'Ön Lisans' ? 'selected' : '' }}>Ön
                                        Lisans</option>
                                    <option value="Lise" {{ $isbasvuru->mezuniyet == 'Lise' ? 'selected' : '' }}>Lise</option>
                                    <option value="OrtaOkul" {{ $isbasvuru->mezuniyet == 'OrtaOkul' ? 'selected' : '' }}>
                                        OrtaOkul</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="durum">Medeni Hal</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <select name="medeni_hal" id="medeni_hal" class="form-select form-select-sm">
                                    <option value="Evli" {{ $isbasvuru->medeni_hal == 'Evli' ? 'selected' : '' }}>Evli
                                    </option>
                                    <option value="Bekar" {{ $isbasvuru->medeni_hal == 'Bekar' ? 'selected' : '' }}>Bekar
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="cocuk_yasi">Çocuk Sayınız ve Yaşları</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <input type="text" name="cocuk_yasi" id="cocuk_yasi" class="form-control form-control-sm"
                                    value="{{$isbasvuru->cocuk_yasi}}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="askerlik_durumu">Askerlik Durumu</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                                <select name="askerlik_durumu" id="askerlik_durumu" class="form-select form-select-sm">
                                    <option value="Yapıldı" {{ $isbasvuru->askerlik_durumu == 'Yapıldı' ? 'selected' : '' }}>
                                        Yapıldı</option>
                                    <option value="Yapılmadı" {{ $isbasvuru->askerlik_durumu == 'Yapılmadı' ? 'selected' : '' }}>Yapılmadı</option>
                                    <option value="Tecilli" {{ $isbasvuru->askerlik_durumu == 'Tecilli' ? 'selected' : '' }}>
                                        Tecilli</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="ehliyet_sinif">Ehliyet Sınfı</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <input type="text" name="ehliyet_sinif" id="ehliyet_sinif"
                                    class="form-control form-control-sm" value="{{$isbasvuru->ehliyet_sinif}}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="ehliyet_tarihi">Ehliyet Tarihi</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <input type="date" name="ehliyet_tarihi" id="ehliyet_tarihi"
                                    class="form-control form-control-sm" value="{{$isbasvuru->ehliyet_tarihi}}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="kan_grubu">Kan Grubu</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <input type="text" name="kan_grubu" id="kan_grubu" class="form-control form-control-sm"
                                    value="{{$isbasvuru->kan_grubu}}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="sorusturma">Hakkınızda Soruşturma Açıldı Mı?</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <select name="sorusturma" id="sorusturma" class="form-select form-select-sm">
                                    <option value="Evet" {{ $isbasvuru->sorusturma == 'Evet' ? 'selected' : '' }}>Evet
                                    </option>
                                    <option value="Hayır" {{ $isbasvuru->sorusturma == 'Hayır' ? 'selected' : '' }}>Hayır
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="sigara">Sigara Kullanıyor Musunuz?</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <select name="sigara" id="sigara" class="form-select form-select-sm">
                                    <option value="Evet" {{ $isbasvuru->sigara == 'Evet' ? 'selected' : '' }}>Evet</option>
                                    <option value="Hayır" {{ $isbasvuru->sigara == 'Evet' ? 'selected' : '' }}>Hayır</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="ameliyat">Hastalık, Ameliyat Geçirdiniz Mi?</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <select name="ameliyat" id="ameliyat" class="form-select form-select-sm">
                                    <option value="Evet" {{ $isbasvuru->ameliyat == 'Evet' ? 'selected' : '' }}>Evet</option>
                                    <option value="Hayır" {{ $isbasvuru->ameliyat == 'Evet' ? 'selected' : '' }}>Hayır
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="dosya">Dosya</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <input type="file" name="dosya" id="dosya" class="form-control form-control-sm"
                                    value="{{$isbasvuru->dosya}}" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="resim">Resim</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <input type="file" name="resim" id="resim" class="form-control form-control-sm"
                                    value="{{$isbasvuru->resim}}" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="kalite_firma">Kalite Sistemi Olan Bir Firmada Çalıştınız Mı?</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <select name="kalite_firma" id="kalite_firma" class="form-select form-select-sm">
                                    <option value="Evet" {{ $isbasvuru->kalite_firma == 'Evet' ? 'selected' : '' }}>Evet
                                    </option>
                                    <option value="Hayır" {{ $isbasvuru->kalite_firma == 'Evet' ? 'selected' : '' }}>Hayır
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="aylik_ucret">İstediğiniz Aylık Net Ücret</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <input type="text" name="aylik_ucret" id="aylik_ucret" class="form-control form-control-sm"
                                    value="{{$isbasvuru->aylik_ucret}}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="aylik_ucret">Ne Zaman İşe Başlayabilirsiniz</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <input type="text" name="ise_baslama" id="ise_baslama" class="form-control form-control-sm"
                                    value="{{$isbasvuru->ise_baslama}}" required>
                            </div>
                        </div>

                        <div class="col-md-4" style="margin-top: 10px">
                            <table id="yabancidil_table" class="table table-responsive"
                                style="width: 100%; cellspacing: 0; margin-bottom: 0">
                                <thead>
                                    <tr>
                                        <th colspan="100%">
                                            <button type="button" id="addyabancidil"
                                                class="btn btn-sm btn-primary btn-block"
                                                style="width: 100%; text-align: center;">
                                                <i class="fa fa-plus"></i> Yabancı Dil Ekle
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th><b>#</b></th>
                                        <th>Yabancı Dil</th>
                                        <th>Derecesi</th>
                                        <th>Ekle/Çıkar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($isbasvuru->yabanci_dil)
                                                                    @php
                                                                        $yabancidiller = json_decode($isbasvuru->yabanci_dil, true);

                                                                    @endphp
                                                                    @foreach($yabancidiller as $key => $yabancidilleritem)
                                                                        <tr>
                                                                            <td>{{ $key + 1 }}</td>
                                                                            <td>
                                                                                <div class="input-group m-b-sm">
                                                                                    <span class="input-group-addon"></span>
                                                                                    <input type="text" name="inputs[{{ $key }}][yabanci_dil]"
                                                                                        class="form-control form-control-sm "
                                                                                        value="{{ $yabancidilleritem['yabanci_dil'] }}">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="input-group m-b-sm">
                                                                                    <span class="input-group-addon"></span>
                                                                                    <input type="text" name="inputs[{{ $key }}][yabanci_dil_derecesi]"
                                                                                        class="form-control form-control-sm "
                                                                                        value="{{ $yabancidilleritem['yabanci_dil_derecesi'] }}">
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                    @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4" style="margin-top: 10px">
                            <table id="egitimdurumu_table" class="table table-responsive"
                                style="width: 100%; cellspacing: 0; margin-bottom: 0">
                                <thead>
                                    <tr>
                                        <th colspan="100%">
                                            <button type="button" id="addegitimdurumu"
                                                class="btn btn-sm btn-primary btn-block"
                                                style="width: 100%; text-align: center;">
                                                <i class="fa fa-plus"></i> Eğitim Durumu Ekle
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th><b>#</b></th>
                                        <th>Seviye</th>
                                        <th>Okul Adı</th>
                                        <th>Mezuniyet Yılı</th>
                                        <th>Derecesi</th>
                                        <th>Ekle/Çıkar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($isbasvuru->egitim_durumu)
                                                                    @php
                                                                        $egitimler = json_decode($isbasvuru->egitim_durumu, true);
                                                                    @endphp

                                                                    @foreach($egitimler as $key => $egitim)
                                                                        <tr>
                                                                            <td>{{ $key + 1 }}</td>
                                                                            <td>
                                                                                <div class="input-group m-b-sm">
                                                                                    <span class="input-group-addon"></span>
                                                                                    <input type="text" name="inputss[{{ $key }}][okul_seviyesi]"
                                                                                        class="form-control form-control-sm "
                                                                                        value="{{ $egitim['okul_seviyesi'] }}">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="input-group m-b-sm">
                                                                                    <span class="input-group-addon"></span>
                                                                                    <input type="text" name="inputss[{{ $key }}][okul_adi]"
                                                                                        class="form-control form-control-sm " value="{{ $egitim['okul_adi'] }}">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="input-group m-b-sm">
                                                                                    <span class="input-group-addon"></span>
                                                                                    <input type="text" name="inputss[{{ $key }}][mezuniyet_yili]"
                                                                                        class="form-control form-control-sm "
                                                                                        value="{{ $egitim['mezuniyet_yili'] }}">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="input-group m-b-sm">
                                                                                    <span class="input-group-addon"></span>
                                                                                    <input type="text" name="inputss[{{ $key }}][okul_derecesi]"
                                                                                        class="form-control form-control-sm "
                                                                                        value="{{ $egitim['okul_derecesi'] }}">
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4" style="margin-top: 10px">
                            <table id="calisilanfirma_table" class="table table-responsive"
                                style="width: 100%; cellspacing: 0; margin-bottom: 0">
                                <thead>
                                    <tr>
                                        <th colspan="100%">
                                            <button type="button" id="addcalisilanfirma"
                                                class="btn btn-sm btn-primary btn-block"
                                                style="width: 100%; text-align: center;">
                                                <i class="fa fa-plus"></i> Çalışılan Firma Ekle
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th><b>#</b></th>
                                        <th>Firma Adı</th>
                                        <th>Yılı</th>
                                        <th>Çıkış Nedeni</th>
                                        <th>Ekle/Çıkar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($isbasvuru->calisilan_firma)
                                                                    @php
                                                                        $calisilanfirma = json_decode($isbasvuru->calisilan_firma, true);

                                                                    @endphp
                                                                    @foreach($calisilanfirma as $key => $calisilanfirmaitem)
                                                                        <tr>
                                                                            <td>{{ $key + 1 }}</td>
                                                                            <td>
                                                                                <div class="input-group m-b-sm">
                                                                                    <span class="input-group-addon"></span>
                                                                                    <input type="text" name="inputsss[{{ $key }}][firma_adi]"
                                                                                        class="form-control form-control-sm"
                                                                                        value="{{ $calisilanfirmaitem['firma_adi'] }}">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="input-group m-b-sm">
                                                                                    <span class="input-group-addon"></span>
                                                                                    <input type="text" name="inputsss[{{ $key }}][calisilan_yil]"
                                                                                        class="form-control form-control-sm "
                                                                                        value="{{ $calisilanfirmaitem['calisilan_yil'] }}">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="input-group m-b-sm">
                                                                                    <span class="input-group-addon"></span>
                                                                                    <input type="text" name="inputsss[{{ $key }}][cikis_nedeni]"
                                                                                        class="form-control form-control-sm"
                                                                                        value="{{ $calisilanfirmaitem['cikis_nedeni'] }}">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4" style="margin-top: 10px">
                            <table id="referans_table" class="table table-responsive"
                                style="width: 100%; cellspacing: 0; margin-bottom: 0">
                                <thead>
                                    <tr>
                                        <th colspan="100%">
                                            <button type="button" id="addreferans" class="btn btn-sm btn-primary btn-block"
                                                style="width: 100%; text-align: center;">
                                                <i class="fa fa-plus"></i> Referans Ekle
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th><b>#</b></th>
                                        <th>Ad Soyad</th>
                                        <th>Mesleği</th>
                                        <th>Telefon No</th>
                                        <th>Ekle/Çıkar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($isbasvuru->referanss)
                                                                    @php
                                                                        $referanslar = json_decode($isbasvuru->referanss, true);

                                                                    @endphp
                                                                    @foreach($referanslar as $key => $referanslaritem)
                                                                        <tr>
                                                                            <td>{{ $key + 1 }}</td>
                                                                            <td>
                                                                                <div class="input-group m-b-sm">
                                                                                    <span class="input-group-addon"></span>
                                                                                    <input type="text" name="inputssss[{{ $key }}][referans_adsoyad]"
                                                                                        class="form-control form-control-sm"
                                                                                        value="{{ $referanslaritem['referans_adsoyad'] }}">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="input-group m-b-sm">
                                                                                    <span class="input-group-addon"></span>
                                                                                    <input type="text" name="inputssss[{{ $key }}][referans_meslegi]"
                                                                                        class="form-control form-control-sm "
                                                                                        value="{{ $referanslaritem['referans_meslegi'] }}">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="input-group m-b-sm">
                                                                                    <span class="input-group-addon"></span>
                                                                                    <input type="text" name="inputssss[{{ $key }}][referans_tel]"
                                                                                        class="form-control form-control-sm"
                                                                                        value="{{ $referanslaritem['referans_tel'] }}">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4" style="margin-top: 10px">
                            <table id="pcprogrami_table" class="table table-responsive"
                                style="width: 100%; cellspacing: 0; margin-bottom: 0">
                                <thead>
                                    <tr>
                                        <th colspan="100%">
                                            <button type="button" id="addpcprogrami"
                                                class="btn btn-sm btn-primary btn-block"
                                                style="width: 100%; text-align: center;">
                                                <i class="fa fa-plus"></i>Bilgisayar Programı Ekle
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th><b>#</b></th>
                                        <th>Bilgisayar Programı</th>
                                        <th>Derecesi</th>
                                        <th>Ekle/Çıkar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($isbasvuru->pc_programi)
                                    @php
                                        $pcprogrami = json_decode($isbasvuru->pc_programi, true);
                                    @endphp
                                    @foreach($pcprogrami as $key => $pcprogramiitem)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputsssss[{{ $key }}][bilgisayar_prog]"
                                                        class="form-control form-control-sm" value="{{ $pcprogramiitem['bilgisayar_prog'] }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputsssss[{{ $key }}][bilgisayar_prog_derecesi]"
                                                        class="form-control form-control-sm " value="{{ $pcprogramiitem['bilgisayar_prog_derecesi'] }}">
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>


                        <div class="col-md-5">
                            <label for="ev_adresi">Ev Adresi</label>
                            <textarea name="ev_adresi" id="ev_adresi" cols="20" rows="2"
                                class="form-control form-control-sm ">{{$isbasvuru->ev_adresi}}</textarea>
                        </div>

                        <div class="col-md-4">
                            <label for="kurs">Katılmış Olduğunuz Kurs, Seminer Ve Eğitimler Var İse Adı, Süresi Ve
                                Tarihi</label>
                            <textarea name="kurs" id="kurs" cols="20" rows="2"
                                class="form-control form-control-sm ">{{$isbasvuru->kurs}}</textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="sertifika">Eğer Eğitimlere Katıldıysanız Hangi Sertifikalarınız Mevcut </label>
                            <textarea name="sertifika" id="sertifika" cols="20" rows="2"
                                class="form-control form-control-sm ">{{$isbasvuru->sertifika}}</textarea>
                        </div>



                        <div class="col-md-12">
                            <label for="gorusme_notu">Görüşmeyi Yapanın Görüşleri</label>
                            <textarea name="gorusme_notu" id="gorusme_notu" cols="20" rows="2"
                                class="form-control form-control-sm ">{{$isbasvuru->gorusme_notu}}</textarea>
                        </div>
                        <div class="signature-container">
                            <h5>Görüşmeyi Yapan İmza</h5>
                            <canvas id="signature-canvas" width="200" height="100"><strong>
                                <img src="{{$isbasvuru->signature_data}}" alt="İmza" width="100">
                            </strong></canvas>
                            <input type="hidden" name="signature_data" id="signature-data">

                            <div class="button-group">
                                <button type="button" id="clear-btn" class="clear">Temizle</button>
                            </div>
                        </div>
                        <style>
                            .signature-container {
                                margin: 30px 0;
                                text-align: center;
                            }

                            #signature-canvas {
                                border: 2px solid #333;
                                background-color: #f9f9f9;
                                touch-action: none;
                            }

                            .button-group {
                                margin-top: 15px;
                            }

                            button.clear {
                                background-color: #f44336;
                            }

                            .signature-preview {
                                margin-top: 30px;
                                text-align: center;
                            }

                            .signature-preview img {
                                max-width: 100%;
                                border: 1px solid #ddd;
                            }
                        </style>
                    </div>

                    <div class="row">
                        <div class="col-md-12 ">
                            <button type="submit" id="submit-form" class="btn btn-sm btn-outline-primary"
                                style="float: right; margin-left: 2px">
                                Kaydet</button>
                            <a href="{{ route('teklifler.index') }}" class="btn btn-sm btn-outline-secondary"
                                style="float: right">
                                Vazgeç</a>
                        </div>
                    </div>

                </form>


            </div>
        </div>
    </div>
    <script src="{{ asset('custom/customjs/city.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".rating-checkbox").on("change", function () {
                var row = $(this).closest("tr"); // Satırı bul
                if ($(this).is(":checked")) {
                    row.find(".rating-checkbox").not(this).prop("disabled", true); // Diğer checkbox'ları devre dışı bırak
                } else {
                    row.find(".rating-checkbox").prop("disabled", false); // Seçim kaldırıldığında diğerlerini tekrar aktif et
                }

                calculateTotalScore(); // Toplam puanı güncelle
            });

            function calculateTotalScore() {
                let total = 0;
                $(".rating-checkbox:checked").each(function () {
                    total += parseInt($(this).val()); // Seçili olan checkbox'ın değerini topla
                });
                $("#total-score").val(total); // Toplam puanı input alanına yazdır
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const canvas = document.getElementById('signature-canvas');
            const ctx = canvas.getContext('2d');
            const signatureInput = document.getElementById('signature-data');
            const clearBtn = document.getElementById('clear-btn');
            let isDrawing = false;
            let lastX = 0;
            let lastY = 0;

            // Canvas boyut ayarı
            function resizeCanvas() {
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.style.width = canvas.offsetWidth + 'px';
                canvas.style.height = canvas.offsetHeight + 'px';
                ctx.scale(ratio, ratio);
            }

            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();

            // Çizim fonksiyonları
            function startDrawing(e) {
                isDrawing = true;
                [lastX, lastY] = getPosition(e);
            }

            function draw(e) {
                if (!isDrawing) return;

                ctx.strokeStyle = '#000';
                ctx.lineWidth = 2;
                ctx.lineJoin = 'round';
                ctx.lineCap = 'round';

                const [x, y] = getPosition(e);

                ctx.beginPath();
                ctx.moveTo(lastX, lastY);
                ctx.lineTo(x, y);
                ctx.stroke();

                lastX = x;
                lastY = y;

                // Her hareketten sonra imzayı güncelle
                updateSignature();
            }

            function stopDrawing() {
                isDrawing = false;
                updateSignature();
            }

            function getPosition(e) {
                const rect = canvas.getBoundingClientRect();
                let x, y;

                if (e.type.includes('touch')) {
                    x = e.touches[0].clientX - rect.left;
                    y = e.touches[0].clientY - rect.top;
                } else {
                    x = e.clientX - rect.left;
                    y = e.clientY - rect.top;
                }

                return [x, y];
            }

            function updateSignature() {
                signatureInput.value = canvas.toDataURL();
            }

            function clearCanvas() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                signatureInput.value = '';
            }

            // Event listeners
            canvas.addEventListener('mousedown', startDrawing);
            canvas.addEventListener('mousemove', draw);
            canvas.addEventListener('mouseup', stopDrawing);
            canvas.addEventListener('mouseout', stopDrawing);

            canvas.addEventListener('touchstart', function (e) {
                e.preventDefault();
                startDrawing(e);
            });

            canvas.addEventListener('touchmove', function (e) {
                e.preventDefault();
                draw(e);
            });

            canvas.addEventListener('touchend', stopDrawing);

            clearBtn.addEventListener('click', clearCanvas);

            // Form gönderilirken kontrol
            document.querySelector('form').addEventListener('submit', function (e) {
                if (signatureInput.value === '') {
                    e.preventDefault();
                    alert('Lütfen imza atın!');
                }
            });
        });
    </script>
    <script>
        var i = $('#yabancidil_table tbody tr').length;
        $(document).on('click', '#addyabancidil', function () {

            ++i;
            var newRow = $('<tr>');
            newRow.append('<td>' + i + '</td>');
            newRow.append(`
                            <td>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon" ></span>
                                    <input type="text" name="inputs[` + i + `][yabanci_dil]" class="form-control form-control-sm " >
                                </div>
                            </td>
                            <td>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon" ></span>
                                    <input type="text" name="inputs[` + i + `][yabanci_dil_derecesi]" class="form-control form-control-sm input-mask" >
                                </div>
                            </td>

                            <td><button type="button" class="btn btn-sm btn-danger remove-yabancidil-table-row" style="--bs-btn-padding-y: 0.12rem">-</button></td>
                            `);
            $('#yabancidil_table').append(newRow);
            $(document).on('click', '.remove-yabancidil-table-row', function () {
                $(this).closest('tr').remove();
                updateValues();
            });

        });
    </script>
    <script>
        var a = $('#egitimdurumu_table tbody tr').length;
        $(document).on('click', '#addegitimdurumu', function () {

            ++a;
            var newRow = $('<tr>');
            newRow.append('<td>' + a + '</td>');
            newRow.append(`

                            <td>
                            <div class="input-group m-b-sm">
                                <span class="input-group-addon"></span>
                                <input type="text" name="inputss[` + a + `][okul_seviyesi]"
                                    class="form-control form-control-sm " value="Ortaokul" >
                            </div>
                        </td>
                            <td>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon" ></span>
                                    <input type="text" name="inputss[` + a + `][okul_adi]" class="form-control form-control-sm " >
                                </div>
                            </td>
                            <td>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon" ></span>
                                    <input type="text" name="inputss[` + a + `][mezuniyet_yili]" class="form-control form-control-sm " >
                                </div>
                            </td>
                            <td>
                            <div class="input-group m-b-sm">
                                <span class="input-group-addon"></span>
                                <input type="text" name="inputss[` + a + `][okul_derecesi]"
                                    class="form-control form-control-sm " >
                            </div>
                        </td>
                            <td><button type="button" class="btn btn-sm btn-danger remove-egitimdurumu-table-row" style="--bs-btn-padding-y: 0.12rem">-</button></td>
                            `);
            $('#egitimdurumu_table').append(newRow);

            $(document).on('click', '.remove-egitimdurumu-table-row', function () {
                $(this).closest('tr').remove();
                updateValues();
            });
        });
    </script>
    <script>
        var b = $('#calisilanfirma_table tbody tr').length;
        $(document).on('click', '#addcalisilanfirma', function () {

            ++b;
            var newRow = $('<tr>');
            newRow.append('<td>' + b + '</td>');
            newRow.append(`

                           <td>
                            <div class="input-group m-b-sm">
                                <span class="input-group-addon"></span>
                                <input type="text" name="inputsss[` + b + `][firma_adi]"
                                    class="form-control form-control-sm" >
                            </div>
                        </td>
                        <td>
                            <div class="input-group m-b-sm">
                                <span class="input-group-addon"></span>
                                <input type="text" name="inputsss[` + b + `][calisilan_yil]"
                                    class="form-control form-control-sm " >
                            </div>
                        </td>
                        <td>
                            <div class="input-group m-b-sm">
                                <span class="input-group-addon"></span>
                                <input type="text" name="inputsss[` + b + `][cikis_nedeni]"
                                    class="form-control form-control-sm " >
                            </div>
                        </td>
                            <td><button type="button" class="btn btn-sm btn-danger remove-calisilanfirma-table-row" style="--bs-btn-padding-y: 0.12rem">-</button></td>
                            `);
            $('#calisilanfirma_table').append(newRow);

            $(document).on('click', '.remove-calisilanfirma-table-row', function () {
                $(this).closest('tr').remove();
                updateValues();
            });
        });
    </script>
    <script>
        var c = $('#referans_table tbody tr').length;
        $(document).on('click', '#addreferans', function () {

            ++c;
            var newRow = $('<tr>');
            newRow.append('<td>' + c + '</td>');
            newRow.append(`

                         <td>
                            <div class="input-group m-b-sm">
                                <span class="input-group-addon"></span>
                                <input type="text" name="inputssss[` + c + `][referans_adsoyad]"
                                    class="form-control form-control-sm" >
                            </div>
                        </td>
                        <td>
                            <div class="input-group m-b-sm">
                                <span class="input-group-addon"></span>
                                <input type="text" name="inputssss[` + c + `][referans_meslegi]"
                                    class="form-control form-control-sm " >
                            </div>
                        </td>
                        <td>
                            <div class="input-group m-b-sm">
                                <span class="input-group-addon"></span>
                                <input type="text" name="inputssss[` + c + `][referans_tel]"
                                    class="form-control form-control-sm " >
                            </div>
                        </td>
                            <td><button type="button" class="btn btn-sm btn-danger remove-referans-table-row" style="--bs-btn-padding-y: 0.12rem">-</button></td>
                            `);
            $('#referans_table').append(newRow);

            $(document).on('click', '.remove-referans-table-row', function () {
                $(this).closest('tr').remove();
                updateValues();
            });
        });
    </script>
    <script>
        var d = $('#pcprogrami_table tbody tr').length;
        $(document).on('click', '#addpcprogrami', function () {

            ++d;
            var newRow = $('<tr>');
            newRow.append('<td>' + d + '</td>');
            newRow.append(`

                        <td>
                            <div class="input-group m-b-sm">
                                <span class="input-group-addon"></span>
                                <input type="text" name="inputsssss[` + c + `][bilgisayar_prog]"
                                    class="form-control form-control-sm" >
                            </div>
                        </td>
                        <td>
                            <div class="input-group m-b-sm">
                                <span class="input-group-addon"></span>
                                <input type="text" name="inputsssss[` + c + `][bilgisayar_prog_derecesi]"
                                    class="form-control form-control-sm " >
                            </div>
                        </td>
                            <td><button type="button" class="btn btn-sm btn-danger remove-pcprogrami-table-row" style="--bs-btn-padding-y: 0.12rem">-</button></td>
                            `);
            $('#pcprogrami_table').append(newRow);

            $(document).on('click', '.remove-pcprogrami-table-row', function () {
                $(this).closest('tr').remove();
                updateValues();
            });
        });
    </script>
@endsection
