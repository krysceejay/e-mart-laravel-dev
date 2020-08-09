<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
      rel="stylesheet"
      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
      crossorigin="anonymous"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap"
      rel="stylesheet"
    />
    <link href="{{ asset('css/main.min.css') }}" rel="stylesheet">

    <title>{{ config('app.name', 'Emart') }}</title>
  </head>
  <body>
    @if (Route::current()->getName() !== 'cart' && Route::current()->getName() !== 'user-cart')
      {{-- Add cart Section --}}
      @include('inc.cart')
    @endif
    @include('inc.menu')

@yield('content')

    <section id="info" class="py-4">
      <div class="container">
        <div class="info-links">
          <div class="info-links-contact">
            <h3>Contact Us</h3>
            <div>
              <i class="fa fa-map-marker"></i>
              <span>123 Sebastian, USA.</span>
            </div>
            <div>
              <i class="fa fa-phone"></i>
              <span>+2348106199360</span>
            </div>
            <div>
              <i class="fa fa-envelope-o"></i>
              <span>mail@example.com</span>
            </div>
          </div>
          <div class="info-links-quicklinks">
            <h3>Quick Links</h3>
            <ul>
              <li>
                <a href="">Home</a>
              </li>
              <li>
                <a href="">About</a>
              </li>
              <li>
                <a href="">Faq</a>
              </li>
              <li>
                <a href="">Terms Of Use</a>
              </li>
              <li>
                <a href="">Privacy Policy</a>
              </li>
            </ul>
          </div>
          <div class="info-links-followus">
            <h3>Follow Us</h3>
            <div class="social-media">
              <a href=""><i class="fa fa-facebook"></i></a>

              <a href=""><i class="fa fa-twitter"></i></a>

              <a href=""><i class="fa fa-instagram"></i></a>

              <a href=""><i class="fa fa-whatsapp"></i></a>
            </div>
            <div class="app-platforms">
              <h4>Download the App</h4>
              <div class="appstore">
                <img src="/storage/img/gplay.png" alt="" />
              </div>
              <div class="appstore">
                <img src="/storage/img/apple.png" alt="" />
              </div>
            </div>
          </div>
          <div class="info-links-sub">
            <h3>Subscribe</h3>
            <p>Enter your email to subscribe to our newsletter</p>
            <form name="sub-form" method="POST">
              <div class="sub-form">
                <span class="form-control-wrap">
                  <input
                    type="email"
                    name="email"
                    id="email"
                    size="40"
                    class="form-sub"
                    placeholder="Your email"
                  />
                </span>
                <button type="submit" class="form-sub submit">
                  <i class="fa fa-chevron-right"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <footer>
      Copyright &copy; 2020, All Rights Reserved
    </footer>

