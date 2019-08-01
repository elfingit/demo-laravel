@if ($paginator->lastPage() > 1)

    <div class="pagination-container">
        <div class="pagination">
            @if($paginator->currentPage() != 1)
                <a href="{{ $paginator->url(1) }}">&lt;</a>
            @else
                &lt;
            @endif
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <span class="{{ ($paginator->currentPage() == $i) ? 'active' : '' }}">
                    <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </span>
            @endfor
            @if($paginator->currentPage() != $paginator->lastPage())
                <a href="{{ $paginator->url($paginator->currentPage()+1) }}" >&gt;</a>
            @else
                    &gt;
            @endif
        </div>
    </div>
@endif
