@extends('admin.layouts.app')
@section('title')
STMP MAIL ENTEGRASYON
@endsection
@section('contents')
@section('topheader')
STMP MAIL ENTEGRASYON
@endsection
<div class="card">
    <div class="card-body">
        <form action="#" method="POST" id="add-form" enctype="multipart/form-data">
            @csrf
            <div class="row" style="padding: 1%; ">
                    <div class="col-md-3">
                        <label for="mail_host">Giden Mail Sunucusu<code>*</code></label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <input type="text" name="mail_host" id="mail_host"
                                class="form-control form-control-sm" placeholder="smtp.cukurovapatent.com" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="mail_port">Giden Mail Port<code>*</code></label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <input type="text" name="mail_port" id="mail_port"
                                class="form-control form-control-sm" placeholder="465" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="mail_username">Email Adres<code>*</code></label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <input type="text" name="mail_username" id="mail_username"
                                class="form-control form-control-sm" placeholder="info@cukurovapatent.com" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="mail_password">Email Şifre<code>*</code></label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <input type="text" name="mail_password" id="mail_password"
                                class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="mail_encryption">SSL/TLS<code>*</code></label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <select name="mail_encryption" id="mail_encryption"
                                class="form-select form-select-sm" required>
                                <option value="SSL">SSL</option>
                                <option value="TSL">TSL</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="mail_from_address">Gönderen Mail Adres<code>*</code></label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <input type="text" name="mail_from_address" id="mail_from_address"
                                class="form-control form-control-sm" placeholder="info@cukurovapatent.com" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="mail_from_name">Gönderen Başlık<code>*</code></label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <input type="text" name="mail_from_name" id="mail_from_name"
                                class="form-control form-control-sm" placeholder="ÇUKUROVA PATENT" required>
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
