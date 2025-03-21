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

    <div id="printArea">
        <h1 style="text-align: center;">Marka Takip Raporu</h1>
        <table class="table table-bordered" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f8f9fa; text-align: left;">
                    <th>#</th>
                    {{-- <th>İşlem Tarihi</th> --}}
                    <th>Başvuru Tarihi</th>
                    <th>Yenileme Tarihi</th>
                    <th>Referans No</th>
                    <th>Firma Adı</th>
                    <th>Firma GSM</th>
                    <th>Marka Adı</th>
                    <th>Marka Sınıf</th>
                    <th>Başvuru No</th>
                    <th>Hizmet Türü</th>
                    <th>VKN</th>
                    <th>TC</th>
                    <th>Şehir</th>
                    <th>Marka İşlem</th>
                    <th>Marka Durum</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $markatakipitem)
                    <tr>
                        <td>{{ $startNumber - $loop->index }}</td>
                        {{-- <td>{{ $markatakipitem->islem_tarihi }}</td> --}}
                        <td>{{ $markatakipitem->basvuru_tarihi }}</td>
                        <td>{{ $markatakipitem->yenileme_tarih }}</td>
                        <td>{{ $markatakipitem->referans_no }}</td>
                        <td>{{ $markatakipitem->firmaadi->firma_unvan }}</td>
                        <td>{{ $markatakipitem->firmaadi->yetkili_kisi_tel }}</td>
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
    </div>
</body>

</html>
