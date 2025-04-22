@extends('admin.layouts.app')
@section('title')
    {{ $itiraztakip->marka_adi }} GÜNCELLE
@endsection
@section('contents')
@section('topheader')
    {{ $itiraztakip->marka_adi }} GÜNCELLE
@endsection

<div class="card">
    <div class="card-body">
        <div class="row">

            <form action="{{ route('itiraztakipp.update', ['itiraztakipp' => $itiraztakip->id]) }}" method="POST"
                id="add-form">
                @csrf
                @method('put')
                <div class="col-md-12" style="padding: 1%; ">
                    <div class="row">
                        <div class="col-md-4 select2-sm">
                            <label for="markatakip_id">Başvuru No</label>
                            <input type="text"
                                class="form-control form-control-sm" value="{{ $marka->basvuru_no }}" readonly>
                            <input type="hidden" name="markatakip_id" value="{{ $marka->id }}">

                        </div>

                        <div class="col-md-4">
                            <label for="marka_adi">Marka Adı</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-building"></i>
                                </span>
                                <input type="text" name="marka_adi" id="marka_adi"
                                    class="form-control form-control-sm" readonly required
                                    value="{{ $itiraztakip->marka_adi }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="firma_adi">Firma Adı</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-building"></i>
                                </span>
                                <input type="text" name="firma_adi" id="firma_adi"
                                    class="form-control form-control-sm" readonly required
                                    value="{{ $itiraztakip->firma_adi }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="referans_no">Referans No</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-building"></i>
                                </span>
                                <input type="text" name="referans_no" id="referans_no"
                                    class="form-control form-control-sm" readonly required
                                    value="{{ $itiraztakip->referans_no }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="musteri_temsilcisi">Müşteri Temsilcisi</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-building"></i>
                                </span>
                                <input type="text" name="musteri_temsilcisi" id="musteri_temsilcisi"
                                    class="form-control form-control-sm" readonly required
                                    value="{{ $itiraztakip->musteri_temsilcisi }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="satis_temsilcisi">Satış Temsilcisi</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-building"></i>
                                </span>
                                <input type="text" name="satis_temsilcisi" id="satis_temsilcisi"
                                    class="form-control form-control-sm" readonly required
                                    value="{{ $itiraztakip->satis_temsilcisi }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="teblig_tarihi">Tebliğ Tarihi</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="date" name="teblig_tarihi" id="teblig_tarihi"
                                    class="form-control form-control-sm" required
                                    value="{{ $itiraztakip->teblig_tarihi }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="bakanlik_karari">Bakanlık Kararı</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-building"></i>
                                </span>
                                <select name="bakanlik_karari" id="bakanlik_karari" class="form-control form-control-sm"
                                    required>
                                    <option value="Başvuru Noksan"
                                        {{ $itiraztakip->bakanlik_karari == 'Başvuru Noksan' ? 'selected' : '' }}>
                                        Başvuru Noksan</option>
                                    <option value="Marka Kısmi Red Kararı"
                                        {{ $itiraztakip->bakanlik_karari == 'Marka Kısmi Red Kararı' ? 'selected' : '' }}>
                                        Marka Kısmi Red Kararı</option>
                                    <option value="Marka Red Kararı"
                                        {{ $itiraztakip->bakanlik_karari == 'Marka Red Kararı' ? 'selected' : '' }}>
                                        Marka Red Kararı</option>
                                    <option value="Yayına İtiraz"
                                        {{ $itiraztakip->bakanlik_karari == 'Yayına İtiraz' ? 'selected' : '' }}>Yayına
                                        İtiraz</option>
                                    <option value="Yayına İkinci İtiraz"
                                        {{ $itiraztakip->bakanlik_karari == 'Yayına İkinci İtiraz' ? 'selected' : '' }}>
                                        Yayına İkinci İtiraz</option>
                                    <option value="Yayına İtirazlar Red"
                                        {{ $itiraztakip->bakanlik_karari == 'Yayına İtirazlar Red' ? 'selected' : '' }}>
                                        Yayına İtirazlar Red</option>
                                    <option value="Yayına İtirazlar Kısmi Kabul"
                                        {{ $itiraztakip->bakanlik_karari == 'Yayına İtirazlar Kısmi Kabul' ? 'selected' : '' }}>
                                        Yayına İtirazlar Kısmi Kabul</option>
                                    <option value="Yayına İtirazlar Kabul-Tam Red"
                                        {{ $itiraztakip->bakanlik_karari == 'Yayına İtirazlar Kabul-Tam Red' ? 'selected' : '' }}>
                                        Yayına İtirazlar Kabul-Tam Red</option>
                                    <option value="Yayıma İtiraz Kabul"
                                        {{ $itiraztakip->bakanlik_karari == 'Yayıma İtiraz Kabul' ? 'selected' : '' }}>
                                        Yayıma İtiraz Kabul</option>
                                    <option value="Yayıma İtiraz Kısmi Kabul"
                                        {{ $itiraztakip->bakanlik_karari == 'Yayıma İtiraz Kısmi Kabul' ? 'selected' : '' }}>
                                        Yayıma İtiraz Kısmi Kabul</option>
                                    <option value="Yayıma İtiraz Red"
                                        {{ $itiraztakip->bakanlik_karari == 'Yayıma İtiraz Red' ? 'selected' : '' }}>
                                        Yayıma İtiraz Red</option>
                                    <option value="Yidk İtiraz Kabul"
                                        {{ $itiraztakip->bakanlik_karari == 'Yidk İtiraz Kabul' ? 'selected' : '' }}>
                                        Yidk İtiraz Kabul</option>
                                    <option value="Yidk İtiraz Kısmi Kabul"
                                        {{ $itiraztakip->bakanlik_karari == 'Yidk İtiraz Kısmi Kabul' ? 'selected' : '' }}>
                                        Yidk İtiraz Kısmi Kabul</option>
                                    <option value="Yidk İtiraz Red"
                                        {{ $itiraztakip->bakanlik_karari == 'Yidk İtiraz Red' ? 'selected' : '' }}>Yidk
                                        İtiraz Red</option>
                                    <option value="İşlemden Kaldırma Yazısı"
                                        {{ $itiraztakip->bakanlik_karari == 'İşlemden Kaldırma Yazısı' ? 'selected' : '' }}>
                                        İşlemden Kaldırma Yazısı</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="itiraz_islem">İşlem Adı</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-building"></i>
                                </span>

                                    <input type="text" id="islem_adi" name="itiraz_islem" class="form-control form-control-sm" value="{{$itiraztakip->itiraz_islem}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="itiraz_durum">İtiraz Durum</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-building"></i>
                                </span>
                                <select name="itiraz_durum" id="itiraz_durum" class="form-control form-control-sm"
                                    required>
                                    <option value="Yapıldı"
                                        {{ $itiraztakip->itiraz_durum == 'Yapıldı' ? 'selected' : '' }}>Yapıldı
                                    </option>
                                    <option value="Beklemede"
                                        {{ $itiraztakip->itiraz_durum == 'Beklemede' ? 'selected' : '' }}>Beklemede
                                    </option>
                                    <option value="Yapılmadı"
                                        {{ $itiraztakip->itiraz_durum == 'Yapılmadı' ? 'selected' : '' }}>Yapılmadı
                                    </option>
                                    <option value="İptal"
                                        {{ $itiraztakip->itiraz_durum == 'İptal' ? 'selected' : '' }}>İptal</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="teblig_bitis_tarihi">Tebliğ Bitiş Tarihi</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="date" name="teblig_bitis_tarihi" id="teblig_bitis_tarihi"
                                    class="form-control form-control-sm"
                                    required  value="{{ $itiraztakip->teblig_bitis_tarihi }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="ucret">Ücret</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-money-bill"></i>
                                </span>
                                <input type="number" name="ucret" id="ucret"
                                    class="form-control form-control-sm" required value="{{ $itiraztakip->ucret }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="itiraz_dosya">İtiraz Dosya</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-check"></i>
                                </span>
                                <input type="file" name="itiraz_dosya" id="itiraz_dosya"
                                    class="form-control form-control-sm">
                                <!-- Eğer dosya görüntüleme gerekiyorsa -->
                                @if ($itiraztakip->itiraz_dosya)
                                    <small><a href="{{ asset($itiraztakip->itiraz_dosya) }}"
                                            target="_blank">{{ $itiraztakip->itiraz_dosya }}</a></small>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="itiraz_aciklama">İtiraz Açıklama</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fa-solid fa-comments"></i></span>
                            <textarea name="itiraz_aciklama" id="itiraz_aciklama" cols="20" rows="2"
                                class="form-control form-control-sm">{{ $itiraztakip->itiraz_aciklama }}</textarea>
                        </div>
                    </div>
                    <div style="display: flex; padding: 10px; gap:20px; text-align: center; justify-content: end">

                        <a href="{{route('itiraztakipp.index')}}" class="btn btn-outline-warning btn-sm py-6 w-25"> Vazgeç</a>
                            <button type="submit" id="submit-form" class="btn btn-outline-dark btn-sm py-6 w-75"
                               >
                                Güncelle</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('bakanlik_karari').addEventListener('change', function() {
        const selectedValue = this.value;
        const islemAdiInput = document.getElementById('islem_adi');

        // İşlem adı eşleştirmeleri
        const islemAdlari = {
            'Başvuru Noksan': 'Noksan Tamamlama',
            'Marka Kısmi Red Kararı': 'Kısmi Red Kararına İtiraz',
            'Marka Red Kararı': 'Red Kararına İtiraz',
            'Yayına İtiraz': 'Görüş Dosyası',
            'Yayına İkinci İtiraz': 'UİDD Görüş Bildirme',
            'Yayına İtirazlar Red': 'İşlem Yapılmaz',
            'Yayına İtirazlar Kısmi Kabul': 'Karara İtiraz',
            'Yayına İtirazlar Kabul-Tam Red': 'Karara İtiraz',
            'Yayıma İtiraz Kabul': 'Karara İtiraz',
            'Yayıma İtiraz Kısmi Kabul': 'Karara İtiraz',
            'Yayıma İtiraz Red': 'Karara İtiraz',
            'Yidk İtiraz Kabul': 'Nihai Karar',
            'Yidk İtiraz Kısmi Kabul': 'Nihai Karar',
            'Yidk İtiraz Red': 'Nihai Karar',
            'İşlemden Kaldırma Yazısı': 'Karşılığı Yok'
        };

        // Seçim değerine göre işlem adını belirle
        islemAdiInput.value = islemAdlari[selectedValue] || ''; // Eşleşme yoksa boş bırak
    });
