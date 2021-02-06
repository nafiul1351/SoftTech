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
						<li class="active">{{ __('About Us') }}</li>
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
                        <h3 class="title">{{ __('About Us') }}</h3>
                    </div>
                </div>
                <div id="store" class="col-md-12">
	                <p class="title">Softtech is an online shopping mall for buying and selling laptops, comuters and their related components. It's payment methods are totally secure. Both Buyers and sellers can be benefited by using this website.</p>
               		<div class="row" style="padding-top: 15px;">
                        <div class="col-md-12">
                            <h3 class="title">{{ __('Owner Info:') }}</h3>
                            <br>
                            <ul class="header-links pull-left">
                                <li><i class="fa fa-user"></i> {{ __('Md. Nafiul Islam') }}</li>
                                <br>
                                <li><i class="fa fa-envelope"></i> <a class="about" href="mailto:nafiul1351@gmail.com">{{ __('nafiul1351@gmail.com') }}</a></li>
                                <br>
                                <li><i class="fa fa-phone"></i> <a class="about" href="tel:+8801992775545">{{ __('+8801992775545') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('partials.frontend.footer')

@endsection
