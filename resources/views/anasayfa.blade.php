@extends('admin.layouts.app')
@section('title')
Anasayfa
@endsection
@section('contents')
@php
    $salesData = [];
    $purchaseData = [];
    $salesRevenue = [];
    $purchaseCost = [];

    // 1-12 ayları sıfırla
    for ($i = 1; $i <= 12; $i++) {
        $salesData[$i] = 0;
        $purchaseData[$i] = 0;
        $salesRevenue[$i] = 0; // Satış toplam fiyatları
        $purchaseCost[$i] = 0; // Alış toplam maliyetleri
    }

    // Verileri çek
    foreach ($ayliksatisgrafigi as $rapor) {
        if ($rapor->satis) {
            foreach ($rapor->satis->satislardata as $satisData) {
                $month = date('n', strtotime($rapor->satis->satis_tarihi)); // 1-12 formatında ay
                $salesData[$month] += $satisData->satis_hizmet_miktar; // Satış miktarı
                $salesRevenue[$month] += $satisData->satis_toplam_fiyat; // Satış toplam fiyatı
            }
        }
        if ($rapor->alis) {
            foreach ($rapor->alis->alislardata as $alisData) {
                $month = date('n', strtotime($rapor->alis->fis_tarihi));
                $purchaseData[$month] += $alisData->miktar; // Alış miktarı
                $purchaseCost[$month] += $alisData->tutar; // Alış toplam fiyatı
            }
        }
    }

    // Grafik için JSON'a çevir
    $salesJson = json_encode(array_values($salesData));
    $purchaseJson = json_encode(array_values($purchaseData));
    $salesRevenueJson = json_encode(array_values($salesRevenue));
    $purchaseCostJson = json_encode(array_values($purchaseCost));

@endphp



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById("areaChart").getContext("2d");

        var salesData = {!! $salesJson !!};
        var purchaseData = {!! $purchaseJson !!};
        var salesRevenue = {!! $salesRevenueJson !!};
        var purchaseCost = {!! $purchaseCostJson !!};

        var areaChart = new Chart(ctx, {
            type: "line", // Çizgi grafik (area)
            data: {
                labels: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],
                datasets: [
                    {
                        label: "Satışlar",
                        data: salesData,
                        backgroundColor: "rgba(54, 162, 235, 0.3)", // Açık mavi (satışlar)
                        borderColor: "rgba(54, 162, 235, 1)",
                        fill: true,
                        borderWidth: 2,
                        tension: 0.4,
                    },
                    {
                        label: "Alışlar",
                        data: purchaseData,
                        backgroundColor: "rgba(255, 99, 132, 0.3)", // Açık kırmızı (alışlar)
                        borderColor: "rgba(255, 99, 132, 1)",
                        fill: true,
                        borderWidth: 2,
                        tension: 0.4,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: "#333", font: { weight: 'bold' } },
                        title: {
                            display: true,
                            text: "Toplam Adet"
                        }
                    },
                    x: {
                        ticks: { color: "#333", font: { weight: 'bold' } }
                    }
                },
                plugins: {
                    legend: {
                        labels: { color: "#222", font: { size: 14, weight: 'bold' } }
                    },
                    tooltip: {
                        backgroundColor: "rgba(0, 0, 0, 0.8)",
                        callbacks: {
                            label: function(tooltipItem) {
                                var index = tooltipItem.dataIndex;
                                var label = tooltipItem.dataset.label;
                                var amount = tooltipItem.raw;
                                var revenue = label === "Satışlar" ? salesRevenue[index] : purchaseCost[index];

                                return [
                                    label + ": " + amount + " adet",
                                    "Toplam Fiyat: " + revenue.toLocaleString() + " ₺"
                                ];
                            }
                        }
                    }
                }
            }
        });
    });
</script>


