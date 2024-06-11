
<div class="dataTable-bottom">
    <div class="dataTable-info">Showing {{ $entries->firstItem() }} to {{ $entries->lastItem() }} of {{ $entries->total() }} entries</div>
    <nav class="dataTable-pagination">
        <ul class="dataTable-pagination-list">
            @if ($entries->onFirstPage())
                <li class="pager disabled"><a>‹</a></li>
            @else
                <li class="pager"><a href="{{ $entries->previousPageUrl() }}" data-page="{{ $entries->currentPage() - 1 }}">‹</a></li>
            @endif

            @foreach ($entries->getUrlRange(1, $entries->lastPage()) as $page => $url)
                @if ($page == $entries->currentPage())
                    <li class="active"><a>{{ $page }}</a></li>
                @else
                    <li class=""><a href="{{ $url }}" data-page="{{ $page }}">{{ $page }}</a></li>
                @endif
            @endforeach

            @if ($entries->hasMorePages())
                <li class="pager"><a href="{{ $entries->nextPageUrl() }}" data-page="{{ $entries->currentPage() + 1 }}">›</a></li>
            @else
                <li class="pager disabled"><a>›</a></li>
            @endif
        </ul>
    </nav>
</div>
