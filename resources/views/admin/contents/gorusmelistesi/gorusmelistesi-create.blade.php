@extends('admin.layouts.app')
@section('title')
    ARAMA KAYDI OLUŞTUR
@endsection
@section('contents')
@section('topheader')
ARAMA KAYDI OLUŞTUR
@endsection
<div class="card">
    <div class="card-body">
        <div class="row">
            <form action="{{route('gorusmelistesi.store')}}" method="POST" id="add-form">
                @csrf
            <div class="col-md-12" style="padding: 1%; ">
                <div class="row">

                    <div class="col-md-6 select2-sm">
                        <label for="cari_id" >Firma</label>

                          <select name="cari_id" id="cari_id" required style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                            <!-- Dinamik veriler buraya yüklenecek -->
                          </select>
                      </div>
                      <div class="col-md-6">
                        <label for="hizmet_turu">Hizmet Türü<code>*</code></label>
                        <div class="form-group input-with-icon">
                            <span class="icon">
                                <i class="fa-solid fa-phone"></i>
                            </span>
                            <select name="hizmet_turu" id="hizmet_turu" class="form-select form-select-sm">
                                <option value="">Lütfen Seçim Yapınız</option>
                                <option value="Marka">Marka</option>
                                <option value="ISO">ISO</option>
                                <option value="WEB">WEB</option>
                                <option value="Domain">Domain</option>
                                <option value="ERP">ERP</option>
                            </select>
                        </div>
                    </div>
                      <div class="col-md-4">
                        <label for="arama_tipi">Arama Tipi<code>*</code></label>
                        <div class="form-group input-with-icon">
                            <span class="icon">
                                <i class="fa-solid fa-phone"></i>
                            </span>
                            <select name="arama_tipi" id="arama_tipi" class="form-select form-select-sm">
                                <option value="">Lütfen Seçim Yapınız</option>
                                <option value="Gelen Arama">Gelen Arama</option>
                                <option value="Giden Arama">Giden Arama</option>
                                <option value="Müşteri Ziyareti">Müşteri Ziyareti</option>
                                <option value="İnternet">İnternet</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="hatirlat_durumu">Hatırlatma Durumu<code>*</code></label>
                        <div class="form-group input-with-icon">
                            <span class="icon">
                                <i class="fa fa-check"></i>
                            </span>
                            <select name="hatirlat_durumu" id="hatirlat_durumu"
                                class="form-select form-select-sm">
                                <option value="">Lütfen Seçim Yapınız</option>
                                <option value="Olumlu">Olumlu</option>
                                <option value="Olumsuz">Olumsuz</option>
                                <option value="Düşünüyor">Düşünüyor</option>
                                <option value="Standart Kayıt">Standart Kayıt</option>
                                <option value="Ziyaret Bekliyor">Ziyaret Bekliyor</option>
                                <option value="Aranacak">Aranacak</option>
                                <option value="Kara Liste">Kara Liste</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="hatirlat_tarihi">Hatırlatma Tarihi<code>*</code></label>
                        <div class="form-group input-with-icon">
                            <span class="icon">
                                <i class="fa-solid fa-calendar-days"></i>
                            </span>
                            <input type="date" name="hatirlat_tarihi" id="hatirlat_tarihi"
                                class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="not">Görüşme Notu</label>
                            <textarea name="not" id="not" cols="20" rows="2" class="form-control form-control-sm "></textarea>
                    </div>
                      <div class="row">
                        <div class="col-md-12 mt-1">
                            <button type="submit" id="submit-form" class="btn btn-sm btn-outline-primary"
                                style="float: right; margin-left: 2px;">
                                Kaydet</button>
                            <a href="{{route('gorusmelistesi.index')}}" class="btn btn-sm btn-outline-secondary" style="float: right"> Vazgeç</a>
                        </div>
                    </div>

                </form>


                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  // Select2 başlatma
  $('#cari_id').select2({
    theme: 'bootstrap4',  // Bootstrap 4 uyumluluğu
    placeholder: "Firma Seçiniz",
    allowClear: true,
    minimumInputLength: 3,
    width: '100%', // Select2 genişliği
    ajax: {
      url: '/cari-search-kontak',
      type: 'GET',
      dataType: 'json',
      delay: 250,
      data: function(params) {
        return { q: params.term };
      },
      processResults: function(data) {
        return {
          results: data.map(function(item) {
            return { id: item.id, text: item.firma_unvan };
          })
        };
      },
      cache: true
    },
    language: {
      inputTooShort: function() { return "Lütfen en az 3 karakter girin."; },
      noResults: function() { return "Sonuç bulunamadı."; }
    }
  });
    // Select2 açıldığında arama inputuna otomatik odaklanma
    $('#cari_id').on('select2:open', function() {
            setTimeout(() => {
                let searchField = $('.select2-container--open .select2-search__field');
                if (searchField.length) {
                    searchField[0].focus();
                }
            }, 150); // 50 yerine 150 ms bekleyelim
        });
});
</script>
@endsection
