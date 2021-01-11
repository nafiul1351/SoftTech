<!-- Header -->
<header>
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left" style="color: white;">
                <li><i class="fa fa-phone"></i> {{ __('+8801953806556') }}</li>
                <li><i class="fa fa-envelope-o"></i> {{ __('nafiul1351@gmail.com') }}</li>
                <li><i class="fa fa-map-marker"></i> {{ __('Mirpur, Dhaka') }}</li>
            </ul>
            <ul class="header-links pull-right">
                @if (Route::has('login'))
                    @auth
                        <li><a href="{{ url('/home') }}"><i class="fa fa-user-o"></i> {{ __('Dashboard') }}</a></li>
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i>
                                 {{ __('Logout') }}
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}"><i class="fa fa-user-o"></i> {{ __('Login') }}</a></li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
    <div id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="{{ URL::to('/') }}" class="logo">
                                <img style="max-width: 200px; margin-top: 15px;" src="{{ asset('public/images/icon/logo.svg') }}" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="text-align: center;" class="header-search">
                            <form method="GET" action="{{ route('search.result') }}">
                                @csrf

                                <input style="border-radius: 20px 0px 0px 20px;" name="product" class="input" placeholder="Search here">
                                <button type="submit" class="search-btn">{{ __('Search') }}</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <div>
                                @auth
                                    <a href="{{ route('show.wishlist') }}">
                                        <i class="fa fa-heart-o"></i>
                                        <span>{{ __('Your Wishlist') }}</span>
                                        <div class="qty">{{Auth::user()->wishlists->count()}}</div>
                                    </a>
                                @else
                                    <a href="{{ route('show.wishlist') }}">
                                        <i class="fa fa-heart-o"></i>
                                        <span>{{ __('Your Wishlist') }}</span>
                                    </a>
                                @endif
                            </div>
                            <div class="dropdown">
                                @auth
                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>{{ __('Your Cart') }}</span>
                                        <div class="qty">{{Auth::user()->carts->count()}}</div>
                                    </a>
                                    <div class="cart-dropdown">
                                        
                                        <div class="cart-list">
                                            @foreach(Auth::user()->carts as $crt)
                                                <div class="product-widget">
                                                    <div class="product-img">
                                                        <img src="{{asset($crt->products->coverimage)}}" alt="">
                                                    </div>
                                                    <div class="product-body">
                                                        <h3 class="product-name"><a href="{{URL::to('/product/detail/'.$crt->products->id)}}">{{$crt->products->productname}}</a></h3>
                                                        <h4 class="product-price">
                                                            <span class="qty">{{$crt->quantity}}{{ __('x') }}</span>
                                                            {{ __('BDT') }}
                                                            <?php
                                                                $quantity = $crt->quantity;
                                                                $price = $crt->products->discountedprice;
                                                                $new_price = $quantity * $price;
                                                                echo $new_price;
                                                            ?>
                                                        </h4>
                                                    </div>
                                                    <a class="delete" href="{{URL::to('/remove/from/cart/'.$crt->products->id)}}"><i class="fa fa-close"></i></a>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        <div class="cart-summary">
                                            @if(Auth::user()->carts->count() > 0)
                                                <h5>{{ __('Total') }} {{$crt->count()}} {{ __('item(s) selected') }}</h5>
                                            @else
                                                <h5>{{ __('Total 0 item(s) selected') }}</h5>
                                            @endif
                                        </div>
                                        
                                        <div class="cart-btns">
                                            <a href="{{route('view.cart')}}">{{ __('View Cart') }}</a>
                                            <a href="{{route('order.checkout')}}">{{ __('Checkout') }}  <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                        
                                    </div>
                                @else
                                    <a href="{{ route('view.cart') }}">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>{{ __('Your Cart') }}</span>
                                    </a>
                                @endif
                            </div>
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>{{ __('Menu') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</header>

<!-- Navigation -->
<nav id="navigation">
    <div class="container">
        <div id="responsive-nav">
            <ul class="main-nav nav navbar-nav">
                <li class="active"><a href="{{ URL::to('/') }}">{{ __('Home') }}</a></li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#brand" aria-expanded="false" aria-controls="brand">
                        <span class="menu-title">{{ __('Brands') }}</span>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <div class="collapse" id="brand">
                        <ul class="nav flex-column sub-menu">
                            @foreach($brand as $brnd)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{URL::to('/product/for/brand/'.$brnd->id)}}">{{ $brnd->brandname }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                
                <li><a href="#">Store</a></li>
                <li><a href="#">Contact us</a></li>
            </ul>
        </div>
    </div>
</nav>