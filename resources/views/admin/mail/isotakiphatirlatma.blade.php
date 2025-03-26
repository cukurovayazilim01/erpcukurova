<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISO Takip Hatırlatma</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: #039FE0;
            color: #fff;
            padding: 15px;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .content {
            padding: 20px;
            font-size: 16px;
            color: #333;
        }
        .highlight {
            font-weight: bold;
            color: #039FE0;
        }
        .footer {
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #777;
            border-top: 1px solid #ddd;
            margin-top: 20px;
        }
        .btn {
            display: inline-block;
            background: #039FE0;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn:hover {
            background: #e63946;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        ISO Takip Hatırlatma
    </div>
    <div class="content">
            <p>Sayın <span class="highlight">{{ $iso->islemyapan->ad_soyad }}</span>,</p>
            <p>Ara Denetim Tarihi<span class="highlight"> {{ $iso->ara_denetim_tarihi }} </span> olan <span class="highlight">{{$iso->firmaadi->firma_unvan}}</span> carisinin <span class="highlight">{{$iso->hizmet_adi}}</span> belgesinin yenilemesini yapmayı unutmayınız.</p>


    </div>
    <div class="footer">
        &copy; {{ date('Y') }} Çukurova Patent | Tüm hakları saklıdır.
    </div>
</div>

</body>
</html>
