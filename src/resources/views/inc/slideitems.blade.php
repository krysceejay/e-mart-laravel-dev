
  <ul class="hs">
      @if (!$allItems->isEmpty())
        @foreach ($allItems as $key => $item)

    <li class="hs__item">
      <div class="hs__item__image__wrapper">
        <a href="{{ route('item', $item->slug ) }}" class="img-link">
          <img
            class="hs__item__image"
            src="/storage/{{ $item->display_image }}"
            alt="first image"
          />
        </a>
      </div>

      <div class="hs__item__description">
        <a href="{{ route('item', $item->slug ) }}">
          <span class="hs__item__title">{{ $item->name }}</span>
        </a>
        <div class="hs__item__subtitle">
          @if ($item->old_price != null || !empty($item->old_price))
            <del class="old-price">
              &#8358;{{ number_format($item->old_price) }}
            </del>
          @endif
          <span class="new-price">
            &#8358;{{ number_format($item->new_price) }}
          </span>
        </div>
        <button
          class="btn-add-to-cart"
          img="{{ $item->display_image }}"
          inm="{{ $item->name }}"
          p="{{ $item->new_price }}"
          iid="{{ $item->id }}"
          sl="{{ $item->slug }}"
          @guest
          gt=""
          @endguest
        >Add To Cart
      </button>
      </div>
    </li>
    @endforeach
    @endif
  </ul>
