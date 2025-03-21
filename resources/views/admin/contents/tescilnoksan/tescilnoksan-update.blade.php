
@extends('admin.layouts.app')
@section('title')
    {{ $tescilnoksan->marka_adi }} GÜNCELLE
@endsection
@section('contents')
@section('topheader')
    {{ $tescilnoksan->marka_adi }} GÜNCELLE
@endsection

<div class="card">
    <div class="card-body">
        <div class="row">

            <form action="{{ route('tescilnoksan.update', ['tescilnoksan' => $tescilnoksan->id]) }}" method="POST"
                id="add-form">
                @csrf
                @method('put')
                <div class="col-md-12" style="padding: 1%; ">
                    <div class="row">
                            {{-- <div class="col-md-4 select2-sm">
                                <label for="markatakip_id" >Başvuru No</label>

                                  <select name="markatakip_id" id="markatakip_id" required style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                    <!-- Dinamik veriler buraya yüklenecek -->
                                  </select>
                              </div> --}}
                              <div class="col-md-4 select2-sm">
                                <label for="markatakip_id">Başvuru No</label>
                                <input type="text" name="markatakip_id" id="markatakip_id"
                                    class="form-control form-control-sm" value="{{ $marka->basvuru_no }}" readonly>
                                <input type="hidden" name="markatakip_id" value="{{ $marka->id }}">

                            </div>
                            <div class="col-md-4">
                                <label for="marka_adi">Marka Adı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="marka_adi" id="marka_adi"
                                        class="form-control form-control-sm" value="{{$tescilnoksan->marka_adi}}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="firma_adi">Firma Adı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="firma_adi" id="firma_adi"
                                        class="form-control form-control-sm" value="{{$tescilnoksan->firma_adi}}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="referans_no">Referans No</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="referans_no" id="referans_no"
                                        class="form-control form-control-sm" value="{{$tescilnoksan->referans_no}}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="musteri_temsilcisi">Müşteri Temsilcisi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="musteri_temsilcisi" id="musteri_temsilcisi"
                                        class="form-control form-control-sm" value="{{$tescilnoksan->musteri_temsilcisi}}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="satis_temsilcisi">Satış Temsilcisi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="satis_temsilcisi" id="satis_temsilcisi"
                                        class="form-control form-control-sm" value="{{$tescilnoksan->satis_temsilcisi}}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="tn_durum">İtiraz Durum</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <select name="tn_durum" id="tn_durum"
                                        class="form-select form-select-sm" required>
                                        <option value="Yapıldı"
                                        {{$tescilnoksan->tn_durum == 'Yapıldı' ? 'selected' : ''}}>Yapıldı</option>
                                        <option value="Beklemede"
                                        {{$tescilnoksan->tn_durum == 'Beklemede' ? 'selected' : ''}}>Beklemede</option>
                                        <option value="Yapılmadı"
                                        {{$tescilnoksan->tn_durum == 'Yapılmadı' ? 'selected' : ''}}>Yapılmadı</option>
                                        <option value="İptal"
                                        {{$tescilnoksan->tn_durum == 'İptal' ? 'selected' : ''}}>İptal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="teblig_tarihi">Tebliğ Tarihi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" name="teblig_tarihi" id="teblig_tarihi"
                                        class="form-control form-control-sm" value="{{$tescilnoksan->teblig_tarihi}}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="teblig_bitis_tarihi">Tebliğ Bitiş Tarihi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" name="teblig_bitis_tarihi" id="teblig_bitis_tarihi"
                                        class="form-control form-control-sm" style="pointer-events: none; cursor: not-allowed" onkeydown="return false;" value="{{$tescilnoksan->teblig_bitis_tarihi}}" required readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="itiraz_dosya">İtiraz Dosya</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="file" name="itiraz_dosya" id="itiraz_dosya"
                                        class="form-control form-control-sm" value="{{$tescilnoksan->itiraz_dosya}}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="itiraz_aciklama">İtiraz Açıklama</label>
                                <textarea name="itiraz_aciklama" id="itiraz_aciklama" cols="20" rows="2"
                                    class="form-control form-control-sm ">{{$tescilnoksan->itiraz_aciklama}}</textarea>
                            </div>

                            <div class="col-md-12 mt-2 mr-15">
                                <button type="submit" id="submit-form" class="btn btn-sm btn-outline-success"
                                    style="float: right; margin-left: 2px;">
                                    İtirazı Güncelle</button>
                                <a href="{{ route('itiraztakipp.index') }}" class="btn btn-sm btn-outline-secondary"
                                    style="float: right"> Vazgeç</a>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('searchForm').addEventListener('submit', function(event) {
                event.preventDefault();
            });
        });
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tebligTarihiInput = document.getElementById("teblig_tarihi");
        var tebligBitisTarihiInput = document.getElementById("teblig_bitis_tarihi");

        tebligTarihiInput.addEventListener("change", function() {
            // Seçilen tarihi al
            var selectedDate = new Date(tebligTarihiInput.value);

            // 2 ay ekleyerek yeni tarihi hesapla
            var yeniTarih = new Date(selectedDate);
            yeniTarih.setMonth(selectedDate.getMonth() + 2);

            // Yeni tarihi "YYYY-MM-DD" formatına çevir
            var yeniTarihFormatli = yeniTarih.toISOString().split('T')[0];

            // Sonucu teblig_bitis_tarihi inputuna yaz
            tebligBitisTarihiInput.value = yeniTarihFormatli;
        });
    });
