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
{{-- @php
    // Değerlendiriciler ve renkleri
    $evaluators = [];
    $colors = ['#FFD700', '#90EE90', '#87CEEB', '#FFA07A']; // Farklı renkler

    foreach ($degerlemeformlari as $index => $form) {
        $evaluators[$form->user->id] = [
            'name' => $form->user->ad_soyad,
            'date' => date('d.m.Y', strtotime($form->created_at)),
            'color' => $colors[$index % count($colors)]
        ];
    }

    // Kriterleri ve değerlendirmeleri birleştir
    $combinedCriteria = [];
    foreach ($kriterler as $kriteritem) {
        if (!isset($combinedCriteria[$kriteritem->kriter])) {
            $combinedCriteria[$kriteritem->kriter] = [];
        }
        $combinedCriteria[$kriteritem->kriter][$kriteritem->personeldegerlemeform_id] = $kriteritem->rating;
    }
@endphp

<h3>Personel Değerlendirme Sonuçları</h3>

<!-- Değerlendirici Bilgileri -->
<div style="margin-bottom: 20px; padding: 10px; background-color: #f5f5f5; border-radius: 5px;">
    @foreach ($evaluators as $userId => $evaluator)
    <div style="display: inline-block; margin-right: 30px;">
        <span style="display: inline-block; width: 15px; height: 15px; background-color: {{ $evaluator['color'] }}; margin-right: 5px; border-radius: 50%;"></span>
        <strong>{{ $evaluator['name'] }}</strong> ({{ $evaluator['date'] }})
    </div>
    @endforeach
</div>

<!-- Personel Bilgileri -->
<table style="width: 100%; margin-bottom: 20px; border-collapse: collapse;">
    <tr>
        <th style="padding: 8px; background-color: #f2f2f2; border: 1px solid #ddd;">Adı Soyadı</th>
        <th style="padding: 8px; background-color: #f2f2f2; border: 1px solid #ddd;">Sicil No</th>
        <th style="padding: 8px; background-color: #f2f2f2; border: 1px solid #ddd;">Görevi</th>
        <th style="padding: 8px; background-color: #f2f2f2; border: 1px solid #ddd;">Departman</th>
    </tr>
    <tr>
        <td style="padding: 8px; border: 1px solid #ddd;">{{ $personel->ad_soyad }}</td>
        <td style="padding: 8px; border: 1px solid #ddd;">{{ $personel->sigorta_sicil_no }}</td>
        <td style="padding: 8px; border: 1px solid #ddd;">{{ $personel->gorevi }}</td>
        <td style="padding: 8px; border: 1px solid #ddd;">{{ $personel->departman }}</td>
    </tr>
</table>

<!-- Değerlendirme Tablosu -->
<table style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th style="padding: 8px; background-color: #f2f2f2; border: 1px solid #ddd; width: 50%;">Değerlendirme Kriterleri</th>
            <th style="padding: 8px; background-color: #f2f2f2; border: 1px solid #ddd; text-align: center;" colspan="4">Değerlendirme Sonucu</th>
        </tr>
        <tr>
            <th style="padding: 8px; background-color: #f2f2f2; border: 1px solid #ddd;"></th>
            <th style="padding: 8px; background-color: #f2f2f2; border: 1px solid #ddd; text-align: center;">Kötü</th>
            <th style="padding: 8px; background-color: #f2f2f2; border: 1px solid #ddd; text-align: center;">Orta</th>
            <th style="padding: 8px; background-color: #f2f2f2; border: 1px solid #ddd; text-align: center;">İyi</th>
            <th style="padding: 8px; background-color: #f2f2f2; border: 1px solid #ddd; text-align: center;">Çok İyi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($combinedCriteria as $kriter => $ratings)
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $kriter }}</td>

            <!-- Kötü Sütunu -->
            <td style="padding: 8px; border: 1px solid #ddd; text-align: center;">
                @foreach ($ratings as $formId => $rating)
                    @if($rating == 1)
                        @php $form = $degerlemeformlari->firstWhere('id', $formId); @endphp
                        <span style="color: {{ $evaluators[$form->islem_yapan]['color'] }};">✓</span>
                    @endif
                @endforeach
            </td>

            <!-- Orta Sütunu -->
            <td style="padding: 8px; border: 1px solid #ddd; text-align: center;">
                @foreach ($ratings as $formId => $rating)
                    @if($rating == 2)
                        @php $form = $degerlemeformlari->firstWhere('id', $formId); @endphp
                        <span style="color: {{ $evaluators[$form->islem_yapan]['color'] }};">✓</span>
                    @endif
                @endforeach
            </td>

            <!-- İyi Sütunu -->
            <td style="padding: 8px; border: 1px solid #ddd; text-align: center;">
                @foreach ($ratings as $formId => $rating)
                    @if($rating == 3)
                        @php $form = $degerlemeformlari->firstWhere('id', $formId); @endphp
                        <span style="color: {{ $evaluators[$form->islem_yapan]['color'] }};">✓</span>
                    @endif
                @endforeach
            </td>

            <!-- Çok İyi Sütunu -->
            <td style="padding: 8px; border: 1px solid #ddd; text-align: center;">
                @foreach ($ratings as $formId => $rating)
                    @if($rating == 4)
                        @php $form = $degerlemeformlari->firstWhere('id', $formId); @endphp
                        <span style="color: {{ $evaluators[$form->islem_yapan]['color'] }};">✓</span>
                    @endif
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<style>
    /* Ekstra stiller */
    table {
        margin-bottom: 30px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    th {
        font-weight: 600;
    }
    span[style*="color:"] {
        font-size: 18px;
        margin: 0 2px;
    }
</style> --}}
<form method="GET" action="{{route('degerlemeformuSHOW',['id'=>$personel->id])}}">
    <select name="form_id" onchange="this.form.submit()">
        <option value="">Tümü</option>
        @foreach($degerlemeformlari as $form)
            <option value="{{ $form->id }}" {{ request('form_id') == $form->id ? 'selected' : '' }}>
                Değerlendirme Formu : {{ $form->id }}
            </option>
        @endforeach
    </select>
