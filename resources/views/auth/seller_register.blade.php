@extends('layouts.app')
@section('content')
    <!-- Register -->
    <div class="login-area login-s2">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="type" value="Seller">
                    <div class="login-form-head">
                        <h4><a class="logo" href="{{ URL::to('/') }}">{{ config('app.name', 'Laravel') }}</a></h4>
                        <p>{{ __('Please Sign up to the system') }}</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-group">
                            <label for="firstname">{{ __('First Name:') }}</label>
                            <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" placeholder="Please enter the first name" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
                            @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lastname">{{ __('Last Name:') }}</label>
                            <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" placeholder="Please enter the last name" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender">{{ __('Gender:') }}</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <label class="form-check-label"><input type="radio" id="gender" class="form-check-input @error('gender') is-invalid @enderror" name="gender" autofocus value="Male">{{ __('Male') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <label class="form-check-label"><input type="radio" id="gender" class="form-check-input @error('gender') is-invalid @enderror" name="gender" autofocus value="Female">{{ __('Female') }}</label>
                            </div>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="dob">{{ __('Date of Birth:') }}</label>
                            <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="dob" autofocus>
                            @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
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
                            <label for="phonenumber">{{ __('Phone Number:') }}</label>
                            <input id="phonenumber" type="text" class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber" placeholder="Please enter the phone number" value="{{ old('phonenumber') }}" required autocomplete="phonenumber" autofocus>
                            @error('phonenumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bkashnumber">{{ __('Bkash Number:') }}</label>
                            <input id="bkashnumber" type="text" class="form-control @error('bkashnumber') is-invalid @enderror" name="bkashnumber" placeholder="Please enter the bkash number" value="{{ old('bkashnumber') }}" required autocomplete="bkashnumber" autofocus>
                            @error('bkashnumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="rocketnumber">{{ __('Rocket Number:') }}</label>
                            <input id="rocketnumber" type="text" class="form-control @error('rocketnumber') is-invalid @enderror" name="rocketnumber" placeholder="Please enter the rocket number" value="{{ old('rocketnumber') }}" required autocomplete="rocketnumber" autofocus>
                            @error('rocketnumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">{{ __('Profile Picture:') }}</label>
                            
                                <input id="image" type="file" class="dropify @error('image') is-invalid @enderror" data-height="100" name="image">
                                
                                @error('image')
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
                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password:') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Please confirm the password" required autocomplete="new-password">
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">{{ __('Submit') }} <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">{{ __('Want to be a buyer?') }} <a href="{{ route('register') }}">{{ __('Buyer Sign up') }}</a></p>
                            <p class="text-muted">{{ __('Already have an account?') }} <a href="{{ route('login') }}">{{ __('Sign in') }}</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