@guest
@else
    <!-- The Modal -->
    <div id="myModal" class="modal">
      <!-- Modal content -->
      <div class="modal-content">
        <span id="closeModal" class="close">&times;</span>
        <div class="modal-content-wrap">
          <div class="modal-content-wrap-img">
            <svg
              id="f1410098-b6ef-424e-beee-8c1519bc1d1f"
              data-name="Layer 1"
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              width="915.68773"
              height="679.27607"
              viewBox="0 0 915.68773 679.27607"
            >
              <defs>
                <linearGradient
                  id="b5076013-d6c0-4649-8f63-d536232108ef"
                  x1="549.23403"
                  y1="734.77229"
                  x2="549.23403"
                  y2="126.56914"
                  gradientTransform="matrix(0.97485, 0.30762, -0.30291, 0.99, 144.20301, -171.28919)"
                  gradientUnits="userSpaceOnUse"
                >
                  <stop offset="0" stop-color="gray" stop-opacity="0.25" />
                  <stop
                    offset="0.53514"
                    stop-color="gray"
                    stop-opacity="0.12"
                  />
                  <stop offset="1" stop-color="gray" stop-opacity="0.1" />
                </linearGradient>
                <linearGradient
                  id="be72c466-93ff-4e9c-a64c-30b94918ee69"
                  x1="549.32281"
                  y1="679.27607"
                  x2="549.32281"
                  y2="233.83602"
                  gradientTransform="matrix(1, 0, 0, 1, 0, 0)"
                  xlink:href="#b5076013-d6c0-4649-8f63-d536232108ef"
                />
              </defs>
              <title>Credit card</title>
              <rect
                x="184.85689"
                y="201.52958"
                width="728.622"
                height="445.00176"
                rx="27.5"
                transform="translate(-243.24579 71.69262) rotate(-17.2615)"
                fill="url(#b5076013-d6c0-4649-8f63-d536232108ef)"
              />
              <rect
                x="193.71997"
                y="205.56022"
                width="713.75592"
                height="429.25181"
                rx="27.5"
                transform="translate(-242.04064 71.94381) rotate(-17.2615)"
                fill="#fff"
              />
              <rect
                x="155.9523"
                y="267.86085"
                width="713.75592"
                height="61.55937"
                transform="translate(-207.67506 55.26252) rotate(-17.2615)"
                fill="#3aafa9"
              />
              <rect
                x="303.66876"
                y="610.48755"
                width="181.35057"
                height="26.62027"
                transform="translate(-309.4966 34.74867) rotate(-17.2615)"
                fill="#bdbdbd"
              />
              <rect
                x="287.34157"
                y="547.84131"
                width="314.45191"
                height="26.62027"
                transform="translate(-288.64532 46.83008) rotate(-17.2615)"
                fill="#e0e0e0"
              />
              <rect
                x="182.9579"
                y="233.83602"
                width="732.72983"
                height="445.44005"
                rx="27.5"
                fill="url(#be72c466-93ff-4e9c-a64c-30b94918ee69)"
              />
              <rect
                x="191.27673"
                y="238.37789"
                width="713.75592"
                height="429.25181"
                rx="27.5"
                fill="#fff"
              />
              <rect
                x="361.01292"
                y="446.76044"
                width="20.79708"
                height="59.06372"
                fill="#e0e0e0"
              />
              <rect
                x="387.63319"
                y="446.76044"
                width="20.79708"
                height="59.06372"
                fill="#e0e0e0"
              />
              <rect
                x="414.25346"
                y="446.76044"
                width="20.79708"
                height="59.06372"
                fill="#e0e0e0"
              />
              <rect
                x="460.83892"
                y="446.76044"
                width="20.79708"
                height="59.06372"
                fill="#e0e0e0"
              />
              <rect
                x="487.45919"
                y="446.76044"
                width="20.79708"
                height="59.06372"
                fill="#e0e0e0"
              />
              <rect
                x="514.07946"
                y="446.76044"
                width="20.79708"
                height="59.06372"
                fill="#e0e0e0"
              />
              <rect
                x="560.66493"
                y="446.76044"
                width="20.79708"
                height="59.06372"
                fill="#e0e0e0"
              />
              <rect
                x="587.28519"
                y="446.76044"
                width="20.79708"
                height="59.06372"
                fill="#e0e0e0"
              />
              <rect
                x="613.90546"
                y="446.76044"
                width="20.79708"
                height="59.06372"
                fill="#e0e0e0"
              />
              <rect
                x="660.49093"
                y="446.76044"
                width="20.79708"
                height="59.06372"
                fill="#e0e0e0"
              />
              <rect
                x="687.1112"
                y="446.76044"
                width="20.79708"
                height="59.06372"
                fill="#e0e0e0"
              />
              <rect
                x="713.73147"
                y="446.76044"
                width="20.79708"
                height="59.06372"
                fill="#e0e0e0"
              />
              <rect
                x="236.68773"
                y="350.83602"
                width="124"
                height="68"
                fill="#3aafa9"
              />
              <rect
                x="718.68773"
                y="573.83602"
                width="76"
                height="76"
                fill="#3aafa9"
                opacity="0.1"
              />
              <rect
                x="756.68773"
                y="573.83602"
                width="76"
                height="76"
                fill="#3aafa9"
                opacity="0.1"
              />
            </svg>
          </div>
          <div class="payment-options">
            <h4>Payment option</h4>
            <a href="{{ route('order-received') }}" class="btn btn-pay"
              >Pay With Debit Card</a
            >
          </div>
        </div>
      </div>
    </div>
    @endguest

    <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"
    ></script>
    {{-- <script src="./js/script.js"></script> --}}
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
  </body>
</html>
