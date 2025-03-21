@extends('admin.layouts.app')
@section('title')
    {{ $zimmet->personel->ad_soyad }} Zimmet Teslim Alma
@endsection
@section('contents')
@section('topheader')
    {{ $zimmet->personel->ad_soyad }} Zimmet Teslim Alma
@endsection

<div class="card">
    <div class="card-body">
        <div class="row">
            <form action="{{ route('zimmet.update', ['zimmet' => $zimmet->id]) }}" method="POST" id="add-form" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="col-md-12" style="padding: 1%; ">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="personel_id">Personel Adı</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input style="border: none" type="text" name="personel_id" id="personel_id" readonly
                                    value="{{ $zimmet->personel->ad_soyad }}">
                            </div>
                        </div>
                        <div class="col-md-12" style="padding-top: 5px">

                            <table id="odeme_table" class="table table-responsive"
                                style="width: 100%; cellspacing: 0; margin-bottom: 0; margin-top: 10px;">

                                <thead>
                                    <tr>
                                        <th><b>#</b></th>
                                        <th>Zimmet Tarihi</th>
                                        <th>Marka</th>
                                        <th>Model</th>
                                        <th>Miktar</th>
                                        <th>Birim</th>
                                        <th>Teslim Edilen Resim</th>
                                        <th>Alınan Tarih</th>
                                        <th>Alınan Miktar</th>
                                        <th>Durum</th>
                                        <th>Teslim Alınan Resim</th>
                                        <th>Açıklama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($zimmet->zimmetdata as $key => $zimmetdataitem)
                                        <tr>
                                            <td></td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="date"
                                                        name="inputss[{{ $key }}][verilme_tarihi]" readonly
                                                        class="form-control form-control-sm "
                                                        value="{{ $zimmetdataitem->verilme_tarihi }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputss[{{ $key }}][marka]"
                                                        readonly class="form-control form-control-sm "
                                                        value="{{ $zimmetdataitem->marka }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputss[{{ $key }}][model]"
                                                        readonly class="form-control form-control-sm "
                                                        value="{{ $zimmetdataitem->model }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputss[{{ $key }}][miktar]"
                                                        readonly class="form-control form-control-sm "
                                                        value="{{ $zimmetdataitem->miktar }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputss[{{ $key }}][birim]"
                                                        readonly class="form-control form-control-sm "
                                                        value="{{ $zimmetdataitem->birim }}">
                                                </div>

                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    @if (!empty($zimmetdataitem->verme_dosya))
                                                        <a href="{{ asset($zimmetdataitem->verme_dosya) }}"
                                                            style="font-size:10px " target="_blank"
                                                            class="btn btn-sm btn-primary">
                                                            Dosyayı Görüntüle
                                                        </a>
                                                    @endif
                                                    <input type="file"
                                                        name="inputss[{{ $key }}][verme_dosya]"
                                                        style="width: 1px; display: none;"
                                                        class="form-control form-control-sm" disabled readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="date" name="inputss[{{ $key }}][geri_alma_tarihi]"
                                                        class="form-control form-control-sm "
                                                        value="{{ $zimmetdataitem->geri_alma_tarihi }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputss[{{ $key }}][geri_alma_miktar]"
                                                        class="form-control form-control-sm "
                                                        value="{{ $zimmetdataitem->geri_alma_miktar }}">
                                                </div>
                                            </td>
                                            <td>
                                                <select name="inputss[{{ $key }}][durum]" class="form-control form-control-sm "
                                                    required>
                                                    <option value="">Teslim Alınan Zimmet Durumu Seçiniz..
                                                    </option>
                                                    <option value="Hasarsız ve Tam Olarak Teslim Edilmiştir">Hasarsız ve
                                                        Tam Olarak Teslim Edilmiştir</option>
                                                    <option value="Hasarlı Yada Eksik Teslim Edilmiştir">Hasarlı Yada
                                                        Eksik Teslim Edilmiştir</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="file" name="inputss[{{ $key }}][alma_dosya]"
                                                        class="form-control form-control-sm ">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputss[{{ $key }}][aciklama]"
                                                        class="form-control form-control-sm "
                                                        value="{{ $zimmetdataitem->aciklama }}">
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12 mt-2 mr-15">
                            <button type="submit" id="submit-form" class="btn btn-sm btn-outline-success"
                                style="float: right; margin-left: 2px;">
                                Güncelle</button>
                            <a href="{{ route('zimmet.index') }}" class="btn btn-sm btn-outline-secondary"
                                style="float: right"> Vazgeç</a>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@include('session.session')
@endsection