@php
    $tahsilatGruplar = [];
    $odemeGruplar = [];

    foreach ($tahsilatodemechart as $hrkt) {
        if ($hrkt->tahsilat_id) {
            $tip = $hrkt->tahsilat->odeme_tipi; // Kasa mı Banka mı?
                 // Kasa veya banka adını güvenli bir şekilde al
        $ad = $tip === 'Kasa'
            ? (isset($hrkt->tahsilat->kasaadi) ? $hrkt->tahsilat->kasaadi->kasa_adi : 'Bilinmeyen Kasa')
            : (isset($hrkt->tahsilat->bankaadi) ? $hrkt->tahsilat->bankaadi->banka_adi : 'Bilinmeyen Banka');

            if (!isset($tahsilatGruplar[$tip][$ad])) {
                $tahsilatGruplar[$tip][$ad] = 0;
            }
            $tahsilatGruplar[$tip][$ad] += $hrkt->tahsilat->tahsilat_tutar;
        }

        if ($hrkt->odeme_id) {
            $tip = $hrkt->odeme->odeme_tipi; // Kasa mı Banka mı?
          // Kasa veya banka adını güvenli bir şekilde al
        $ad = $tip === 'Kasa'
            ? (isset($hrkt->odeme->kasaadi) ? $hrkt->odeme->kasaadi->kasa_adi : 'Bilinmeyen Kasa')
            : (isset($hrkt->odeme->bankaadi) ? $hrkt->odeme->bankaadi->banka_adi : 'Bilinmeyen Banka');

            if (!isset($odemeGruplar[$tip][$ad])) {
                $odemeGruplar[$tip][$ad] = 0;
            }
            $odemeGruplar[$tip][$ad] += $hrkt->odeme->odeme_tutar;
        }
    }

    // Chart.js için verileri JSON formatına çevir
    $tahsilatLabels = json_encode(array_merge(array_keys($tahsilatGruplar['Kasa'] ?? []), array_keys($tahsilatGruplar['Banka'] ?? [])));
    $tahsilatData = json_encode(array_merge(array_values($tahsilatGruplar['Kasa'] ?? []), array_values($tahsilatGruplar['Banka'] ?? [])));

    $odemeLabels = json_encode(array_merge(array_keys($odemeGruplar['Kasa'] ?? []), array_keys($odemeGruplar['Banka'] ?? [])));
    $odemeData = json_encode(array_merge(array_values($odemeGruplar['Kasa'] ?? []), array_values($odemeGruplar['Banka'] ?? [])));

    // Renk paleti (dinamik)
    $colors = ['#36A2EB', '#FF6384', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'];
@endphp

<div class="row">
    <!-- Günlük Tahsilat -->
    <div class="col-md-3">
        <div class="card shadow-lg">
            <div class="card-header bg-success text-white text-center">
                <h5 class="mb-0">Günlük Tahsilat</h5>
            </div>
            <div class="card-body text-center">
                <canvas id="tahsilatChart"></canvas>
            </div>
        </div>
    </div>
    <!-- Günlük Ödeme -->
    <div class="col-md-3">
        <div class="card shadow-lg">
            <div class="card-header bg-danger text-white text-center">
                <h5 class="mb-0">Günlük Ödeme</h5>
            </div>
            <div class="card-body text-center">
                <canvas id="odemeChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h5 class="mb-0">Satış & Alış Grafiği</h5>
            </div>
            <div class="card-body">
                <canvas id="areaChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h5 class="mb-0">Personel Bazlı Satış Grafiği</h5>
            </div>
            <div class="card-body">
                <canvas id="personelbazlisatisgrafigi" style="height: 150px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h5 class="mb-0">Aylara Göre Hizmet Türü Satış Grafiği</h5>
            </div>
            <div class="card-body">
                <canvas id="salesChart" style="height: 150px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h5 class="mb-0">Personel Hedef Grafiği</h5>
            </div>
            <div class="card-body">
                <canvas id="personelhedefgrafigi" height="400"></canvas>
            </div>
        </div>
    </div>
    @php
    use App\Models\Yillikizinhakki;

    $currentYear = date('Y');
    $yillikizingrafigi = Yillikizinhakki::where('yili', $currentYear)->get();

    $labels = [];
    $data = [];
    $backgroundColors = [];
    $borderColors = [];

    $renkler = ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff', '#ff9f40', '#8e44ad', '#27ae60'];
    $index = 0;
    $totalIzinHakki = 0;

    foreach ($yillikizingrafigi as $izin) {
        $labels[] = $izin->personel->ad_soyad;
        $data[] = $izin->kalan_izin_hakki;
        $totalIzinHakki += $izin->kalan_izin_hakki;

        $backgroundColors[] = $renkler[$index % count($renkler)];
        $borderColors[] = '#fff'; // Beyaz kenarlıklar
        $index++;
    }

    $chartLabels = json_encode($labels);
    $chartData = json_encode($data);
    $chartColors = json_encode($backgroundColors);
    $totalIzin = json_encode($totalIzinHakki);
@endphp

<div class="col-md-6">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Yıllık İzin Grafiği</h5>
        </div>
        <div class="card-body">
            <canvas id="yillikizingrafigi" height="400"></canvas>
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                <span style="font-size: 20px; font-weight: bold; color: green;">Toplam</span><br>
                <span style="font-size: 18px; color: gray;">{!! $totalIzin !!}</span>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById("yillikizingrafigi").getContext("2d");

        var chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! $chartLabels !!},
                datasets: [{
                    data: {!! $chartData !!},
                    backgroundColor: {!! $chartColors !!},
                    borderColor: '#fff',
                    borderWidth: 2,
                    hoverOffset: 8 // Üzerine gelince büyüme efekti
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%', // Ortayı boş bırakma oranı
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' gün';
                            }
                        }
                    },
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            }
        });
    });
