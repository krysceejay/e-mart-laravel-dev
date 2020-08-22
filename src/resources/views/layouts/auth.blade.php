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

    <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"
    ></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
      var acc = document.getElementsByClassName("accordion");
      var i;

      for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
          /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
          this.classList.toggle("activeA");

          /* Toggle between hiding and showing the active panel */
          var panel = this.nextElementSibling;
          if (panel.style.display === "block") {
            panel.style.display = "none";
          } else {
            panel.style.display = "block";
          }
        });
      }
    </script>
  </body>
</html>
