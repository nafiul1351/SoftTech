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
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf

                    <div class="login-form-head">
                        <h4><a class="logo" href="{{ URL::to('/') }}">{{ config('app.name', 'Laravel') }}</a></h4>
                        <p>{{ __('Please verify your e-mail address') }}</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email,') }}
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another.') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
