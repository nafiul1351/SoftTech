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
                        <li><a href="">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</a></li>
                        <li class="active">{{ __('Your Cart') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Your carts -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">{{ __('Your Cart') }}</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    @if(Auth::user()->carts->count() == 0)
                        <h5 class="title">{{ __('Sorry, your cart is empty. Please add some products in it.') }}</h5>
                    @endif
                    <div class="row">
                        <div class="products-tabs">
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @foreach(Auth::user()->carts as $crt)
                                        <div class="product">
                                            <div class="product-img">
                                                <img src="{{asset($crt->products->coverimage)}}" alt="">
                                            </div>
                                            <form method="POST" action="{{ URL::to('/update/cart/'.$crt->id) }}">
                                                @csrf

                                                <div style="height: 180px;" class="product-body">
                                                    <h3 class="product-name"><a href="{{URL::to('/product/detail/'.$crt->products->id)}}">{{ $crt->products->productname }}</a></h3>
                                                    <h4 class="product-price">
                                                        {{ __('SubTotal:') }} {{ __('BDT') }}
                                                        <?php
                                                            $quantity = $crt->quantity;
                                                            $price = $crt->products->discountedprice;
                                                            $new_price = $quantity * $price;
                                                            echo $new_price;
                                                        ?>
                                                    </h4>
                                                    <label for="quantity">{{ __('Quantity:') }}</label>
                                                    <input style="width:40%" value="{{$crt->quantity}}" type="number" min="1" name="quantity">
                                                    <div class="product-rating"></div>
                                                    <div class="product-btns">
                                                        <a data-toggle="tooltip" data-placement="top" title="Remove from Cart" href="{{URL::to('/remove/from/cart/'.$crt->products->id)}}"><i style="color: red;" class="fa fa-trash"></i></a>
                                                    </div>
                                                </div>
                                                <div class="add-to-cart">
                                                    <button type="submit" class="add-to-cart-btn"><i class="fa fa-refresh"></i> {{ __('Update') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user()->carts->count() > 0)
        <hr>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div style="text-align: center;">
                            <h4 style="font-size: 30px; color: red;">{{ __('Total:') }}</h4>
                            <p style="font-weight: bold; font-size: 20px; color: red;">
                                {{ __('BDT') }}
                                <?php
                                    $subtotal = array();
                                    foreach (Auth::user()->carts as $crt) {
                                        $quantity = $crt->quantity;
                                        $price = $crt->products->discountedprice;
                                        $new_price = $quantity * $price;
                                        array_push($subtotal, $new_price);
                                    }
                                    $total = array_sum($subtotal);
                                    echo $total;
                                ?>
                            </p>
                            <a href="{{route('order.checkout')}}" class="primary-btn order-submit">{{ __('Procced To Checkout') }}  <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Footer -->
    @include('partials.frontend.footer')

@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
</script>
@endsection
