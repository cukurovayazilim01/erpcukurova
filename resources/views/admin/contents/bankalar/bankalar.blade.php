@extends('admin.layouts.app')
@section('title')
Bankalar
@endsection
@section('contents')
@section('topheader')
Bankalar
@endsection
<div class="card radius-5">
    <div class="card-header bg-transparent">
        <div class="row ">
            <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">
                <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                    <button type="button" class="btn btn-outline-dark btn-sm " data-bs-toggle="modal"
                        data-bs-target="#bankaeklemodal"> <i class="fa-solid fa-plus"></i> Banka Ekle</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="bankaeklemodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="add-form" action="{{ route('bankalar.store') }}" method="POST" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Banka Kayıt Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body"
                    style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                    <div class="row ">
                                <div class="col-md-4">
                                    <label for="banka_adi">Banka Adı</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-inbox"></i>
                                        </span>
                                        <input type="text" name="banka_adi" id="banka_adi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="sube_adi">Şube Adı</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-inbox"></i>
                                        </span>
                                        <input type="text" name="sube_adi" id="sube_adi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="sube_kodu">Şube Kodu</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-inbox"></i>
                                        </span>
                                        <input type="text" name="sube_kodu" id="sube_kodu"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="hesap_adi">Hesap Adı</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-inbox"></i>
                                        </span>
                                        <input type="text" name="hesap_adi" id="hesap_adi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="iban">IBAN</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-inbox"></i>
                                        </span>
                                        <input type="text" name="iban" id="iban"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="hesap_no">Hesap No</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-money-bill"></i>
                                        </span>
                                        <input type="number" name="hesap_no" id="hesap_no"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="user_id">Yetkili Kişi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <select name="user_id" id="user_id"
                                            class="form-control form-control-sm" required>
                                            <option value="">Lütfen Seçim Yapınız...</option>
                                            @foreach ($user as $useritem)
                                            <option value="{{$useritem->id}}">{{$useritem->ad_soyad}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="acilis_bakiyesi">Açılış Bakiyesi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-money-bill"></i>
                                        </span>
                                        <input type="text" name="acilis_bakiyesi" id="acilis_bakiyesi"
                                            class="form-control form-control-sm input-mask" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="kart_turu">Kart Türü</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select name="kart_turu" id="kart_turu"
                                            class="form-control form-control-sm" required>
                                            <option value="Hesap Kartı">Hesap Kartı</option>
                                            <option value="Kredi Kartı">Kredi Kartı</option>
                                            <option value="Sanal Kart">Sanal Kart</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="doviz">Para Birimi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select name="doviz" id="doviz"
                                            class="form-control form-control-sm" required>
                                            <option value="TL">TL</option>
                                            <option value="DOLAR">DOLAR</option>
                                            <option value="EURO">EURO</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="acilis_bakiye_tarih">Banka Açılış Tarihi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="acilis_bakiye_tarih" id="acilis_bakiye_tarih"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="durum">Durum</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <select name="durum" id="durum" class="form-control form-control-sm">
                                            <option value="Aktif">Aktif</option>
                                            <option value="Pasif">Pasif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div
                            style="display: flex; padding: 10px 0; gap:20px; text-align: center; justify-content: end">

                            <button type="button" class="btn btn-outline-warning btn-sm py-6 w-25" data-bs-dismiss="modal">Vazgeç</button>
                            <button type="submit" id="submit-form" class="btn btn-outline-dark btn-sm py-6 w-75">Kaydet</button>

                            </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="card-body" style="border-radius: 5px">
        <div class="table-responsive" style="border-radius: 5px">
            <table class="table table-bordered table-striped" style="width:100%;  ">
                <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th>Açılış Tarihi</th>
                            <th>Banka Adı</th>
                            <th>Şube Adı/Kodu</th>
                            <th>Yetkili Kişi</th>
                            <th>Hesap Adı</th>
                            <th>Hesap No</th>
                            <th>IBAN</th>
                            <th>Açılış Bakiye</th>
                            <th>Bakiye</th>
                            <th>Kart Türü</th>
                            <th>Durum</th>
                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bankalar as $sn => $bankalaritem)
                            <tr>
                                <td scope="row">{{ $sn + 1 }}</td>
                                <td>{{ $bankalaritem->acilis_bakiye_tarih }}</td>
                                <td>{{ $bankalaritem->banka_adi }}</td>
                                <td>{{ $bankalaritem->sube_adi }}/{{ $bankalaritem->sube_kodu }}</td>
                                <td>{{ $bankalaritem->adsoyad->ad_soyad }}</td>
                                <td>{{ $bankalaritem->hesap_adi }}</td>
                                <td>{{ $bankalaritem->hesap_no }}</td>
                                <td>{{ $bankalaritem->iban }}</td>
                                <td>@if ($bankalaritem->doviz === 'TL')
                                    {{ number_format($bankalaritem->acilis_bakiyesi, 2, ',', '.') }} <b style="color: red">₺</b>
                                    @elseif($bankalaritem->doviz === 'DOLAR')
                                    {{ number_format($bankalaritem->acilis_bakiyesi, 2, ',', '.') }} <b style="color: blue">$</b>
                                    @elseif($bankalaritem->doviz === 'EURO')
                                    {{ number_format($bankalaritem->acilis_bakiyesi, 2, ',', '.') }} <b style="color: rgb(43, 255, 0)">€</b>
                                    @endif
                                </td>
                                <td>@if ($bankalaritem->doviz === 'TL')
                                    {{ number_format($bankalaritem->bakiye, 2, ',', '.') }} <b style="color: red">₺</b>
                                    @elseif($bankalaritem->doviz === 'DOLAR')
                                    {{ number_format($bankalaritem->bakiye, 2, ',', '.') }} <b style="color: blue">$</b>
                                    @elseif($bankalaritem->doviz === 'EURO')
                                    {{ number_format($bankalaritem->bakiye, 2, ',', '.') }} <b style="color: rgb(43, 255, 0)">€</b>
                                    @endif
                                </td>
                                <td>{{ $bankalaritem->kart_turu }}</td>
                                <td>@if ($bankalaritem->durum === 'Aktif')
                                    <span class="badge bg-success">{{ $bankalaritem->durum }}</span>
                                    @elseif($bankalaritem->durum === 'Pasif')
                                    <span class="badge bg-danger">{{ $bankalaritem->durum }}</span>
                                    @endif</td>
                                <td class="text-right">
                                    <div class="databutton">
                                        <div class="d-flex align-items-center fs-6"  style="justify-content: space-evenly; ">
                                            <button class="text-warning" data-bs-toggle="modal"
                                            data-bs-target="#bankalarupdateModal-{{ $bankalaritem->id }}"><i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i></button>
                                        @include('admin.contents.bankalar.bankalar-update')
                                            <form action="{{ route('bankalar.destroy', ['bankalar' => $bankalaritem->id]) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn  p-0 m-0 show_confirm">
                                                    <i style="color: rgb(180, 68, 34)"
                                                    class="fa-solid fa-trash-can fs-6"></i>
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

        <div class="col-sm-4 col-md-5 " style=" float: right; margin-top: 20px; ">
            {{-- {{ $aramalar->appends(['entries' => $perPage])->links() }} --}}
        </div>
    </div>
</div>
@include('session.session')
@endsection
