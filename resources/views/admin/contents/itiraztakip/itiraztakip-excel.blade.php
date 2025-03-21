<table style="width: 829px;">
    <tbody>
        <tr style="height: 68px;">
            <td colspan="14" style="text-align: center; vertical-align: middle; font-size: 20px; font-weight: bold;">
                İTİRAZ TAKİP
            </td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr style="background-color: #f8f9fa; text-align: left;">
            <th style="font-weight: bold">#</th>
            <th style="font-weight: bold">Başvuru No</th>
            <th style="font-weight: bold">Referans No</th>
            <th style="font-weight: bold">Bakanlık Kararı</th>
            <th style="font-weight: bold">İtiraz İşlem</th>
            <th style="font-weight: bold">Marka Adı</th>
            <th style="font-weight: bold">Firma Adı</th>
            <th style="font-weight: bold">Müşteri Temsilcisi</th>
            <th style="font-weight: bold">İşlem Yapan</th>
            <th style="font-weight: bold">Tebliğ Tarihi</th>
            <th style="font-weight: bold">Tebliğ Bitiş Tarihi</th>
            <th style="font-weight: bold">Ücret</th>
            <th style="font-weight: bold">Durum</th>
            <th style="font-weight: bold">İşlem Tarihi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($itiraztakip as $sn => $itiraztakipitem)
        <tr>
            <td>{{ $sn + 1 }}</td>
            <td>{{ $itiraztakipitem->referansno->basvuru_no }}</td>
            <td>{{ $itiraztakipitem->referans_no }}</td>
            <td>{{ $itiraztakipitem->bakanlik_karari }}</td>
            <td>{{ $itiraztakipitem->itiraz_islem }}</td>
            <td>{{ $itiraztakipitem->marka_adi }}</td>
            <td>{{ $itiraztakipitem->firma_adi }}</td>
            <td>{{ $itiraztakipitem->musteri_temsilcisi }}</td>
            <td>{{ $itiraztakipitem->satis_temsilcisi }}</td>
            <td>{{ $itiraztakipitem->teblig_tarihi }}</td>
            <td>{{ $itiraztakipitem->teblig_bitis_tarihi }}</td>
            <td>{{ number_format($itiraztakipitem->ucret, 2, ',', '.') }} ₺</td>
            <td>{{ $itiraztakipitem->itiraz_durum }}</td>
            <td>{{ $itiraztakipitem->islem_tarihi }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
