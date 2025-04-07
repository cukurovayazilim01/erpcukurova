@extends('admin.layouts.app')
@section('title')
    Hizmetler
@endsection
@section('contents')
    @section('topheader')
        Hizmetler
    @endsection
    <div class="card radius-5">
        <div class="card-header bg-transparent">
            <div class="row ">
                <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">
                    <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                        <button type="button" class="btn btn-outline-dark btn-sm " data-bs-toggle="modal"
                            data-bs-target="#hizmetlermodal"> <i class="fa-solid fa-plus"></i> Yeni Ekle</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="hizmetlermodal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <form action="{{ route('hizmetler.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                    @csrf
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header ">
                            <h5 class="modal-title">Hizmetler</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body"
                        style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                                <div class="row ">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="hizmetler_kategori_id">Hizmet Kategori Adı</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-layer-group"></i>
                                            </span>
                                            <select name="hizmetler_kategori_id" id="hizmetler_kategori_id"
                                                class="form-control form-control-sm">
                                                <option value="">Lütfen Seçim Yapınız..</option>
                                                @foreach ($hizmetlerkategori as $item)
                                                    <option value="{{$item->id}}">{{$item->kategori_ad}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="hizmet_ad">Hizmet Adı</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-layer-group"></i>
                                            </span>
                                            <input type="text" name="hizmet_ad" id="hizmet_ad"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="hizmet_maliyet">Hizmet Maliyet</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-money-bill"></i>
                                            </span>
                                            <input type="number" name="hizmet_maliyet" id="hizmet_maliyet"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="hizmet_satis_fiyati">Hizmet Fiyatı</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-money-bill"></i>
                                            </span>
                                            <input type="number" name="hizmet_satis_fiyati" id="hizmet_satis_fiyati"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="durum">Durum</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-check"></i>
                                            </span>
                                            <select name="durum" id="durum" class="form-control form-control-sm">
                                                <option value="Aktif">Aktif</option>
                                                <option value="Pasif">Pasif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="teklife_ekle">Tekliflere Eklesin mi ?</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-check"></i>
                                            </span>
                                            <select name="teklife_ekle" id="teklife_ekle"
                                                class="form-control form-control-sm">
                                                <option value="Evet">Evet</option>
                                                <option value="Hayır">Hayır</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="hizmet_aciklama">Hizmet Açıklaması</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text"><i class="fa-solid fa-comments"></i></span>
                                        <textarea name="hizmet_aciklama" id="hizmet_aciklama" cols="20" rows="2"
                                            class="form-control form-control-sm "></textarea>
                                    </div>
                                    </div>
                                </div>
                                <div
                                style="display: flex; padding: 10px 0; gap:20px; text-align: center; justify-content: end">

                                <button type="button" class="btn btn-outline-warning btn-sm py-6 w-25" data-bs-dismiss="modal">Vazgeç</button>
                                <button type="submit" id="submit-form" class="btn btn-outline-dark btn-sm py-6 w-75">Kaydet</button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body" style="border-radius: 5px">
            <div class="table-responsive" style="border-radius: 5px">
                <table class="table table-bordered table-hover" style="width:100%;  ">
                    <thead>
                        <tr>
                            <th style="color: white" scope="col">#</th>
                            <th style="color: white">Hizmet Kategori Adı</th>
                            <th style="color: white">Hizmet Adı</th>
                            <th style="color: white">Maliyet</th>
                            <th style="color: white">Fiyat</th>
                            <th style="color: white">Durum</th>
                            <th style="color: white">Teklife Eklensin mi ?</th>
                            <th style="color: white">Açıklama</th>
                            <th style="color: white">Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hizmetler as $sn => $hizmetleritem)
                            <tr>
                                <th scope="row">{{ $sn + 1 }}</th>
                                <td>{{ $hizmetleritem->hizmetlerkategori->kategori_ad }}</td>
                                <td>{{ $hizmetleritem->hizmet_ad }}</td>
                                <td>{{number_format($hizmetleritem->hizmet_maliyet, 2, ',', '.')  }} ₺</td>
                                <td>{{number_format($hizmetleritem->hizmet_satis_fiyati, 2, ',', '.')  }} ₺</td>
                                <td>@if ($hizmetleritem->durum === 'Aktif')
                                    <span class="badge bg-success">{{ $hizmetleritem->durum }}</span>
                                @elseif($hizmetleritem->durum === 'Pasif')
                                    <span class="badge bg-danger">{{ $hizmetleritem->durum }}</span>
                                @endif
                                </td>
                                <td>
                                    @if ($hizmetleritem->teklife_ekle === 'Evet')
                                        <span class="badge bg-success">{{ $hizmetleritem->teklife_ekle }}</span>
                                    @elseif($hizmetleritem->teklife_ekle === 'Hayır')
                                        <span class="badge bg-danger">{{ $hizmetleritem->teklife_ekle }}</span>
                                    @endif
                                </td>
                                <td>{{ $hizmetleritem->hizmet_aciklama }}</td>

                                <td class="text-right">
                                    <div class="databutton">
                                        <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">
                                            <button  data-bs-toggle="modal"
                                                data-bs-target="#hizmetlerupdateModal-{{ $hizmetleritem->id }}"><i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i></button>
                                            @include('admin.contents.hizmetler.hizmetler-update')

                                            <form action="{{ route('hizmetler.destroy', ['hizmetler' => $hizmetleritem->id]) }}"
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
