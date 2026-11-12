@if ($paginator->hasPages())
<div class="pagination left">
    <ul class="pagination-list">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
        <li><a href="{{ $paginator->previousPageUrl() }}"><i class="lni lni-chevron-left"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="active"><a href="javascript:void(0)">{{ $page }}</a></li>
        @else
        <li><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}"><i class="lni lni-chevron-right"></i></a></li>
        @endif
    </ul>
</div>
@endif