@extends('layouts.auth')

@section('content')
<main id="auth-sec" class="py-4">
      <div class="container">
        <div class="auth-sec">
          <div class="auth-sec-login">
            <a href="" class="btn btn-auth"
              ><img src="/storage/img/google.png" alt="" />
              <span>Login with Google</span></a
            >
            <a href="" class="btn btn-auth"
              ><img src="/storage/img/facebook.png" alt="" />
              <span>Login with Facebook</span></a
            >
            <div class="auth-or">or</div>
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group">
                <label for="email">{{ __('E-Mail') }}</label>
                <input
                  type="email"
                  name="email" value="{{ old('email') }}"
                  placeholder="Enter your email"
                  required autocomplete="email" autofocus
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
                />
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-check">
                <span>
                  <input type="checkbox" name="remember" id="" {{ old('remember') ? 'checked' : '' }} />
                  {{ __('Remember Me') }}
                </span>

                @if (Route::has('password.request'))

                    <span><a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a> </span>
                @endif
              </div>
              <div class="auth-btn">
                <button type="submit" class="btn btn-auth-form">{{ __('Login') }}</button>
              </div>
            </form>
            <div class="sign-up-link">
              <span>Don't have an account?</span>
              <a href="{{ route('register') }}">Register</a>
            </div>
          </div>
        </div>
      </div>
    </main>

    @endsection
