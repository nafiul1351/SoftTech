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
                                <div style="padding-left: 10px; padding-right: 10px;">
                                    <h4>{{ __('2. Brand:') }}</h4>
                                    <div style="padding-left: 10px;">
                                        <p>{{ __('i. Brand menu contains the functionality for adding a new brand.') }}</p>
                                        <p>{{ __('ii. It shows all the brands stored in the database.') }}</p>
                                        <p>{{ __('iii. It also contains the functionality for editing and deleting a stored brand.') }}</p>
                                    </div>
                                </div>
                                <div style="padding-left: 10px; padding-right: 10px;">
                                    <h4>{{ __('3. Category:') }}</h4>
                                    <div style="padding-left: 10px;">
                                        <p>{{ __('i. Category menu contains the functionality for adding a new category.') }}</p>
                                        <p>{{ __('ii. It shows all the categories stored in the database.') }}</p>
                                        <p>{{ __('iii. It also contains the functionality for editing and deleting a stored category.') }}</p>
                                    </div>
                                </div>
                                <div style="padding-left: 10px; padding-right: 10px;">
                                    <h4>{{ __('4. Seller:') }}</h4>
                                    <div style="padding-left: 10px;">
                                        <p>{{ __('i. Seller menu contains the functionality for approving a new seller.') }}</p>
                                        <p>{{ __('ii. It also contains the functionality for suspending a approved seller.') }}</p>
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
