@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-dark mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">
                        <i class="material-symbols-rounded text-sm">chevron_left</i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">
                        <i class="material-symbols-rounded text-sm">chevron_left</i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">
                        <i class="material-symbols-rounded text-sm">chevron_right</i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">
                        <i class="material-symbols-rounded text-sm">chevron_right</i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>

    <style>
        .pagination-dark {
            display: flex;
            gap: 4px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .pagination-dark .page-item .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            font-size: 0.875rem;
            font-weight: 500;
            color: #344767;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
        }

        .pagination-dark .page-item .page-link:hover {
            background: linear-gradient(195deg, #42424a 0%, #191919 100%);
            color: #fff;
            border-color: transparent;
        }

        .pagination-dark .page-item.active .page-link {
            background: linear-gradient(195deg, #42424a 0%, #191919 100%);
            color: #fff;
            border-color: transparent;
            box-shadow: 0 3px 5px -1px rgba(0, 0, 0, 0.09), 0 2px 3px -1px rgba(0, 0, 0, 0.07);
        }

        .pagination-dark .page-item.disabled .page-link {
            color: #adb5bd;
            background-color: #f8f9fa;
            border-color: #dee2e6;
            cursor: not-allowed;
            opacity: 0.65;
        }

        .pagination-dark .page-item .page-link i {
            font-size: 1rem;
        }
    </style>
@endif