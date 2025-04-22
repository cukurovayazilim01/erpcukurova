@extends('admin.layouts.app')
@section('title')
    PERSONEL PERFORMANS DEĞERLEME
@endsection
@section('contents')
    @section('topheader')
        PERSONEL PERFORMANS DEĞERLEME
    @endsection
    <style>
        table {
            margin-left: 11.4pt;
            margin-right: calc(18%);
            border-collapse: collapse;
            width: 44%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
            font-size: 13px;
            font-family: "Times New Roman", serif;
        }

        .header {
            font-weight: bold;
            color: black;
        }

        p {
            margin: 0cm;
            margin-bottom: .0001pt;
            font-size: 13px;
            font-family: "Times New Roman", serif;
            text-align: center;
        }

        li {
            text-align: left;
        }
    </style>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <form action="{{ route('degerlemeformuPOST') }}" method="POST" id="add-form">
                    @csrf
                    <div class="col-md-12" style="padding: 1%; ">
                        <div class="row">
                        <input type="hidden" name="personel_id" id="personel_id" value="{{$personel->id}}">

                            <div class="col-md-2">
                                <label for="tescil_tl">Personel Adı Soyadı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="" id="" readonly
                                        class="form-control form-control-sm" value="{{$personel->ad_soyad}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="tescil_tl">Sicil No</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="" id="" readonly
                                        class="form-control form-control-sm" value="{{$personel->sigorta_sicil_no}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="tescil_tl">Görevi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="" id="" readonly
                                        class="form-control form-control-sm" value="{{$personel->gorevi}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="tescil_tl">Departman</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="" id="" readonly
                                        class="form-control form-control-sm" value="{{$personel->departman}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="tescil_tl">Değerlendirmeyi Yapan</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="" id="" readonly
                                        class="form-control form-control-sm"
                                        value="@if(Auth::check()){{ Auth::user()->ad_soyad }}@endif">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="tescil_tl">Değerlendirme Tarihi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="" id="" readonly
                                        class="form-control form-control-sm" value="{{ date('d.m.Y') }}">
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-12">
                        <table id="table" class="table table-responsive"
                            style="width: 100%; cellspacing: 0; margin-bottom: 0">
                            <thead>
                                <tr>
                                    <th><b>#</b></th>
                                    <th style="width: 35%">DEĞERLENDİRME KRİTERLERİ</th>
                                    <th style="width: 15%">KÖTÜ</th>
                                    <th style="width: 15%">ORTA</th>
                                    <th style="width: 15%">İYİ</th>
                                    <th style="width: 15%">ÇOK İYİ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($degerlemekriter as $sn => $degerlemekriteritem)
                                    <tr>
                                        <td>{{ $sn + 1 }}</td>
                                        <td>
                                            <div class="input-group m-b-sm">
                                                <input type="text" name="inputs[{{ $sn }}][kriter]" readonly
                                                    value="{{ $degerlemekriteritem->kriter }}"
                                                    class="form-control satir_aciklama">
                                            </div>
                                        </td>
                                        <td><input type="checkbox" class="rating-checkbox" name="inputs[{{ $sn }}][rating]"
                                                value="1"></td>
                                        <td><input type="checkbox" class="rating-checkbox" name="inputs[{{ $sn }}][rating]"
                                                value="2"></td>
                                        <td><input type="checkbox" class="rating-checkbox" name="inputs[{{ $sn }}][rating]"
                                                value="3"></td>
                                        <td><input type="checkbox" class="rating-checkbox" name="inputs[{{ $sn }}][rating]"
                                                value="4"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row d-flex justify-content-end">
                        <div class="col-md-5" style=" padding: 10px;">
                            <label for="konu" style="display: block; margin-bottom: 5px;">Konu</label>
                            <textarea id="konu" name="konu" rows="2" readonly
                                style="width: 100%;  padding: 10px; border: 1px solid #ccc; border-radius: 4px; resize: none; background-color: #F0F0F0;">Bu değerlendirme her personel için 6 ayda bir ilgili bölüm sorumlusu tarafından yapılır. Yönetim gözden geçirme toplantıları için bir veri oluşturur. Personelin dosyasında saklanır.( kötü:1, orta: 2, iyi: 3, çok iyi: 4 )</textarea>
                </div>
                <div class="col-md-5" style=" padding: 10px;">
                    <label for="aciklama" style="display: block; margin-bottom: 5px;">Açıklama</label>
                    <textarea id="aciklama" name="aciklama" rows="2"
                        style="width: 100%;  padding: 10px; border: 1px solid #ccc; border-radius: 4px; resize: none; "></textarea>
        </div>

                    <div class="col-md-2 " style=" padding: 10px;">
                        <label for="exampleInputEmail1">TOPLAM <span style="color: red">*</span></label>
                        <div class="input-group m-b-sm">
                            <span class="input-group-addon"></span>
                            <input type="number" name="toplam" id="total-score"
                                class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </div>
                <div class="signature-container">
                    <h3>Lütfen aşağıya imzanızı atın</h3>
                    <canvas id="signature-canvas" width="600" height="300"></canvas>
                    <input type="hidden" name="signature_data" id="signature-data">

                    <div class="button-group">
                        <button type="button" id="clear-btn" class="clear">Temizle</button>
                    </div>
                </div>
                <style>

                    .signature-container {
                        margin: 30px 0;
                        text-align: center;
                    }
                    #signature-canvas {
                        border: 2px solid #333;
                        background-color: #f9f9f9;
                        touch-action: none;
                    }
                    .button-group {
                        margin-top: 15px;
                    }
                    button {
                        padding: 10px 20px;
                        margin: 0 10px;
                        cursor: pointer;
                        background-color: #4CAF50;
                        color: white;
                        border: none;
                        border-radius: 4px;
                    }
                    button.clear {
                        background-color: #f44336;
                    }
                    .signature-preview {
                        margin-top: 30px;
                        text-align: center;
                    }
                    .signature-preview img {
                        max-width: 100%;
                        border: 1px solid #ddd;
                    }
                </style>
                    <div class="row">
                        <div class="col-md-12 mt-1">
                            <button type="submit" id="submit-form" class="btn btn-sm btn-outline-primary"
                                style="float: right; margin-left: 2px;">
                                Kaydet</button>
                            <a href="{{ route('teklifler.index') }}" class="btn btn-sm btn-outline-secondary"
                                style="float: right"> Vazgeç</a>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <table>
                <tbody>
                    <tr>
                        <td class="header">ADI SOYADI</td>
                        <td>{{$personel->ad_soyad}}</td>
                        <td class="header">GÖREVİ</td>
                        <td>{{$personel->gorevi}}</td>
                        <td class="header">DEĞERLENDİRME TARİHİ</td>
                        <td>{{ date('d.m.Y') }}</td>
                    </tr>
                    <tr>
                        <td class="header">SİCİL NO</td>
                        <td>{{$personel->sigorta_sicil_no}}</td>
                        <td class="header">DEPARTMAN</td>
                        <td>{{$personel->departman}}</td>
                        <td class="header">DEĞERLENDİRME YAPAN</td>
                        @if(Auth::check())
                            <td>{{ Auth::user()->ad_soyad }}</td>
                        @endif

                    </tr>
                </tbody>
            </table>
            <form action="{{ route('performansdegerleme.store') }}" method="POST" enctype="multipart/form-data"
                id="add-form">
                @csrf
                <p style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;'><span
                        style="font-size:11px;color:black;">&nbsp;</span></p>
                <table style="margin-left: 11.4pt;border-collapse: collapse;border: none;width: 690px;">
                    <tbody>
                        <tr>
                            <td colspan="2" rowspan="2">
                                <p><strong><span style="color:black;">D E Ğ E R L E N D İ R M E &nbsp;K R İ T E R L E R
                                            İ</span></strong></p>
                            </td>
                            <td colspan="5"
                                style="width:262.05pt;border:solid windowtext 1.0pt;border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt;">
                                <p><strong><span style="color:black;">DEĞERLENDİRME</span></strong></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><strong><span style="color:black;">K&ouml;t&uuml;&nbsp;</span></strong></p>
                            </td>
                            <td>
                                <p><strong><span style="color:black;">Orta</span></strong></p>
                            </td>
                            <td colspan="2"
                                style="width:65.5pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:20.75pt;">
                                <p><strong><span style="color:black;">iyi</span></strong></p>
                            </td>
                            <td
                                style="width:65.6pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:20.75pt;">
                                <p><strong><span style="color:black;">&Ccedil;ok iyi</span></strong></p>
                            </td>
                        </tr>
                        @foreach ($degerlemekriter as $sn => $degerlemekriteritem)

                            <tr>
                                <td colspan="2">
                                    <div
                                        style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;'>
                                        <li
                                            style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;'>
                                            <span style="font-size:16px;color:black;">{{$sn + 1}}.
                                                {{$degerlemekriteritem->kriter}}</span></li>
                                    </div>
                                </td>
                                <td
                                    style="width:65.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:25.25pt;">
                                    <p><span style="color:black;">&nbsp;</span></p>
                                </td>
                                <td
                                    style="width:65.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:25.25pt;">
                                    <p><span style="color:black;">&nbsp;</span></p>
                                </td>
                                <td colspan="2"
                                    style="width:65.5pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:25.25pt;">
                                    <p><span style="color:black;">&nbsp;</span></p>
                                </td>
                                <td
                                    style="width:65.6pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:25.25pt;">
                                    <p><span style="color:black;">&nbsp;</span></p>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2"
                                style="width: 254.75pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;height: 19.75pt;vertical-align: bottom;">
                                <p
                                    style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;margin-left:18.0pt;text-align:right;line-height:200%;'>
                                    <strong><span style="font-size:16px;line-height:200%;color:black;">T O P L A
                                            M</span></strong></p>
                            </td>
                            <td
                                style="width: 65.5pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 19.75pt;vertical-align: top;">
                                <p
                                    style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;line-height:200%;'>
                                    <span style="font-size:11px;line-height:200%;color:black;">&nbsp;</span></p>
                            </td>
                            <td
                                style="width: 65.5pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 19.75pt;vertical-align: top;">
                                <p
                                    style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;line-height:200%;'>
                                    <span style="font-size:11px;line-height:200%;color:black;">&nbsp;</span></p>
                            </td>
                            <td colspan="2"
                                style="width: 65.5pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 19.75pt;vertical-align: top;">
                                <p
                                    style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;line-height:200%;'>
                                    <span style="font-size:11px;line-height:200%;color:black;">&nbsp;</span></p>
                            </td>
                            <td
                                style="width: 65.6pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 19.75pt;vertical-align: top;">
                                <p
                                    style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;line-height:200%;'>
                                    <span style="font-size:11px;line-height:200%;color:black;">&nbsp;</span></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"
                                style="width: 254.75pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;height: 19.75pt;vertical-align: bottom;">
                                <p
                                    style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;margin-left:18.0pt;text-align:right;line-height:200%;'>
                                    <strong><span style="font-size:16px;line-height:200%;color:black;">GENEL
                                            TOPLAM</span></strong></p>
                            </td>
                            <td colspan="2"
                                style="width: 131pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 19.75pt;vertical-align: top;">
                                <p
                                    style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;line-height:200%;'>
                                    <span style="font-size:11px;line-height:200%;color:black;">&nbsp;</span></p>
                            </td>
                            <td colspan="3"
                                style="width: 131.1pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 19.75pt;vertical-align: top;">
                                <p
                                    style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;line-height:200%;'>
                                    <span style="font-size:11px;line-height:200%;color:black;">&nbsp;</span></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7"
                                style="width:516.8pt;border:solid windowtext 1.0pt;border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:134.75pt;">
                                <p
                                    style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;line-height:150%;'>
                                    <strong><span
                                            style='font-size:19px;line-height:150%;font-family:"Arial",sans-serif;color:black;'>Bu
                                            değerlendirme her personel i&ccedil;in 6 ayda bir ilgili b&ouml;l&uuml;m
                                            sorumlusu tarafından yapılır. Y&ouml;netim g&ouml;zden ge&ccedil;irme
                                            toplantıları i&ccedil;in bir veri oluşturur. Personelin dosyasında
                                            saklanır.</span></strong></p>
                                <p
                                    style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;text-align:center;line-height:150%;'>
                                    <strong><span
                                            style='font-size:19px;line-height:  150%;font-family:"Arial",sans-serif;color:black;'>(
                                            k&ouml;t&uuml;:1, orta: 2, iyi: 3, &ccedil;ok iyi: 4 )</span></strong></p>
                            </td>
                        </tr>
                        <tr>
                            <td
                                style="width:112.05pt;border:solid windowtext 1.0pt;border-top:  none;padding:0cm 5.4pt 0cm 5.4pt;height:28.9pt;">
                                <p><span style='font-family:"Arial",sans-serif;color:black;'>DEĞERLENDİREN</span></p>
                            </td>
                            <td colspan="4"
                                style="width:338.25pt;border-top:none;border-left:  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:28.9pt;">
                                <p><span style='font-family:"Arial",sans-serif;color:black;'>A&Ccedil;IKLAMA</span></p>
                            </td>
                            <td colspan="2"
                                style="width:66.5pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:28.9pt;">
                                <p><span style='font-family:"Arial",sans-serif;color:black;'>İMZA</span></p>
                            </td>
                        </tr>
                        <tr>
                            <td
                                style="width:112.05pt;border:solid windowtext 1.0pt;border-top:  none;padding:0cm 5.4pt 0cm 5.4pt;height:84.6pt;">
                                <p
                                    style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;'>
                                    <strong><span
                                            style='font-size:15px;font-family:"Arial",sans-serif;color:black;'>&nbsp;</span></strong>
                                </p>
                                <p
                                    style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;'>
                                    <strong><span
                                            style='font-size:15px;font-family:"Arial",sans-serif;color:black;'>&nbsp;</span></strong>
                                </p>
                                <p
                                    style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;'>
                                    <strong><span
                                            style='font-size:15px;font-family:"Arial",sans-serif;color:black;'>&nbsp;</span></strong>
                                </p>
                                <p
                                    style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;'>
                                    <strong><span
                                            style='font-size:15px;font-family:"Arial",sans-serif;color:black;'>&nbsp;</span></strong>
                                </p>
                            </td>
                            <td colspan="4"
                                style="width:338.25pt;border-top:none;border-left:  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:84.6pt;">
                                <p
                                    style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;'>
                                    <strong><span
                                            style='font-size:15px;font-family:"Arial",sans-serif;color:black;'>&nbsp;</span></strong>
                                </p>
                            </td>
                            <td colspan="2"
                                style="width:66.5pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:84.6pt;">
                                <p
                                    style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;'>
                                    <strong><span
                                            style='font-size:15px;font-family:"Arial",sans-serif;color:black;'>&nbsp;</span></strong>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="border:none;"><br></td>
                            <td style="border:none;"><br></td>
                            <td style="border:none;"><br></td>
                            <td style="border:none;"><br></td>
                            <td style="border:none;"><br></td>
                            <td style="border:none;"><br></td>
                            <td style="border:none;"><br></td>
                        </tr>
                    </tbody>
                </table>
            </form>

            <p style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;'><span
                    style="color:black;">&nbsp;</span></p>

            <div class="row">
                <div class="col-md-12 mt-1">
                    <button type="submit" id="submit-form" class="btn btn-sm btn-outline-primary"
                        style="float: right; margin-left: 2px;">
                        Kaydet</button>
                    <a href="{{route('performansdegerleme.index')}}" class="btn btn-sm btn-outline-secondary"
                        style="float: right"> Vazgeç</a>
                </div>
            </div>

            <div class="col-sm-4 col-md-5 " style=" float: right; margin-top: 20px; ">
                {{-- {{ $aramalar->appends(['entries' => $perPage])->links() }} --}}
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".rating-checkbox").on("change", function () {
                var row = $(this).closest("tr"); // Satırı bul
                if ($(this).is(":checked")) {
                    row.find(".rating-checkbox").not(this).prop("disabled", true); // Diğer checkbox'ları devre dışı bırak
                } else {
                    row.find(".rating-checkbox").prop("disabled", false); // Seçim kaldırıldığında diğerlerini tekrar aktif et
                }

                calculateTotalScore(); // Toplam puanı güncelle
            });

            function calculateTotalScore() {
                let total = 0;
                $(".rating-checkbox:checked").each(function () {
                    total += parseInt($(this).val()); // Seçili olan checkbox'ın değerini topla
                });
                $("#total-score").val(total); // Toplam puanı input alanına yazdır
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('signature-canvas');
            const ctx = canvas.getContext('2d');
            const signatureInput = document.getElementById('signature-data');
            const clearBtn = document.getElementById('clear-btn');
            let isDrawing = false;
            let lastX = 0;
            let lastY = 0;

            // Canvas boyut ayarı
            function resizeCanvas() {
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.style.width = canvas.offsetWidth + 'px';
                canvas.style.height = canvas.offsetHeight + 'px';
                ctx.scale(ratio, ratio);
            }

            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();

            // Çizim fonksiyonları
            function startDrawing(e) {
                isDrawing = true;
                [lastX, lastY] = getPosition(e);
            }

            function draw(e) {
                if (!isDrawing) return;

                ctx.strokeStyle = '#000';
                ctx.lineWidth = 2;
                ctx.lineJoin = 'round';
                ctx.lineCap = 'round';

                const [x, y] = getPosition(e);

                ctx.beginPath();
                ctx.moveTo(lastX, lastY);
                ctx.lineTo(x, y);
                ctx.stroke();

                lastX = x;
                lastY = y;

                // Her hareketten sonra imzayı güncelle
                updateSignature();
            }

            function stopDrawing() {
                isDrawing = false;
                updateSignature();
            }

            function getPosition(e) {
                const rect = canvas.getBoundingClientRect();
                let x, y;

                if (e.type.includes('touch')) {
                    x = e.touches[0].clientX - rect.left;
                    y = e.touches[0].clientY - rect.top;
                } else {
                    x = e.clientX - rect.left;
                    y = e.clientY - rect.top;
                }

                return [x, y];
            }

            function updateSignature() {
                signatureInput.value = canvas.toDataURL();
            }

            function clearCanvas() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                signatureInput.value = '';
            }

            // Event listeners
            canvas.addEventListener('mousedown', startDrawing);
            canvas.addEventListener('mousemove', draw);
            canvas.addEventListener('mouseup', stopDrawing);
            canvas.addEventListener('mouseout', stopDrawing);

            canvas.addEventListener('touchstart', function(e) {
                e.preventDefault();
                startDrawing(e);
            });

            canvas.addEventListener('touchmove', function(e) {
                e.preventDefault();
                draw(e);
            });

            canvas.addEventListener('touchend', stopDrawing);

            clearBtn.addEventListener('click', clearCanvas);

            // Form gönderilirken kontrol
            document.querySelector('form').addEventListener('submit', function(e) {
                if (signatureInput.value === '') {
                    e.preventDefault();
                    alert('Lütfen imza atın!');
                }
            });
        });
    </script>
@endsection
