<section id="slide-cart">

  <div class="cart-header">
    <h3>Cart</h3>
    <span id="cart-close">&#215;</span>
  </div>
  @guest
    <h1>please login</h1>
  @else
  <div class="cart-items-wrap">
    @if (!$cartList->isEmpty())
      @foreach ($cartList as $key => $cart)

    <div id="cart{{ $cart->item->id }}" class="cart-items-single">
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
          &#8358;{{ number_format($cart->item->new_price) }}
        </div>
        <div class="quantity-control">
          <button
            class="minus"
            onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
          >
            &#x2212;
          </button>
          <input min="1" max="100" value="1" type="number" />
          <button
            class="plus"
            onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
          >
            &#x2b;
          </button>
        </div>
      </div>
      <span class="cart-item-remove">&#215;</span>
    </div>

  @endforeach
@endif
  </div>
  @endguest

  @guest
  @else
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
      <span class="cart-total-head">Total</span>
      <span class="cart-total-all-price">&#8358;5,000</span>
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
