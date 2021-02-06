@extends('layouts.frontend.app')
@section('content')

    <!-- Navbar -->
    @include('partials.frontend.navbar', ['brand' => $brand])

    <!-- Category -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">{{ __('Categories') }}</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-slick" data-nav="#slick-nav-cat">
                            @foreach($category as $ctgry)
                                <div class="col-md-4 col-xs-6">
                                    <div class="shop">
                                        <div class="shop-img">
                                            <img src="{{asset($ctgry->categoryimage)}}" alt="">
                                        </div>
                                        <div class="shop-body">
                                            <h3>{{$ctgry->categoryname}}<br>{{ __('Collection') }}</h3>
                                            <a href="{{URL::to('/product/for/category/'.$ctgry->id)}}" class="cta-btn">{{ __('Shop now') }} <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div id="slick-nav-cat" class="products-slick-nav"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Products -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">{{ __('Latest Products') }}</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @foreach($product as $prdct)
                                        <div class="product">
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

    <!-- Hot Deal -->
    <div id="hot-deal" class="section" style="background-image: url({{asset('/public/images/hotdeal.jpg')}}); background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <ul class="hot-deal-countdown">
                            <li>
                                <div>
                                    <h3>{{ __('02') }}</h3>
                                    <span>{{ __('Days') }}</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>{{ __('10') }}</h3>
                                    <span>{{ __('Hours') }}</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>{{ __('34') }}</h3>
                                    <span>{{ __('Mins') }}</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>{{ __('60') }}</h3>
                                    <span>{{ __('Secs') }}</span>
                                </div>
                            </li>
                        </ul>
                        <h2 class="text-uppercase" style="color: #C10425;">{{ __('hot deal this week') }}</h2>
                        <p style="color: #C10425;">{{ __('New Collection Up to 50% OFF') }}</p>
                        <a class="primary-btn cta-btn" href="#">{{ __('Shop now') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Selling Products -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">{{ __('Top Selling Products') }}</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-2">
                                    @foreach($product2 as $prdct)
                                        @if($prdct->sales > 0)
                                        <div class="product">
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
                                        @endif
                                    @endforeach
                                </div>
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
