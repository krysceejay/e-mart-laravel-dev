<section id="slide-cart">

  <div class="cart-header">
    <h3>Cart</h3>
    <span id="cart-close">&#215;</span>
  </div>

  @guest
    <div id="gcart" class="cart-items-wrap"></div>
  @else
    <div id="ucart" class="cart-items-wrap">
    @if (!$cartList->isEmpty())
      @foreach ($cartList as $key => $cart)

    <div id="cart{{ $cart->item_id }}" class="cart-items-single">
      <div class="cart-item-img">
        <a href="{{ route('item', $cart->item->slug ) }}">
          <img src="/storage/{{ $cart->item->display_image }}" alt="" />
        </a>
      </div>

      <div class="cart-item-text">
        <div class="cart-item-text-name">
          {{ $cart->item->name }}
        </div>
        <div class="cart-item-text-price">
          &#8358; <span id="ctotal{{ $cart->item_id }}">{{ number_format($cart->item->new_price * $cart->unit) }}</span>
        </div>
        <div class="quantity-control">
          <button
            class="minus getval"
            onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
            iid="{{ $cart->item_id }}" p="{{ $cart->item->new_price }}"
          >
            &#x2212;
          </button>
          <input class="catnumber{{ $cart->item_id }}" min="1" max="2000" value="1" type="number" />
          <button
            class="plus getval"
            onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
            iid="{{ $cart->item_id }}" p="{{ $cart->item->new_price }}"
          >
            &#x2b;
          </button>
        </div>
      </div>
      <span class="cart-item-remove" iid="{{ $cart->item_id }}">&#215;</span>
    </div>
    @endforeach
  @endif
  </div>
@endguest

  @guest
    <div class="cart-total">
      <div class="cart-total-sub">
        <span class="cart-total-head">Subtotal</span>
        <span class="cart-total-price">&#8358;

          <span id="sub-total">4,000</span>
        </span>

      </div>
      <div class="cart-total-delivery">
        <span class="cart-total-head">Delivery Fee</span>
        <span class="cart-total-price">&#8358;

          <span id="dlvry">1,000</span>
        </span>
      </div>
      <div class="cart-total-all">
        <span class="cart-total-head">Total</span>
        <span class="cart-total-all-price">&#8358;

          <span id="total-sum">5,000</span>
        </span>
      </div>
      <div class="cart-total-checkout">
        <a href="login.html" class="btn btn-shop-now" id="loginBtn">
          Login To Check Out
        </a>
        <a href="#" class="btn btn-shop-now" id="guestBtn">
          Check Out As Guest
        </a>
        </div>
      <div class="view-cart">
        <a href="{{ route('cart') }}" class="btn btn-view-cart">View Cart</a>
      </div>
    </div>
  @else
  <div class="cart-total">
    <div class="cart-total-sub">
      <span class="cart-total-head">Subtotal</span>
      <span class="cart-total-price">&#8358;
        <span id="sub-total">4,000</span>
      </span>
    </div>
    <div class="cart-total-delivery">
      <span class="cart-total-head">Delivery Fee</span>
      <span class="cart-total-price">&#8358;
        <span id="dlvry">1,000</span>
      </span>
    </div>
    <div class="cart-total-all">
      <span class="cart-total-head">Total</span>
      <span class="cart-total-all-price">&#8358;
        <span id="total-sum">5,000</span>
      </span>
    </div>
    <div class="cart-total-checkout">
      <button class="btn btn-shop-now" id="myBtn">Check Out</button>
    </div>
    <div class="view-cart">
      <a href="{{ route('cart') }}" class="btn btn-view-cart">View Cart</a>
    </div>
  </div>
  @endguest

</section>
