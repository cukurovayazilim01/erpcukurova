   <!-- Modal -->
   <div class="modal fade" id="perseonelegitimModal-{{ $personelitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="add-form" action="{{ route('personelegitimPOST', ['id' => $personelitem->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">{{ $personelitem->ad_soyad }} Personel Eğitim Ekleme Ekranı</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body d-flex flex-column" style="padding: 2%;">
                 <!-- Form Alanı -->
                 <div class="row mb-3">
                     <div class="col-md-4">
                         <label for="egitim_yili">Eğitim Tarihi</label>
                         <div class="form-group input-with-icon">
                             <span class="icon"><i class="fa-solid fa-layer-group"></i></span>
                             <input type="date" name="egitim_yili" id="egitim_yili" class="form-control form-control-sm" required>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <label for="egitim_adi">Eğitim Adı</label>
                         <div class="form-group input-with-icon">
                             <span class="icon"><i class="fa-solid fa-layer-group"></i></span>
                             <input type="text" name="egitim_adi" id="egitim_adi" class="form-control form-control-sm" required>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <label for="egitim_suresi">Eğitim Süresi</label>
                         <div class="form-group input-with-icon">
                             <span class="icon"><i class="fa-solid fa-layer-group"></i></span>
                             <input type="text" name="egitim_suresi" id="egitim_suresi" class="form-control form-control-sm" required>
                         </div>
                     </div>
                     <div class="col-md-4">
                        <label for="egitim_yeri">Eğitim Yeri</label>
                        <div class="form-group input-with-icon">
                            <span class="icon"><i class="fa-solid fa-layer-group"></i></span>
                            <input type="text" name="egitim_yeri" id="egitim_yeri" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="egitim_dosya">Eğitim Dosyası</label>
                        <div class="form-group input-with-icon">
                            <span class="icon"><i class="fa-solid fa-layer-group"></i></span>
                            <input type="file" name="egitim_dosya" id="egitim_dosya" class="form-control form-control-sm" required>
                        </div>
                    </div>
                     <div class="col-md-12 mt-2">
                         <label for="egitim_sonucu">Eğitim İçeriği</label>
                         <textarea name="egitim_sonucu" id="egitim_sonucu" cols="20" rows="2" class="form-control form-control-sm"></textarea>
                     </div>
                 </div>

                 <!-- Tablo Alanı -->
                 <div class="table-responsive">
                     <table class="table align-middle mb-0" id="example2">
                         <thead class="table-light">
                             <tr>
                                 <th>#</th>
                                 <th>Eğitim Tarihi</th>
                                 <th>Eğitim Adı</th>
                                 <th>Eğitim Süresi</th>
                                 <th>Eğitim Yeri</th>
                                 <th>Eğitim İçeriği</th>
                                 <th>Eğitim Dokümanı</th>
                                 <th>Sil</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($personelegitim->where('personel_id',$personelitem->id) as $sn => $personelegitimitem)
                                 <tr>
                                     <th scope="row">{{ $sn + 1 }}</th>
                                     <td>{{ $personelegitimitem->egitim_yili }}</td>
                                     <td>{{ $personelegitimitem->egitim_adi }}</td>
                                     <td>{{ $personelegitimitem->egitim_suresi }}</td>
                                     <td>{{ $personelegitimitem->egitim_yeri }}</td>
                                     <td>{{ $personelegitimitem->egitim_sonucu }}</td>
                                     <td>
                                         @if ($personelegitimitem->egitim_dosya)
                                         @php
                                             $fileExtension = pathinfo($personelegitimitem->egitim_dosya, PATHINFO_EXTENSION);
                                         @endphp

                                         @if (strtolower($fileExtension) === 'pdf')
                                             <a href="{{ asset($personelegitimitem->egitim_dosya) }}" target="_blank" style="color: red">
                                                 <i class="bi bi-file-earmark-pdf" style="color: red;"></i> Görüntüle
                                             </a>
                                         @else
                                             <a href="{{ asset($personelegitimitem->egitim_dosya) }}" target="_blank">
                                                 <i class="bi bi-image"></i> Görüntüle
                                             </a>
                                         @endif
                                     @else
                                         <span class="text-muted">Resim Yok</span>
                                     @endif
                                     </td>
                                         <td>
                                             <button type="button" class="btn btn-link text-danger p-0 m-0 delete-document"
                                                 data-id="{{ $personelegitimitem->id }}">
                                                 <i class="bi bi-trash-fill"></i>
                                             </button>
                                         </td>

                                         <script>
                                         document.addEventListener("DOMContentLoaded", function() {
                                             document.querySelectorAll(".delete-document").forEach(button => {
                                                 button.addEventListener("click", function() {
                                                     let documentId = this.getAttribute("data-id");
                                                     if (confirm("Bu dokümanı silmek istediğinize emin misiniz?")) {
                                                         fetch("{{ route('personelegitimDELETE', ['id' => '__ID__']) }}".replace('__ID__', documentId), {
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
             </div>

                <!-- Modal Footer -->
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-sm btn-outline-secondary"
                        data-bs-dismiss="modal">Vazgeç</button>
                    <button type="submit" id="submit-form" class="btn btn-outline-primary btn-sm ">Kaydet</button>
                </div>
            </div>
        </form>
    </div>
</div>
