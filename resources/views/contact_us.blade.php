@extends('layouts.frontend.app')
@section('content')

    <!-- Navbar -->
    @include('partials.frontend.navbar', ['brand' => $brand])

    <!-- Breadcrumb -->
	<div id="breadcrumb" class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb-tree">
						<li><a href="{{ URL::to('/') }}">{{ __('Home') }}</a></li>
						<li class="active">{{ __('Contact Us') }}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

    <!-- Search Results -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">{{ __('Contact Us') }}</h3>
                    </div>
                </div>
                <div id="store" class="col-md-12">
	                <h5 class="title">{{ __('Have any question? Please contact us.') }}</h5>
               		<div class="row" style="padding-top: 15px;">
                        <div class="col-md-12">
                            <div class="map2">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3649.647863734534!2d89.78114131435001!3d23.831117791606356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fe17953189326d%3A0x4adf33029e168b4a!2sPost%20Ofiice%20Shivalaya!5e0!3m2!1sen!2sbd!4v1611157938911!5m2!1sen!2sbd" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen>
                                </iframe>
                            </div>
                            <hr>
                            <form class="contact1-form validate-form" method="" action="">
                                <span class="contact1-form-title">
                                    {{ __('Send us a message:') }}
                                </span>
                                <div class="wrap-input1 validate-input">
                                    <input class="input1" type="text" name="name" placeholder="Name">
                                    <span class="shadow-input1"></span>
                                </div>
                                <div class="wrap-input1 validate-input">
                                    <input class="input1" type="email" name="email" placeholder="Email">
                                    <span class="shadow-input1"></span>
                                </div>
                                <div class="wrap-input1 validate-input">
                                    <input class="input1" type="text" name="phone" placeholder="Phone">
                                    <span class="shadow-input1"></span>
                                </div>
                                <div class="wrap-input1 validate-input">
                                    <textarea class="input1" type="text" name="message" placeholder="Message"></textarea>
                                    <span class="shadow-input1"></span>
                                </div>
                                <div class="container-contact1-form-btn">
                                    <button class="contact1-form-btn" type="submit">
                                        <span>
                                            {{ __('Send') }}
                                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('partials.frontend.footer')

@endsection
