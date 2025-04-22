@extends('admin.layouts.app')
@section('title')
ÖZTEK SMS ENTEGRASYON
@endsection
@section('contents')
@section('topheader')
ÖZTEK SMS ENTEGRASYON
@endsection
<div class="card">
    <div class="card-body">
        <form action="{{route('smsapiPUT',$smsapi->id)}}" method="POST" id="add-form">
            @csrf
            @method('PUT')
            <div class="row" style="padding: 1%; ">
                    <div class="col-md-3">
                        <label for="kullanici_no">Kullanıcı No<code>*</code></label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <input type="text" name="kullanici_no" id="kullanici_no"  value="{{$smsapi->kullanici_no}}"
                                class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="kullanici_adi">Kullanıcı Adı<code>*</code></label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <input type="text" name="kullanici_adi" id="kullanici_adi" value="{{$smsapi->kullanici_adi}}"
                                class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="sifre">Şifre<code>*</code></label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <input type="text" name="sifre" id="sifre" value="{{$smsapi->sifre}}"
                                class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="orginator">SMS Başlığı (Orginator)<code>*</code></label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <input type="text" name="orginator" id="orginator" value="{{$smsapi->orginator}}"
                                class="form-control form-control-sm" required>
                        </div>
                    </div>

                        <div class="col-md-12 mt-3">
                            <button type="submit" id="submit-form" class="btn btn-sm btn-outline-primary"
                                style="float: right; margin-left: 2px;">
                                Kaydet</button>
                            <a href="{{route('entegrasyonmenu')}}" class="btn btn-sm btn-outline-secondary" style="float: right"> Vazgeç</a>
                        </div>
                    </div>


                </form>


            </div>
        </div>

@endsection
