@extends('admin.layouts.app')
@section('title')
    Tahsilat
@endsection
@section('contents')
    @section('topheader')
        Tahsilat
    @endsection
    <div class="card radius-5">
        <div class="card-body"
            style="border-radius: 5px; padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">
            <div class="row">
                <form action="{{ route('sosyalmedya.update', $sosyalmedya->id) }}" method="POST"
                    enctype="multipart/form-data" id="add-form">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12" style="padding: 1%; ">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <label for="gonderi_zamani">Gönderi Zamanı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="datetime-local" name="gonderi_zamani" id="gonderi_zamani" value="{{$sosyalmedya->gonderi_zamani}}"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="gonderi_yeri">Gönderi Yeri</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <select name="gonderi_yeri" id="gonderi_yeri" class="form-control form-control-sm"
                                        required>
                                        <option value="">Lütfen Seçim Yapınız</option>
                                        <option value="instagram"  {{ $sosyalmedya->gonderi_yeri == 'instagram' ? 'selected' : '' }}>İnstagram</option>
                                        <option value="facebook" {{ $sosyalmedya->gonderi_yeri == 'facebook' ? 'selected' : '' }}>Facebook</option>
                                        <option value="linkedin" {{ $sosyalmedya->gonderi_yeri == 'linkedin' ? 'selected' : '' }}>Linkedin</option>
                                        <option value="X" {{ $sosyalmedya->gonderi_yeri == 'X' ? 'selected' : '' }}>X</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="gonderi_adi">Gönderi Adı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="gonderi_adi" id="gonderi_adi" value="{{$sosyalmedya->gonderi_adi}}"
                                        class="form-control form-control-sm " >
                                </div>
                            </div>
                            <h5>Mevcut Resimler:</h5>
                            @php
                                $resimler = json_decode($sosyalmedya->resim, true) ?? [];
                            @endphp

                            @if ($resimler)
                                <div class="d-flex flex-wrap gap-3">
                                    @foreach ($resimler as $key => $resim)
                                        <div class="position-relative text-center">
                                            <img src="{{ asset($resim) }}" width="120" class="border rounded mb-1">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="silinecek_resimler[]" value="{{ $resim }}" id="sil-{{ $key }}">
                                                <label class="form-check-label" for="sil-{{ $key }}">Sil</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif



                            <div class="col-md-4 col-sm-12">
                                <label for="odeme_yapan">Gönderi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="file" name="resim[]" multiple class="form-control form-control-sm"
                                        >
                                </div>
                            </div>

                            {{--
                            <div class="col-md-4 col-sm-12">
                                <label for="odeme_tipi">Ödeme Yöntemi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <select name="odeme_tipi" id="odeme_tipi" class="form-control form-control-sm" required>
                                        <option value="">Lütfen Seçim Yapınız</option>
                                        <option value="Kasa">Kasa</option>
                                        <option value="Banka">Banka</option>
                                    </select>
                                </div>

                            </div>





                            <div class="col-md-4 col-sm-12">
                                <label for="tahsilat_tutar">Tahsilat Tutarı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-money-bill"></i>
                                    </span>
                                    <input type="text" name="tahsilat_tutar" id="tahsilat_tutar"
                                        class="form-control form-control-sm input-mask" required>
                                </div>
                            </div> --}}

                        </div>
                    </div>


                    <div style="display: flex; padding: 10px; gap:20px; text-align: center; justify-content: end">

                        <a href="{{route('sosyalmedya.index')}}" class="btn btn-outline-warning btn-sm py-6 w-25">
                            Vazgeç</a>
                        <button type="submit" id="submit-form" class="btn btn-outline-dark btn-sm py-6 w-75">
                            Kaydet</button>
                    </div>

                </form>


            </div>
        </div>
    </div>


@endsection