</form>
@foreach($degerlemeformlari as $form)
@if(request('form_id') == $form->id || !request('form_id'))
            <h3>Değerlendirme Formu : {{ $form->id }}</h3>
            <table style="margin-left: 11.4pt;border-collapse: collapse;border: none;width: 690px;">
                <tbody>
                    <tr>
                        <td class="header">ADI SOYADI</td>
                        <td class="header">SİCİL NO</td>
                        <td class="header">GÖREVİ</td>
                        <td class="header">DEPARTMAN</td>
                        <td class="header">DEĞERLENDİRME TARİHİ</td>
                        <td class="header">DEĞERLENDİRME YAPAN</td>
                    </tr>
                    <tr>
                        <td>{{$personel->ad_soyad}}</td>
                        <td>{{$personel->sigorta_sicil_no}}</td>
                        <td>{{$personel->gorevi}}</td>


                        <td>{{$personel->departman}}</td>
                        <td>{{ date('d.m.Y', strtotime($form->created_at)) }}</td>

                        <td>{{ $form->user->ad_soyad }}</td>
                    </tr>
                </tbody>
            </table>
            <table style="margin-left: 11.4pt;border-collapse: collapse;border: none;width: 690px; margin-top: 10px;">
                <tbody>
                    <tr>
                        <td colspan="2" rowspan="2">
                            <p><strong><span style="color:black;">D E Ğ E R L E N D İ R M E &nbsp;K R İ T E R L E R
                                        İ</span></strong></p>
                        </td>
                        <td colspan="5" style="border:solid windowtext 1.0pt;border-left:none;padding:0cm 5.4pt;">
                            <p><strong><span style="color:black;">DEĞERLENDİRME</span></strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><strong><span style="color:black;">Kötü</span></strong></p>
                        </td>
                        <td>
                            <p><strong><span style="color:black;">Orta</span></strong></p>
                        </td>
                        <td colspan="2">
                            <p><strong><span style="color:black;">İyi</span></strong></p>
                        </td>
                        <td>
                            <p><strong><span style="color:black;">Çok iyi</span></strong></p>
                        </td>
                    </tr>

                    @php
    // Calculate total score and maximum possible score
    $totalScore = 0;
    $maxScore = 0;

    foreach ($kriterler->where('personeldegerlemeform_id', $form->id) as $kriteritem) {
        $totalScore += $kriteritem->rating;
        $maxScore += 4; // Since each criterion has max 4 points (Çok iyi)
    }

    // Calculate percentage
    $percentage = $maxScore > 0 ? round(($totalScore / $maxScore) * 100) : 0;
