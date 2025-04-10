   <!-- Modal -->
   <div class="modal fade" id="perseoneldokumanModal-{{ $personelitem->id }}" tabindex="-1" aria-hidden="true">
       <div class="modal-dialog modal-xl">
           <form id="add-form" action="{{ route('personeldokumanpost', ['id' => $personelitem->id]) }}" method="POST"
               enctype="multipart/form-data">
               @csrf
               <div class="modal-content">
                   <!-- Modal Header -->
                   <div class="modal-header ">
                       <h5 class="modal-title">{{ $personelitem->ad_soyad }} Personel Doküman Ekleme Ekranı</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>

                   <!-- Modal Body -->
                   <div class="modal-body d-flex flex-column" style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">
                    <!-- Form Alanı -->
                    <div class="row ">
                        <div class="col-md-4">
                            <label for="dokuman_donem">Doküman Yılı</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fa-solid fa-layer-group"></i></span>
                                <input type="date" name="dokuman_donem" id="dokuman_donem" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="dokuman_adi">Doküman Adı</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fa-solid fa-layer-group"></i></span>
                                <input type="text" name="dokuman_adi" id="dokuman_adi" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="dokuman_yolu">Doküman</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fa-solid fa-layer-group"></i></span>
                                <input type="file" name="dokuman_yolu" id="dokuman_yolu" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="aciklama">Açıklama</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fa-solid fa-comments"></i></span>
                            <textarea name="aciklama" id="aciklama" cols="20" rows="2" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>
                    </div>

                    <!-- Tablo Alanı -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="example2">
                            <thead >
                                <tr>
                                    <th>#</th>
                                    <th>Doküman Tarihi</th>
                                    <th>Doküman Adı</th>
                                    <th>Doküman</th>
                                    <th>Sil</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($personeldokuman->where('personel_id',$personelitem->id) as $sn => $personeldokumanitem)
                                    <tr>
                                        <th scope="row">{{ $sn + 1 }}</th>
                                        <td>{{ $personeldokumanitem->dokuman_donem }}</td>
                                        <td>{{ $personeldokumanitem->dokuman_adi }}</td>
                                        <td>
                                            @if ($personeldokumanitem->dokuman_yolu)
                                            @php
                                                $fileExtension = pathinfo($personeldokumanitem->dokuman_yolu, PATHINFO_EXTENSION);
                                            @endphp

                                            @if (strtolower($fileExtension) === 'pdf')
                                                <a href="{{ asset($personeldokumanitem->dokuman_yolu) }}" target="_blank" style="color: red">
                                                    <i class="bi bi-file-earmark-pdf" style="color: red;"></i> Görüntüle
                                                </a>
                                            @else
                                                <a href="{{ asset($personeldokumanitem->dokuman_yolu) }}" target="_blank">
                                                    <i class="bi bi-image"></i> Görüntüle
                                                </a>
                                            @endif
                                        @else
                                            <span class="text-muted">Resim Yok</span>
                                        @endif
                                        </td>
                                            <td>
                                                <button type="button" class="btn btn-link text-danger p-0 m-0 delete-document"
                                                    data-id="{{ $personeldokumanitem->id }}">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </td>

                                            <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                document.querySelectorAll(".delete-document").forEach(button => {
                                                    button.addEventListener("click", function() {
                                                        let documentId = this.getAttribute("data-id");
                                                        if (confirm("Bu dokümanı silmek istediğinize emin misiniz?")) {
                                                            fetch("{{ route('personeldokumandelete', ['id' => '__ID__']) }}".replace('__ID__', documentId), {
                                                                method: "POST",
                                                                headers: {
                                                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                                                    "Content-Type": "application/json"
                                                                },
                                                                body: JSON.stringify({ _method: "DELETE" })
                                                            })
                                                            .then(response => response.json())
                                                            .then(data => {
                                                                if (data.success) {
                                                                    alert("Doküman başarıyla silindi.");
                                                                    location.reload(); // Sayfayı yenile
                                                                } else {
                                                                    alert("Silme işlemi başarısız.");
                                                                }
                                                            })
                                                            .catch(error => console.error("Hata:", error));
                                                        }
                                                    });
                                                });
                                            });
                                            </script>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                     <!-- Modal Footer -->
                   <div class="mobile-footer"
                   style="display: flex;  gap:20px; text-align: center; justify-content: end; ">
                    <button type="button" class="btn btn-outline-warning btn-sm py-6 w-25" data-bs-dismiss="modal">Vazgeç</button>
                    <button type="submit" class="btn btn-outline-dark btn-sm py-6 w-75">Kaydet</button>
                   </div>
                </div>


               </div>
           </form>
       </div>
   </div>
