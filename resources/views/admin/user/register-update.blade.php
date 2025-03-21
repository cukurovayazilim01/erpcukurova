@extends('admin.layouts.app')
@section('title')
    Kullanıcı Kayıt
@endsection
@section('contents')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="background-image: linear-gradient(to right, rgb(28, 139, 24) , rgb(247, 247, 247));">
                    <h4 class="card-title text-white">Kullanıcı Güncelemme</h4>
                </div><!--end card-header-->
                <div class="card-body">
                    <form action="{{ route('register.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <label for="ad_soyad">Resim <code>*</code></label>
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="file" name="resim" id="input-file-now" class="dropify" data-default-file="{{$user->resim}}" />                                                   
                                        </div><!--end card-body-->
                                    </div><!--end card-->
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ad_soyad">Ad Soyad <code>*</code></label>
                                    <input type="text" class="form-control form-control-sm" id="ad_soyad" value="{{$user->ad_soyad}}"
                                        name="ad_soyad" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="departman">Departman <code>*</code></label>
                                    <input type="text" class="form-control form-control-sm" id="departman" name="departman" value="{{$user->departman}}" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="gorev">Görev <code>*</code></label>
                                <input type="text" class="form-control form-control-sm" id="gorev" name="gorev" value="{{$user->gorev}}" required>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="telefon">Telefon <code>*</code></label>
                                    <input type="text" class="form-control form-control-sm" id="telefon" name="telefon" value="{{$user->telefon}}" required>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="email">E-Posta <code>*</code></label>
                                    <input type="email" class="form-control form-control-sm" id="email" name="email" value="{{$user->email}}" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="username">Kullanıcı Adı <code>*</code></label>
                                    <input type="text" class="form-control form-control-sm" id="username" name="username" value="{{$user->username}}"  required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="role">Yetki <code>*</code></label>
                                    <select name="role" id="role" class="form-control form-control-sm">
                                        <option value="Standart-User" {{$user->hasRole('Standart-User') ? 'selected' : ''}}>Standart-User</option>
                                      @foreach ($roles as $role)
                                      @if ($role->name != 'Standart-User')
                                      <option value="{{$role->name}}" {{$user->hasRole($role->name) ? 'selected' : ''}}>
                                        {{$role->name}}</option>        
                                      @endif
                                      @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="durum">Durum <code>*</code></label>
                                    <select name="durum" id="durum" class="form-control form-control-sm">
                                        <option value="Aktif" {{$user->durum == 'Aktif' ? 'selected' : ''}}>Aktif</option>
                                        <option value="Pasif" {{$user->durum == 'Pasif' ? 'selected' : ''}}>Pasif</option>
                                    </select>
                                </div>
                            </div>

                        </div> <!-- end row -->
                    </div> <!-- end row -->
                        <div class="card-footer text-center" style="margin-top: 5px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success btn-block btn-sm"><i class="fa fa-save"
                                            aria-hidden="true"></i> Güncelle</button>
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
