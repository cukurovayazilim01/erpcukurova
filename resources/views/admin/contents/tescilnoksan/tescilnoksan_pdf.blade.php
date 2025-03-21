<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title>Tescil Noksan Raporu</title>
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
        <h1 style="text-align: center;">Tescil Noksan Raporu</h1>
        <table class="table table-bordered" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f8f9fa; text-align: left;">
                    <th scope="col">#</th>
                    <th>Başvuru No</th>
                    <th>Referans No</th>
                    <th>Marka Adı</th>
                    <th>Firma Adı</th>
                    <th>Müşteri Temsilcisi</th>
                    <th>Satış Temsilcisi</th>
                    <th>Tebliğ Tarihi</th>
                    <th>Tebliğ Bitiş Tarihi</th>
                    <th>Durum</th>
                    <th>İşlem Tarihi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $tescilnoksanitem)
                <tr>
                    <th scope="row">{{ $startNumber - $loop->index }}</th>
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
    </div>
</body>

</html>
