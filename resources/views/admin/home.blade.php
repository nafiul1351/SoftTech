@extends('admin.layouts.app')
@section('content')
    <div class="container-scroller">

        <!-- Navbar -->
        @include('admin.partials.navbar')

        <div class="container-fluid page-body-wrapper">
            <div class="row row-offcanvas row-offcanvas-right">

                <!-- Sidebar -->
                @include('admin.partials.sidebar')

                    <!-- Main -->
                    <div class="content-wrapper">
                        <h1 style="text-align: center;" class="page-title">{{ __('Admin Dashboard') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <h2 style="text-align: center;" class="card-title">{{ __('Instructions') }}</h2>
                                <div style="padding-left: 10px; padding-right: 10px;">
                                    <h4>{{ __('1. Dashboard:') }}</h4>
                                    <div style="padding-left: 10px;">
                                        <p>{{ __('i. Dashboard menu contains all the instructions for controlling the application.') }}</p>
                                        <p>{{ __('ii. Please read all the instructions for controlling the application.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- Footer -->
                @include('admin.partials.footer')
        
            </div>
        </div>
    </div>
@endsection
