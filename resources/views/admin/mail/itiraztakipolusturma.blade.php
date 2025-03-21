<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İtiraz Takip Hatırlatma</title>
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
        İtiraz Takip Hatırlatma
    </div>
    <div class="content">

            <p>Sayın <span class="highlight">{{ $itiraztakipmail->referansno->firmaadi->yetkili_kisi }}</span>,</p>
            <p>Başvurusunu yapmış olduğunuz <span class="highlight">{{ $itiraztakipmail->referansno->basvuru_no }}</span> nolu markanıza <span class="highlight">{{ $itiraztakipmail->bakanlik_karari}}</span> gelmiştir.</p>
            {{-- <p><strong>Tebliğ Bitiş Tarihi:</strong> {{ \Carbon\Carbon::parse($itiraztakipmail->teblig_bitis_tarihi)->format('d.m.Y') }}</p> --}}
            <p>Lütfen Çukurova Patent müşteri temsilcisine ulaşınız.</p>
            <p>Müşteri Temsilciniz : {{$itiraztakipmail->satis_temsilcisi}}</p>
            <p>Telefon Numarası : <a href="tel:+90{{$itiraztakipmail->referansno->satistemsilcisi->telefon}}">{{$itiraztakipmail->referansno->satistemsilcisi->telefon}} </a>Hemen Arayın..</p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} Çukurova Patent | Tüm hakları saklıdır.
    </div>
</div>

</body>
</html>