</script>


</div>
<style>
    .chart-container {
    position: relative;
    height: 350px; /* Sabit yükseklik */
    padding: 15px;
    background: rgba(255,255,255,0.1);
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   document.addEventListener("DOMContentLoaded", function () {
    var tahsilatLabels = {!! $tahsilatLabels !!};
    var tahsilatData = {!! $tahsilatData !!};
    var odemeLabels = {!! $odemeLabels !!};
    var odemeData = {!! $odemeData !!};

    function createBrightGradients(ctx, count) {
        var gradients = [];
        var centerX = ctx.canvas.width / 2;
        var centerY = ctx.canvas.height / 2;
        var radius = Math.min(ctx.canvas.width, ctx.canvas.height) / 2;

        var brightColors = [
            ['#FF0000', '#FF5733'], // Kırmızı tonları
            ['#9900FF', '#CC33FF'], // Mor tonları
            ['#FF9900', '#FFC300'], // Turuncu tonları
            ['#00FF00', '#33FF57'], // Yeşil tonları
            ['#0099FF', '#33CCFF'], // Mavi tonları
            ['#FF00FF', '#FF66FF']  // Pembe tonları
        ];

        for (var i = 0; i < count; i++) {
            var colors = brightColors[i % brightColors.length];
            var gradient = ctx.createRadialGradient(
                centerX, centerY, radius * 0.2,
                centerX, centerY, radius
            );
            gradient.addColorStop(0, colors[0]);
            gradient.addColorStop(1, colors[1]);
            gradients.push(gradient);
        }
        return gradients;
    }

    var ctxTahsilat = document.getElementById("tahsilatChart").getContext("2d");
    var ctxOdeme = document.getElementById("odemeChart").getContext("2d");

    var tahsilatGradients = createBrightGradients(ctxTahsilat, tahsilatLabels.length);
    var odemeGradients = createBrightGradients(ctxOdeme, odemeLabels.length);

    // Günlük Tahsilat Chart (Doughnut)
    new Chart(ctxTahsilat, {
        type: "doughnut",
        data: {
            labels: tahsilatLabels,
            datasets: [{
                data: tahsilatData,
                backgroundColor: tahsilatGradients,
                borderColor: "rgba(255, 255, 255, 0.8)",
                borderWidth: 2,
                hoverBorderColor: "#FFFFFF",
                hoverBorderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    position: "bottom",
                    labels: {
                        color: "#333",
                        font: { size: 12, weight: 'bold' },
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: "rgba(0, 0, 0, 0.85)",
                    bodyFont: { size: 14, weight: 'bold' },
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ": " + tooltipItem.raw.toLocaleString() + " ₺";
                        }
                    }
                }
            },
            animation: { animateScale: true, animateRotate: true },
            elements: { arc: { borderWidth: 0 } }
        }
    });

    // Günlük Ödeme Chart (Pie)
    new Chart(ctxOdeme, {
        type: "pie",
        data: {
            labels: odemeLabels,
            datasets: [{
                data: odemeData,
                backgroundColor: odemeGradients,
                borderColor: "rgba(255, 255, 255, 0.8)",
                borderWidth: 2,
                hoverBorderColor: "#FFFFFF",
                hoverBorderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: "bottom",
                    labels: {
                        color: "#333",
                        font: { size: 12, weight: 'bold' },
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: "rgba(0, 0, 0, 0.85)",
                    bodyFont: { size: 14, weight: 'bold' },
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ": " + tooltipItem.raw.toLocaleString() + " ₺";
                        }
                    }
                }
            },
            animation: { animateScale: true, animateRotate: true },
            elements: { arc: { borderWidth: 0 } }
        }
    });
});


</script>


