@extends('layouts.app')
@section('content')
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <!-- Verify -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="login-form-head">
                        <h4><a class="logo" href="{{ URL::to('/') }}">{{ config('app.name', 'Laravel') }}</a></h4>
                        <p>{{ __('Please confirm your password') }}</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-group">
                            <label for="password">{{ __('Password:') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Please enter the password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">{{ __('Confirm Password') }} <i class="ti-arrow-right"></i></button>
                        </div>
                        <br>
                        <div style="text-align: center;">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
