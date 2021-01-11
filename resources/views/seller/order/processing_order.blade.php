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
                        <h1 style="text-align: center;" class="page-title">{{ __('Processing Orders') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                        <div class="col-12">
                                            <table id="order-listing" class="table table-striped" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Product ID') }}</th>
                                                        <th>{{ __('Quantity') }}</th>
                                                        <th>{{ __('Total') }}</th>
                                                        <th>{{ __('Address') }}</th>
                                                        <th>{{ __('Method') }}</th>
                                                        <th>{{ __('Status') }}</th>
                                                        <th>{{ __('Actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($orderdetail as $ordrdtl)
                                                        @if($ordrdtl->status != 'Delivered' && $ordrdtl->status != 'Canceled')
                                                            <tr>
                                                                <td style="text-align: center;">
                                                                    <img style="height: 80px; width: 80px; border-radius: 5px;" src="{{asset($ordrdtl->products->coverimage)}}">
                                                                    <br>
                                                                    <p>{{ $ordrdtl->products->productid }}</p>
                                                                </td>
                                                                <td>{{ $ordrdtl->quantity }}</td>
                                                                <td>{{ $ordrdtl->total }}{{ __(' BDT') }}</td>
                                                                <td>{{ $ordrdtl->shippingaddress }}</td>
                                                                @if($ordrdtl->orders->type == 'OP')
                                                                    <td>{{ __('Online Payment') }}</td>
                                                                @elseif($ordrdtl->orders->type == 'COD')
                                                                    <td>{{ __('Cash on Delivery') }}</td>
                                                                @endif
                                                                <td>{{ $ordrdtl->status }}</td>
                                                                <td>
                                                                    <a class="fa fa-eye" style="color: green; text-decoration: none;" href="{{URL::to('/seller/view/order/'.$ordrdtl->id)}}"></a>
                                                                    @if($ordrdtl->status == 'Processing')
                                                                        <a style="color: blue; text-decoration: none; padding-left: 10px;" class="fa fa-gift" href="{{URL::to('/cancel/order/'.$ordrdtl->id)}}"></a>
                                                                    @elseif($ordrdtl->status == 'Packaged')
                                                                        <a style="color: blue; text-decoration: none; padding-left: 10px;" class="fa fa-ship" href="{{URL::to('/cancel/order/'.$ordrdtl->id)}}"></a>
                                                                    @elseif($ordrdtl->status == 'Shipped')
                                                                        <a style="color: blue; text-decoration: none; padding-left: 10px;" class="fa fa-check" href="{{URL::to('/cancel/order/'.$ordrdtl->id)}}"></a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endif
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
