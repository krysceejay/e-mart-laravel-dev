@extends('layouts.auth')
@section('content')
  @include('inc.msg')
    <main id="auth-sec" class="py-4">
      <div id="loader-ring">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
      <div class="container">
        <div class="auth-sec">
          <div class="auth-sec-login">
            <div class="sign-up-link">
              <span>Already have an account?</span>
              <a href="{{ route('login') }}">Login</a>
              <br />
              or
              <a href="{{ route('register') }}">Register</a>
            </div>

            <div class="auth-or">Continue as guest</div>

            <form class="" action="{{ route('dtrans') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="fullname">Full Name</label>
                <input
                  type="text"
                  name="fullname"
                  placeholder="Enter your full name"
                  id="usfullname"
                  value="{{ old('fullname') }}"
                  required
                />
                @error('fullname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <span class="invalid-feedback" role="alert">
                    <strong class="usfullname"></strong>
                </span>

              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input
                  type="email"
                  name="email"
                  placeholder="Enter your email"
                  id="usemail"
                  value="{{ old('email') }}"

                />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <span class="invalid-feedback" role="alert">
                    <strong class="usemail"></strong>
                </span>

              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input
                  type="tel"
                  name="phone"
                  placeholder="Enter Phone number"
                  id="usphone"
                  value="{{ old('phone') }}"
                  required
                />
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <span class="invalid-feedback" role="alert">
                    <strong class="usphone"></strong>
                </span>
              </div>
              <div class="form-group">
                <label for="address">Delivery Address</label>
                <input
                  type="text"
                  name="address"
                  placeholder="Enter Delivery address"
                  id="usaddress"
                  value="{{ old('address') }}"
                  required
                />
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <span class="invalid-feedback" role="alert">
                    <strong class="usaddress"></strong>
                </span>
              </div>
              <!-- <div class="auth-btn">
                <button type="submit" class="btn btn-auth-form">
                  Continue
                </button>
              </div> -->
              <span class="confirm-guest"
                >We'll send a confirmation of your order to the provided
                email address</span
              >

            <div class="payment-options">
              <!-- <h4>Payment option</h4> -->
              <div id="pay-stk" class="btn btn-pay">Pay With Debit Card</div>

              <div class="btn btn-pay accordion">
                Direct Bank Transfer
              </div>
              <div class="panel">
                <small>
                  {{-- Orders will be processed when payment is confirmed.<br /> --}}
                  Pay to the account below, upload screenshot of successful payment and click
                  <span>Submit</span>.
                </small>
                <div class="acct-det">
                  <p>Guaranty Trust Bank</p>
                  <p>ACCOUNT NAME: E-MART Online Store</p>
                  <p>ACCOUNT NUMBER: 0158672312</p>
                </div>

                <div class="form-group">
                  <label for="address">Upload Screenshot Of Payment</label>
                  <input
                    type="file"
                    name="screenshot"
                    id="usfile"
                    value="{{ old('screenshot') }}"
                    required
                  />
                  @error('screenshot')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <input id="fcitms" type="hidden" name="fcitms">

                <button type="submit" id="g-check-sub" class="btn-shop-now">Submit</button>
              </div>
            </div>
          </form>

          </div>
        </div>
      </div>
    </main>
    <script defer type="text/javascript" src="https://js.paystack.co/v1/inline.js"></script>
  @endsection
