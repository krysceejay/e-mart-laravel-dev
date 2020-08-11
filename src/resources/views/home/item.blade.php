@extends('layouts.home')

@section('content')
<main id="detail-sec" class="py-4">
      <h2>Item Details</h2>
      <div class="detail-sec-wrap py-4">
        <div class="image-sec">
          <div
            id="main-img"
            style="background: url('/storage/{{ $item->display_image }}') no-repeat center; background-size: contain;">

          </div>
          <div class="all-imgs">
            <img src="/storage/{{ $item->display_image }}" class="active-img" alt="" />

            @if (!$itemImages->isEmpty())
              @foreach ($itemImages as $key => $itemImage)
                <img src="/storage/{{ $itemImage->img }}" alt="" />
              @endforeach
            @endif
          </div>
        </div>
        <div class="text-sec">
          <div class="item-name">{{ $item->name }}</div>
          <span class="stars" style="--rating: 3.5;"></span>
          <a href="review.html" class="rate-text">3.5 of 12 reviews</a>
          <div class="item-price">
            &#8358;{{ number_format($item->new_price) }}
          </div>
          <div class="item-description">
            {{ $item->description }}
          </div>
          <div class="item-control">
            <div class="quantity-control">
              <button
                class="minus"
                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
              >
                &#x2212;
              </button>
              <input min="1" max="100" value="5" type="number" />
              <button
                class="plus"
                onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
              >
                &#x2b;
              </button>
            </div>
            <div class="add-to-cart">
              <button class="btn-add-to-cart">Add To Cart</button>
            </div>
          </div>
        </div>
      </div>
    </main>

    {{-- Add More Section --}}
    @include('inc.addmore')
    @endsection