</script>
 {{-- SEARCHHHH  --}}
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
    $(document).ready(function(){
        $('#searchInput').on('input', function(event) {
            var searchValue = $(this).val();

            if (searchValue.trim() === '') {
                // Eğer input boşsa, tüm veriyi yükle
                $.ajax({
                    url: '{{ route('tescilnoksansearch') }}',
                    method: 'GET',
                    data: { tescilnoksansearch: '' }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('tescilnoksansearch') }}',
                    method: 'GET',
                    data: { tescilnoksansearch: searchValue }, // Arama değeri
                    success: function(response) {
                        // Sadece tbody kısmını güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            }
        });
    });
</script>
 <script>
    $(document).ready(function() {
        $('#markatakip_id').on('change', function() {
            var selectedCariId = $(this).val();

            $.ajax({
                url: '/getMarkabilgi/' + selectedCariId,
                type: 'GET',
                dataType: 'json', // Gelen verinin JSON olduğunu belirtin
                success: function(data) {
                    // AJAX isteği başarılı olduğunda çalışacak kod
                    $('#marka_adi').val(data.marka_adi);
                    $('#firma_adi').val(data.firma_adi);
                    $('#referans_no').val(data.referans_no);
                    $('#musteri_temsilcisi').val(data.musteri_temsilcisi);
                    $('#satis_temsilcisi').val(data.satis_temsilcisi);

                },
                error: function(xhr, textStatus, errorThrown) {
                    // AJAX isteği başarısız olduğunda çalışacak kod
                    console.error('AJAX isteği başarısız: ' + textStatus);
                }
            });
        });
    });
</script>

 <script>
     $(document).ready(function() {
       // Select2 başlatma
       $('#markatakip_id').select2({
         theme: 'bootstrap4',  // Bootstrap 4 uyumluluğu
         placeholder: "Başvuru No Seçiniz",
         allowClear: true,
         minimumInputLength: 3,
         width: '100%', // Select2 genişliği
         ajax: {
           url: '/basvuruno-search',
           type: 'GET',
           dataType: 'json',
           delay: 250,
           data: function(params) {
             return { q: params.term };
           },
           processResults: function(data) {
             return {
               results: data.map(function(item) {
                 return { id: item.id, text: item.basvuru_no };
               })
             };
           },
           cache: true
         },
         dropdownParent: $('#tescilnoksanmodal'), // Modal ID'sini burada belirtin
         language: {
           inputTooShort: function() { return "Lütfen en az 3 karakter girin."; },
           noResults: function() { return "Sonuç bulunamadı."; }
         }
       });
     });
     </script>
     <script>
        $(document).ready(function() {
     $('#cari_id_1').select2({
        theme: 'bootstrap4',
        placeholder: "Firma Seçiniz",
        allowClear: true,
        minimumInputLength: 3,
        width: '100%',
        ajax: {
            url: '/cari-search',
            type: 'GET',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                };
            },
            processResults: function(data) {
                return {
                    results: data.map(function(item) {
                        return {
                            id: item.firma_unvan,
                            text: item.firma_unvan
                        };
                    })
                };
            },
            cache: true
        },
        dropdownParent: $('#tescilnoksanfilmodal'),
        language: {
            inputTooShort: function() {
                return "Lütfen en az 3 karakter girin.";
            },
            noResults: function() {
                return "Sonuç bulunamadı.";
            }
        }
    });
    });

    </script>


        @include('session.session')
    @endsection
