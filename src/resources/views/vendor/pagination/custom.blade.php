@if ($paginator->hasPages())
  <ul class="paginate-links-menu py-3">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <li class="" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <a href="#" class="btn-lighten">
              <i class="fa fa-angle-left"></i>
            </a>
        </li>
    @else
        <li class="">
            <a class="btn-lighten" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
              <i class="fa fa-angle-left"></i>
            </a>
        </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="" aria-disabled="true">
              <a href="#" class="btn-lighten">{{ $element }}</a>
            </li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="" aria-current="page">
                      <a href="#" class="btn-lighten current">{{ $page }}</a>
                    </li>
                @else
                    <li class="">
                      <a href="{{ $url }}" class="btn-lighten">{{ $page }}</a>
                    </li>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <li class="">
          <a href="{{ $paginator->nextPageUrl() }}" class="btn-lighten" rel="next" aria-label="@lang('pagination.next')">
            <i class="fa fa-angle-right"></i>
          </a>
        </li>
    @else
        <li class="" aria-disabled="true" aria-label="@lang('pagination.next')">
          <a href="#" class="btn-lighten">
            <i class="fa fa-angle-right"></i>
          </a>
        </li>
    @endif
  </ul> 
@endif