</script>
<script>
    document.getElementById('bakanlik_karari').addEventListener('change', function () {
    const selectedOption = this.value;
    const tebligTarihiInput = document.getElementById('teblig_tarihi');
    const tebligBitisTarihiInput = document.getElementById('teblig_bitis_tarihi');

    // Tebliğ tarihi boşsa işlem yapılmasın
    if (!tebligTarihiInput.value) {
        tebligBitisTarihiInput.value = '';
        return;
    }

    const tebligTarihi = new Date(tebligTarihiInput.value);

    // İşlem türlerine göre gün ekleme kuralları
    const gunEklemeKurallari = {
        'Başvuru Noksan': 60,
        'Marka Kısmi Red Kararı': 60,
        'Marka Red Kararı': 60,
        'Yayına İtirazlar Red': 60,
        'Yayına İtirazlar Kısmi Kabul': 60,
        'Yayına İtirazlar Kabul-Tam Red': 60,
        'Yayıma İtiraz Kabul': 60,
        'Yayıma İtiraz Kısmi Kabul': 60,
        'Yayıma İtiraz Red': 60,
        'Yayına İtiraz': 30,
        'Yayına İkinci İtiraz': 30,
        'Yidk Nihai Karar': 1,
    };

    // Seçilen opsiyon için gün ekleme değerini al
    const gunEkle = gunEklemeKurallari[selectedOption];

    if (gunEkle !== undefined) {
        // Tebliğ tarihine gün ekle
        const tebligBitisTarihi = new Date(tebligTarihi);
        tebligBitisTarihi.setDate(tebligBitisTarihi.getDate() + gunEkle);

        // YYYY-MM-DD formatında tarihi alıp inputa yaz
        const formattedDate = tebligBitisTarihi.toISOString().split('T')[0];
        tebligBitisTarihiInput.value = formattedDate;
    } else {
        // Belirtilen bir işlem yoksa bitiş tarihini temizle
        tebligBitisTarihiInput.value = '';
    }
});

</script>
@include('session.session')
@endsection
