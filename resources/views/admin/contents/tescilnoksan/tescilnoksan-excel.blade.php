<table style="width: 829px;">
    <tbody>
        <tr style="height: 68px;">
            <td colspan="11" style="text-align: center; vertical-align: middle; font-size: 20px; font-weight: bold;">
                TESCİL NOKSAN
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
            <th style="font-weight: bold">Marka Adı</th>
            <th style="font-weight: bold">Firma Adı</th>
            <th style="font-weight: bold">Müşteri Temsilcisi</th>
            <th style="font-weight: bold">İşlem Yapan</th>
            <th style="font-weight: bold">Tebliğ Tarihi</th>
            <th style="font-weight: bold">Tebliğ Bitiş Tarihi</th>
            <th style="font-weight: bold">Durum</th>
            <th style="font-weight: bold">İşlem Tarihi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tescilnoksan as $sn => $tescilnoksanitem)
            <tr>
                <th scope="row">{{ $sn + 1 }}</th>
                <td>{{ $tescilnoksanitem->referansno->basvuru_no }}</td>
                <td>{{ $tescilnoksanitem->referans_no }}</td>
                <td>{{ $tescilnoksanitem->marka_adi }}</td>
                <td>{{ $tescilnoksanitem->firma_adi }}</td>
                <td>{{ $tescilnoksanitem->musteri_temsilcisi }}</td>
                <td>{{ $tescilnoksanitem->satis_temsilcisi }}</td>
                <td>{{ $tescilnoksanitem->teblig_tarihi }}</td>
                <td>{{ $tescilnoksanitem->teblig_bitis_tarihi }}</td>
                <td>{{ $tescilnoksanitem->tn_durum }}</td>
                <td>{{ $tescilnoksanitem->islem_tarihi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
