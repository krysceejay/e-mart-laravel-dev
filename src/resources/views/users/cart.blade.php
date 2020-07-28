@extends('layouts.home')
@section('content')
<main id="cart-sec" class="py-3">
      <section id="cart-items-wrap">
        <h4>My Cart</h4>
        <div class="cart-items-wrapper">
          <div class="cart-items-single">
            <div class="cart-item-img">
              <a href="">
                <img src="/storage/img/handbag2-img.jpg" alt="" />
              </a>
            </div>
            <div class="cart-item-text-name">
              Suade Shoe Men
            </div>
            <div class="cart-item-text-price">
              &#8358;3,000
            </div>
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
            <span class="cart-item-remove">&#215;</span>
          </div>
          <div class="cart-items-single">
            <div class="cart-item-img">
              <a href="">
                <img src="/storage/img/watch.jpg" alt="" />
              </a>
            </div>
            <div class="cart-item-text-name">
              Suade Shoe Men
            </div>
            <div class="cart-item-text-price">
              &#8358;3,000
            </div>
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
            <span class="cart-item-remove">&#215;</span>
          </div>
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

    {{-- Add More Section --}}
    @include('inc.addmore')
    @endsection
