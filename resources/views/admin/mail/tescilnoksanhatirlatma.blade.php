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
        Tescil Noksan Hatırlatma
    </div>
    <div class="content">
        @if(isset($tescilnoksansatistemsilcisi))
            <p>Sayın <span class="highlight">{{ $tescilnoksansatistemsilcisi->satis_temsilcisi }}</span>,</p>
            <p><span class="highlight">{{ $tescilnoksansatistemsilcisi->marka_adi }}</span> Başvuru no <span class="highlight">{{ $tescilnoksansatistemsilcisi->referansno->basvuru_no }}</span> olan markanın tescil noksan tebliğ bitiş tarihine 7 gün kalmıştır.</p>
            <p><strong>Tebliğ Bitiş Tarihi:</strong> {{ \Carbon\Carbon::parse($tescilnoksansatistemsilcisi->teblig_bitis_tarihi)->format('d.m.Y') }}</p>
            <p>Lütfen gerekli işlemleri tamamlayınız.</p>
        @elseif(isset($tescilnoksanmusteri))
            <p>Sayın <span class="highlight">{{ $tescilnoksanmusteri->referansno->firmaadi->yetkili_kisi }}</span>,</p>
            <p>Başvuru numarası  <span class="highlight">{{ $tescilnoksanmusteri->referansno->basvuru_no }}</span> olan markanın 'Tescil Ücret bildirimi' yapılmış olup kanuni süre olarak son 7 gün kalmıştır.</p>
            <p><strong>Tebliğ Bitiş Tarihi:</strong> {{ \Carbon\Carbon::parse($tescilnoksanmusteri->teblig_bitis_tarihi)->format('d.m.Y') }}</p>
            <p>Lütfen gerekli işlemleri tamamlamak için bizimle iletişime geçin.</p>
            <p>Müşteri Temsilciniz : {{$itiraztakipmail->satis_temsilcisi}}</p>
            <p>Telefon Numarası : <a href="tel:+90{{$tescilnoksanmusteri->referansno->satistemsilcisi->telefon}}">{{$tescilnoksanmusteri->referansno->satistemsilcisi->telefon}} </a>Hemen Arayın..</p>
        @else
            <p>Bir hata oluştu veya geçerli bir takip kaydı bulunamadı.</p>
        @endif
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} Çukurova Patent | Tüm hakları saklıdır.
    </div>
</div>

</body>
</html>
