       <!-- Güncelleme Modal -->
                                        <!-- Modal -->
                                        <div class="modal fade" id="resmievraklarupdateModal-{{ $resmievraklaritem->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog ">
                                                <form action="{{ route('resmievraklarr.update', $resmievraklaritem->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title">
                                                                {{$resmievraklaritem->dokuman_adi}} {{$resmievraklaritem->dokuman_yili}}
                                                                EVRAK
                                                                GÜNCELLE</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <!-- Modal Body -->
                                                        <div class="modal-body" style="display: flex">
                                                            <!-- Left Side -->
                                                            <div class="col-md-12" style="padding: 3%;">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="dokuman_adi">Doküman Adı</label>
                                                                        <div class="form-group input-with-icon">
                                                                            <span class="icon">
                                                                                <i class="fa-solid fa-layer-group"></i>
                                                                            </span>
                                                                            <input type="text" name="dokuman_adi"
                                                                                id="dokuman_adi"
                                                                                class="form-control form-control-sm"
                                                                                required
                                                                                value="{{ $resmievraklaritem->dokuman_adi }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="dokuman_yili">Doküman Yılı</label>
                                                                        <div class="form-group input-with-icon">
                                                                            <span class="icon">
                                                                                <i class="fa-solid fa-check"></i>
                                                                            </span>
                                                                            <select name="dokuman_yili"
                                                                                id="dokuman_yili"
                                                                                class="form-select form-select-sm">
                                                                                @for ($year = 2023; $year <= 2030; $year++)
                                                                                    <option
                                                                                        value="{{ $year }}"
                                                                                        {{ $resmievraklaritem->dokuman_yili == $year ? 'selected' : '' }}>
                                                                                        {{ $year }}
                                                                                    </option>
                                                                                @endfor
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="dokuman_yolu">Doküman</label>
                                                                        @if ($resmievraklaritem->dokuman_yolu)
                                                                        <a href="{{ asset($resmievraklaritem->dokuman_yolu) }}" target="_blank" class="text-decoration-none">
                                                                            Görüntüle
                                                                        </a>
                                                                        @endif
                                                                        <div class="form-group input-with-icon">
                                                                            <span class="icon">
                                                                                <i class="fa-solid fa-layer-group"></i>
                                                                            </span>

                                                                            <!-- Mevcut dokümanı gösterme -->

                                                                            <!-- Dosya yükleme inputu -->
                                                                            <input type="file" name="dokuman_yolu" id="dokuman_yolu" class="form-control form-control-sm">
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="dokuman_alim_tarihi">Evrak Alım Tarihi</label>
                                                                        <div class="form-group input-with-icon">
                                                                            <span class="icon">
                                                                                <i class="fa-solid fa-layer-group"></i>
                                                                            </span>
                                                                            <input type="date" name="dokuman_alim_tarihi" id="dokuman_alim_tarihi"
                                                                                class="form-control form-control-sm" value="{{$resmievraklaritem->dokuman_alim_tarihi}}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="dokuman_hatirlatma_tarihi">Evrak Hatırlatma Tarihi</label>
                                                                        <div class="form-group input-with-icon">
                                                                            <span class="icon">
                                                                                <i class="fa-solid fa-layer-group"></i>
                                                                            </span>
                                                                            <input type="date" name="dokuman_hatirlatma_tarihi" value="{{$resmievraklaritem->dokuman_hatirlatma_tarihi}}"
                                                                                id="dokuman_hatirlatma_tarihi" class="form-control form-control-sm"
                                                                                required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="status">Durum</label>
                                                                        <div class="form-group input-with-icon">
                                                                            <span class="icon">
                                                                                <i class="fa-solid fa-check"></i>
                                                                            </span>
                                                                            <select name="status" id="status" class="form-select form-select-sm">
                                                                                <option value="Aktif" {{ $resmievraklaritem->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                                                                <option value="Pasif" {{ $resmievraklaritem->status == 'Pasif' ? 'selected' : '' }}>Pasif</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <label for="aciklama">Doküman Açıklama</label>
                                                                        <textarea name="aciklama" id="aciklama" cols="20" rows="2" class="form-control form-control-sm ">{{$resmievraklaritem->aciklama}}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal Footer -->
                                                        <div class="modal-footer bg-light">
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-secondary"
                                                                data-bs-dismiss="modal">Vazgeç</button>
                                                            <button type="submit"
                                                                class="btn btn-outline-success btn-sm">Güncelle</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
