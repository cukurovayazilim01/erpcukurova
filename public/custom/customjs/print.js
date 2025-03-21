function customPrint() {
    var printContents = document.getElementById('printArea').innerHTML; // Yazdırılacak alanı seç
    var originalContents = document.body.innerHTML; // Mevcut içeriği sakla

    document.body.innerHTML = printContents; // Sayfa içeriğini yazdırılacak içerikle değiştir
    window.print(); // Yazdırma işlemini başlat
    document.body.innerHTML = originalContents; // Orijinal içeriği geri yükle
    location.reload(); // Sayfayı yeniden yükle (isteğe bağlı)
}
