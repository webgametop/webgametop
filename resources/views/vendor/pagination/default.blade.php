@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center align-items-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <div class="main-border-button border-no-active">
                        <a href="#" style="border-color: #666;color: white;background-color: rgba(128, 128, 128);pointer-events: none;">&lsaquo;</a>
                    </div>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page">
                                <div class="main-border-button border-no-active">
                                    <a href="#" style="border-color: #666;color: white;background-color: rgba(128, 128, 128);pointer-events: none;">{{ $page }}</a>
                                </div>
                            </li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <div class="main-border-button border-no-active">
                        <a href="#" style="border-color: #666;color: white;background-color: rgba(128, 128, 128);pointer-events: none;">&rsaquo;</a>
                    </div>
                </li>
            @endif
        </ul>
    </nav>
@endif
