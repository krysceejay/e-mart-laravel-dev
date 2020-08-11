@extends('layouts.home')

@section('content')

  <!-- Slideshow container -->
  <section class="slideshow-container">
    <div class="slideshow">
      @foreach ($slides as $key => $slide)

      <div
        class="slide {{ $key == 0 ? 'active-slide' : '' }}"
        style="background: url('/storage/{{ $slide->slide_image }}') no-repeat center; background-size: cover;"
      >
        <div class="content">
          <h1>Healthy Savings</h1>
          <p>
            Get Up To 30% off
          </p>
          <a href="{{ route('items') }}" class="btn-shop-now">Shop Now</a>
        </div>
      </div>

      @endforeach

    </div>

    <button id="prev" class="btn-slide">
      <i class="fa fa-arrow-left"></i>
    </button>
    <button id="next" class="btn-slide">
      <i class="fa fa-arrow-right"></i>
    </button>
  </section>
  <!-- / End Slide -->

    <!-- <section class="horizontal-scroll">
      <div class="item">Item2</div>
      <div class="item">Item2</div>
      <div class="item">Item3</div>
      <div class="item">Item4</div>
      <div class="item">Item5</div>
      <div class="item">Item1</div>
      <div class="item">Item2</div>
      <div class="item">Item3</div>
      <div class="item">Item4</div>
      <div class="item">Item5</div>
    </section> -->

    <!-- Just arrived section -->
    <section class="py-3">
      <div class="container">
        <div class="hs__wrapper">
          <div class="hs__header">
            <div class="hs__arrows">
              <a class="arrow disabled arrow-prev"
                ><i class="fa fa-angle-left fa-2x"></i
              ></a>
            </div>
            <h2 class="hs__headline">Just Arrived</h2>
            <div class="hs__arrows">
              <a class="arrow arrow-next"
                ><i class="fa fa-angle-right fa-2x"></i
              ></a>
            </div>
          </div>
        @include('inc.slideitems')
        </div>

      <!-- / End Just Arrived section -->

      <!-- Best seller section -->
          <div class="hs__wrapper py-3">
            <div class="hs__header">
              <div class="hs__arrows">
                <a class="arrow disabled arrow-prev"
                  ><i class="fa fa-angle-left fa-2x"></i
                ></a>
              </div>
              <h2 class="hs__headline">Best Seller</h2>
              <div class="hs__arrows">
                <a class="arrow arrow-next"
                  ><i class="fa fa-angle-right fa-2x"></i
                ></a>
              </div>
            </div>
        @include('inc.slideitems')
      </div>

      </div>
    </section>
    <!-- / End Best seller section -->

    <!-- Featured section -->

    <!-- / End Featured section -->

    <section id="market" class="py-2">
      <div class="container">
        <div class="market-info">
          <div class="market-info-content">
            <i class="fa fa-truck fa-3x"></i>
            <div class="m-text">
              <div class="head-text">Free Delivery</div>
              <div class="head-content">Free Delivery on your first order!</div>
            </div>
          </div>

          <div class="market-info-content">
            <i class="fa fa-money fa-3x"></i>
            <div class="m-text">
              <div class="head-text">Money Guarantee</div>
              <div class="head-content">7 days money back guarantee</div>
            </div>
          </div>
          <div class="market-info-content">
            <i class="fa fa-headphones fa-3x"></i>
            <div class="m-text">
              <div class="head-text">Online Support</div>
              <div class="head-content">
                Online support from 8am to 5pm daily
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    @endsection