@extends('admin.layouts.app')
@section('title')
Sosyal Medya Hesapları
@endsection
@section('contents')
@section('topheader')
Sosyal Medya Hesapları
@endsection
<div class="card radius-5">
    <div class="card-header bg-transparent">
        <div class="row ">

            <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">

                <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                    <button type="button" class="btn btn-outline-dark btn-sm " data-bs-toggle="modal"
                    data-bs-target="#sosyalmedyalistmodal"> <i class="fa-solid fa-plus"></i> Yeni Ekle</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="sosyalmedyalistmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="add-form" action="{{ route('smhesaplarilist.store') }}" method="POST" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Sosyal Medya Hesap Kayıt Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body"
                    style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                    <div class="row ">
                                <div class="col-md-6">
                                    <label for="hesap_adi">Hesap Adı</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-inbox"></i>
                                        </span>
                                        <input type="text" name="hesap_adi" id="hesap_adi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="acilis_tarihi">Açılış Tarihi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="acilis_tarihi" id="acilis_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="platform">Hesap Platformu</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select name="platform" id="platform"
                                            class="form-control form-control-sm" required>
                                            <option value="">Lütfen Seçiniz</option>
                                            <option value="İnstagram">İnstagram</option>
                                            <option value="Facebook">Facebook</option>
                                            <option value="X">X</option>
                                            <option value="LinkedIn">LinkedIn</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="mail">Bağlı Mail</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-envelope"></i>
                                        </span>
                                        <input type="mail" name="mail" id="mail"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="telefon">Bağlı Telefon</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-phone"></i>
                                        </span>
                                        <input type="number" name="telefon" id="telefon"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="personel_id">Sorumlu Personel</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <select name="personel_id" id="personel_id"
                                            class="form-select form-select-sm" required>
                                            <option value="">Lütfen Seçiniz</option>
                                            @foreach ($personel as $personelitem)
                                                <option value="{{ $personelitem->id }}">
                                                    {{ $personelitem->ad_soyad }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
            <table class="table table-bordered table-hover" style="width:100%;" id="example2">
                <thead >
                    <tr>
                        <th style="color: white" scope="col">#</th>
                        <th style="color: white">Hesap Adı</th>
                        <th style="color: white">Platform</th>
                        <th style="color: white">Açılış Tarihi</th>
                        <th style="color: white">Bağlı Mail</th>
                        <th style="color: white">Bağlı Telefon</th>
                        <th style="color: white">Sorumlu Personel</th>

                        <th style="color: white">Aksiyon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($smhesaplarilist as $sn => $smhesaplarilistitem)
                    <tr>
                        <td scope="row">{{ $sn + 1 }}</td>
                        <td>
                            {{$smhesaplarilistitem->hesap_adi}}
                        </td>
                        @if ($smhesaplarilistitem->platform == 'İnstagram')
                        <td><i class="fa-brands fa-instagram" style="color: #E1306C; font-size: 25px"></i></td>
                    @elseif ($smhesaplarilistitem->platform == 'Facebook')
                        <td><i class="fa-brands fa-facebook-f" style="color: #1877F2; font-size: 25px"></i></td>
                    @elseif ($smhesaplarilistitem->platform == 'X')
                        <td><i class="fa-brands fa-x-twitter" style="color: #000000; font-size: 25px"></i></td>
                    @elseif ($smhesaplarilistitem->platform == 'LinkedIn')
                        <td><i class="fa-brands fa-linkedin-in" style="color: #0077B5; font-size: 25px"></i></td>
                    @else
                        <td><i class="fa-solid fa-question" style="color: #666666; font-size: 25px"></i></td>
                    @endif
                        <td>{{ $smhesaplarilistitem->acilis_tarihi }}</td>
                        <td>{{ $smhesaplarilistitem->mail }}</td>
                        <td>{{ $smhesaplarilistitem->telefon }}</td>
                        <td>{{ $smhesaplarilistitem->personel->ad_soyad }}</td>



                        <td class="text-right">
                            <div class="databutton">
                                <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">
                                <button data-bs-toggle="modal"
                                    data-bs-target="#smhesaplarilistupdateModal-{{ $smhesaplarilistitem->id }}">
                                    <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i>
                                </button>
                                @include('admin.contents.smhesaplarilist.smhesaplarilist-update')

                                    <form
                                        action="{{ route('smhesaplarilist.destroy', ['smhesaplarilist' => $smhesaplarilistitem->id]) }}"
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
    </div>
</div>
@include('session.session')




@endsection
