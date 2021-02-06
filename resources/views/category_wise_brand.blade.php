                    @if($product->count() == 0)
	                	<h5 class="title">{{ __('This category has no product for this brand. Please check back later.') }}</h5>
	                @endif
               		<div class="row">
               			@foreach($product as $prdct)
               				<div class="col-md-4 col-xs-6">
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
                                            @if($prdct->reviews->avg('rating') > 0.9 && $prdct->reviews->avg('rating') < 1.6)
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            @elseif($prdct->reviews->avg('rating') > 1.5 && $prdct->reviews->avg('rating') < 2.6)
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            @elseif($prdct->reviews->avg('rating') > 2.5 && $prdct->reviews->avg('rating') < 3.6)
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            @elseif($prdct->reviews->avg('rating') > 3.5 && $prdct->reviews->avg('rating') < 4.6)
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            @elseif($prdct->reviews->avg('rating') > 4.5 && $prdct->reviews->avg('rating') < 5.1)
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            @else
                                                <i style="color: black;">{{ __('Not Rated') }}</i>
                                            @endif
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