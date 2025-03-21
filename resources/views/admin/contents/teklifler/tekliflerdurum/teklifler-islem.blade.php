{{-- ===============TEKLİF İŞLEM MODALI=============== --}}
<!-- Modal -->
<div class="modal fade" id="teklifislemmodal-{{ $teklifleritem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Teklif İşlemleri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body" style="padding-top: 15px">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card radius-10 shadow-lg border-0 bg-gradient-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <p class="text-wrap" style="color: black">
                                                Teklif Kodu <span
                                                    class="badge bg-light text-primary fw-bold" style="font-size: 18px ">{{ $teklifleritem->teklif_kodu_text }}-{{ $teklifleritem->teklif_kodu }}</span> teklif fiyatı<strong> {{ number_format($teklifleritem->teklif_kdvli_toplam, 2, ',', '.') }} ₺</strong>
                                                olan
                                                <strong>{{ $teklifleritem->firmaadi->firma_unvan }}</strong> firmasının
                                                teklif işlemini seçiniz.
                                            </p>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Footer -->
            <div class="modal-footer bg-light">
                <meta name="csrf-token" content="{{ csrf_token() }}">

                <!-- Butonları URL'ye Göre Dinamik Olarak Göster/Gizle -->
                @if (!request()->is('onaylananteklifler') && !request()->is('onaylanmayanteklifler'))
                    <!-- Onay Butonu -->
                    <button type="button" class="btn btn-outline-success btn-sm"
                        onclick="handleTeklifAction(event, {{ $teklifleritem->id }}, 'onay')">
                        Onayla
                    </button>

                    <!-- Red Butonu -->
                    <button type="button" class="btn btn-outline-danger btn-sm"
                        onclick="handleTeklifAction(event, {{ $teklifleritem->id }}, 'red')">
                        Reddet
                    </button>
                @else
                    <!-- İptal Et Butonu -->
                    <button type="button" class="btn btn-outline-warning btn-sm"
                        onclick="handleTeklifAction(event, {{ $teklifleritem->id }}, 'iptal')">
                        İptal Et
                    </button>
                @endif

                <!-- Vazgeç Butonu -->
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Vazgeç</button>

            </div>
        </div>
    </div>
</div>
