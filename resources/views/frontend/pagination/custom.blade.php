  <div class="pagination">
        <div class="pagination-area">
            <div class="pagination-list">
                @if ($paginator->hasPages())
                <ul class="list-inline">
                    @if ($paginator->onFirstPage())
                    <li><a href="#"><i class="las la-arrow-left"></i></a></li>
                    @else
                    <li><a href="{{ $paginator->previousPageUrl() }}"><i class="las la-arrow-left"></i></a></li>
                    @endif
                    @foreach ($elements as $element)
                    @if (is_string($element))
                        <li><a href="#" class="disabled">{{ $element }}</a></li>
                    @endif
                    @if (is_array($element))
                     @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                    <li><a href="#" class="active my-active">{{ $page }}</a></li>
                    @else
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                    @endforeach
                @endif
            @endforeach
                    
                    {{-- <li><a href="#">4</a></li> --}}
                    @if ($paginator->hasMorePages())
                    <li><a href="{{ $paginator->nextPageUrl() }}"><i class="las la-arrow-right"></i></a></li>
                    @else
                    <li class="disabled"><a href="#"><i class="las la-arrow-right"></i></a></li>
                    @endif
                </ul>
                @endif 
            </div>
        </div>
    </div>
