@extends('admin.layouts.app')
@section('title')
    Satış Fişine Aktar
@endsection
@section('contents')
@section('topheader')
    Satış Fişine Aktar
@endsection
<div class="card">
    <div class="card-body">
        <form action="{{ route('Postsatisfisineaktar',$teklifler->id) }}" method="POST" id="add-form">
            @csrf
        <div class="row">
            <div class="col-md-12" style="padding: 1%;">
                <div class="row">
                    <div class="col-md-4">
                        <label for="cari_id">Firma</label>
                        <div class="form-group input-with-icon" style="display: flex; align-items: center;">
                            <span class="icon">
                                <i class="fa fa-building"></i>
                            </span>
                            <input type="text" name="cari_id" id="cari_id" class="form-control form-control-sm"
                                value="{{ $teklifler->firmaadi->firma_unvan }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="teklif_tarihi">Teklif Tarihi</label>
                        <div class="form-group input-with-icon">
                            <span class="icon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input type="date" name="teklif_tarihi" id="teklif_tarihi"
                                class="form-control form-control-sm" value="{{ $teklifler->teklif_tarihi }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="user_id">Satış Temsilcisi</label>
                        <div class="form-group input-with-icon">
                            <span class="icon">
                                <i class="fa fa-user"></i>
                            </span>
                            <input type="text" name="user_id" id="user_id" class="form-control form-control-sm"
                                value="{{ $teklifler->user->ad_soyad }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="teklif_konu">Teklif Konusu</label>
                        <textarea name="teklif_konu" id="teklif_konu" cols="20" rows="2" style="background: #F0F0F0"
                            class="form-control form-control-sm" readonly>{{ $teklifler->teklif_konu }}</textarea>
                    </div>
                    {{-- <div class="col-md-6">
                        <label for="teklif_aciklama">Açıklama</label>
                        <textarea name="teklif_aciklama" id="teklif_aciklama" cols="20" rows="2" style="background: #F0F0F0"
                            class="form-control form-control-sm" readonly>{{ $teklifler->teklif_aciklama }}</textarea>
                    </div> --}}
                </div>
            </div>

            <div class="col-md-12">
                <table id="table" class="table table-responsive" style="width: 100%; cellspacing: 0; margin-bottom: 0">
                    <thead>
                        <tr>
                            <th><b>#</b></th>
                            <th>Hizmet Türü</th>
                            <th>Hizmet/Ürün</th>
                            <th>Açıklama</th>
                            <th style="width: 15%">Miktar/Birim</th>
                            <th>Fiyat</th>
                            <th>Kdv/Tutar</th>
                            <th>Toplam Fiyat</th>
                            <th>İskonto</th>
                            <th>Ödenecek Tutar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tekliflerdata as $index => $input)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <input type="text" name="inputs[{{ $index }}][hizmetlerkategori_id]"
                                       class="form-control form-control-sm"
                                       value="{{ $input->hizmetlerkategori->kategori_ad }}" readonly>
                            </td>
                            <td>
                                <input type="text" name="inputs[{{ $index }}][hizmet_id]"
                                       class="form-control form-control-sm"
                                       value="{{ $input->hizmetler->hizmet_ad }}" readonly>
                            </td>
                            <td>
                                <input type="text" name="inputs[{{ $index }}][satir_aciklama]"
                                       class="form-control form-control-sm"
                                       value="{{ $input->satir_aciklama }}" readonly>
                            </td>
                            <td>
                                <div class="input-group m-b-sm">
                                    <div class="col-md-5" style="padding: 0px">
                                        <input type="number" name="inputs[{{ $index }}][teklif_hizmet_miktar]"
                                               class="form-control form-control-sm"
                                               value="{{ $input->teklif_hizmet_miktar }}" readonly>
                                    </div>
                                    <div class="col-md-7" style="padding: 0px">
                                        <input type="text" name="inputs[{{ $index }}][teklif_hizmet_birim]"
                                               class="form-control form-control-sm"
                                               value="{{ $input->teklif_hizmet_birim }}" readonly>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <input type="text" name="inputs[{{ $index }}][teklif_fiyat]"
                                       class="form-control form-control-sm"
                                       value="{{  number_format($input->teklif_fiyat, 2, ',', '.') }} ₺" readonly>
                            </td>
                            <td>
                                <div class="input-group m-b-sm">
                                    <div class="col-md-5" style="padding: 0px">
                                        <input type="text" name="inputs[{{ $index }}][teklif_kdv_oran]"
                                               class="form-control form-control-sm"
                                               value="{{ $input['teklif_kdv_oran'] }}" readonly>
                                    </div>
                                    <div class="col-md-7" style="padding: 0px">
                                        <input type="text" name="inputs[{{ $index }}][teklif_kdv_tutar]"
                                               class="form-control form-control-sm"
                                               value="{{number_format( $input->teklif_kdv_tutar, 2, ',', '.') }} ₺" readonly>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <input type="text" name="inputs[{{ $index }}][teklif_kdvsiz_fiyat]"
                                       class="form-control form-control-sm"
                                       value="{{ number_format($input->teklif_kdvsiz_fiyat, 2, ',', '.') }} ₺" readonly>
                            </td>
                            <td>
                                <input type="text" name="inputs[{{ $index }}][teklif_iskonto]"
                                       class="form-control form-control-sm"
                                       value="{{ number_format($input->teklif_iskonto, 2, ',', '.') }} ₺" readonly>
                            </td>
                            <td>
                                <input type="text" name="inputs[{{ $index }}][teklif_toplam_fiyat]"
                                       class="form-control form-control-sm"
                                       value="{{ number_format( $input->teklif_toplam_fiyat, 2, ',', '.') }} ₺" readonly>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>


            <div class="col-md-6" style="flex: 1; max-width: 50%; padding: 10px;">
                <label for="aciklama" style="display: block; margin-bottom: 5px;">Açıklama</label>
                <textarea id="aciklama" name="aciklama" rows="5"
                    style="width: 100%; height: 150px; padding: 10px; border: 1px solid #ccc; border-radius: 4px; resize: none; background: #F0F0F0">{{ $teklifler->aciklama }}</textarea>
            </div>

            <div class="col-md-6" style="padding: 10px;">
                <div class="col-md-12" style="display: none">
                    <label for="exampleInputEmail1">TOPLAM MALİYET<span style="color: red">*</span></label>
                    <div class="input-group m-b-sm">
                        <span class="input-group-addon"></span>
                        <input type="text" name="maliyet_kdvli_tutar" id="maliyet_kdvli_tutar"
                            class="form-control form-control-sm"
                            value="{{ number_format($teklifler->maliyet_kdvli_tutar, 2, ',', '.') }} ₺" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="exampleInputEmail1">TOPLAM İSKONTO<span style="color: red">*</span></label>
                    <div class="input-group m-b-sm">
                        <span class="input-group-addon"></span>
                        <input type="text" name="teklif_iskonto_toplam" id="teklif_iskonto_toplam"
                            class="form-control form-control-sm"
                            value="{{ number_format($teklifler->teklif_iskonto_toplam, 2, ',', '.') }} ₺" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="exampleInputEmail1">KDV TOPLAM<span style="color: red">*</span></label>
                    <div class="input-group m-b-sm">
                        <span class="input-group-addon"></span>
                        <input type="text" name="teklif_kdv_toplam" id="teklif_kdv_toplam"
                            class="form-control form-control-sm"
                            value="{{ number_format($teklifler->teklif_kdv_toplam, 2, ',', '.') }} ₺" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="exampleInputEmail1">ARA TOPLAM<span style="color: red">*</span></label>
                    <div class="input-group m-b-sm">
                        <span class="input-group-addon"></span>
                        <input type="text" name="teklif_ara_toplam" id="teklif_ara_toplam"
                            class="form-control form-control-sm"
                            value="{{ number_format($teklifler->teklif_ara_toplam, 2, ',', '.') }} ₺" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="exampleInputEmail1">TOPLAM TUTAR<span style="color: red">*</span></label>
                    <div class="input-group m-b-sm">
                        <span class="input-group-addon"></span>
                        <input type="text" name="teklif_kdvli_toplam" id="teklif_kdvli_toplam"
                            class="form-control form-control-sm"
                            value="{{ number_format($teklifler->teklif_kdvli_toplam, 2, ',', '.') }} ₺" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <button type="submit" id="submit-form" class="btn btn-sm btn-outline-primary"
                            style="float: right; margin-left: 2px;">
                            Satış Fişine Aktar</button>
                        <a href="{{ route('teklifler.index') }}" class="btn btn-sm btn-outline-secondary"
                            style="float: right;">Vazgeç</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection
