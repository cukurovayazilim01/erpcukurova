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
                <form action="{{ route('postToInstagram') }}" method="POST" style="display: inline;">
                    @csrf

                    <div>
                        <label for="image_url">Resim URL:</label>
                        <input type="text" name="image_url" id="image_url" placeholder="https://..." required>
                    </div>

                    <div>
                        <label for="caption">Açıklama (Caption):</label>
                        <input type="text" name="caption" id="caption" placeholder="#etiket yaz" required>
                    </div>

                    <div>
                        <label for="alt_text">Alt Metin:</label>
                        <input type="text" name="alt_text" id="alt_text" placeholder="Açıklayıcı alternatif metin">
                    </div>

                    <button type="submit" class="btn p-0 m-0">
                        <i style="color: rgb(180, 68, 34)" class="fa-solid fa-paper-plane fs-6"></i>
                        Gönderiyi Paylaş
                    </button>
                </form>


            </div>
        </div>
    </div>



@endsection
