@extends('admin.layouts.app')
@section('title')
    Kullanıcı Kayıt
@endsection
@section('contents')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="background-image: linear-gradient(to right, rgb(28, 139, 24) , rgb(247, 247, 247));">
                    <h4 class="card-title text-white">{{$user->ad_soyad}} ŞİFRE GÜNCELLEME</h4>
                </div><!--end card-header-->
                <div class="card-body">
                    <form action="{{ route('userresetpasswordPOST',$user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="username">Yeni Şifre <code>*</code></label>
                                    <input type="text" class="form-control form-control-sm" id="password" name="password"  required>
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
