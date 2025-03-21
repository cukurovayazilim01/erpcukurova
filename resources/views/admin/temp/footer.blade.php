
       <!--start overlay-->
       <div class="overlay nav-toggle-icon"></div>
       <!--end overlay-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

         <!--start switcher-->
       <div class="switcher-body">
        <button class="btn btn-primary btn-switcher shadow-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-paint-bucket me-0"></i></button>
        <div class="offcanvas offcanvas-end shadow border-start-0 p-2" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling">
          <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Theme Customizer</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
          </div>
          <div class="offcanvas-body">
            <h6 class="mb-0">Theme Variation</h6>
            <hr>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="LightTheme" value="option1">
              <label class="form-check-label" for="LightTheme">Light</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="DarkTheme" value="option2">
              <label class="form-check-label" for="DarkTheme">Dark</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="SemiDarkTheme" value="option3">
              <label class="form-check-label" for="SemiDarkTheme">Semi Dark</label>
            </div>
            <hr>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="MinimalTheme" value="option3" checked>
              <label class="form-check-label" for="MinimalTheme">Minimal Theme</label>
            </div>
            <hr/>
            <h6 class="mb-0">Header Colors</h6>
            <hr/>
            <div class="header-colors-indigators">
              <div class="row row-cols-auto g-3">
                <div class="col">
                  <div class="indigator headercolor1" id="headercolor1"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor2" id="headercolor2"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor3" id="headercolor3"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor4" id="headercolor4"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor5" id="headercolor5"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor6" id="headercolor6"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor7" id="headercolor7"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor8" id="headercolor8"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
       </div>
       <!--end switcher-->

  </div>
  <!--end wrapper-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $(document).ready(function() {
        toastr.options = {
            closeButton: true, // Kapatma butonu ekle
            progressBar: true, // İlerleme çubuğu ekle
            positionClass: "toast-top-right", // Sağ üst köşede göster
            timeOut: "5000", // 5 saniye sonra kaybolur
            newestOnTop: true, // Yeni bildirimler en üstte çıksın
            preventDuplicates: true, // Aynı bildirimi tekrar gösterme
        };

        @if(session('success'))
            toastr.success("{{ session('success') }}", "Bilgilendirme");
        @endif

        @if(session('warning'))
            toastr.warning("{{ session('warning') }}", "Dikkat!");
        @endif

        @if(session('error'))
            toastr.error("{{ session('error') }}", "Hata!");
        @endif
    });
</script>

  <!-- Bootstrap bundle JS -->
  <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
  <!--plugins-->
  <script src="{{asset('assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
  <script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
  <script src="{{asset('assets/js/pace.min.js')}}"></script>
  <script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
	<script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
  <script src="{{asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/plugins/chartjs/chart.min.js')}}"></script>
  <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
  <script src="{{asset('assets/js/form-select2.js')}}"></script>

  <!--app-->
  <script src="{{asset('assets/js/app.js')}}"></script>
  <script src="{{asset('assets/js/index.js')}}"></script>

  <script>
     new PerfectScrollbar(".best-product")
     new PerfectScrollbar(".top-sellers-list")
  </script>
<script src="{{asset('custom/customjs/required.js')}}"></script>

