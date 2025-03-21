@extends('admin.layouts.app')
@section('title')
    RAHAT FATURA ENTEGRASYON
@endsection
@section('contents')
@section('topheader')
    RAHAT FATURA ENTEGRASYON
@endsection
<div class="card">
    <div class="card-body">
        <form action="{{route('efaturaapiPUT',$efaturaapi->id)}}" method="POST" id="add-form">
            @csrf
            @method('PUT')

            <div class="row" style="padding: 1%; ">
                <div class="col-md-4">
                    <label for="rf_kullanici_adi">Kullanıcı Adı<code>*</code></label>
                    <div class="form-group input-with-icon">
                        <span class="icon">
                            <i class="fa-solid fa-check"></i>
                        </span>
                        <input type="text" name="rf_kullanici_adi" id="rf_kullanici_adi"
                            class="form-control form-control-sm" value="{{$efaturaapi->rf_kullanici_adi}}" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="rf_sifre">Şifre<code>*</code></label>
                    <div class="form-group input-with-icon">
                        <span class="icon">
                            <i class="fa-solid fa-check"></i>
                        </span>
                        <input type="text" name="rf_sifre" id="rf_sifre" value="{{$efaturaapi->rf_sifre}}" class="form-control form-control-sm"
                            required>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="rf_token">APİ - KEY<code>*</code></label>
                    <div class="form-group input-with-icon">
                        <span class="icon">
                            <i class="fa-solid fa-check"></i>
                        </span>
                        <input type="text" name="rf_token" id="rf_token" class="form-control form-control-sm" value="{{$efaturaapi->rf_token}}"
                            required>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <button type="submit" id="submit-form" class="btn btn-sm btn-outline-primary"
                        style="float: right; margin-left: 2px;">
                        Kaydet</button>
                    <a href="{{ route('entegrasyonmenu') }}" class="btn btn-sm btn-outline-secondary"
                        style="float: right"> Vazgeç</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
