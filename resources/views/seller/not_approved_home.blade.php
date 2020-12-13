@extends('seller.layouts.app')
@section('content')
    <div class="container-scroller">

        <!-- Navbar -->
        @include('seller.partials.navbar')

        <div class="container-fluid page-body-wrapper">
            <div class="row row-offcanvas row-offcanvas-right">

                <!-- Sidebar -->
                @include('seller.partials.not_approved_sidebar')

                    <!-- Main -->
                    <div class="content-wrapper">
                        <h1 style="text-align: center;" class="page-title">{{ __('Seller Dashboard') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <div style="text-align: center;">
                                    <p>{{ __('Your account is currently under review.') }}</p>
                                    <p>{{ __('Please check back later.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- Footer -->
                @include('seller.partials.footer')
        
            </div>
        </div>
    </div>
@endsection
