
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$izinler->personel->ad_soyad}} İZİN FORMU </title>
    {{-- <style>
        table{
            border: 1px solid black;
        }
        td{
            border: 1px solid black;
        }
    </style> --}}
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container {
            width: 850px;
            border: 2px solid #000;
            padding: 15px;
            border-radius: 10px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .header img {
            width: 250px;
            height: 100px;
        }
        .header .title {
            font-size: 40px;
            font-weight: bold;
            text-align: center;
            flex: 1;
        }
        .info-table, .details-table, .approval-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .info-table td, .details-table td, .approval-table td {
            border: 1px solid #000;
            padding: 8px;
        }
        .info-table td:first-child {
            font-weight: bold;
            background-color: #f5f5f5;
            width: 50%;
        }
        .approval {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-top: 15px;
        }
        .signature-table {
            width: 100%;
            margin-top: 20px;
            text-align: center;
        }
        .signature-table td {
            height: 80px;
            vertical-align: bottom;
            font-weight: bold;
            border-top: 2px solid #000;
        }
    </style>
</head>
<body><div class="form-container">
    <!-- Üst Bilgi -->
    <div class="header">
        <img src="{{ asset('logintemp/cukurova-marka-patent.png') }}" alt="Logo">
        <div class="title">İZİN FORMU</div>
        <table class="info-table" style="width: 30%; font-size: 12px;">
            <tr><td>Doküman No</td><td>FR-01</td></tr>
            <tr><td>Yayın Tarihi</td><td>{{$izinler->islem_tarihi}}</td></tr>
            <tr><td>Rev. No</td><td>00</td></tr>
            <tr><td>Rev. Tarihi</td><td>00</td></tr>
        </table>
    </div>

    <!-- Detay Bilgiler -->
    <table class="details-table">
        <tr><td>Adı Soyadı</td><td>{{$izinler->personel->ad_soyad}}</td></tr>
        <tr><td>Sigorta Sicil No.</td><td>{{$izinler->personel->sigorta_sicil_no}}</td></tr>
        <tr><td>Görev / Unvan</td><td>{{$izinler->personel->gorevi}}</td></tr>
        <tr><td>İzin Türü</td><td>{{$izinler->izin_turu}}</td></tr>
        <tr><td>İzin Süresi</td><td>{{$izinler->izin_gun}}</td></tr>
        <tr>
            <td>Ayrılış Tarihi / Saat</td>
            <td>{{$izinler->baslangic_tarihi}}</td>
        </tr>
        <tr>
            <td>İşe Başlama Tarihi / Saat</td>
            <td>{{$izinler->bitis_tarihi}}</td>
        </tr>
        <tr><td>İzindeki Tel. No.</td><td>{{$izinler->personel->gsm}}</td></tr>
        <tr><td>İzin Adresi</td><td></td></tr>
        <tr><td>Açıklama</td><td>{{$izinler->izin_aciklama}}</td></tr>
    </table>

    <!-- Onay Bölümü -->
    <div class="approval">İzinli Olarak Ayrılmasında Mahsur Yoktur</div>

    <!-- İmza Bölümü -->
    <table class="signature-table">
        <tr>
            <td>Talep Eden</td>
            <td>Amiri</td>
        </tr>
    </table>
</div>
</body>
</html>
