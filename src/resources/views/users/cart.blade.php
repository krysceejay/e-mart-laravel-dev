@extends('layouts.home')
@section('content')
<main id="cart-sec" class="gcart-sec py-3">
      <section id="cart-items-wrap">
        <h4>My Cart</h4>
        <div id="loader-ring">
              <div></div>
              <div></div>
              <div></div>
              <div></div>
            </div>
        <div id="gcart" class="cart-items-wrapper ctwrapper">
          @foreach ($cartList as $cart)

          <div id="cart{{ $cart->item_id }}" class="cart-items-single">
            <div class="cart-item-img">
              <a href="{{ route('item', $cart->item->slug ) }}">
                <img src="/storage/{{ $cart->item->display_image }}" alt="" />
              </a>
            </div>
            <div class="cart-item-text-name">
              {{ $cart->item->name }}
            </div>
            <div class="cart-item-text-price">
              &#8358;<span id="ctotal{{ $cart->item_id }}">{{ number_format($cart->item->new_price * $cart->unit) }}</span>
            </div>
            <div class="quantity-control">
              <button
                class="minus getval"
                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                iid="{{ $cart->item_id }}" p="{{ $cart->item->new_price }}"
              >
                &#x2212;
              </button>
              <input class="catnumber{{ $cart->item_id }}" min="1" max="2000" value="{{ $cart->unit }}" type="number" />
              <button
                class="plus getval"
                onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                iid="{{ $cart->item_id }}" p="{{ $cart->item->new_price }}"
              >
                &#x2b;
              </button>
            </div>
            <span class="cart-item-remove" iid="{{ $cart->item_id }}">&#215;</span>
          </div>

          @endforeach

        </div>
        <div class="enter-promo">
          <div class="enter-promo-text">
            <i class="fa fa-tag"></i> Enter Promo Code
          </div>
          <form action="" class="enter-promo-form">
            <input type="text" placeholder="Enter code..." />
            <button class="btn btn-small">Apply</button>
          </form>
        </div>
      </section>
      <aside>
        <h4>Order Summary</h4>
        <div class="cart-total">
          <div class="cart-total-sub">
            <span class="cart-total-head">Subtotal</span>
            <span class="cart-total-price">&#8358;
              <span id="sub-total">{{ number_format($total) }}</span>
            </span>
          </div>
          <div class="cart-total-delivery">
            <span class="cart-total-head">Delivery Fee</span>
            <span class="cart-total-price">&#8358;
              <span id="dlvry">{{ number_format($delivery) }}</span>
            </span>
          </div>
          <div class="cart-total-all">
            <span class="cart-total-all-head">Total</span>
            <span class="cart-total-all-price">&#8358;
              <span id="total-sum">{{ number_format($total + $delivery) }}</span>
            </span>
          </div>
          <div class="cart-total-checkout">
            <button class="btn-shop-now" id="myBtn">Check Out</button>
          </div>
        </div>
      </aside>
    </main>

    {{-- Add More Section --}}
    @include('inc.addmore')
    @endsection
