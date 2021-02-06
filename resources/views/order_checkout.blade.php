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
                        <li class="active">{{ __('Order Checkout') }}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

    <!-- Order Checkout -->
    <div class="section">
        <div class="container">
            <form method="POST" action="{{ URL::to('/pay/order/'.$total) }}" id="ordrchckotfrm">
                @csrf

                <div class="row">
                    <div class="col-md-7">
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">{{ __('Billing Address') }}</h3>
                            </div>
                            <div class="form-group">
                                <input class="input @error('firstname') is-invalid @enderror" type="text" name="firstname" placeholder="Please enter the first name" value="{{Auth::user()->firstname}}">
                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="input @error('lastname') is-invalid @enderror" type="text" name="lastname" placeholder="Please enter the last name" value="{{Auth::user()->lastname}}">
                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="input @error('email') is-invalid @enderror" type="email" name="email" placeholder="Please enter the e-mail address" value="{{Auth::user()->email}}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="input @error('shippingaddress') is-invalid @enderror" type="text" name="shippingaddress" placeholder="Please enter the shipping address">
                                @error('shippingaddress')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="input @error('phonenumber') is-invalid @enderror" type="text" name="phonenumber" placeholder="Please enter the phone number" value="{{Auth::user()->phonenumber}}">
                                @error('phonenumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="order-notes">
                            <textarea class="input @error('note') is-invalid @enderror" name="note" placeholder="Please enter the order note (Optional)"></textarea>
                            @error('note')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-5 order-details">
                        <div class="section-title text-center">
                            <h3 class="title">{{ __('Your Order') }}</h3>
                        </div>
                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>{{ __('PRODUCT') }}</strong></div>
                                <div><strong>{{ __('TOTAL') }}</strong></div>
                            </div>
                            <div class="order-products">
                                @foreach(Auth::user()->carts as $crt)
                                    <div class="order-col">
                                        <div>{{$crt->quantity}}{{ __('x') }} {{ $crt->products->productname }}</div>
                                        <div>
                                            {{ __('BDT') }}
                                            <?php
                                                $quantity = $crt->quantity;
                                                $price = $crt->products->discountedprice;
                                                $new_price = $quantity * $price;
                                                echo $new_price;
                                            ?>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="order-col">
                                <?php
                                    $subtotal = array();
                                    foreach (Auth::user()->carts as $crt) {
                                        $quantity = $crt->quantity;
                                        $price = $crt->products->discountedprice;
                                        $new_price = $quantity * $price;
                                        array_push($subtotal, $new_price);
                                    }
                                    $total = array_sum($subtotal);
                                    if ($total > 10000) {
                                        echo "
                                            <div>Shiping Cost</div>
                                            <div><strong>FREE</strong></div>
                                        ";
                                    }
                                    else{
                                        echo "
                                            <div>Shiping Cost</div>
                                            <div><strong>BDT 200</strong></div>
                                        ";
                                    }
                                ?>
                            </div>
                            <div class="order-col">
                                <div><strong>{{ __('TOTAL') }}</strong></div>
                                <div>
                                    <strong class="order-total">
                                        {{ __('BDT') }}
                                        {{$total}}
                                    </strong>
                                </div>
                            </div>
                        </div>
                        <div class="payment-method">
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-1" value="COD">
                                <label for="payment-1">
                                    <span></span>
                                    {{ __('CASH ON DELIVERY') }}
                                </label>
                                <div class="caption">
                                    <p>{{ __('You have chosen our Cash On Delivery system as your payment method for these orders.') }}</p>
                                </div>
                            </div>
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-2" value="OP">
                                <label for="payment-2">
                                    <span></span>
                                    {{ __('ONLINE PAYMENT') }}
                                </label>
                                <div class="caption">
                                    <p>{{ __('You have chosen our Online Payment system as your payment method for these orders.') }}</p>
                                </div>
                            </div>
                        </div>
                        <button style="width: 100%;" class="primary-btn order-submit" onclick="event.preventDefault(); document.getElementById('ordrchckotfrm').submit()">{{ __('Place Order') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    @include('partials.frontend.footer')

@endsection
