@extends('admin.layouts.app')
@section('title')
    Çek/Senet Ödeme
@endsection
@section('contents')
@section('topheader')
{{$ceksenet->cek_no}} No'lu Çek Ödemesi
@endsection
<div class="card">
    <div class="card-body">
        <div class="row">
            <form action="{{ route('Postcekodeme',$ceksenet->id) }}" method="POST" id="add-form">
                @csrf
                <div class="col-md-12" style="padding: 1%; ">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="cari_id">Firma</label>
                            <div class="form-group input-with-icon" style="display: flex; align-items: center;">
                                <span class="icon">
                                    <i class="fa fa-building"></i>
                                </span>
                                <input type="text" name="cari_unvan" id="cari_unvan"
                                    class="form-control form-control-sm" value="{{ $cariler->firma_unvan }}" readonly>
                                <input type="hidden" name="cari_id" value="{{ $cariler->id }}">
                            </div>
                        </div>
                        {{-- <input type="hidden" name="tahsileden_id" id="tahsileden_id" class="form-control form-control-sm" readonly> --}}
                        <input type="hidden" name="tahsil_eden" id="tahsil_eden" class="form-control form-control-sm" readonly>


                        <div class="col-md-4">
                            <label for="cek_vade_tarihi">Vade Tarihi</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </span>
                                <input type="date" name="cek_vade_tarihi" id="cek_vade_tarihi" class="form-control form-control-sm" value="{{ $ceksenet->cek_vade_tarihi }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="cek_no">Çek No</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-inbox"></i>
                                </span>
                                <input type="text" name="cek_no" id="cek_no" class="form-control form-control-sm" value="{{ $ceksenet->cek_no }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="banka_adi">Banka Adı</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-inbox"></i>
                                </span>
                                <input type="text" name="banka_adi" id="banka_adi" class="form-control form-control-sm" value="{{ $ceksenet->banka_adi }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="sube_adi">Şube Adı</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-inbox"></i>
                                </span>
                                <input type="text" name="sube_adi" id="sube_adi" class="form-control form-control-sm" value="{{ $ceksenet->sube_adi }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="tutar">Çek Tutarı</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-money-bill"></i>
                                </span>
                                <input type="text" name="odeme_tutar" id="odeme_tutar" class="form-control form-control-sm" value="{{ $ceksenet->tutar }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="hesap_no">Hesap No</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa-solid fa-inbox"></i>
                                </span>
                                <input type="text" name="hesap_no" id="hesap_no" class="form-control form-control-sm" value="{{ $ceksenet->hesap_no }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="odeme_tipi">Ödeme Yöntemi</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa fa-user"></i>
                                </span>
                            <select name="odeme_tipi" id="odeme_tipi" class="form-select form-select-sm" required >
                                <option value="">Lütfen Seçim Yapınız</option>
                                {{-- <option value="Kasa">Kasa</option> --}}
                                <option value="Banka">Banka</option>
                            </select>
                        </div>

                        </div>

                        <div class="col-md-4">
                            <label id="kasa_banka_label"></label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa fa-user"></i>
                                </span>
                                {{-- <select name="kasa_id" id="kasa_id" class="form-select form-select-sm" style="display: none;">
                                    <option value="">Lütfen Seçim Yapınız</option>
                                    @foreach ($kasalar as $item)
                                    <option value="{{ $item->id }}">{{ $item->kasa_adi }}</option>
                                    @endforeach
                                </select> --}}
                                <select name="banka_id" id="banka_id" class="form-select form-select-sm" style="display: none;">
                                    <option value="">Lütfen Seçim Yapınız</option>
                                    @foreach ($bankalar as $banka)
                                    <option value="{{ $banka->id }}">{{ $banka->banka_adi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="aciklama">Çek Açıklaması</label>
                            <textarea name="aciklama" id="aciklama" cols="20" rows="2" class="form-control form-control-sm" readonly style="background-color: #f7f7f7;">{{ $ceksenet->aciklama }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-1 mr-15" style="padding-right: 28px">
                        <button type="submit" id="submit-form" class="btn btn-sm btn-outline-primary"
                            style="float: right; margin-left: 2px;">
                            Ödemeyi Kaydet</button>
                        <a href="{{ route('ceksenet.index') }}" class="btn btn-sm btn-outline-secondary"
                            style="float: right"> Vazgeç</a>
                    </div>
                </div>

            </form>


        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const odemeTipiSelect = document.getElementById("odeme_tipi");
        const kasaBankaLabel = document.getElementById("kasa_banka_label");
        const kasaSelect = document.getElementById("kasa_id");
        const bankaSelect = document.getElementById("banka_id");

        function handleOdemeTipiChange() {
            const odemeTipi = odemeTipiSelect.value;

            if (odemeTipi === "Banka") {
                kasaBankaLabel.textContent = "Bankalar";
                bankaSelect.style.display = "block";
                kasaSelect.style.display = "none";
            } else if (odemeTipi === "Kasa") {
                kasaBankaLabel.textContent = "Kasalar";
                kasaSelect.style.display = "block";
                bankaSelect.style.display = "none";
            } else {
                kasaBankaLabel.textContent = "";
                kasaSelect.style.display = "none";
                bankaSelect.style.display = "none";
            }
        }

        odemeTipiSelect.addEventListener("change", handleOdemeTipiChange);
    });
</script>


@endsection
