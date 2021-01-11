@extends('user.layouts.app')
@section('content')
    <div class="container-scroller">

        <!-- Navbar -->
        @include('user.partials.navbar')

        <div class="container-fluid page-body-wrapper">
            <div class="row row-offcanvas row-offcanvas-right">

                <!-- Sidebar -->
                @include('user.partials.sidebar')

                    <!-- Main -->
                    <div class="content-wrapper">
                        <h1 style="text-align: center;" class="page-title">{{ __('Order Details') }}</h1>
                        <div class="section">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-5 col-md-push-2">
                                        <div id="product-main-img">
                                            <div class="product-preview">
                                                <img src="{{asset($orderdetail->products->coverimage)}}" alt="">
                                            </div>
                                            @foreach($orderdetail->products->otherimages as $othrimgs)
                                                <div class="product-preview">
                                                    <img src="{{asset($othrimgs->otherimage)}}" alt="">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-2  col-md-pull-5">
                                        <div id="product-imgs">
                                            <div class="product-preview">
                                                <img src="{{asset($orderdetail->products->coverimage)}}" alt="">
                                            </div>
                                            @foreach($orderdetail->products->otherimages as $othrimgs)
                                                <div class="product-preview">
                                                    <img src="{{asset($othrimgs->otherimage)}}" alt="">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="product-details">
                                            <h2 class="product-name">{{$orderdetail->products->productname}}</h2>
                                            <div>
                                                <div class="product-rating">
                                                    <?php
                                                        $rated = floor($orderdetail->products->reviews->avg('rating'));
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
                                                <p>{{$orderdetail->products->reviews->count()}} {{ __('Review(s)') }}</p>
                                            </div>
                                            <div>
                                                <h3 class="product-price">{{ __('BDT') }} {{$orderdetail->products->discountedprice}} <del class="product-old-price">{{$orderdetail->products->regularprice}}</del></h3>
                                            </div>
                                            <p style="font-weight: bold;"><span>&#183;</span> {{ __('Shop:') }} {{$orderdetail->products->shops->shopname}}</p>
                                            <p style="font-weight: bold;"><span>&#183;</span> {{ __('Category:') }} {{$orderdetail->products->categories->categoryname}}</p>
                                            <p style="font-weight: bold;"><span>&#183;</span> {{ __('Brand:') }} {{$orderdetail->products->brands->brandname}}</p>
                                            <p style="font-weight: bold;"><span>&#183;</span> {{ __('Model:') }} {{$orderdetail->products->productmodel}}</p>
                                        </div>
                                        <div id="review-form">
                                            @if(!$orderdetail->reviews()->exists())
                                                <form class="review-form" method="POST" action="{{URL::to('/submit/review/'.$orderdetail->id)}}">
                                                    @csrf

                                                    @if($orderdetail->status == 'Delivered')
                                                        <textarea class="input" name="review" placeholder="Your Review"></textarea>
                                                        <div class="input-rating">
                                                            <span>{{ __('Your Rating: ') }}</span>
                                                            <div class="stars">
                                                                <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
                                                                <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
                                                                <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
                                                                <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
                                                                <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="primary-btn">{{ __('Submit') }}</button>
                                                    @elseif($orderdetail->status == 'Canceled')
                                                        <h4 style="color: #DA0024;">{{ __('Sorry, this order is canceled. You can not rate this product.') }}</h4>
                                                    @else
                                                        <h4 style="color: #DA0024;">{{ __('You can rate this product once the delivery is completed.') }}</h4>
                                                    @endif
                                                </form>
                                            @elseif($orderdetail->reviews()->exists())
                                                <h4 style="color: #DA0024;">{{ __('Your review for this order:') }}</h4>
                                                <div id="reviews">
                                                    <ul class="reviews">
                                                        <li>
                                                            <div class="review-heading">
                                                                <h5 class="name">{{$orderdetail->reviews->users->firstname}} {{$orderdetail->reviews->users->lastname}}</h5>
                                                                <p class="date">{{$orderdetail->reviews->created_at}}</p>
                                                                <div class="review-rating">
                                                                    <?php
                                                                        $rated = floor($orderdetail->reviews->rating);
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
                                                                <p style="text-align: center;">{{$orderdetail->reviews->comment}}</p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-7 mt-5">
                                        <div class="card">
                                            <div class="card-body">
                                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{ __('Order Info') }}</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('Product Info') }}</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="pills-tabContent">
                                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                        <p style="font-weight: bold;"><span>&#183;</span> {{ __('Date:') }} {{$orderdetail->created_at}}</p>
                                                        <p style="font-weight: bold;"><span>&#183;</span> {{ __('Order ID:') }} {{$orderdetail->id}}</p>
                                                        <p style="font-weight: bold;"><span>&#183;</span> {{ __('Transaction ID:') }} {{$orderdetail->orders->trx_id}}</p>
                                                        @if($orderdetail->orders->type == 'OP')
                                                            <p style="font-weight: bold;"><span>&#183;</span> {{ __('Method: Online Payment') }}</p>
                                                        @elseif($orderdetail->orders->type == 'COD')
                                                            <p style="font-weight: bold;"><span>&#183;</span> {{ __('Method: Cash on Delivery') }}</p>
                                                        @endif
                                                        <p style="font-weight: bold;"><span>&#183;</span> {{ __('Status:') }} {{$orderdetail->status}}</p>
                                                        <p style="font-weight: bold;"><span>&#183;</span> {{ __('Color:') }} {{$orderdetail->color}}</p>
                                                        <p style="font-weight: bold;"><span>&#183;</span> {{ __('Quantity:') }} {{$orderdetail->quantity}}</p>
                                                        <p style="font-weight: bold;"><span>&#183;</span> {{ __('Total:') }} {{$orderdetail->total}}</p>
                                                    </div>
                                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                        @foreach (explode(',', $orderdetail->products->productdescription) as $prdctdscrptn)
                                                            <p style="font-weight: bold;"><span>&#183;</span> {{ $prdctdscrptn }}</p>
                                                        @endforeach
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
                @include('user.partials.footer')
        
            </div>
        </div>
    </div>
@endsection
