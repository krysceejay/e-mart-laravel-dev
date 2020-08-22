@extends('layouts.auth')
@section('content')
  @include('inc.msg')
    <main id="auth-sec" class="py-4">
      <div class="container">
        <div class="auth-sec">
          <div class="auth-sec-login">
            <div class="sign-up-link">
              <span>Already have an account?</span>
              <a href="login.html">Login</a>
              <br />
              or
              <a href="register.html">Register</a>
            </div>

            <div class="auth-or">Continue as guest</div>

              <div class="form-group">
                <label for="fullname">Full Name</label>
                <input
                  type="text"
                  name=""
                  placeholder="Enter your full name"
                  id="usfullname"
                  required
                />
                <span class="invalid-feedback" role="alert">
                    <strong class="usfullname"></strong>
                </span>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input
                  type="email"
                  name=""
                  placeholder="Enter your email"
                  id="usemail"
                  required
                />
                <span class="invalid-feedback" role="alert">
                    <strong class="usemail"></strong>
                </span>
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input
                  type="number"
                  name=""
                  placeholder="Enter Phone number"
                  id="usphone"
                  required
                />
                <span class="invalid-feedback" role="alert">
                    <strong class="usphone"></strong>
                </span>
              </div>
              <div class="form-group">
                <label for="address">Delivery Address</label>
                <input
                  type="text"
                  name=""
                  placeholder="Enter Delivery address"
                  id="usaddress"
                  required
                />
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
              <a href="ordereceived.html" class="btn btn-pay"
                >Pay With Debit Card</a
              >

              <button class="btn btn-pay accordion">
                Direct Bank Transfer
              </button>
              <div class="panel">
                <small
                  >Orders will be processed when payment is confirmed.<br />pay
                  to the account below and click Submit.
                </small>
                <p>Guarranty Trust Bank</p>
                <p>ACCOUNT NAME: E-MART Online Store</p>
                <p>ACCOUNT NUMBER: 0158672312</p>
                <button type="submit" id="g-check-sub" class="btn-shop-now">Submit</button>
              </div>
            </div>

          </div>
        </div>
      </div>
    </main>

  @endsection