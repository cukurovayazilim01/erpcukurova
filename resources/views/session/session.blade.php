{{-- <style>
    .swal2-custom-popup {
    max-width: 400px;
    border-radius: 10px;
    background: #f9f9f9; /* Hafif gri arka plan */
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
}

.swal2-custom-title {
    color: #333; /* Koyu başlık rengi */
    font-size: 1.5rem;
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
}

.swal2-custom-content {
    color: orange; /* Turuncu renk */
    font-size: 1rem;
    text-align: center;
    text-transform: uppercase;
}

</style>
<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Bilgilendirme',
            text: "{{ session('success') }}",
            confirmButtonText: 'Tamam',
            customClass: {
                popup: 'swal2-custom-popup',
                title: 'swal2-custom-title',
                content: 'swal2-custom-content'
            }
        });
    });
</script>
@endif

@if(session('warning'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'warning',
            title: 'Dikkat!',
            text: "{{ session('warning') }}",
            confirmButtonText: 'Tamam',
            customClass: {
                popup: 'swal2-custom-popup',
                title: 'swal2-custom-title',
                content: 'swal2-custom-content'
            }
        });
    });
</script>
@endif

@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Hata!',
            text: "{{ session('error') }}",
            confirmButtonText: 'Tamam',
            customClass: {
                popup: 'swal2-custom-popup',
                title: 'swal2-custom-title',
                content: 'swal2-custom-content'
            }
        });
    });
</script>
@endif --}}



