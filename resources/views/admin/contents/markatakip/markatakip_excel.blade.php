<table style="width: 829px;">
    <tbody>
        <tr style="height: 68px;">
            <td colspan="16" style="text-align: center; vertical-align: middle; font-size: 20px; font-weight: bold;">
                MARKA TAKİP
            </td>
        </tr>
    </tbody>
</table>
   <table class="table table-bordered" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f8f9fa; text-align: left;">
                <th style="font-weight: bold">#</th>
                <th style="font-weight: bold">Başvuru Tarihi</th>
                <th style="font-weight: bold">Yenileme Tarihi</th>
                <th style="font-weight: bold">Referans No</th>
                <th style="font-weight: bold">Firma Adı</th>
                <th style="font-weight: bold">Firma GSM</th>
                <th style="font-weight: bold">Satış Temsilcisi</th>
                <th style="font-weight: bold">Marka Adı</th>
                <th style="font-weight: bold">Marka Sınıf</th>
                <th style="font-weight: bold">Başvuru No</th>
                <th style="font-weight: bold">Hizmet Türü</th>
                <th style="font-weight: bold">VKN</th>
                <th style="font-weight: bold">TC</th>
                <th style="font-weight: bold">Şehir</th>
                <th style="font-weight: bold">Marka İşlem</th>
                <th style="font-weight: bold">Marka Durum</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($markatakip as $sn => $markatakipitem)
                <tr>
                    <td>{{$sn+1}}</td>
                    <td>{{ $markatakipitem->basvuru_tarihi }}</td>
                    <td>{{ $markatakipitem->yenileme_tarih }}</td>
                    <td>{{ $markatakipitem->referans_no }}</td>
                    <td>{{ $markatakipitem->firmaadi->firma_unvan }}</td>
                    <td>{{ $markatakipitem->firmaadi->yetkili_kisi_tel }}</td>
                    <td>{{ $markatakipitem->satistemsilcisi->ad_soyad }}</td>

                    <td>{{ $markatakipitem->marka_adi }}</td>
                    <td>{{ $markatakipitem->marka_sinif }}</td>
                    <td>{{ $markatakipitem->basvuru_no }}</td>
                    <td>{{ $markatakipitem->hizmet->hizmet_ad }}</td>
                    <td>{{ $markatakipitem->vkn }}</td>
                    <td>{{ $markatakipitem->tc }}</td>
                    <td>{{ $markatakipitem->sehir }}</td>
                    <td>{{ $markatakipitem->marka_islem }}</td>
                    <td>{{ $markatakipitem->marka_durum }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
