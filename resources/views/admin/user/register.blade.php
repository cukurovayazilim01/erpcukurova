@extends('admin.layouts.app')
@section('title')
    KULLANICI KAYIT
@endsection
@section('contents')
@section('topheader')
KULLANICI KAYIT
@endsection
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="background-image: linear-gradient(to right, rgb(24, 55, 139) , rgb(247, 247, 247));">
                    <h4 class="card-title text-white">Kullanıcı Kayıt Ekranı</h4>
                </div><!--end card-header-->
                <div class="card-body">
                    <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <label for="ad_soyad">Resim <code>*</code></label>
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="file" name="resim" id="input-file-now" class="dropify" />
                                        </div><!--end card-body-->
                                    </div><!--end card-->
                            </div>
                            <div class="col-md-4"></div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ad_soyad">Ad Soyad <code>*</code></label>
                                    <input type="text" class="form-control form-control-sm" id="ad_soyad"
                                        name="ad_soyad" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="departman">Departman <code>*</code></label>
                                    <input type="text" class="form-control form-control-sm" id="departman" name="departman" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="gorev">Görev <code>*</code></label>
                                <input type="text" class="form-control form-control-sm" id="gorev" name="gorev" required>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="telefon">Telefon <code>*</code></label>
                                    <input type="text" class="form-control form-control-sm" id="telefon" name="telefon" required>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="email">E-Posta <code>*</code></label>
                                    <input type="email" class="form-control form-control-sm" id="email" name="email" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="username">Kullanıcı Adı <code>*</code></label>
                                    <input type="text" class="form-control form-control-sm" id="username" name="username" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="password">Şifre <code>*</code></label>
                                    <input type="text" class="form-control form-control-sm" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="role">Yetki <code>*</code></label>
                                    <select name="role" id="role" class="form-control form-control-sm">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="durum">Durum <code>*</code></label>
                                    <select name="durum" id="durum" class="form-control form-control-sm">
                                        <option value="Aktif">Aktif</option>
                                        <option value="Pasif">Pasif</option>
                                    </select>
                                </div>
                            </div>

                        </div> <!-- end row -->
                    </div> <!-- end row -->
                        <div class="card-footer text-center" style="margin-top: 5px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary btn-block btn-sm"><i class="fa fa-save"
                                            aria-hidden="true"></i> Kaydet</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('register.index') }}" class="btn btn-danger btn-block btn-sm"><i
                                            class="fa fa-backward" aria-hidden="true"></i> Vazgeç</a>

                                </div>
                            </div>
                        </div>
                    </form>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->
@endsection
