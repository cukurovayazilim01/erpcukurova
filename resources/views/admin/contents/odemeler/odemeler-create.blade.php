@extends('admin.layouts.app')
@section('title')
    Ödemeler
@endsection
@section('contents')
@section('topheader')
Ödemeler
@endsection
<div class="card radius-5">
    <div class="card-body" style="border-radius: 5px; padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

        <div class="row">
            <form action="{{route('odemeler.store')}}" method="POST" id="add-form">
                @csrf
            <div class="col-md-12" style="padding: 1%; ">
                <div class="row">

                    <div class="col-md-6 col-sm-12 select2-sm">
                        <label for="cari_id" >Firma</label>

                          <select name="cari_id" id="cari_id" required style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                            <!-- Dinamik veriler buraya yüklenecek -->
                          </select>
                      </div>

                    <div class="col-md-6 col-sm-12">
                        <label for="tarih">Ödeme Tarihi</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input type="datetime-local" name="tarih" id="tarih"
                                class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <input type="hidden" name="odeme_kodu" id="odeme_kodu">

                    <div class="col-md-4 col-sm-12">
                        <label for="odemeyapan_id">Ödeme Yapan</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                            <select name="odemeyapan_id" id="odemeyapan_id" class="form-control form-control-sm" required>
                                <option value="">Lütfen Seçim Yapınız</option>
                                @foreach ($user as $useritem)
                                    <option value="{{ $useritem->id }}">{{ $useritem->ad_soyad }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="tahsil_eden">Tahsil Eden</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                            <input type="text" name="tahsil_eden" id="tahsil_eden"
                                class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="odeme_turu">Ödeme Türü</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa fa-check"></i>
                            </span>
                        <select name="odeme_turu" id="odeme_turu" class="form-control form-control-sm" required>
                            <option value="">Lütfen Seçim Yapınız</option>
                            <option value="EFT">EFT</option>
                            <option value="Havale">Havale</option>
                            <option value="Nakit">Nakit</option>
                        </select>
                    </div>

                    </div>

                    <div class="col-md-4 col-sm-12">
                        <label for="odeme_tipi">Ödeme Yöntemi</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa fa-check"></i>
                            </span>
                        <select name="odeme_tipi" id="odeme_tipi" class="form-control form-control-sm" required >
                            <option value="">Lütfen Seçim Yapınız</option>
                            <option value="Kasa">Kasa</option>
                            <option value="Banka">Banka</option>
                        </select>
                    </div>

                    </div>

                    <div class="col-md-4 col-sm-12">
                        <label id="kasa_banka_label"></label>
                        <div class="input-group mb-2" style="border: 1px solid #ced4da;border-radius: 7px;">
                            <span class="input-group-text">
                                <i class="fa-solid fa-layer-group"></i>
                            </span>
                            <select name="kasa_id" id="kasa_id" class="form-control form-control-sm" style="display: none;">
                                <option value="">Lütfen Seçim Yapınız</option>
                                @foreach ($kasalar as $item)
                                <option value="{{ $item->id }}">{{ $item->kasa_adi }}</option>
                                @endforeach
                            </select>
                            <select name="banka_id" id="banka_id" class="form-control form-control-sm" style="display: none;">
                                <option value="">Lütfen Seçim Yapınız</option>
                                @foreach ($bankalar as $banka)
                                <option value="{{ $banka->id }}">{{ $banka->banka_adi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="col-md-4 col-sm-12">
                        <label for="odeme_tutar">Ödeme Tutarı</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa-solid fa-money-bill"></i>
                            </span>
                            <input type="text" name="odeme_tutar" id="odeme_tutar"
                                class="form-control form-control-sm input-mask" required>
                        </div>
                    </div>

                </div>
            </div>


            <div style="display: flex; padding: 10px; gap:20px; text-align: center; justify-content: end">

                <a href="{{route('odemeler.index')}}" class="btn btn-outline-warning btn-sm py-6 w-25"> Vazgeç</a>
                    <button type="submit" id="submit-form" class="btn btn-outline-dark btn-sm py-6 w-75"
                       >
                        Kaydet</button>
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
      url: '/cari-search',
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
<script>
document.addEventListener("DOMContentLoaded", function () {
    const odemeTuruSelect = document.getElementById("odeme_turu");
    const odemeTipiSelect = document.getElementById("odeme_tipi");
    const kasaBankaLabel = document.getElementById("kasa_banka_label");
    const kasaSelect = document.getElementById("kasa_id");
    const bankaSelect = document.getElementById("banka_id");

    function disableOdemeTipi() {
        odemeTipiSelect.style.pointerEvents = "none"; // Kullanıcı değiştiremesin
        odemeTipiSelect.readOnly = true;
    }

    function enableOdemeTipi() {
        odemeTipiSelect.style.pointerEvents = ""; // Kullanıcı değiştirebilsin
        odemeTipiSelect.readOnly = false;
    }

    function handleOdemeTuruChange() {
        const odemeTuru = odemeTuruSelect.value;

        if (odemeTuru === "EFT" || odemeTuru === "Havale") {
            odemeTipiSelect.value = "Banka"; // Otomatik olarak Banka seçilir
            disableOdemeTipi();
            kasaBankaLabel.textContent = "Bankalar";
            bankaSelect.style.display = "block";
            bankaSelect.required = true;
            kasaSelect.style.display = "none";
            kasaSelect.required = false;
        } else if (odemeTuru === "Nakit") {
            odemeTipiSelect.value = "Kasa"; // Otomatik olarak Kasa seçilir
            disableOdemeTipi();
            kasaBankaLabel.textContent = "Kasalar";
            kasaSelect.style.display = "block";
            kasaSelect.required = true;
            bankaSelect.style.display = "none";
            bankaSelect.required = false;
        } else {
            odemeTipiSelect.value = ""; // Varsayılan duruma döndür
            enableOdemeTipi();
            kasaBankaLabel.textContent = "";
            kasaSelect.style.display = "none";
            kasaSelect.required = false;
            bankaSelect.style.display = "none";
            bankaSelect.required = false;
        }
    }

    odemeTuruSelect.addEventListener("change", handleOdemeTuruChange);
});
</script>


@endsection
