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
