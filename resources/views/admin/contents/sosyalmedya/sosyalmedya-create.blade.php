@extends('admin.layouts.app')
@section('title')
    Gönderi Oluştur
@endsection
@section('contents')
    @section('topheader')
        Gönderi Oluştur
    @endsection
    <style>
    .icon-container {
      display: flex;
      gap: 30px;
      flex-wrap: wrap;
      justify-content: center;
    }

    /* Checkbox'ları gizleyelim */
    input[type="checkbox"] {
      display: none;
    }

    .icon-label {
      font-size: 50px;
      cursor: pointer;
      padding: 20px;
      border-radius: 15px;
      transition: all 0.3s ease;
      border: 2px solid transparent;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    /* Seçilen iconların etrafına mavi border ekleyip, arka planı değiştiriyoruz */
    input[type="checkbox"]:checked + .icon-label {
      border-color: #478bfb;
      background-color: #eaf1ff;
    }

    /* Seçili ikonun etrafına küçük check işareti ekliyoruz */
    input[type="checkbox"]:checked + .icon-label::after {
      content: '\f00c'; /* FontAwesome check işareti */
      font-family: 'Font Awesome 5 Free';
      font-weight: 900;
      position: absolute;
      top: -5px;
      right: -5px;
      font-size: 20px;
      color: #478bfb;
    }

    /* Hover efekti */
    .icon-label:hover {
      background-color: rgba(71, 139, 251, 0.1);
    }

    .icon-label i {
      transition: color 0.3s ease;
    }

    /* Seçilen ikonun rengini değiştiriyoruz */
    input[type="checkbox"]:checked + .icon-label i {
      color: #478bfb;
    }
  </style>
    <div class="card radius-5">
        <div class="card-body"
            style="border-radius: 5px; padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">
            <div class="row">
                <form action="{{route('sosyalmedya.store')}}" method="POST" id="add-form"  enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12" style="padding: 1%; ">
                        <div class="row">


                            <div class="icon-container">
                                <input type="checkbox" id="instagram" name="gonderi_yeri[]" value="instagram">
                                <label class="icon-label" for="instagram" title="Instagram">
                                </label>
                                <i class="fa-brands fa-instagram" style="color:#E1306C; font-size: 40px;"></i>

                                <input type="checkbox" id="facebook" name="gonderi_yeri[]" value="facebook">
                                <label class="icon-label" for="facebook" title="Facebook">
                                </label>
                                <i class="fa-brands fa-facebook" style="color:#1877F2; font-size: 40px;"></i>

                                <input type="checkbox" id="x" name="gonderi_yeri[]" value="x">
                                <label class="icon-label" for="x" title="X">
                                </label>
                                <i class="fa-brands fa-x-twitter" style="color:#000; font-size: 40px;"></i>

                                <input type="checkbox" id="linkedin" name="gonderi_yeri[]" value="linkedin">
                                <label class="icon-label" for="linkedin" title="LinkedIn">
                                </label>
                                <i class="fa-brands fa-linkedin" style="color:#0A66C2; font-size: 40px;"></i>
                              </div>

                            <div class="col-md-4 col-sm-12">
                                <label for="gonderi_adi">Gönderi Adı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="gonderi_adi" id="gonderi_adi"
                                        class="form-control form-control-sm " required>
                                </div>
                            </div>


                            <div class="col-md-4 col-sm-12">
                                <label for="odeme_yapan">Gönderi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="file" name="resim[]" multiple class="form-control form-control-sm" required>
                                </div>
                            </div>

{{--
                            <div class="col-md-4 col-sm-12">
                                <label for="odeme_tipi">Ödeme Yöntemi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <select name="odeme_tipi" id="odeme_tipi" class="form-control form-control-sm" required>
                                        <option value="">Lütfen Seçim Yapınız</option>
                                        <option value="Kasa">Kasa</option>
                                        <option value="Banka">Banka</option>
                                    </select>
                                </div>

                            </div>





                            <div class="col-md-4 col-sm-12">
                                <label for="Gönderi Oluştur_tutar">Gönderi Oluştur Tutarı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-money-bill"></i>
                                    </span>
                                    <input type="text" name="Gönderi Oluştur_tutar" id="Gönderi Oluştur_tutar"
                                        class="form-control form-control-sm input-mask" required>
                                </div>
                            </div> --}}

                        </div>
                    </div>


                    <div style="display: flex; padding: 10px; gap:20px; text-align: center; justify-content: end">

                        <a href="{{route('sosyalmedya.index')}}" class="btn btn-outline-warning btn-sm py-6 w-25"> Vazgeç</a>
                        <button type="submit" id="submit-form" class="btn btn-outline-dark btn-sm py-6 w-75">
                            Kaydet</button>
                    </div>

                </form>


            </div>
        </div>
    </div>



@endsection
