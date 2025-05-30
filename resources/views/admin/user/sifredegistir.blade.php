@extends('admin.adminlayouts.adminapp')
@section('contents')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="wrapper">
            <div class="card">
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                @if($errors)
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
                @endif
                <form class="form-horizontal" method="POST" action="{{ route('postsifredegistir') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                        <label for="new-password" class="col-md-4 control-label">Mevcut Şifre</label>

                        <div class="col-md-6">
                            <input id="current-password" type="password" class="form-control" name="current-password"
                                required>

                            @if ($errors->has('current-password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('current-password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                        <label for="new-password" class="col-md-4 control-label">Yeni Şifre</label>
                        <div class="col-md-6">
                            <input id="new-password" type="password" class="form-control" name="new-password" required>

                            @if ($errors->has('new-password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('new-password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="new-password-confirm" class="col-md-4 control-label">Yeni Şifre Tekrar</label>
                        <div class="col-md-6">
                            <input id="new-password-confirm" type="password" class="form-control"
                                name="new-password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Şifreyi değiştir
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection