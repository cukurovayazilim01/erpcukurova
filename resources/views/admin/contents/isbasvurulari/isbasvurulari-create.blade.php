@extends('admin.layouts.app')
@section('title')
    İŞ BAŞVURUSU OLUŞTUR
@endsection
@section('contents')
    @section('topheader')
        İŞ BAŞVURUSU OLUŞTUR
    @endsection

    <style>
        th {
            color: white;
        }
    </style>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <form action="{{ route('isbasvurulari.store') }}" method="POST" id="add-form">
                    @csrf
                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-md-2">
                                <label for="tarih">Başvuru Tarihi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="date" name="tarih" id="tarih" class="form-control form-control-sm"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <label for="ad_soyad">Ad Soyadı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="ad_soyad" id="ad_soyad" class="form-control form-control-sm"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="dogum_yeri">Doğum Yeri</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-city"></i>
                                    </span>
                                    <select name="dogum_yeri" id="firma_il" class="form-select form-select-sm"
                                        required onchange="firma_ilceListele()">
                                        <option value="">İl Seçin</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="dogum_tarihi">Doğum Tarihi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="date" name="dogum_tarihi" id="dogum_tarihi" class="form-control form-control-sm"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="basvuru_pozisyon">Başvurduğu Pozisyon</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="basvuru_pozisyon" id="basvuru_pozisyon"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="telefon">Telefon</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="number" name="telefon" id="telefon"
                                        class="form-control form-control-sm no-zero" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="ev_telefon">Ev Telefon</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="number" name="ev_telefon" id="ev_telefon"
                                        class="form-control form-control-sm no-zero" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="meslek_kodu">Eposta</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="email" name="email" id="email" class="form-control form-control-sm"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="meslegi">Meslek</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="meslegi" id="meslegi" class="form-control form-control-sm"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="mezuniyet">Mezuniyet</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <select name="mezuniyet" id="mezuniyet" class="form-select form-select-sm">
                                        <option value="Lisans">Lisans</option>
                                        <option value="Yüksek Lisans">Yüksek Lisans</option>
                                        <option value="Ön Lisans">Ön Lisans</option>
                                        <option value="Lise">Lise</option>
                                        <option value="OrtaOkul">OrtaOkul</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="durum">Medeni Hal</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <select name="medeni_hal" id="medeni_hal" class="form-select form-select-sm">
                                        <option value="Evli">Evli</option>
                                        <option value="Bekar">Bekar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="cocuk_yasi">Çocuk Sayınız ve Yaşları</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="cocuk_yasi" id="cocuk_yasi"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="askerlik_durumu">Askerlik Durumu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <select name="askerlik_durumu" id="askerlik_durumu" class="form-select form-select-sm">
                                        <option value="Yapıldı">Yapıldı</option>
                                        <option value="Yapılmadı">Yapılmadı</option>
                                        <option value="Tecilli">Tecilli</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="ehliyet_sinif">Ehliyet Sınfı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="ehliyet_sinif" id="ehliyet_sinif"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="ehliyet_tarihi">Ehliyet Tarihi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="date" name="ehliyet_tarihi" id="ehliyet_tarihi"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="kan_grubu">Kan Grubu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="kan_grubu" id="kan_grubu" class="form-control form-control-sm"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="sorusturma">Hakkınızda Soruşturma Açıldı Mı?</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <select name="sorusturma" id="sorusturma" class="form-select form-select-sm">
                                        <option value="Evet">Evet</option>
                                        <option value="Hayır">Hayır</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="sigara">Sigara Kullanıyor Musunuz?</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <select name="sigara" id="sigara" class="form-select form-select-sm">
                                        <option value="Evet">Evet</option>
                                        <option value="Hayır">Hayır</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="ameliyat">Hastalık, Ameliyat Geçirdiniz Mi?</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <select name="ameliyat" id="ameliyat" class="form-select form-select-sm">
                                        <option value="Evet">Evet</option>
                                        <option value="Hayır">Hayır</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="dosya">Dosya</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="file" name="dosya" id="dosya" class="form-control form-control-sm"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="resim">Resim</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="file" name="resim" id="resim" class="form-control form-control-sm"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="kalite_firma">Kalite Sistemi Olan Bir Firmada Çalıştınız Mı?</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <select name="kalite_firma" id="kalite_firma" class="form-select form-select-sm">
                                        <option value="Evet">Evet</option>
                                        <option value="Hayır">Hayır</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="aylik_ucret">İstediğiniz Aylık Net Ücret</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="aylik_ucret" id="aylik_ucret"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="aylik_ucret">Ne Zaman İşe Başlayabilirsiniz</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="ise_baslama" id="ise_baslama"
                                        class="form-control form-control-sm" required>
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
                                        <tr>
                                            <td></td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputs[0][yabanci_dil]"
                                                        class="form-control form-control-sm ">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputs[0][yabanci_dil_derecesi]"
                                                        class="form-control form-control-sm ">
                                                </div>
                                            </td>

                                        </tr>
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
                                        <tr>
                                            <td></td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputss[0][okul_seviyesi]"
                                                        class="form-control form-control-sm " value="İlkokul">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputss[0][okul_adi]"
                                                        class="form-control form-control-sm ">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputss[0][mezuniyet_yili]"
                                                        class="form-control form-control-sm ">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputss[0][okul_derecesi]"
                                                        class="form-control form-control-sm ">
                                                </div>
                                            </td>

                                        </tr>
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
                                        <tr>
                                            <td></td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputsss[0][firma_adi]"
                                                        class="form-control form-control-sm">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputsss[0][calisilan_yil]"
                                                        class="form-control form-control-sm ">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputsss[0][cikis_nedeni]"
                                                        class="form-control form-control-sm ">
                                                </div>
                                            </td>


                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4" style="margin-top: 10px">
                                <table id="referans_table" class="table table-responsive"
                                    style="width: 100%; cellspacing: 0; margin-bottom: 0">
                                    <thead>
                                        <tr>
                                            <th colspan="100%">
                                                <button type="button" id="addreferans"
                                                    class="btn btn-sm btn-primary btn-block"
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
                                        <tr>
                                            <td></td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputssss[0][referans_adsoyad]"
                                                        class="form-control form-control-sm">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputssss[0][referans_meslegi]"
                                                        class="form-control form-control-sm ">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputssss[0][referans_tel]"
                                                        class="form-control form-control-sm ">
                                                </div>
                                            </td>


                                        </tr>
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
                                        <tr>
                                            <td></td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputsssss[0][bilgisayar_prog]"
                                                        class="form-control form-control-sm">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputsssss[0][bilgisayar_prog_derecesi]"
                                                        class="form-control form-control-sm ">
                                                </div>
                                            </td>



                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                            <div class="col-md-5">
                                <label for="ev_adresi">Ev Adresi</label>
                                <textarea name="ev_adresi" id="ev_adresi" cols="20" rows="2"
                                    class="form-control form-control-sm "></textarea>
                            </div>

                            <div class="col-md-4">
                                <label for="kurs">Katılmış Olduğunuz Kurs, Seminer Ve Eğitimler Var İse Adı, Süresi Ve
                                    Tarihi</label>
                                <textarea name="kurs" id="kurs" cols="20" rows="2"
                                    class="form-control form-control-sm "></textarea>
                            </div>
                            <div class="col-md-3">
                                <label for="sertifika">Eğer Eğitimlere Katıldıysanız Hangi Sertifikalarınız Mevcut </label>
                                <textarea name="sertifika" id="sertifika" cols="20" rows="2"
                                    class="form-control form-control-sm "></textarea>
                            </div>



                            <div class="col-md-12">
                                <label for="gorusme_notu">Görüşmeyi Yapanın Görüşleri</label>
                                <textarea name="gorusme_notu" id="gorusme_notu" cols="20" rows="2"
                                    class="form-control form-control-sm "></textarea>
                            </div>
                            <div class="signature-container">
                                <h5>Görüşmeyi Yapan İmza</h5>
                                <canvas id="signature-canvas" width="200" height="100"></canvas>
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
                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-1">
                            <button type="submit" name="action" value="save" class="btn btn-sm btn-outline-primary"
                                style="float: right; margin-left: 2px;">
                                Kaydet
                            </button>

                            <button type="submit" name="action" value="save_and_transfer"
                                class="btn btn-sm btn-outline-success" style="float: right;">
                                Kaydet ve Personel Listesine Aktar
                            </button>

                            <a href="{{ route('isbasvurulari.index') }}" class="btn btn-sm btn-outline-secondary"
                                style="float: right">
                                Vazgeç
                            </a>
                        </div>
                    </div>

                </form>

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
            var i = 0;
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
                                        <input type="text" name="inputs[` + i + `][yabanci_dil_derecesi]" class="form-control form-control-sm " >
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
            var a = 0;
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
            var b = 0;
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
            var c = 0;
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
            var d = 0;
            $(document).on('click', '#addpcprogrami', function () {

                ++d;
                var newRow = $('<tr>');
                newRow.append('<td>' + d + '</td>');
                newRow.append(`

                            <td>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon"></span>
                                    <input type="text" name="inputsssss[` + d + `][bilgisayar_prog]"
                                        class="form-control form-control-sm" >
                                </div>
                            </td>
                            <td>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon"></span>
                                    <input type="text" name="inputsssss[` + d + `][bilgisayar_prog_derecesi]"
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