<script src="{{asset('custom/customjs/label.js')}}"></script>
<script src="{{asset('custom/customjs/print.js')}}"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- DataTables Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<!-- JSZip (Excel için) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- PDFMake (PDF için) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Tüm inputları seç ve her birine aynı işlemleri uygula
        document.querySelectorAll('.input-mask').forEach(function (input) {
            input.addEventListener('input', function (event) {
                let inputValue = event.target.value;

                // Virgülü noktaya çevir
                inputValue = inputValue.replace(/,/g, '.');

                // İlk noktadan sonrasındaki noktaları kaldır
                let parts = inputValue.split('.');
                if (parts.length > 2) {
                    inputValue = parts[0] + '.' + parts.slice(1).join('');
                }

                // Sadece sayılar ve noktayı kabul et
                inputValue = inputValue.replace(/[^0-9.]/g, '');

                // Güncellenmiş değeri geri yaz
                event.target.value = inputValue;
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('input[type="number"].no-zero').forEach(function (input) {
        input.addEventListener('input', function (event) {
            let inputValue = event.target.value;

            // Eğer giriş değeri "0" ile başlıyorsa, girişe izin verme
            if (inputValue.startsWith("0")) {
                event.target.value = inputValue.replace(/^0+/, '');
            }
        });
    });
});

</script>
<script>
    function validateRequiredFields() {
        var requiredFields = document.querySelectorAll('[required]');
        var isValid = true;

        requiredFields.forEach(function(field) {
            if (field.value.trim() === '') {
                isValid = false;
                field.style.borderColor = 'red';
            }
        });

        return isValid;
    }

    var addRowButton = document.getElementById('submit-form');
    var isButtonDisabled = localStorage.getItem('isButtonDisabled');

    if (isButtonDisabled === 'true') {
        addRowButton.disabled = true;
        addRowButton.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2"><path d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 11.6585 22 11.4878 21.9848 11.3142C21.9142 10.5049 21.586 9.71257 21.0637 9.09034C20.9516 8.95687 20.828 8.83317 20.5806 8.58578L15.4142 3.41944C15.1668 3.17206 15.0431 3.04835 14.9097 2.93631C14.2874 2.414 13.4951 2.08581 12.6858 2.01515C12.5122 2 12.3415 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355Z" stroke="currentColor" stroke-width="1.5"></path><path d="M17 22V21C17 19.1144 17 18.1716 16.4142 17.5858C15.8284 17 14.8856 17 13 17H11C9.11438 17 8.17157 17 7.58579 17.5858C7 18.1716 7 19.1144 7 21V22" stroke="currentColor" stroke-width="1.5"></path><path opacity="0.5" d="M7 8H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path></svg>İşlem devam ediyor...';
    }

    addRowButton.addEventListener('click', function () {
        if (validateRequiredFields()) {
            this.disabled = true;
            this.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2"><path d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 11.6585 22 11.4878 21.9848 11.3142C21.9142 10.5049 21.586 9.71257 21.0637 9.09034C20.9516 8.95687 20.828 8.83317 20.5806 8.58578L15.4142 3.41944C15.1668 3.17206 15.0431 3.04835 14.9097 2.93631C14.2874 2.414 13.4951 2.08581 12.6858 2.01515C12.5122 2 12.3415 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355Z" stroke="currentColor" stroke-width="1.5"></path><path d="M17 22V21C17 19.1144 17 18.1716 16.4142 17.5858C15.8284 17 14.8856 17 13 17H11C9.11438 17 8.17157 17 7.58579 17.5858C7 18.1716 7 19.1144 7 21V22" stroke="currentColor" stroke-width="1.5"></path><path opacity="0.5" d="M7 8H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path></svg>İşlem devam ediyor...';
            document.getElementById('add-form').submit();
            localStorage.setItem('isButtonDisabled', 'true');
        }
    });

    window.addEventListener('beforeunload', function () {
        localStorage.removeItem('isButtonDisabled');
    });
            </script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Sayfa başına gösterilecek giriş sayısı seçim menüsü
                    const entriesForm = document.getElementById("entriesForm");
                    const entriesSelect = entriesForm.querySelector("select[name='entries']");

                    // Seçim değiştirildiğinde form gönderiliyor
                    entriesSelect.addEventListener("change", function() {
                        entriesForm.submit();
                    });
                });
            </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.show_confirm').forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const form = this.closest("form");

                Swal.fire({
                    title: 'Silmek istediğinizden emin misiniz?',
                    text: "Bu işlem geri alınamaz!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Evet, sil!',
                    cancelButtonText: 'Hayır'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tooltip'i başlat
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                trigger: 'hover', // Sadece hover ile tooltip göster
                delay: { show: 0, hide: 0 } // Tooltip'in hemen gösterilip kaybolmasını sağla
            });
        });
    });
</script>


</body>

</html>
