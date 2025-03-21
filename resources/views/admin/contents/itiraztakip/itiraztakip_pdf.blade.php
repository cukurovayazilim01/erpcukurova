<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title>Marka Takip Raporu</title>
    <style>
        body {
            font-size: 6px;
            font-family: "DejaVu Sans Mono", monospace;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 1px;
        }

        th,
        td {
            font-size: 6px;
            word-wrap: break-word;
            padding: 1px;
            text-align: center;
        }

        h1 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 7px;
        }

        th {
            background-color: #f2f2f2;
        }

        table th:first-child,
        table td:first-child {
            width: 7px !important;
            word-wrap: break-word;
        }

        table th {
            background-color: #f8f9fa;
            color: #333;
        }
    </style>
</head>

<body>

    <div id="printArea" >
        <h1 style="text-align: center;">İtiraz Takip Raporu</h1>
        <table class="table table-bordered" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f8f9fa; text-align: left;">
                    <th>#</th>
                    <th>Başvuru No</th>
                    <th>Referans No</th>
                    <th>Bakanlık Kararı</th>
                    <th>İtiraz İşlem</th>
                    <th>Marka Adı</th>
                    <th>Firma Adı</th>
                    <th>Müşteri Temsilcisi</th>
                    <th>İşlem Yapan</th>
                    <th>Tebliğ Tarihi</th>
                    <th>Tebliğ Bitiş Tarihi</th>
                    <th>Ücret</th>
                    <th>Durum</th>
                    <th>İşlem Tarihi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $itiraztakipitem)
                <tr>
                    <td>{{ $startNumber - $loop->index }}</td>
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
    </div>
</body>

</html>
