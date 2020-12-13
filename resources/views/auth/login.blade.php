@extends('layouts.app')
@section('content')
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    
    <!-- Login -->
    <div class="login-area login-s2">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="login-form-head">
                        <h4><a class="logo" href="{{ URL::to('/') }}">{{ config('app.name', 'Laravel') }}</a></h4>
                        <p>{{ __('Please Sign in to the system') }}</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address:') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Please enter the e-mail address" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Password:') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Please enter the password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" checked="checked" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                                @endif
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">{{ __('Submit') }} <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">{{ __('Do not have an account?') }} <a href="{{ route('register') }}">{{ __('Sign up') }}</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
