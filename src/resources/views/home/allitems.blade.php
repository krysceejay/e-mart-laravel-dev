@extends('layouts.home')

@section('content')
<main id="main-sec" class="py-3">
      <aside id="main-sec-aside">
        <form action="">
          <div class="aside-search">
            <h4>Search here</h4>

            <div class="aside-form">
              <span class="form-control-wrap">
                <input
                  type="text"
                  name="search"
                  size="40"
                  class="form-sub"
                  placeholder="Item name..."
                />
              </span>
            </div>
          </div>
          <hr />
          <div class="aside-price">
            <h4>Price range</h4>

            <div class="form-group-wrap">
              <input type="number" placeholder="From" class="price-from" />

              <input type="number" placeholder="To" />
            </div>

            <!-- <span id="min-price">&#8358;100</span> -
          <span id="max-price">&#8358;10000</span>
          <div class="aside-price-slider">
            <input type="range" min="0" max="100" value="25" id="input-left" />
            <input type="range" min="0" max="100" value="75" id="input-right" />

            <div class="slider">
              <div class="track"></div>
              <div class="range"></div>
              <div class="thumb left"></div>
              <div class="thumb right"></div>
            </div>
          </div> -->
          </div>
          <hr />
          <div class="aside-review">
            <h4>Customer Review</h4>

            <div class="user-ratings">
              <input
                id="star-5"
                name="rating[rating]"
                type="radio"
                value="5"
              /><label for="star-5" title="5 stars">
                &#x2605;
              </label>
              <input
                id="star-4"
                name="rating[rating]"
                type="radio"
                value="4"
              /><label for="star-4" title="4 stars">
                &#x2605;
              </label>
              <input
                id="star-3"
                name="rating[rating]"
                type="radio"
                value="3"
              /><label for="star-3" title="3 stars">
                &#x2605;
              </label>
              <input
                id="star-2"
                name="rating[rating]"
                type="radio"
                value="2"
              /><label for="star-2" title="2 stars">
                &#x2605;
              </label>
              <input
                id="star-1"
                name="rating[rating]"
                type="radio"
                value="1"
              /><label for="star-1" title="1 star">
                &#x2605;
              </label>
            </div>
          </div>
          <button type="submit" class="btn btn-filter">
            Filter
          </button>
        </form>
      </aside>
      <section id="main-sec-prod">
        <div class="main-prod-view">
          @if (!$allItems->isEmpty())

            @foreach ($allItems as $key => $item)
              <div class="main-prod-view-single">
                <div class="prod-img">
                  <a href="{{ route('item', $item->slug ) }}">
                    <img src="/storage/{{ $item->display_image }}" alt="" />
                  </a>
                </div>
                <div class="prod-text">
                  <a href="{{ route('item', $item->slug ) }}">
                    <div class="prod-text-name">

                      {{ $item->name }}
                    </div>
                  </a>

                  <div class="prod-text-price">
                    <del class="old-price">
                      &#8358;{{ $item->old_price }}
                    </del>
                    <span class="new-price">
                      &#8358;{{ $item->new_price }}
                    </span>
                  </div>
                  <button class="btn-add-to-cart">Add To Cart</button>
                  <span class="badge-new">New</span>
                </div>
              </div>
            @endforeach

          @else
            <div class="col-12 text-center">
                <h4>Oops!</h4>
                <p>Looks like there are no farms here.</p>
            </div>
        @endif




        </div>
        {{-- <ul class="paginate-links-menu py-3">
          <li class="">
            <a href="" class="btn-lighten">
              <i class="fa fa-angle-left"></i>
            </a>
          </li>

          <li class="">
            <a href="" class="btn-lighten current">1</a>
          </li>
          <li class="">
            <a href="" class="btn-lighten">2</a>
          </li>
          <li class="">
            <a href="" class="btn-lighten">3</a>
          </li>
          <li class="">
            <a href="" class="btn-lighten">4</a>
          </li>
          <li class="">
            <a href="" class="btn-lighten">5</a>
          </li>

          <li class="">
            <a href="" class="btn-lighten">6</a>
          </li>

          <li class="">
            <a href="" class="btn-lighten">
              <i class="fa fa-angle-right"></i>
            </a>
          </li>
        </ul> --}}
      </section>
    </main>
        @endsection
