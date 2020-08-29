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
            <form method="POST" action="{{ route('register') }}">
                @csrf
              <div class="form-group">
                <label for="firstname">First Name</label>
                <input
                  type="text"
                  name="firstname"
                  value="{{ old('firstname') }}"
                  placeholder="Enter your first name"
                  required
                />
                @error('firstname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="lastname">Last Name</label>
                <input
                  type="text"
                  name="lastname"
                  value="{{ old('lastname') }}"
                  placeholder="Enter your first name"
                  required
                />
                @error('lastname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input
                  type="email"
                  name="email"
                  value="{{ old('email') }}"
                  placeholder="Enter your email"
                  required
                  autocomplete="email"
                />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input
                  type="password"
                  name="password"
                  placeholder="Enter your password"
                  required
                />
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="password">Confirm Password</label>
                <input
                  type="password"
                  name="password_confirmation"
                  placeholder="Confirm your password"
                  required
                  autocomplete="new-password"
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
