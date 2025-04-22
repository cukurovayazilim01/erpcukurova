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
    <style>
        .modal-body .row{
            border-bottom: 0px !important;
        }
    </style>
    <!-- Modal -->
    <div class="modal fade" id="sosyalmedyalistmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="add-form" action="{{ route('smhesaplarilist.store') }}" method="POST" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Sosyal Medya Hesap Bağla</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body"
                        style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                        <div class="row" style="padding: 0 5rem; display: flex; justify-content: center">
                            <div class="col-lg-4" style="position: relative;">
                                <a href="{{route('facebook.redirect')}}">
                                <div class="card radius-5 card-container">
                                    <div class="card-body text-center">
                                            <div class="col-md-12">
                                                <img src="{{ asset('resim/face.png') }}" alt="Instagram">
                                            </div>
                                            <div class="col-md-12">
                                                Facebook Sayfası / Bağlı Instagram Hesabı
                                            </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-lg-4" style="position: relative;">
                                <a href="#">
                                <div class="card radius-5 card-container">
                                    <div class="card-body text-center">
                                        <div class="col-md-12">
                                            <img src="{{ asset('resim/ins.png') }}" alt="Facebook">
                                        </div>
                                        <div class="col-md-12">
                                            Instagram İşletme
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-lg-4" style="position: relative;">
                                <a href="#">
                                <div class="card radius-5 card-container">
                                    <div class="card-body text-center">
                                        <div class="col-md-12">
                                            <img src="{{ asset('resim/gbusiness.png') }}" alt="Twitter">
                                        </div>
                                        <div class="col-md-12">
                                            Google Business
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-lg-4" style="position: relative;">
                                <a href="#">
                                <div class="card radius-5 card-container">
                                    <div class="card-body text-center">
                                        <div class="col-md-12">
                                            <img src="{{ asset('resim/youtube.png') }}" alt="Twitter">
                                        </div>
                                        <div class="col-md-12">
                                            Youtube
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-lg-4" style="position: relative;">
                                <a href="#">
                                <div class="card radius-5 card-container">
                                    <div class="card-body text-center">
                                        <div class="col-md-12">
                                            <img src="{{ asset('resim/twt.png') }}" alt="Twitter">
                                        </div>
                                        <div class="col-md-12">
                                            X (Twitter) İletişime Geçin
                                        </div>
                                    </div>
                                </div>
                            </a>

                            </div>
                            <div class="col-lg-4" style="position: relative;">
                                <a href="#">
                                <div class="card radius-5 card-container">
                                    <div class="card-body text-center">
                                        <div class="col-md-12">
                                            <img src="{{ asset('resim/lnk.png') }}" alt="LinkedIn">
                                        </div>
                                        <div class="col-md-12">
                                           Linkedin
                                        </div>
                                    </div>
                                </div>
                            </a>
                            </div>
                            <div class="col-lg-4" style="position: relative;">
                                <a href="#">
                                <div class="card radius-5 card-container">
                                    <div class="card-body text-center">
                                        <div class="col-md-12">
                                            <img src="{{ asset('resim/tiktok.png') }}" alt="LinkedIn">
                                        </div>
                                        <div class="col-md-12">
                                           Tiktok
                                        </div>
                                    </div>
                                </div>
                            </a>
                            </div>
                            <div class="col-lg-4" style="position: relative;">
                                <a href="#">
                                <div class="card radius-5 card-container">
                                    <div class="card-body text-center">
                                        <div class="col-md-12">
                                            <img src="{{ asset('resim/telegram.png') }}" alt="LinkedIn">
                                        </div>
                                        <div class="col-md-12">
                                           Telegram
                                        </div>
                                    </div>
                                </div>
                            </a>
                            </div>
                            <div class="col-lg-4" style="position: relative;">
                                <a href="#">
                                    <div class="card radius-5 card-container">
                                        <div class="card-body text-center">
                                            <div class="col-md-12">
                                                <img src="{{ asset('resim/wp.png') }}" alt="LinkedIn">
                                            </div>
                                            <div class="col-md-12">
                                               Whatsapp (Yakında)
                                            </div>
                                        </div>
                                    </div>
                            </a>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-4">



                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card-body" style="border-radius: 5px">
        <div class="table-responsive" style="border-radius: 5px">
            <table class="table table-bordered table-striped" style="width:100%;" id="example2">
                <thead>
                    <tr>
                        <th style="color: white" scope="col">#</th>
                        <th style="color: white">Hesap Adı</th>
                        <th style="color: white">Platform</th>
                        <th style="color: white">Açılış Tarihi</th>
                        <th style="color: white">Bağlı Mail</th>
                        <th style="color: white">Bağlı Telefon</th>
                        <th style="color: white">Sorumlu Personel</th>
                        <th style="color: white">Durum</th>

                        <th style="color: white">Aksiyon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($account as $sn => $accountitem)
                        <tr>
                            <td scope="row">{{ $sn + 1 }}</td>
                            <td>
                                {{ $accountitem->account_name }}
                            </td>
                            @if ($accountitem->platform_tipi == 'İnstagram')
                                <td><i class="fa-brands fa-instagram" style="color: #E1306C; font-size: 25px"></i></td>
                            @elseif ($accountitem->platform_tipi == 'Facebook')
                                <td><i class="fa-brands fa-facebook-f" style="color: #1877F2; font-size: 25px"></i></td>
                            @elseif ($accountitem->platform_tipi == 'X')
                                <td><i class="fa-brands fa-x-twitter" style="color: #000000; font-size: 25px"></i></td>
                            @elseif ($accountitem->platform_tipi == 'LinkedIn')
                                <td><i class="fa-brands fa-linkedin-in" style="color: #0077B5; font-size: 25px"></i>
                                </td>
                            @else
                                <td><i class="fa-solid fa-question" style="color: #666666; font-size: 25px"></i></td>
                            @endif
                            <td>{{ $accountitem->acilis_tarihi }}</td>
                            <td>{{ $accountitem->mail }}</td>
                            <td>{{ $accountitem->telefon }}</td>
                            <td>{{ $accountitem->adsoyad->ad_soyad }}</td>
                            <td>@if ($accountitem->status === 'Aktif')
                                <span class="badge bg-success">{{ $accountitem->status }}</span>
                                @elseif($accountitem->status === 'Pasif')
                                <span class="badge bg-danger">{{ $accountitem->status }}</span>
                                @endif</td>



                            <td class="text-right">
                                <div class="databutton">
                                    <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">
                                        <button data-bs-toggle="modal"
                                            data-bs-target="#smhesaplarilistupdateModal-{{ $accountitem->id }}">
                                            <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i>
                                        </button>
                                        @include('admin.contents.smhesaplarilist.smhesaplarilist-update')

                                        <form
                                            action="{{ route('smhesaplarilist.destroy', ['smhesaplarilist' => $accountitem->id]) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn  p-0 m-0 show_confirm">
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
