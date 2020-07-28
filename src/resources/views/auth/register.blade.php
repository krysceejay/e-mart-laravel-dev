@extends('layouts.auth')

@section('content')
<main id="auth-sec" class="py-4">
      <div class="container">
        <div class="auth-sec">
          <div class="auth-sec-login">
            <a href="" class="btn btn-auth"
              ><img src="/storage/img/google.png" alt="" />
              <span>Register with Google</span></a
            >
            <a href="" class="btn btn-auth"
              ><img src="/storage/img/facebook.png" alt="" />
              <span>Register with Facebook</span></a
            >
            <div class="auth-or">or</div>
            <form action="">
              <div class="form-group">
                <label for="fname">First Name</label>
                <input
                  type="text"
                  name=""
                  placeholder="Enter your first name"
                  id=""
                />
              </div>
              <div class="form-group">
                <label for="fname">Last Name</label>
                <input
                  type="text"
                  name=""
                  placeholder="Enter your first name"
                  id=""
                />
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input
                  type="email"
                  name=""
                  placeholder="Enter your email"
                  id=""
                />
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input
                  type="password"
                  name=""
                  placeholder="Enter your password"
                  id=""
                />
              </div>

              <div class="auth-btn">
                <button type="submit" class="btn btn-auth-form">Sign Up</button>
              </div>
            </form>
            <div class="sign-up-link">
              <span>Already have an account?</span>
              <a href="{{ route('login') }}">Login</a>
            </div>
          </div>
        </div>
      </div>
    </main>
    @endsection
