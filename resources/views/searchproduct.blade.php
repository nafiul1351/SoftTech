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
						<li><a href="">{{ __('Search Result') }}</a></li>
						<li class="active">{{$search_product}}</li>
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
                        <h3 class="title">{{ __('Search Results for ') }}{{$search_product}}</h3>
                    </div>
                </div>
                <div id="store" class="col-md-12">
                	@if($product->count() == 0)
	                	<h5 class="title">{{ __('Sorry, no results found for this keyword. Please try a different keyword.') }}</h5>
	                @endif
               		<div class="row">
               			@foreach($product as $prdct)
               				<div class="col-md-3 col-xs-6">
                            	<div style="margin-bottom: 60px;" class="product">
                                    <div class="product-img">
                                        <img src="{{asset($prdct->coverimage)}}" alt="">
                                        <div class="product-label">
                                            @if($prdct->newly == 1)
                                                <span class="new">{{ __('NEW') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div style="height: 180px;" class="product-body">
                                        <p class="product-category">{{ $prdct->categories->categoryname}}</p>
                                        <h3 class="product-name"><a href="{{URL::to('/product/detail/'.$prdct->id)}}">{{ $prdct->productname }}</a></h3>
                                        <h4 class="product-price">{{ __('BDT') }} {{ $prdct->discountedprice }} <del class="product-old-price">{{ $prdct->regularprice }}</del></h4>
                                        <div class="product-rating">
                                            <?php
                                                $rated = floor($prdct->reviews->avg('rating'));
                                                $unrated = 5-$rated;
                                                while($rated > 0){
                                                    echo('<i class="fa fa-star"></i> ');
                                                    $rated--;
                                                }
                                                while($unrated > 0){
                                                    echo('<i class="fa fa-star-o"></i> ');
                                                    $unrated--;
                                                }
                                            ?>
                                        </div>
                                        <div class="product-btns">
                                            @auth
                                                @if(Auth::user()->checkwishlists($prdct->id))
                                                    <a data-toggle="tooltip" data-placement="top" title="Remove from Wishlist" href="{{URL::to('/remove/from/wishlist/'.$prdct->id)}}"><i style="color: red;" class="fa fa-heart"></i></a>
                                                @else
                                                    <a data-toggle="tooltip" data-placement="top" title="Add to Wishlist" href="{{URL::to('/add/to/wishlist/'.$prdct->id)}}"><i class="fa fa-heart-o"></i></a>
                                                @endif
                                            @else
                                                <a data-toggle="tooltip" data-placement="top" title="Add to Wishlist" href="{{URL::to('/add/to/wishlist/'.$prdct->id)}}"><i class="fa fa-heart-o"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="add-to-cart">
                                        <a href="{{URL::to('/product/detail/'.$prdct->id)}}"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> {{ __('Add to Cart') }}</button></a>
                                    </div>
                            	</div>
                        	</div>
                        @endforeach
                    </div>
					<div class="store-filter clearfix">
						<span class="store-qty">
	                		{{ __('Showing ') }}{{$product->count()}}{{ __(' of ') }}{{$product_all->count()}}{{ __(' products') }}
	            		</span>
						{{$product->links('partials.pagination')}}
					</div>
                </div>
            </div>
        </div>
    </div>

    <!-- NEWSLETTER -->
    <div id="newsletter" class="section">
        <div class="container">
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
        </div>
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
