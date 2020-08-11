<nav id="main-nav">
  <!-- <img src="img/logo.png" alt="My Portfolio" id="logo" /> -->
  <a href="{{ route('home') }}">
  <h1><span class="text-primary">WONDERFUL</span>LOGO</h1>
  </a>
  <div>
    <ul>
      <li><i class="fa fa-phone"></i> +234 123 456 7890</li>
      @guest
        <li><a href="{{ route('login') }}">Login</a></li>
        @if (Route::has('register'))
          <li><a href="{{ route('register') }}">Register</a></li>
        @endif
      @else
        <li>{{ Auth::user()->first_name }}</li>
        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                    </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </li>

      @endguest

      <li>

          @guest
            <a href="{{ route('user-cart') }}" class="cart-icon">
              <i class="fa fa-shopping-cart cart-nav"></i>
            <span
            id="cart-count"
            gt=""
            >
            0
            </span>
          </a>
          @else
            <a href="{{ route('cart') }}" class="cart-icon">
              <i class="fa fa-shopping-cart cart-nav"></i>
          <span
          id="cart-count"
          >
            {{ $cartCount }}
          </span>
        </a>
          @endguest

      </li>
    </ul>

    <form name="email-form" method="POST">
      <div class="email-form">
        <span class="form-control-wrap">
          <input
            type="email"
            name="email"
            size="40"
            class="form-sub"
            placeholder="What item are you looking for today?"
          />
        </span>
        <button type="submit" class="form-sub submit">
          <i class="fa fa-chevron-right"></i>
        </button>
      </div>
    </form>
  </div>
</nav>
<nav id="minor-nav">
  <div class="parent-sub-menu">
    <span>Category</span> <i class="fa fa-angle-down" id="show-cat"></i>
    <ul class="nav-sub-menu">
      <li>
        <a href="">Kitchen</a>
      </li>
      <li>
        <a href="">Household</a>
      </li>
      <li>
        <a href="">Cloths</a>
      </li>
      <li>
        <a href="">Gaget</a>
      </li>
      <li>
        <a href="">Groceries</a>
      </li>
      <li>
        <a href="">Kitchen</a>
      </li>
      <li>
        <a href="">Household</a>
      </li>
      <li>
        <a href="">Cloths</a>
      </li>
      <li>
        <a href="">Gaget</a>
      </li>
      <li>
        <a href="">Groceries</a>
      </li>
      <li>
        <a href="">Kitchen</a>
      </li>
      <li>
        <a href="">Household</a>
      </li>
      <li>
        <a href="">Cloths</a>
      </li>
      <li>
        <a href="">Gaget</a>
      </li>
      <li>
        <a href="">Groceries</a>
      </li>
      <li>
        <a href="">Cloths</a>
      </li>
      <li>
        <a href="">Gaget</a>
      </li>
    </ul>
  </div>

  <ul class="minor-nav-list">
    <li><a href="{{ route('home') }}" class="{{ Route::current()->getName() == 'home' ? 'current' : '' }}">Home</a></li>
    <li><a href="{{ route('items') }}" class="{{ Route::current()->getName() == 'items' || Route::current()->getName() == 'item' ? 'current' : '' }}">All Items</a></li>
    <li><a href="#">Kitchen</a></li>
    <li><a href="#">Household</a></li>
    <li><a href="#">Faqs</a></li>
    <li><a href="#">Contact</a></li>
  </ul>

  <div class="menu-wrap">
    <input type="checkbox" class="toggler" />
    <div class="hamburger"><div></div></div>
    <div class="menu">
      <div>
        <div>
          <ul>
            <li><a href="{{ route('home') }}" class="{{ Route::current()->getName() == 'home' ? 'current' : '' }}">Home</a></li>
            <li><a href="{{ route('items') }}" class="{{ Route::current()->getName() == 'items' || Route::current()->getName() == 'item' ? 'current' : '' }}">All Items</a></li>
            <li><a href="#">Kitchen</a></li>
            <li><a href="#">Household</a></li>
            <li><a href="#">Faqs</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>