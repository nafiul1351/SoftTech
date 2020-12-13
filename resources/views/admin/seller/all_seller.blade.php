@extends('admin.layouts.app')
@section('content')
    <div class="container-scroller">

        <!-- Navbar -->
        @include('admin.partials.navbar')

        <div class="container-fluid page-body-wrapper">
            <div class="row row-offcanvas row-offcanvas-right">

                <!-- Sidebar -->
                @include('admin.partials.sidebar', ['seller' => $not_approved_seller])

                    <!-- Main -->
                    <div class="content-wrapper">
                        <h1 style="text-align: center;" class="page-title">{{ __('All Sellers') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                        <div class="col-12">
                                            <table id="order-listing" class="table table-striped" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Name') }}</th>
                                                        <th>{{ __('E-mail') }}</th>
                                                        <th>{{ __('Phone') }}</th>
                                                        <th>{{ __('Bkash') }}</th>
                                                        <th>{{ __('Rocket') }}</th>
                                                        <th>{{ __('Actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($seller as $slr)
                                                        <tr>
                                                            <td>{{$slr->firstname}} {{$slr->lastname}}</td>
                                                            <td>{{$slr->email}}</td>
                                                            <td>{{$slr->phonenumber}}</td>
                                                            <td>{{$slr->sellerdetails->bkashnumber}}</td>
                                                            <td>{{$slr->sellerdetails->rocketnumber}}</td>
                                                            <td>
                                                                <a class="btn btn-outline-danger" href="{{URL::to('/suspend/seller/'.$slr->id)}}">{{ __('Suspend') }}</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
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
