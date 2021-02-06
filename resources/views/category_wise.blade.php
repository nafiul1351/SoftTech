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
						<li><a href="">{{ __('Product') }}</a></li>
						<li class="active">{{$category->categoryname}}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

    <!-- Category -->
    <div class="section">
        <div class="container">
            <div class="row">

                <!-- Aside -->
                <div id="aside" class="col-md-3">
                    <div class="aside">
                        <h3 class="aside-title">{{ __('Brands') }}</h3>
                        <div class="checkbox-filter">
                            <input type="hidden" id="cat_id" value="{{$category->id}}">
                            <select name="brand" class="selectpicker">
                                <option selected value="0">{{ __('All') }}</option>
                                @foreach($brand as $brnd)
                                    <option value="{{$brnd->id}}">{{$brnd->brandname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="section-title">
                        <h3 class="title">{{ __('Products for ') }}{{$category->categoryname}}</h3>
                    </div>
                </div>
                <div id="store" class="col-md-9">
                	@if($product->count() == 0)
	                	<h5 class="title">{{ __('This category has no product. Please check back later.') }}</h5>
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

<script>
    $(document).ready(function(){
        $('select[name="brand"]').on('change', function(){
            var brand = $(this).val();
            var cat = $("#cat_id").val();
            $.ajax({
                type: 'get',
                dataType: 'html',
                url: '{{URL::to('/product/for/category/by/brand')}}',
                data: 'brand_id=' + brand + '&cat_id=' + cat,
                success:function(response){
                    console.log(response);
                    $("#store").html(response);
                }
            });
        });
    });
</script>
@endsection
