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

    <!-- NEWSLETTER -->
    <div id="newsletter" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="newsletter">
                        <p>Sign Up for the <strong>NEWSLETTER</strong></p>
                        <form>
                            <input class="input" type="email" placeholder="Enter Your Email">
                            <button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
                        </form>
                        <ul class="newsletter-follow">
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /NEWSLETTER -->

    <!-- FOOTER -->
    <footer id="footer">
        <!-- top footer -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">About Us</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Categories</h3>
                            <ul class="footer-links">
                                <li><a href="#">Hot deals</a></li>
                                <li><a href="#">Laptops</a></li>
                                <li><a href="#">Smartphones</a></li>
                                <li><a href="#">Cameras</a></li>
                                <li><a href="#">Accessories</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Information</h3>
                            <ul class="footer-links">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Orders and Returns</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Service</h3>
                            <ul class="footer-links">
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">View Cart</a></li>
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="#">Track My Order</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /top footer -->

        <!-- bottom footer -->
        <div id="bottom-footer" class="section">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-payments">
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                        </ul>
                        <span class="copyright">
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </span>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bottom footer -->
    </footer>
    <!-- /FOOTER -->

@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
</script>
@endsection
