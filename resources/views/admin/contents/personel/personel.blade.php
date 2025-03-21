@extends('admin.layouts.app')
@section('title')
    Personel Özlük Dosyası
@endsection
@section('contents')
@section('topheader')
    Personel Özlük Dosyası
@endsection
<div class="card radius-10">
    <div class="card-header bg-transparent">
        <div class="row g-3 align-items-center">
            <div class="col">
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <button type="button" class="btn btn-sm btn-outline-primary px-5" data-bs-toggle="modal"
                        data-bs-target="#personelmodal"><i class="fa-solid fa-plus"></i>Yeni Ekle</button>
                    {{-- <div class="dropdown">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">Action</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                            </li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="personelmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('personell.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Personel Özlük Dosyası</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style="padding: 2%;">
                            <div class="row">

                                <div class="col-md-3">
                                    <label for="ad_soyad">Ad Soyad</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="ad_soyad" id="ad_soyad"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="tc">TC Kimlik No</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="number" name="tc" id="tc"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="sigorta_sicil_no">Sigorta Sicil No</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="number" name="sigorta_sicil_no" id="sigorta_sicil_no"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="sigorta_giris_tarihi">Sigorta Giriş Tarihi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="sigorta_giris_tarihi" id="sigorta_giris_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="meslek_kodu">Meslek Kodu</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="number" name="meslek_kodu" id="meslek_kodu"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="okul">Okulu</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="okul" id="okul"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="mezuniyet">Mezuniyet</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
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
                                <div class="col-md-3">
                                    <label for="meslegi">Mesleği</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="meslegi" id="meslegi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="departman">Departman</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="departman" id="departman"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="dogum_yeri">Doğum Yeri</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="dogum_yeri" id="dogum_yeri"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="dogum_tarihi">Doğum Tarihi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar"></i>
                                        </span>
                                        <input type="date" name="dogum_tarihi" id="dogum_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="gsm">Cep Telefonu</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-phone"></i>
                                        </span>
                                        <input type="number" name="gsm" id="gsm"
                                            class="form-control form-control-sm no-zero" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="mail">E-Posta</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                        <input type="email" name="mail" id="mail"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="gorevi">Görevi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="gorevi" id="gorevi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="kidem_yili">Kıdem Yılı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="number" name="kidem_yili" id="kidem_yili"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="medeni_hali">Medeni Hali</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <select name="medeni_hali" id="medeni_hali" class="form-select form-select-sm">
                                            <option value="Evli">Evli</option>
                                            <option value="Bekar">Bekâr</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="kan_grubu">Kan Grubu</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="kan_grubu" id="kan_grubu"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="askerlik_durumu">Askerlik Durumu</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <select name="askerlik_durumu" id="askerlik_durumu" class="form-select form-select-sm">
                                            <option value="Yapıldı">Yapıldı</option>
                                            <option value="Yapılmadı">Yapılmadı</option>
                                            <option value="Tecilli">Tecilli</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="personel_resim">Personel Resmi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="file" name="personel_resim" id="personel_resim"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="ehliyet_sinif">Ehliyet Sınfı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="ehliyet_sinif" id="ehliyet_sinif"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="ehliyet_tarihi">Ehliyet Tarihi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="date" name="ehliyet_tarihi" id="ehliyet_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="baba_adi">Baba Adı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="baba_adi" id="baba_adi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="baba_meslegi">Baba Mesleği</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="baba_meslegi" id="baba_meslegi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="ayak_no">Ayak No</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="number" name="ayak_no" id="ayak_no"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="beden">Beden</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="number" name="beden" id="beden"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="ev_gsm">Ev Telefonu</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="number" name="ev_gsm" id="ev_gsm"
                                            class="form-control form-control-sm no-zero" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="ise_giris_tarihi">İşe Giriş Tarihi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="ise_giris_tarihi" id="ise_giris_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="ise_giris_tarihi">İşten Çıkış Tarihi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="isten_cikis_tarihi" id="isten_cikis_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="ev_adresi">Ev Adresi</label>
                                    <textarea name="ev_adresi" id="ev_adresi" cols="20" rows="2"
                                        class="form-control form-control-sm "></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="acil_durum_kisi">Acil Durum Kişisi</label>
                                    <textarea name="acil_durum_kisi" id="acil_durum_kisi" cols="20" rows="2"
                                        class="form-control form-control-sm "></textarea>
                                </div>
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
                </div>
            </form>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th>Adı Soyadı</th>
                        <th>Askerlik Durumu</th>
                        <th>Doğum Yeri</th>
                        <th>Doğum Tarihi</th>
                        <th>Medeni Hali</th>
                        <th>Eğitimler</th>
                        <th>Evraklar</th>

                        <th>Aksiyon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personel as $sn => $personelitem)
                        <tr>
                            <th scope="row">{{ $sn + 1 }}</th>
                            <td>{{ $personelitem->ad_soyad }}</td>
                            <td>{{ $personelitem->askerlik_durumu }}</td>
                            <td>{{ $personelitem->dogum_yeri }} </td>
                            <td>{{ $personelitem->dogum_tarihi }} </td>
                            <td>{{ $personelitem->medeni_hali }} </td>
                            <td><button class=" text-success open-modal-btn" data-bs-toggle="modal"
                                data-bs-target="#perseonelegitimModal-{{ $personelitem->id }}">
                                <i class="fa-solid fa-award"></i>
                                </button>
                                @include('admin.contents.personel.personelegitim.personelegitim')
                            </td>
                            <td><button class="text-purple open-modal-btn" data-bs-toggle="modal"
                                data-bs-target="#perseoneldokumanModal-{{ $personelitem->id }}">
                                <i class="fa-solid fa-file"></i>
                                </button>
                                @include('admin.contents.personel.personeldokuman.personeldokuman')</td>


                            <td class="text-right">
                                <div class="databutton">
                                    <div class="d-flex align-items-center fs-6">

                                        <button class="text-warning" data-bs-toggle="modal"
                                            data-bs-target="#personelupdateModal-{{ $personelitem->id }}"><i
                                                class="bi bi-pencil-fill"></i></button>
                                        @include('admin.contents.personel.personel-update')
                                        <a href="{{ route('personell.show', ['personell' => $personelitem
                                        ->id]) }}"
                                            class="text-primary btn btn-link p-0 m-0 ">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <form
                                            action="{{ route('personell.destroy', ['personell' => $personelitem->id]) }}"
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
    </div>
</div>
@include('session.session')
@endsection
