@extends('admin.layouts.app')
@section('title')
    KONTAK OLUŞTUR
@endsection
@section('contents')
    @section('topheader')
        KONTAK OLUŞTUR
    @endsection
    <div class="card radius-5">
        <div class="card-body" style="border-radius: 5px; padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">
            <div class="row">
                <form action="{{route('kontaklistesi.store')}}" method="POST" id="add-form">
                    @csrf
                    <div class="col-md-12" style="padding: 1%; ">
                        <div class="row">

                            <div class="col-md-6 col-sm-12 select2-sm">
                                <label for="cari_id">Firma</label>

                                <select name="cari_id" id="cari_id" required
                                    style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                    <!-- Dinamik veriler buraya yüklenecek -->
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="yetkili_isim">Yetkili Kişi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" name="yetkili_isim" id="yetkili_isim"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="telefon">Telefon</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                    <input type="number" name="telefon" id="telefon"
                                        class="form-control form-control-sm no-zero" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="eposta">E-Posta</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <input type="email" name="eposta" id="eposta"
                                        class="form-control form-control-sm no-zero" required>
                                </div>
                            </div>
                            <div style="display: flex; padding: 10px; gap:20px; text-align: center; justify-content: end">
                                <a href="{{route('kontaklistesi.index')}}" class="btn btn-outline-warning btn-sm py-6 w-25">
                                    Vazgeç</a>
                                <button type="submit" id="submit-form"
                                    class="btn btn-outline-dark btn-sm py-6 w-75">Kaydet</button>
                            </div>

                </form>


            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Select2 başlatma
            $('#cari_id').select2({
                theme: 'bootstrap4',  // Bootstrap 4 uyumluluğu
                placeholder: "Firma Seçiniz",
                allowClear: true,
                minimumInputLength: 3,
                width: '100%', // Select2 genişliği
                dropdownParent: $('body'), // Dropdown'un doğru çalışmasını sağlar
                ajax: {
                    url: '/cari-search-kontak',
                    type: 'GET',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return { q: params.term };
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(function (item) {
                                return { id: item.id, text: item.firma_unvan };
                            })
                        };
                    },
                    cache: true
                },
                language: {
                    inputTooShort: function () { return "Lütfen en az 3 karakter girin."; },
                    noResults: function () { return "Sonuç bulunamadı."; }
                }
            });
            // Select2 açıldığında arama inputuna otomatik odaklanma
            $('#cari_id').on('select2:open', function () {
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
