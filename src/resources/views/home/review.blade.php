@extends('layouts.auth')
@section('content')
    <main id="review-sec" class="py-3">
      <div class="container">
        <section class="rev-sec-wrap">
          <div class="bratings-main">
            <div class="bratings-main-stats">
              <div class="bratings-main-stats-cal">
                <div class="rating-number">
                  <span class="num-main">{{ $round_rate }}</span>
                </div>
                <div class="stars" style="--rating: {{ $round_rate }};"></div>
                <div class="total-num-rating">{{ $count_rev }} rating(s)</div>
              </div>

              <div class="bratings-main-stats-progress">
                @for ($i = 5; $i > 0; $i--)
                  <div class="progress-d">
                    <span class="progress-d-numberr">{{ $i }}</span>
                    <div class="progress-d-ratingprog">
                      <div style="--progwidth: {{ $percent_values[$i] }}%;"></div>
                    </div>
                  </div>
                @endfor
              </div>
            </div>

            <div class="bratings-main-reviews">
              <div class="bratings-main-reviews-head">REVIEWS</div>
              @if (!$reviews->isEmpty())
                @foreach ($reviews as $review)
                <div class="bratings-main-reviews-card">
                  <div class="bratings-main-reviews-card-top">
                    <div class="reviews-stars" style="--userrating: {{ $review->rating }};"></div>
                    <div class="reviews-date">{{ date("d \ M Y",strtotime($review->created_at)) }}</div>
                  </div>
                  <div class="bratings-main-reviews-card-body">
                    {{ $review->review }}
                    <p class="reviewer">by {{ $review->user->first_name }}</p>
                  </div>
                </div>
              @endforeach
              @else
                <p>No review for this item</p>

              @endif

            </div>
            {{ $reviews->links('vendor.pagination.custom') }}
          </div>
        </section>
      </div>
    </main>

  @endsection