@endphp

<!-- Display the evaluation table -->
@foreach ($kriterler->where('personeldegerlemeform_id', $form->id) as $sn => $kriteritem)
    <tr>
        <td colspan="2">
            <li style="font-size:16px;color:black;"> {{$kriteritem->kriter}}</li>
        </td>

        <!-- Kötü -->
        <td style="text-align:center;">
            @if($kriteritem->rating == 1) ✔ @endif
        </td>

        <!-- Orta -->
        <td style="text-align:center;">
            @if($kriteritem->rating == 2) ✔ @endif
        </td>

        <!-- İyi -->
        <td colspan="2" style="text-align:center;">
            @if($kriteritem->rating == 3) ✔ @endif
        </td>

        <!-- Çok iyi -->
        <td style="text-align:center;">
            @if($kriteritem->rating == 4) ✔ @endif
        </td>
    </tr>
@endforeach
                    <tr>
                        <td colspan="1"
                            style="width: 254.75pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;height: 19.75pt;vertical-align: bottom;">
                            <p
                                style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;margin-left:18.0pt;text-align:right;line-height:200%;'>
                                <strong><span style="font-size:14px;line-height:200%;color:black;">TOPLAM YÜZDE</span></strong>
                            </p>
                        </td>
                        <td colspan="6"
                        style="width: 131pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 19.75pt;vertical-align: top;">
                        <p
                            style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;line-height:200%;'>
                            <span style="font-size:18px;line-height:200%;color:black;">%{{ $percentage }}</span>
                        </p>
                    </td>
                    </tr>
                    <tr>
                        <td colspan="1"
                            style="width: 254.75pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;height: 19.75pt;vertical-align: bottom;">
                            <p
                                style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;margin-left:18.0pt;text-align:right;line-height:200%;'>
                                <strong><span style="font-size:14px;line-height:200%;color:black;">
                                        TOPLAM PUAN</span></strong>
                            </p>
                        </td>
                        <td colspan="6"
                            style="width: 131pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 19.75pt;vertical-align: top;">
                            <p
                                style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;line-height:200%;'>
                                <span style="font-size:18px;line-height:200%;color:black;">{{ $totalScore }}/{{ $maxScore }}</span>
                            </p>
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
                                        saklanır.</span></strong>
                            </p>
                            <p
                                style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;text-align:center;line-height:150%;'>
                                <strong><span
                                        style='font-size:19px;line-height:  150%;font-family:"Arial",sans-serif;color:black;'>(
                                        k&ouml;t&uuml;:1, orta: 2, iyi: 3, &ccedil;ok iyi: 4 )</span></strong>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="width:112.05pt;border:solid windowtext 1.0pt;border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:28.9pt;">
                            <p><span style='font-family:"Arial",sans-serif;color:black;'>DEĞERLENDİREN</span></p>
                        </td>
                        <td colspan="4"
                            style="width:338.25pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:28.9pt;">
                            <p><span style='font-family:"Arial",sans-serif;color:black;'>AÇIKLAMA</span></p>
                        </td>
                        <td colspan="2"
                            style="width:66.5pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:28.9pt;">
                            <p><span style='font-family:"Arial",sans-serif;color:black;'>İMZA</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="width:112.05pt;border:solid windowtext 1.0pt;border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:84.6pt;">
                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;'>
                                <strong><span
                                        style='font-size:15px;font-family:"Arial",sans-serif;color:black;'></span>{{$form->user->ad_soyad}}</strong>
                            </p>
                        </td>
                        <td colspan="4"
                            style="width:338.25pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:84.6pt;">
                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;'>
                                <strong><span
                                        style='font-size:15px;font-family:"Arial",sans-serif;color:black;'></span>{{$form->aciklama}}</strong>
                            </p>
                        </td>
                        <td colspan="2"
                            style="width:66.5pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:84.6pt;">
                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:13px;font-family:"Times New Roman",serif;'>
                                <strong>
                                    <img src="{{$form->signature_data}}" alt="İmza" width="100">
                                </strong>
                            </p>
                        </td>
                    </tr>


                </tbody>
            </table>
            @endif
@endforeach





