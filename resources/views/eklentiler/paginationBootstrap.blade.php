<style>
    .sticky-pagination {
    margin-top: 10px;
    position: sticky;
    background: #dee2e6;
    bottom: 0;
    padding: 15px 20px;
    border-top: 1px solid #dee2e6;
    z-index: 100;
    border-radius: 0 0 0.5rem 0.5rem;
    height: 40px;
}

.sticky-pagination .pagination .page-item .page-link {
    border: none;
    margin-top: 15px;
    color: #495057;
    font-weight: 350;
    background-color: #ffffff;
    transition: all 0.2s ease-in-out;
    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
}

.sticky-pagination .pagination .page-item.active .page-link {
    background-color: #999c9f;
    color: #ffffff;
    font-weight: 350;

}

.sticky-pagination .pagination .page-item .page-link:hover {
    background-color: #e2e6ea;
    color: #212529;

}

.sticky-pagination .text-muted {
    font-size: 0.7rem; /* Küçük font */
}
</style>
@if ($paginator->hasPages())
    <div class="d-flex justify-content-between align-items-center sticky-pagination">
        {{-- Kayıt Bilgisi --}}
        <div class="text-muted small">
            Toplam <strong>{{ $paginator->total() }}</strong> kayıttan
            <strong>{{ $paginator->firstItem() }}</strong> - <strong>{{ $paginator->lastItem() }}</strong> arası gösteriliyor
        </div>

        {{-- Sayfalama --}}
        <nav style="font-size: 0.7rem;">
            <ul class="pagination justify-content-end">
                {{-- Geri Butonu --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">Önceki</span></li>
                @else
                    <li class="page-item">
                        <a wire:click="previousPage" class="page-link" href="javascript:void(0)" rel="prev">Önceki</a>
                    </li>
                @endif

                {{-- Sayfa Numaraları --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" wire:key="page-{{ $page }}">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item" wire:key="page-{{ $page }}">
                                    <a class="page-link" wire:click="gotoPage({{ $page }})" href="javascript:void(0)">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- İleri Butonu --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a wire:click="nextPage" class="page-link" href="javascript:void(0)" rel="next">Sonraki</a>
                    </li>
                @else
                    <li class="page-item disabled"><span class="page-link">Sonraki</span></li>
                @endif
            </ul>
        </nav>
    </div>
@endif