@php
    $monthlySales = [];
    $monthlyRevenue = [];

    foreach ($ayliksatisgrafigi as $rapor) {
        if ($rapor->satis) {
            foreach ($rapor->satis->satislardata as $satisData) {
                $month = date('n', strtotime($rapor->satis->satis_tarihi)); // 1-12 formatında ay
                $kategori_adi = $satisData->hizmetlerkategori->kategori_ad ?? 'Kategori Yok';

                if (!isset($monthlySales[$month][$kategori_adi])) {
                    $monthlySales[$month][$kategori_adi] = 0;
                }
                $monthlySales[$month][$kategori_adi] += $satisData->satis_hizmet_miktar;

                if (!isset($monthlyRevenue[$month][$kategori_adi])) {
                    $monthlyRevenue[$month][$kategori_adi] = 0;
                }
                $monthlyRevenue[$month][$kategori_adi] += $satisData->satis_toplam_fiyat;
            }
        }
    }

    $sortedMonths = ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];
    $salesData = [];
    $categories = [];

    // Canlı renkler paleti (parlak ve doygun renkler)
    $colorPalette = [
        'rgba(255, 99, 132, 0.9)', // Parlak Kırmızı
        'rgba(54, 162, 235, 0.9)', // Canlı Mavi
        'rgba(255, 206, 86, 0.9)', // Sarı
        'rgba(75, 192, 192, 0.9)', // Turkuaz
        'rgba(153, 102, 255, 0.9)', // Mor
        'rgba(255, 159, 64, 0.9)' // Turuncu
    ];

    foreach ($sortedMonths as $index => $month) {
        $monthIndex = $index + 1;

        foreach ($monthlySales[$monthIndex] ?? [] as $kategori => $adet) {
            if (!in_array($kategori, $categories)) {
                $categories[] = $kategori;
            }
        }
    }

    foreach ($categories as $index => $kategori) {
        $dataset = [
            'label' => $kategori,
            'data' => [],
            'backgroundColor' => $colorPalette[$index % count($colorPalette)], // Döngüyle renkleri tekrarla
            'borderColor' => $colorPalette[$index % count($colorPalette)], // Kenarlık da aynı renk
            'borderWidth' => 2, // Kenarlık kalınlığı artırıldı
            'revenueData' => []
        ];

        foreach ($sortedMonths as $index => $month) {
            $monthIndex = $index + 1;
            $dataset['data'][] = $monthlySales[$monthIndex][$kategori] ?? 0;
            $dataset['revenueData'][] = $monthlyRevenue[$monthIndex][$kategori] ?? 0;
        }

        $salesData[] = $dataset;
    }
