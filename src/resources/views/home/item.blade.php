@extends('layouts.home')

@section('content')
<main id="detail-sec" class="py-4">
      <h2>Item Details</h2>
      <div class="detail-sec-wrap py-4">
        <div class="image-sec">
          <div
            id="main-img"
            style="background: url('/storage/img/watch.jpg') no-repeat center; background-size: contain;">

          </div>
          <div class="all-imgs">
            <img src="/storage/img/watch.jpg" class="active-img" alt="" />
            <img src="/storage/img/earpods.jpg" alt="" />
            <img src="/storage/img/jacket.jpeg" alt="" />
            <img src="/storage/img/suade-img.jpg" alt="" />
            <img src="/storage/img/bag-img.jpeg" alt="" />
          </div>
        </div>
        <div class="text-sec">
          <div class="item-name">Hand Bag</div>
          <span class="stars" style="--rating: 3.5;"></span>
          <a href="review.html" class="rate-text">3.5 of 12 reviews</a>
          <div class="item-price">
            &#8358;5,100
          </div>
          <div class="item-description">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo
            deleniti rerum tenetur modi quis nesciunt beatae eius aspernatur
            iure, explicabo sapiente assumenda sint dolor architecto hic
            mollitia. Illo, alias consectetur! Lorem ipsum dolor sit amet,
            consectetur adipisicing elit. Nemo deleniti rerum tenetur modi quis
            nesciunt beatae eius aspernatur iure, explicabo sapiente assumenda
            sint dolor architecto hic mollitia. Illo, alias consectetur!
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
