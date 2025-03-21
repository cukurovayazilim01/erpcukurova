@extends('admin.layouts.app')
@section('title')
    KULLANICILAR
@endsection
@section('contents')
@section('topheader')
    KULLANICILAR
@endsection


<div class="row">
    @foreach ($user as $item)
        <div class="col-md-3">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-body">
                    <div class="profile-avatar text-center">
                        <img src="{{ $item->resim }}" class="rounded-circle shadow" width="120" height="120"
                            alt="">
                    </div>

                    <div class="text-center mt-4">
                        <h4 class="mb-1">{{ $item->ad_soyad }}</h4>
                        <p class="mb-0 text-secondary">{{ $item->username }}</p>
                        {{-- <div class="mt-4"></div>
                        <h6 class="mb-1">HR Manager - Codervent Technology</h6>
                        <p class="mb-0 text-secondary">University of Information Technology</p> --}}
                    </div>

                </div>
                <ul class="list-group list-group-flush">
                    <li
                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-top">
                        E-Posta
                        <span class=" rounded-pill">{{ $item->email }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                        Telefon
                        <span class=" rounded-pill">{{ $item->telefon }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                        Departman
                        <span class=" rounded-pill">{{ $item->departman }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                        Yetki
                        <span class=" rounded-pill">
                            @foreach ($item->roles as $role)
                                {{ $role->name }}
                            @endforeach
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                        Durum
                        <span class=" rounded-pill">
                            @if ($item->durum == 'Aktif')
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Pasif</span>
                            @endif
                        </span>
                    </li>
                </ul>


                <div class="d-flex align-items-center justify-content-around mt-5 gap-3">
                    <!-- Şifre İşlemleri -->
                    <div class="text-center">
                        <button type="button" class="btn btn-sm btn-outline-warning" data-toggle="modal"
                            data-target="#exampleModalSuccess{{ $item->id }}">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </button>
                        <p class="mb-0 text-secondary">Şifre İşlemleri</p>
                    </div>

                    <!-- Güncelle -->
                    <div class="text-center">
                        <a href="{{ route('register.edit', ['register' => $item->id]) }}" class="btn btn-sm btn-outline-success ">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </a>
                        <p class="mb-0 text-secondary">Güncelle</p>
                    </div>

                    <!-- Sil -->
                    <div class="text-center">
                        <form action="{{ route('register.destroy', ['register' => $item->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="show_confirm btn btn-sm btn-outline-danger">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>
                        <p class="mb-0 text-secondary">Sil</p>
                    </div>
                </div>

                <!-- Şifre İşlemleri Modal -->
                <div class="modal fade" id="exampleModalSuccess{{ $item->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalSuccess{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{ route('sifredegistir', $item->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="modal-content">
                                <div class="modal-header bg-success">
                                    <h6 class="modal-title m-0 text-white">
                                        {{ $item->ad_soyad }} Şifre Değiştirme
                                    </h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12 text-center align-self-center">
                                            <div class="form-group">
                                                <label for="password">Yeni Şifre <code>*</code></label>
                                                <input type="password" class="form-control form-control-sm" id="password"
                                                    name="password" minlength="6" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Vazgeç</button>
                                    <button type="submit" class="btn btn-success btn-sm">Şifreyi Değiştir</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    @endforeach
</div>


<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Kullanıcılar</h4>
                    </div><!--end col-->

                    <div class="col-md">
                        <ul class="nav nav-pills mb-0 d-inline-flex" id="pills-tab" role="tablist">
                            <li class="nav-item mr-1">
                                <a class="nav-link active" id="pills-grid-tab" data-toggle="pill" href="#Grid_Style"
                                    role="tab" aria-controls="pills-grid" aria-selected="true">
                                    <i class="las la-border-all"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-list-tab" data-toggle="pill" href="#List_style"
                                    role="tab" aria-controls="pills-list" aria-selected="false">
                                    <i class="las la-list-ul"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-auto align-self-center">
                        <div class="d-inline-block">
                            <a href="{{ route('register.create') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                <span>Yeni Ekle</span>
                            </a>
                        </div>

                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->
    {{--     <div class="row" style="padding-bottom: 1%">
        <div class="col-md-12">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="validationTooltipUsernamePrepend"><i class="fa fa-search" aria-hidden="true"></i></span>
                </div>
                <input type="text" class="form-control" id="validationTooltipUsername" placeholder="Lütfen Arama Terimi Giriniz ..." aria-describedby="validationTooltipUsernamePrepend" required="">
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-12">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="Grid_Style" role="tabpanel" aria-labelledby="pills-grid-tab">
                    <div class="search-results">
                        <div class="row">
                            @foreach ($user as $item)
                                <div class="col-lg-3">
                                    <div class="card client-card">
                                        <div class="card-body text-center">
                                            <img src="{{ $item->resim }}" alt="user"
                                                class="rounded-circle thumb-xl">
                                            <h5 class="client-name">{{ $item->ad_soyad }} / {{ $item->username }}</h5>
                                            <span class="text-muted mr-3"><i class="fa fa-envelope"
                                                    aria-hidden="true"></i> {{ $item->email }}</span>
                                            <span class="text-muted"><i
                                                    class="dripicons-phone mr-2 text-dark"></i>{{ $item->telefon }}</span>
                                            <div class="text-muted text-center my-3">
                                                <span class="badge badge-light">{{ $item->departman }}</span>
                                                <span class="badge badge-light">{{ $item->gorev }}</span>
                                            </div>
                                            <div class="text-muted text-center my-3">
                                                <span class="badge badge-primary">
                                                    @foreach ($item->roles as $role)
                                                        Yetki : {{ $role->name }}
                                                    @endforeach
                                                </span>
                                            </div>
                                            <div class="text-muted text-center my-3">
                                                @if ($item->durum == 'Aktif')
                                                    Durum : <span class="badge badge-success">Aktif</span>
                                                @else
                                                    Durum : <span class="badge badge-danger">Pasif</span>
                                                @endif
                                            </div>
                                            <button type="button" class="btn btn-sm btn-soft-warning"
                                                data-toggle="modal"
                                                data-target="#exampleModalSuccess{{ $item->id }}"><i
                                                    class="fa fa-lock" aria-hidden="true"></i> Şifre
                                                İşlemleri</button>
                                            <div class="modal fade" id="exampleModalSuccess{{ $item->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalSuccess1"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{ route('sifredegistir', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success">
                                                                <h6 class="modal-title m-0 text-white"
                                                                    id="exampleModalSuccess1">{{ $item->ad_soyad }}
                                                                    Şifre Değiştirme</h6>
                                                                <button type="button" class="close "
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"><i
                                                                            class="la la-times text-white"></i></span>
                                                                </button>
                                                            </div><!--end modal-header-->
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div
                                                                        class="col-lg-12 text-center align-self-center">
                                                                        <div class="form-group">
                                                                            <label for="username">Yeni Şifre
                                                                                <code>*</code></label>
                                                                            <input type="text"
                                                                                class="form-control form-control-sm"
                                                                                id="password" name="password"
                                                                                required>
                                                                        </div>
                                                                    </div><!--end col-->
                                                                </div><!--end row-->
                                                            </div><!--end modal-body-->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    data-dismiss="modal">Vazgeç</button>
                                                                <button type="submit"
                                                                    class="btn btn-success btn-sm">Şifreyi
                                                                    Değiştir</button>
                                                            </div><!--end modal-footer-->
                                                        </div><!--end modal-content-->
                                                    </form>
                                                </div><!--end modal-dialog-->
                                            </div><!--end modal-->
                                            <a href="{{ route('register.edit', ['register' => $item->id]) }}"
                                                class="btn btn-sm btn-soft-success text-success"><i class="fa fa-edit"
                                                    aria-hidden="true"></i> Güncelle</a>
                                            <form action="{{ route('register.destroy', ['register' => $item->id]) }}"
                                                style="all: initial;" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    class="show_confirm btn btn-sm btn-soft-danger"><i
                                                        class="fa fa-trash" aria-hidden="true"></i> Sil</button>
                                            </form>
                                        </div><!--end card-body-->
                                    </div><!--end card-->
                                </div><!--end col-->
                            @endforeach
                        </div><!--end row-->
                    </div>
                </div><!--end tab-pene-->
                <div class="tab-pane fade" id="List_style" role="tabpanel" aria-labelledby="pills-list-tab">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table mb-0">
                                            <caption>List of users</caption>
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Resim</th>
                                                    <th scope="col">Kullanıcı Adı</th>
                                                    <th scope="col">Telefon</th>
                                                    <th scope="col">E-Posta</th>
                                                    <th scope="col">Yetki</th>
                                                    <th scope="col">Durum</th>
                                                    <th scope="col" class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user as $sn => $item)
                                                    <tr>
                                                        <td>{{ $sn + 1 }}</td>
                                                        <td>
                                                            <div class="media">
                                                                <img src="{{ $item->resim }}" height="40"
                                                                    class="mr-3 align-self-center rounded"
                                                                    alt="...">
                                                                <div class="media-body align-self-center">
                                                                    <h6 class="m-0">{{ $item->ad_soyad }}</h6>
                                                                    <p class="mb-0 text-muted font-11">
                                                                        {{ $item->departman }}/{{ $item->gorev }}</p>
                                                                </div><!--end media body-->
                                                            </div>
                                                        </td>
                                                        <td><i class="fa fa-user" aria-hidden="true"></i>
                                                            {{ $item->username }}</td>
                                                        <td><i
                                                                class="dripicons-phone mr-2 text-dark"></i>{{ $item->telefon }}
                                                        </td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>
                                                            @foreach ($item->roles as $role)
                                                                {{ $role->name }}
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @if ($item->durum == 'Aktif')
                                                                <span class="badge badge-success">Aktif</span>
                                                            @else
                                                                <span class="badge badge-danger">Pasif</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-right">
                                                            <button type="button" class=""
                                                                style="all: initial;" data-toggle="modal"
                                                                data-target="#exampleModalSuccess1{{ $item->id }}"><i
                                                                    class="fa fa-lock"
                                                                    aria-hidden="true"></i></button>
                                                            <div class="modal fade"
                                                                id="exampleModalSuccess1{{ $item->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalSuccess1"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <form
                                                                        action="{{ route('sifredegistir', $item->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('put')
                                                                        <div class="modal-content">
                                                                            <div class="modal-header bg-success">
                                                                                <h6 class="modal-title m-0 text-white"
                                                                                    id="exampleModalSuccess1">
                                                                                    {{ $item->ad_soyad }} Şifre
                                                                                    Değiştirme</h6>
                                                                                <button type="button" class="close "
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true"><i
                                                                                            class="la la-times text-white"></i></span>
                                                                                </button>
                                                                            </div><!--end modal-header-->
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div
                                                                                        class="col-lg-12 text-center align-self-center">
                                                                                        <div class="form-group">
                                                                                            <label for="username">Yeni
                                                                                                Şifre
                                                                                                <code>*</code></label>
                                                                                            <input type="text"
                                                                                                class="form-control form-control-sm"
                                                                                                id="password"
                                                                                                name="password"
                                                                                                required>
                                                                                        </div>
                                                                                    </div><!--end col-->
                                                                                </div><!--end row-->
                                                                            </div><!--end modal-body-->
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-danger btn-sm"
                                                                                    data-dismiss="modal">Vazgeç</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-success btn-sm">Şifreyi
                                                                                    Değiştir</button>
                                                                            </div><!--end modal-footer-->
                                                                        </div><!--end modal-content-->
                                                                    </form>
                                                                </div><!--end modal-dialog-->
                                                            </div><!--end modal-->
                                                            <a
                                                                href="{{ route('register.edit', ['register' => $item->id]) }}"><i
                                                                    class="las la-pen text-secondary font-18"></i></a>
                                                            <form
                                                                action="{{ route('register.destroy', ['register' => $item->id]) }}"
                                                                style="all: initial;" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="show_confirm"
                                                                    style="all: inherit"><i
                                                                        class="las la-trash-alt text-danger font-18"
                                                                        aria-hidden="true"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table><!--end /table-->
                                    </div><!--end /tableresponsive-->
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end tab-pene-->
            </div><!--end tab-content-->
        </div><!--end col-->
    </div><!--end row-->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#validationTooltipUsername').keyup(function() {
                var query = $(this).val();

                $.ajax({
                    url: '/usersearch',
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function(response) {
                        $('.search-results').html(response);
                    }
                });
            });
        });
    </script>
@endsection
