@extends('layouts.home')
@section('content')
  @guest
<main id="cart-sec" class="gcart-sec py-3">
      <section id="cart-items-wrap">
        <h4>My Cart</h4>
        <div id="gcart-wrap" class="cart-items-wrapper"></div>
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
            <span class="cart-total-price">&#8358;4,000</span>
          </div>
          <div class="cart-total-delivery">
            <span class="cart-total-head">Delivery Fee</span>
            <span class="cart-total-price">&#8358;1,000</span>
          </div>
          <div class="cart-total-all">
            <span class="cart-total-all-head">Total</span>
            <span class="cart-total-all-price">&#8358;5,000</span>
          </div>
          <div class="cart-total-checkout">
            <button class="btn-shop-now" id="myBtn">Check Out</button>
          </div>
        </div>
      </aside>
    </main>
  @else
  @endguest
    {{-- Add More Section --}}
    @include('inc.addmore')
    @endsection
