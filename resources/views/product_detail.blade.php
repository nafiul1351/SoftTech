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
						<li><a href="{{ route('product.store') }}">{{ __('Store') }}</a></li>
						<li class="active">{{$product->productname}}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

    <!-- Product -->
    <div class="section">
        <div class="container">
            <div class="row">

                <!-- Product images -->
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        <div class="product-preview">
                            <img src="{{asset($product->coverimage)}}" alt="">
                        </div>
                        @foreach($product->otherimages as $othrimgs)
                            <div class="product-preview">
                                <img src="{{asset($othrimgs->otherimage)}}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        <div class="product-preview">
                            <img src="{{asset($product->coverimage)}}" alt="">
                        </div>
                        @foreach($product->otherimages as $othrimgs)
                            <div class="product-preview">
                                <img src="{{asset($othrimgs->otherimage)}}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">{{$product->productname}}</h2>
                        <div>
                            <div class="product-rating">
                                <?php
                                    $rated = floor($product->reviews->avg('rating'));
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
                            <p>{{$product->reviews->count()}} {{ __('Review(s)') }}</p>
                        </div>
                        <div>
                            <h3 class="product-price">{{ __('BDT') }} {{$product->discountedprice}} <del class="product-old-price">{{$product->regularprice}}</del></h3>
                            @if($product->productquantity == 0)
                                <span class="product-available">{{ __('Out of Stock') }}</span>
                            @elseif($product->productquantity > 0)
                                <span class="product-available">{{ __('In Stock') }}</span>
                            @endif
                        </div>
                        <p style="font-weight: bold;"><span>&#183;</span> {{ __('Shop:') }} {{$product->shops->shopname}}</p>
                        <p style="font-weight: bold;"><span>&#183;</span> {{ __('Category:') }} {{$product->categories->categoryname}}</p>
                        <p style="font-weight: bold;"><span>&#183;</span> {{ __('Brand:') }} {{$product->brands->brandname}}</p>
                        <p style="font-weight: bold;"><span>&#183;</span> {{ __('Model:') }} {{$product->productmodel}}</p>
                        <form method="POST" action="{{ URL::to('/add/to/cart/'.$product->id) }}">
                            @csrf

                            @if($product->productquantity > 0)
                                <div class="product-options">
                                    <label>
                                        {{ __('Color') }}
                                        <select class="input-select" name="color" required>
                                            @foreach (explode(',', $product->productcolor) as $prdctclr)
                                                <option value="{{$prdctclr}}">{{$prdctclr}}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                                <div class="add-to-cart">
                                    <div class="qty-label">
                                        {{ __('Qty') }}
                                        <div class="input-number">
                                            <input type="number" name="quantity" value="{{$product->productquantity}}" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> {{ __('Add to Cart') }}</button>
                                </div>
                            @elseif($product->productquantity == 0)
                                <h4 style="color: #DA0024;">{{ __('Sorry, this product is not available right now. Please check back later.') }}</h4>
                            @endif
                        </form>
                        <ul class="product-btns">
                            @auth
                                @if(Auth::user()->checkwishlists($product->id))
                                    <li><a href="{{URL::to('/remove/from/wishlist/'.$product->id)}}"><i style="color: red;" class="fa fa-heart"></i> {{ __('Remove from Wishlist') }}</a></li>
                                @else
                                    <li><a href="{{URL::to('/add/to/wishlist/'.$product->id)}}"><i class="fa fa-heart-o"></i> {{ __('Add to Wishlist') }}</a></li>
                                @endif
                            @else
                                <li><a href="{{URL::to('/add/to/wishlist/'.$product->id)}}"><i class="fa fa-heart-o"></i> {{ __('Add to Wishlist') }}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Product tabs -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">{{ __('Description') }}</a></li>
                            <li><a data-toggle="tab" href="#tab2">{{ __('Details') }}</a></li>
                            <li><a data-toggle="tab" href="#tab3">{{ __('Reviews') }} {{ __('(') }}{{$product->reviews->count()}}{{ __(')') }}</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p style="text-align: center;"><span>&#183;</span> {{ __('Shop:') }} {{$product->shops->shopname}}</p>
                                        <p style="text-align: center;"><span>&#183;</span> {{ __('Category:') }} {{$product->categories->categoryname}}</p>
                                        <p style="text-align: center;"><span>&#183;</span> {{ __('Brand:') }} {{$product->brands->brandname}}</p>
                                        <p style="text-align: center;"><span>&#183;</span> {{ __('Model:') }} {{$product->productmodel}}</p>
                                    </div>
                                </div>
                            </div>
                            <div id="tab2" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-md-12">
                                        @foreach (explode(',', $product->productdescription) as $prdctdscrptn)
                                            <p style="text-align: center;"><span>&#183;</span> {{ $prdctdscrptn }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div id="tab3" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div id="rating">
                                            <div class="rating-avg">
                                                @if(empty($product->reviews->avg('rating')))
                                                    <span>{{ __('0.00') }}</span>
                                                @else
                                                    <?php
                                                        $rated = $product->reviews->avg('rating');
                                                        $show = number_format($rated, 2);
                                                        echo $show;
                                                    ?>
                                                @endif
                                                <div class="rating-stars">
                                                    <?php
                                                        $rated = floor($product->reviews->avg('rating'));
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
                                            </div>
                                            <ul class="rating">
                                                <li>
                                                    <div class="rating-stars">
                                                        <?php
                                                            $rated = 0;
                                                            while($rated < 5){
                                                                echo('<i class="fa fa-star"></i> ');
                                                                $rated++;
                                                            }
                                                        ?>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <?php
                                                            $five = floor($product->reviews()->where('rating', 5)->count());
                                                            $all = floor($product->reviews->count('rating'));
                                                            if($all == 0){
                                                                echo ('<div></div>');
                                                            }
                                                            else{
                                                                $progress = ($five / $all) * 100;
                                                                if($progress == 0){
                                                                    echo ('<div></div>');
                                                                }
                                                                elseif($progress > 0 && $progress < 6){
                                                                    echo ('<div style="width: 5%;"></div>');
                                                                }
                                                                elseif($progress > 5 && $progress < 11){
                                                                    echo ('<div style="width: 10%;"></div>');
                                                                }
                                                                elseif($progress > 10 && $progress < 16){
                                                                    echo ('<div style="width: 15%;"></div>');
                                                                }
                                                                elseif($progress > 15 && $progress < 21){
                                                                    echo ('<div style="width: 20%;"></div>');
                                                                }
                                                                elseif($progress > 20 && $progress < 26){
                                                                    echo ('<div style="width: 25%;"></div>');
                                                                }
                                                                elseif($progress > 25 && $progress < 31){
                                                                    echo ('<div style="width: 30%;"></div>');
                                                                }
                                                                elseif($progress > 30 && $progress < 36){
                                                                    echo ('<div style="width: 35%;"></div>');
                                                                }
                                                                elseif($progress > 35 && $progress < 41){
                                                                    echo ('<div style="width: 40%;"></div>');
                                                                }
                                                                elseif($progress > 40 && $progress < 46){
                                                                    echo ('<div style="width: 45%;"></div>');
                                                                }
                                                                elseif($progress > 45 && $progress < 51){
                                                                    echo ('<div style="width: 50%;"></div>');
                                                                }
                                                                elseif($progress > 50 && $progress < 56){
                                                                    echo ('<div style="width: 55%;"></div>');
                                                                }
                                                                elseif($progress > 55 && $progress < 61){
                                                                    echo ('<div style="width: 60%;"></div>');
                                                                }
                                                                elseif($progress > 60 && $progress < 66){
                                                                    echo ('<div style="width: 65%;"></div>');
                                                                }
                                                                elseif($progress > 65 && $progress < 71){
                                                                    echo ('<div style="width: 70%;"></div>');
                                                                }
                                                                elseif($progress > 70 && $progress < 76){
                                                                    echo ('<div style="width: 75%;"></div>');
                                                                }
                                                                elseif($progress > 75 && $progress < 81){
                                                                    echo ('<div style="width: 80%;"></div>');
                                                                }
                                                                elseif($progress > 80 && $progress < 86){
                                                                    echo ('<div style="width: 85%;"></div>');
                                                                }
                                                                elseif($progress > 85 && $progress < 91){
                                                                    echo ('<div style="width: 90%;"></div>');
                                                                }
                                                                elseif($progress > 90 && $progress < 96){
                                                                    echo ('<div style="width: 95%;"></div>');
                                                                }
                                                                else{
                                                                    echo ('<div style="width: 100%;"></div>');
                                                                }
                                                            }
                                                        ?>
                                                    </div>
                                                    <span class="sum">
                                                        <?php
                                                            $five = floor($product->reviews()->where('rating', 5)->count());
                                                            echo $five;
                                                        ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <?php
                                                            $rated = 0;
                                                            while($rated < 4){
                                                                echo('<i class="fa fa-star"></i> ');
                                                                $rated++;
                                                            }
                                                            echo('<i class="fa fa-star-o"></i> ');
                                                        ?>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <?php
                                                            $four = floor($product->reviews()->where('rating', 4)->count());
                                                            $all = floor($product->reviews->count('rating'));
                                                            if($all == 0){
                                                                echo ('<div></div>');
                                                            }
                                                            else{
                                                                $progress = ($four / $all) * 100;
                                                                if($progress == 0){
                                                                    echo ('<div></div>');
                                                                }
                                                                elseif($progress > 0 && $progress < 6){
                                                                    echo ('<div style="width: 5%;"></div>');
                                                                }
                                                                elseif($progress > 5 && $progress < 11){
                                                                    echo ('<div style="width: 10%;"></div>');
                                                                }
                                                                elseif($progress > 10 && $progress < 16){
                                                                    echo ('<div style="width: 15%;"></div>');
                                                                }
                                                                elseif($progress > 15 && $progress < 21){
                                                                    echo ('<div style="width: 20%;"></div>');
                                                                }
                                                                elseif($progress > 20 && $progress < 26){
                                                                    echo ('<div style="width: 25%;"></div>');
                                                                }
                                                                elseif($progress > 25 && $progress < 31){
                                                                    echo ('<div style="width: 30%;"></div>');
                                                                }
                                                                elseif($progress > 30 && $progress < 36){
                                                                    echo ('<div style="width: 35%;"></div>');
                                                                }
                                                                elseif($progress > 35 && $progress < 41){
                                                                    echo ('<div style="width: 40%;"></div>');
                                                                }
                                                                elseif($progress > 40 && $progress < 46){
                                                                    echo ('<div style="width: 45%;"></div>');
                                                                }
                                                                elseif($progress > 45 && $progress < 51){
                                                                    echo ('<div style="width: 50%;"></div>');
                                                                }
                                                                elseif($progress > 50 && $progress < 56){
                                                                    echo ('<div style="width: 55%;"></div>');
                                                                }
                                                                elseif($progress > 55 && $progress < 61){
                                                                    echo ('<div style="width: 60%;"></div>');
                                                                }
                                                                elseif($progress > 60 && $progress < 66){
                                                                    echo ('<div style="width: 65%;"></div>');
                                                                }
                                                                elseif($progress > 65 && $progress < 71){
                                                                    echo ('<div style="width: 70%;"></div>');
                                                                }
                                                                elseif($progress > 70 && $progress < 76){
                                                                    echo ('<div style="width: 75%;"></div>');
                                                                }
                                                                elseif($progress > 75 && $progress < 81){
                                                                    echo ('<div style="width: 80%;"></div>');
                                                                }
                                                                elseif($progress > 80 && $progress < 86){
                                                                    echo ('<div style="width: 85%;"></div>');
                                                                }
                                                                elseif($progress > 85 && $progress < 91){
                                                                    echo ('<div style="width: 90%;"></div>');
                                                                }
                                                                elseif($progress > 90 && $progress < 96){
                                                                    echo ('<div style="width: 95%;"></div>');
                                                                }
                                                                else{
                                                                    echo ('<div style="width: 100%;"></div>');
                                                                }
                                                            }
                                                        ?>
                                                    </div>
                                                    <span class="sum">
                                                        <?php
                                                            $four = floor($product->reviews()->where('rating', 4)->count());
                                                            echo $four;
                                                        ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <?php
                                                            $rated = 0;
                                                            while($rated < 3){
                                                                echo('<i class="fa fa-star"></i> ');
                                                                $rated++;
                                                            }
                                                            echo('<i class="fa fa-star-o"></i> ');
                                                            echo('<i class="fa fa-star-o"></i> ');
                                                        ?>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <?php
                                                            $three = floor($product->reviews()->where('rating', 3)->count());
                                                            $all = floor($product->reviews->count('rating'));
                                                            if($all == 0){
                                                                echo ('<div></div>');
                                                            }
                                                            else{
                                                                $progress = ($three / $all) * 100;
                                                                if($progress == 0){
                                                                    echo ('<div></div>');
                                                                }
                                                                elseif($progress > 0 && $progress < 6){
                                                                    echo ('<div style="width: 5%;"></div>');
                                                                }
                                                                elseif($progress > 5 && $progress < 11){
                                                                    echo ('<div style="width: 10%;"></div>');
                                                                }
                                                                elseif($progress > 10 && $progress < 16){
                                                                    echo ('<div style="width: 15%;"></div>');
                                                                }
                                                                elseif($progress > 15 && $progress < 21){
                                                                    echo ('<div style="width: 20%;"></div>');
                                                                }
                                                                elseif($progress > 20 && $progress < 26){
                                                                    echo ('<div style="width: 25%;"></div>');
                                                                }
                                                                elseif($progress > 25 && $progress < 31){
                                                                    echo ('<div style="width: 30%;"></div>');
                                                                }
                                                                elseif($progress > 30 && $progress < 36){
                                                                    echo ('<div style="width: 35%;"></div>');
                                                                }
                                                                elseif($progress > 35 && $progress < 41){
                                                                    echo ('<div style="width: 40%;"></div>');
                                                                }
                                                                elseif($progress > 40 && $progress < 46){
                                                                    echo ('<div style="width: 45%;"></div>');
                                                                }
                                                                elseif($progress > 45 && $progress < 51){
                                                                    echo ('<div style="width: 50%;"></div>');
                                                                }
                                                                elseif($progress > 50 && $progress < 56){
                                                                    echo ('<div style="width: 55%;"></div>');
                                                                }
                                                                elseif($progress > 55 && $progress < 61){
                                                                    echo ('<div style="width: 60%;"></div>');
                                                                }
                                                                elseif($progress > 60 && $progress < 66){
                                                                    echo ('<div style="width: 65%;"></div>');
                                                                }
                                                                elseif($progress > 65 && $progress < 71){
                                                                    echo ('<div style="width: 70%;"></div>');
                                                                }
                                                                elseif($progress > 70 && $progress < 76){
                                                                    echo ('<div style="width: 75%;"></div>');
                                                                }
                                                                elseif($progress > 75 && $progress < 81){
                                                                    echo ('<div style="width: 80%;"></div>');
                                                                }
                                                                elseif($progress > 80 && $progress < 86){
                                                                    echo ('<div style="width: 85%;"></div>');
                                                                }
                                                                elseif($progress > 85 && $progress < 91){
                                                                    echo ('<div style="width: 90%;"></div>');
                                                                }
                                                                elseif($progress > 90 && $progress < 96){
                                                                    echo ('<div style="width: 95%;"></div>');
                                                                }
                                                                else{
                                                                    echo ('<div style="width: 100%;"></div>');
                                                                }
                                                            }
                                                        ?>
                                                    </div>
                                                    <span class="sum">
                                                        <?php
                                                            $three = floor($product->reviews()->where('rating', 3)->count());
                                                            echo $three;
                                                        ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <?php
                                                            echo('<i class="fa fa-star"></i> ');
                                                            echo('<i class="fa fa-star"></i> ');
                                                            $rated = 5;
                                                            while($rated > 2){
                                                                echo('<i class="fa fa-star-o"></i> ');
                                                                $rated--;
                                                            }
                                                        ?>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <?php
                                                            $two = floor($product->reviews()->where('rating', 2)->count());
                                                            $all = floor($product->reviews->count('rating'));
                                                            if($all == 0){
                                                                echo ('<div></div>');
                                                            }
                                                            else{
                                                                $progress = ($two / $all) * 100;
                                                                if($progress == 0){
                                                                    echo ('<div></div>');
                                                                }
                                                                elseif($progress > 0 && $progress < 6){
                                                                    echo ('<div style="width: 5%;"></div>');
                                                                }
                                                                elseif($progress > 5 && $progress < 11){
                                                                    echo ('<div style="width: 10%;"></div>');
                                                                }
                                                                elseif($progress > 10 && $progress < 16){
                                                                    echo ('<div style="width: 15%;"></div>');
                                                                }
                                                                elseif($progress > 15 && $progress < 21){
                                                                    echo ('<div style="width: 20%;"></div>');
                                                                }
                                                                elseif($progress > 20 && $progress < 26){
                                                                    echo ('<div style="width: 25%;"></div>');
                                                                }
                                                                elseif($progress > 25 && $progress < 31){
                                                                    echo ('<div style="width: 30%;"></div>');
                                                                }
                                                                elseif($progress > 30 && $progress < 36){
                                                                    echo ('<div style="width: 35%;"></div>');
                                                                }
                                                                elseif($progress > 35 && $progress < 41){
                                                                    echo ('<div style="width: 40%;"></div>');
                                                                }
                                                                elseif($progress > 40 && $progress < 46){
                                                                    echo ('<div style="width: 45%;"></div>');
                                                                }
                                                                elseif($progress > 45 && $progress < 51){
                                                                    echo ('<div style="width: 50%;"></div>');
                                                                }
                                                                elseif($progress > 50 && $progress < 56){
                                                                    echo ('<div style="width: 55%;"></div>');
                                                                }
                                                                elseif($progress > 55 && $progress < 61){
                                                                    echo ('<div style="width: 60%;"></div>');
                                                                }
                                                                elseif($progress > 60 && $progress < 66){
                                                                    echo ('<div style="width: 65%;"></div>');
                                                                }
                                                                elseif($progress > 65 && $progress < 71){
                                                                    echo ('<div style="width: 70%;"></div>');
                                                                }
                                                                elseif($progress > 70 && $progress < 76){
                                                                    echo ('<div style="width: 75%;"></div>');
                                                                }
                                                                elseif($progress > 75 && $progress < 81){
                                                                    echo ('<div style="width: 80%;"></div>');
                                                                }
                                                                elseif($progress > 80 && $progress < 86){
                                                                    echo ('<div style="width: 85%;"></div>');
                                                                }
                                                                elseif($progress > 85 && $progress < 91){
                                                                    echo ('<div style="width: 90%;"></div>');
                                                                }
                                                                elseif($progress > 90 && $progress < 96){
                                                                    echo ('<div style="width: 95%;"></div>');
                                                                }
                                                                else{
                                                                    echo ('<div style="width: 100%;"></div>');
                                                                }
                                                            }
                                                        ?>
                                                    </div>
                                                    <span class="sum">
                                                        <?php
                                                            $two = floor($product->reviews()->where('rating', 2)->count());
                                                            echo $two;
                                                        ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <?php
                                                            echo('<i class="fa fa-star"></i> ');
                                                            $rated = 5;
                                                            while($rated > 1){
                                                                echo('<i class="fa fa-star-o"></i> ');
                                                                $rated--;
                                                            }
                                                        ?>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <?php
                                                            $one = floor($product->reviews()->where('rating', 1)->count());
                                                            $all = floor($product->reviews->count('rating'));
                                                            if($all == 0){
                                                                echo ('<div></div>');
                                                            }
                                                            else{
                                                                $progress = ($one / $all) * 100;
                                                                if($progress == 0){
                                                                    echo ('<div></div>');
                                                                }
                                                                elseif($progress > 0 && $progress < 6){
                                                                    echo ('<div style="width: 5%;"></div>');
                                                                }
                                                                elseif($progress > 5 && $progress < 11){
                                                                    echo ('<div style="width: 10%;"></div>');
                                                                }
                                                                elseif($progress > 10 && $progress < 16){
                                                                    echo ('<div style="width: 15%;"></div>');
                                                                }
                                                                elseif($progress > 15 && $progress < 21){
                                                                    echo ('<div style="width: 20%;"></div>');
                                                                }
                                                                elseif($progress > 20 && $progress < 26){
                                                                    echo ('<div style="width: 25%;"></div>');
                                                                }
                                                                elseif($progress > 25 && $progress < 31){
                                                                    echo ('<div style="width: 30%;"></div>');
                                                                }
                                                                elseif($progress > 30 && $progress < 36){
                                                                    echo ('<div style="width: 35%;"></div>');
                                                                }
                                                                elseif($progress > 35 && $progress < 41){
                                                                    echo ('<div style="width: 40%;"></div>');
                                                                }
                                                                elseif($progress > 40 && $progress < 46){
                                                                    echo ('<div style="width: 45%;"></div>');
                                                                }
                                                                elseif($progress > 45 && $progress < 51){
                                                                    echo ('<div style="width: 50%;"></div>');
                                                                }
                                                                elseif($progress > 50 && $progress < 56){
                                                                    echo ('<div style="width: 55%;"></div>');
                                                                }
                                                                elseif($progress > 55 && $progress < 61){
                                                                    echo ('<div style="width: 60%;"></div>');
                                                                }
                                                                elseif($progress > 60 && $progress < 66){
                                                                    echo ('<div style="width: 65%;"></div>');
                                                                }
                                                                elseif($progress > 65 && $progress < 71){
                                                                    echo ('<div style="width: 70%;"></div>');
                                                                }
                                                                elseif($progress > 70 && $progress < 76){
                                                                    echo ('<div style="width: 75%;"></div>');
                                                                }
                                                                elseif($progress > 75 && $progress < 81){
                                                                    echo ('<div style="width: 80%;"></div>');
                                                                }
                                                                elseif($progress > 80 && $progress < 86){
                                                                    echo ('<div style="width: 85%;"></div>');
                                                                }
                                                                elseif($progress > 85 && $progress < 91){
                                                                    echo ('<div style="width: 90%;"></div>');
                                                                }
                                                                elseif($progress > 90 && $progress < 96){
                                                                    echo ('<div style="width: 95%;"></div>');
                                                                }
                                                                else{
                                                                    echo ('<div style="width: 100%;"></div>');
                                                                }
                                                            }
                                                        ?>
                                                    </div>
                                                    <span class="sum">
                                                        <?php
                                                            $one = floor($product->reviews()->where('rating', 1)->count());
                                                            echo $one;
                                                        ?>
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Product reviews -->
                                    <div class="col-md-6">
                                        <div id="reviews">
                                            <ul class="reviews">
                                                @if($product->reviews->count() == 0)
                                                    <p style="font-weight: bold; text-align: center;">{{ __('This product has no reviews yet.') }}</p>
                                                @endif
                                                @foreach($review as $revw)
                                                    <li>
                                                        <div class="review-heading">
                                                            <h5 class="name">{{$revw->users->firstname}} {{$revw->users->lastname}}</h5>
                                                            <p class="date">{{$revw->created_at}}</p>
                                                            <div class="review-rating">
                                                                <?php
                                                                    $rated = floor($revw->rating);
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
                                                        </div>
                                                        <div class="review-body">
                                                            <p style="text-align: center;">{{$revw->comment}}</p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <ul class="reviews-pagination">
                                                {{$review->links('partials.review_pagination')}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
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
