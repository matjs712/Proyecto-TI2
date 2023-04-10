<nav style="background-color: white !important;">
    <ul class="pagination d-flex justify-content-center" style="background-color: white;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled page-item"><span class="page-link">
                {{-- @lang('pagination.previous') --}}
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </span></li>
        @else
            <li class="page-item">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link">
                    {{-- @lang('pagination.previous') --}}
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <li class="{{ ($paginator->currentPage() == $i) ? ' active page-item' : 'page-item' }}">
            <a href="{{ $paginator->url($i) }}" class="page-link">{{ $i }}</a>
        </li>
        @endfor


        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-link">
                    {{-- @lang('pagination.next') --}}
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </a>
            </li>
        @else
            <li class="disabled page-item">
                <span class="page-link">
                    {{-- @lang('pagination.next') --}}
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </span>
            </li>
        @endif
    </ul>
</nav>