@endphp

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById("salesChart").getContext("2d");
        var salesChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],
                datasets: @json($salesData)
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: "#333", // Y ekseni yazı rengi
                            font: { weight: 'bold' }
                        },
                        title: {
                            display: true,
                            text: "Toplam Satış Adeti"
                        }
                    },
                    x: {
                        ticks: {
                            color: "#333", // X ekseni yazı rengi
                            font: { weight: 'bold' }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: "#222", // Başlık rengi
                            font: { size: 14, weight: 'bold' }
                        }
                    },
                    tooltip: {
                        backgroundColor: "rgba(0, 0, 0, 0.8)", // Koyu arkaplan
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 12 },
                        callbacks: {
                            label: function(tooltipItem) {
                                let dataset = tooltipItem.dataset;
                                let label = dataset.label || "";
                                let value = tooltipItem.raw;
                                let revenue = dataset.revenueData[tooltipItem.dataIndex] || 0;

                                return `${label}: ${value} adet, Toplam Fiyat: ₺${revenue.toLocaleString()}`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>



@php
    $monthlyRevenueByPerson = [];
    $personnel = [];

    foreach ($ayliksatisgrafigi as $rapor) {
        if ($rapor->satis) {
            foreach ($rapor->satis->satislardata as $satisData) {
                $month = date('n', strtotime($rapor->satis->satis_tarihi)); // 1-12 formatında ay
                $personel_adi = $rapor->satis->user->ad_soyad ?? 'Bilinmeyen Personel';

                if (!isset($monthlyRevenueByPerson[$month][$personel_adi])) {
                    $monthlyRevenueByPerson[$month][$personel_adi] = 0;
                }
                $monthlyRevenueByPerson[$month][$personel_adi] += $satisData->satis_toplam_fiyat;
            }
        }
    }

    $sortedMonths = ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];
    $salesData = [];

    // Parlak renkler paleti (Her personel farklı renk alsın)
    $colorPalette = [
        'rgba(255, 99, 132, 0.9)',  // Kırmızı
        'rgba(54, 162, 235, 0.9)',  // Mavi
        'rgba(255, 206, 86, 0.9)',  // Sarı
        'rgba(75, 192, 192, 0.9)',  // Turkuaz
        'rgba(153, 102, 255, 0.9)', // Mor
        'rgba(255, 159, 64, 0.9)',  // Turuncu
        'rgba(0, 128, 128, 0.9)',   // Koyu Turkuaz
        'rgba(128, 0, 128, 0.9)',   // Koyu Mor
        'rgba(0, 0, 255, 0.9)',     // Koyu Mavi
        'rgba(255, 165, 0, 0.9)',   // Parlak Turuncu
    ];

    foreach ($sortedMonths as $index => $month) {
        $monthIndex = $index + 1;

        foreach ($monthlyRevenueByPerson[$monthIndex] ?? [] as $personel => $tutar) {
            if (!in_array($personel, $personnel)) {
                $personnel[] = $personel;
            }
        }
    }

    foreach ($personnel as $index => $personel) {
        $dataset = [
            'label' => $personel,
            'data' => [],
            'borderColor' => $colorPalette[$index % count($colorPalette)], // Çizgi rengi
            'backgroundColor' => $colorPalette[$index % count($colorPalette)], // Nokta rengi
            'borderWidth' => 2,
            'fill' => false, // Alanı doldurma
            'pointRadius' => 5, // Nokta büyüklüğü
            'pointHoverRadius' => 7 // Üzerine gelince noktanın büyüklüğü
        ];

        foreach ($sortedMonths as $index => $month) {
            $monthIndex = $index + 1;
            $dataset['data'][] = $monthlyRevenueByPerson[$monthIndex][$personel] ?? 0;
        }

        $salesData[] = $dataset;
    }
@endphp

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- PERSONELBAZLI SATIŞ GRAFİĞİ --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById("personelbazlisatisgrafigi").getContext("2d");
        var salesChart = new Chart(ctx, {
            type: "line", // Çizgi grafiği
            data: {
                labels: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],
                datasets: @json($salesData)
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: "Toplam Satış Fiyatı (₺)"
                        },
                        ticks: {
                            color: "#333",
                            font: { weight: 'bold' },
                            callback: function(value) {
                                return "₺" + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        ticks: {
                            color: "#333",
                            font: { weight: 'bold' }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: "#222",
                            font: { size: 14, weight: 'bold' }
                        }
                    },
                    tooltip: {
                        backgroundColor: "rgba(0, 0, 0, 0.8)",
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 12 },
                        callbacks: {
                            label: function(tooltipItem) {
                                let dataset = tooltipItem.dataset;
                                let label = dataset.label || "";
                                let value = tooltipItem.raw;

                                return `${label}: ₺${value.toLocaleString()}`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
{{-- PERSONEL YILLIK HEDEF GRAFİĞİ --}}
@php
    $hedefData = [];

    foreach ($personelhedefgrafigi as $item) {
        $personel = $item->personel->ad_soyad;
        $konu = $item->hedefkonu->hedef_konu;
        $deger = $item->hedeflenen_deger;

        if (!isset($hedefData[$konu])) {
            $hedefData[$konu] = [];
        }

        if (!isset($hedefData[$konu][$personel])) {
            $hedefData[$konu][$personel] = 0;
        }

        $hedefData[$konu][$personel] += $deger;
    }

    $personeller = [];
    foreach ($personelhedefgrafigi as $item) {
        if (!in_array($item->personel->ad_soyad, $personeller)) {
            $personeller[] = $item->personel->ad_soyad;
        }
    }

    // Datasetleri hazırla
    $renkler = [
        '#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff', '#ff9f40', '#8e44ad', '#27ae60'
    ];

    $datasets = [];
    $index = 0;

    foreach ($hedefData as $konu => $personelDegerleri) {
        $data = [];
        foreach ($personeller as $personel) {
            $data[] = $personelDegerleri[$personel] ?? 0;
        }

        $datasets[] = [
            'label' => $konu,
            'data' => $data,
            'backgroundColor' => $renkler[$index % count($renkler)],
            'stack' => 'stack1',
        ];

        $index++;
    }

    $chartLabels = json_encode($personeller);
    $chartDatasets = json_encode($datasets);
@endphp



<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById("personelhedefgrafigi").getContext("2d");

        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! $chartLabels !!},
                datasets: {!! $chartDatasets !!}
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y', // YATAY ÇUBUK GRAFİK
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw + ' birim';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        stacked: true,
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Hedeflenen Değer'
                        }
                    },
                    y: {
                        stacked: true,
                        categoryPercentage: 0.5, // Barların genişliğini küçült
                        barThickness: 10 // Çubuk kalınlığını belirle
                    }
                }
            }
        });
    });
</script>






@endsection
