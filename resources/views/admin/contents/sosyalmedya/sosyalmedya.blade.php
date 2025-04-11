@extends('admin.layouts.app')
@section('title')
    Gönderi Oluştur
@endsection
@section('contents')
    @section('topheader')
        Gönderi Oluştur
    @endsection
    <style>
        .card-container {
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            border-radius: 5px;
        }

        .card-checkbox {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            margin: 0;
            cursor: pointer;
            z-index: 1;
        }

        .card-container:hover {
            border-color: rgba(71, 139, 251, 0.3);
        }

        .card-checkbox:checked~.card-container {
            border-color: #478bfb;
            box-shadow: 0 0 0 1px #478bfb;
        }

        .card-checkbox:checked+.card-body {
            background-color: #eaf1ff;
        }

        .card-body {
            padding: 15px;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Seçili card'da check işareti */
        .card-checkbox:checked~.card-container::after {
            content: '\2713';
            /* Check işareti */
            position: absolute;
            top: -8px;
            right: -8px;
            width: 20px;
            height: 20px;
            background: #478bfb;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            z-index: 2;
        }
    </style>
    <div class="card radius-5">
        <div class="card-body">
            <div class="row">
                <form action="{{ route('postToInstagram') }}" method="POST" style="display: inline;"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12" style="padding: 1%; ">
                        <div class="row" style="padding: 0 5rem; display: flex; justify-content: center">
                            <div class="col-lg-2" style="position: relative;">
                                <input type="checkbox" name="service[]" id="instagram" class="card-checkbox"
                                    value="instagram" />
                                <div class="card radius-5 card-container">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('resim/ins.png') }}" alt="Instagram">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2" style="position: relative;">
                                <input type="checkbox" name="service[]" id="facebook" class="card-checkbox"
                                    value="facebook" />
                                <div class="card radius-5 card-container">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('resim/face.png') }}" alt="Facebook">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2" style="position: relative;">
                                <input type="checkbox" name="service[]" id="twitter" class="card-checkbox"
                                    value="twitter" />
                                <div class="card radius-5 card-container">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('resim/twt.png') }}" alt="Twitter">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2" style="position: relative;">
                                <input type="checkbox" name="service[]" id="linkedin" class="card-checkbox"
                                    value="linkedin" />
                                <div class="card radius-5 card-container">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('resim/lnk.png') }}" alt="LinkedIn">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2" style="position: relative;">
                                <input type="checkbox" name="service[]" id="google" class="card-checkbox" value="google" />
                                <div class="card radius-5 card-container">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('resim/google.png') }}" alt="google">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2" style="position: relative;">
                                <input type="checkbox" name="service[]" id="whatsapp" class="card-checkbox"
                                    value="whatsapp" />
                                <div class="card radius-5 card-container">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('resim/wp.png') }}" alt="whatsapp">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
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
                                    <input type="file" name="resim[]" multiple class="form-control form-control-sm"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="odeme_yapan">Reels</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="file" name="video[]" multiple class="form-control form-control-sm"
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="text">Açıklama</label>
                                <textarea name="text" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                    </div>
            </div>
        </div>


        <div>
            <label for="image_url">Resim URL:</label>
            <input type="text" name="image_url" id="image_url" placeholder="https://...">
        </div>

        <div>
            <label for="caption">Açıklama (Caption):</label>
            <input type="text" name="caption" id="caption" placeholder="#etiket yaz">
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
