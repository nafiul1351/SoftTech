@extends('seller.layouts.app')
@section('content')
    <div class="container-scroller">

        <!-- Navbar -->
        @include('seller.partials.navbar')

        <div class="container-fluid page-body-wrapper">
            <div class="row row-offcanvas row-offcanvas-right">

                <!-- Sidebar -->
                @include('seller.partials.sidebar')

                    <!-- Main -->
                    <div class="content-wrapper">
                        <h1 style="text-align: center;" class="page-title">{{ __('All Products') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                        <div class="col-12">
                                            <table id="order-listing" class="table table-striped" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('ID') }}</th>
                                                        <th>{{ __('Name') }}</th>
                                                        <th>{{ __('Model') }}</th>
                                                        <th>{{ __('Brand') }}</th>
                                                        <th>{{ __('Category') }}</th>
                                                        <th>{{ __('Price') }}</th>
                                                        <th>{{ __('Actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($product as $prdct)
                                                        <tr>
                                                            <td style="text-align: center;">
                                                                <img style="height: 80px; width: 80px; border-radius: 5px;" src="{{asset($prdct->coverimage)}}">
                                                                <br>
                                                                <p>{{ $prdct->productid }}</p>
                                                            </td>
                                                            <td>{{ $prdct->productname }}</td>
                                                            <td>{{ $prdct->productmodel }}</td>
                                                            <td>{{ $prdct->brands->brandname}}</td>
                                                            <td>{{ $prdct->categories->categoryname}}</td>
                                                            <td>{{ $prdct->discountedprice}}</td>
                                                            <td>
                                                                <a class="fa fa-edit" style="color: green; text-decoration: none; padding-right: 5px;" href="{{URL::to('/edit/product/'.$prdct->id)}}"></a>
                                                                <a class="fa fa-trash" style="color: red; text-decoration: none; padding-left: 5px;" href="{{URL::to('/delete/product/'.$prdct->id)}}" id="delete"></a>
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
                @include('seller.partials.footer')
        
            </div>
        </div>
    </div>
@endsection
