document.querySelectorAll('label').forEach(function(label) {
    label.textContent = label.textContent
      .split(' ') // Metni boşluktan ayır
      .map(function(word) {
        return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase(); // İlk harfi büyük, geri kalanları küçük yap
      })
      .join(' '); // Kelimeleri tekrar birleştir
  });
