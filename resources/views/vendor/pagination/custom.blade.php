@if ($paginator->hasPages())
<div class="my-6 flex justify-center">
    <div class="btn-group">
        {{-- @if ($paginator->onFirstPage())
        <li class="page-item disabled">
            <a class="page-link" href="#" 
               tabindex="-1">Previous</a>
        </li>
        @else
        <li class="page-item"><a class="page-link" 
            href="{{ $paginator->previousPageUrl() }}">
                  Previous</a>
          </li>
        @endif --}}
  
        @foreach ($elements as $element)
        @if (is_string($element))
        <li class="page-item disabled">{{ $element }}</li>
        @endif
  
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        {{-- <li class="page-item active">
            <a class="page-link">{{ $page }}</a>
        </li> --}}
        <button
        class="btn btn-active border-base-100 bg-base-100 text-base-content shadow hover:border-base-300 hover:bg-base-300"
      >
      {{ $page }}
      </button>
        @else
        {{-- <li class="page-item">
            <a class="page-link" 
               href="{{ $url }}">{{ $page }}</a>
        </li> --}}
        <a href="{{ $url }}"
        class="btn border-base-100 bg-base-100 text-base-content shadow hover:border-base-300 hover:bg-base-300"
      >
      {{ $page }}
      </a>
        @endif
        @endforeach
        @endif
        @endforeach
  
        {{-- @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" 
               href="{{ $paginator->nextPageUrl() }}" 
               rel="next">Next</a>
        </li>
        @else
        <li class="page-item disabled">
            <a class="page-link" href="#">Next</a>
        </li>
        @endif --}}
    </div>
</div>
    @endif