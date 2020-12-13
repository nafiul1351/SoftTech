@extends('seller.layouts.app')
@section('content')
    <div class="container-scroller">

        <!-- Navbar -->
        @include('seller.partials.navbar')

        <div class="container-fluid page-body-wrapper">
            <div class="row row-offcanvas row-offcanvas-right">

                <!-- Sidebar -->
                @include('seller.partials.sidebar')

                    <!-- Main -->
                    <div class="content-wrapper">
                        <h1 style="text-align: center;" class="page-title">{{ __('Update this Shop') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{URL::to('/update/shop/'.$shop->id)}}">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="serialnumber">{{ __('Serial Number:') }}</label>
                                        <input id="serialnumber" type="text" class="form-control @error('serialnumber') is-invalid @enderror" name="serialnumber" placeholder="Please enter the serial number" value="{{$shop->serialnumber}}" required autocomplete="serialnumber" autofocus>
                                        @error('serialnumber')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="shopname">{{ __('Shop Name:') }}</label>
                                        <input id="shopname" type="text" class="form-control @error('shopname') is-invalid @enderror" name="shopname" placeholder="Please enter the shop name" value="{{$shop->shopname}}" required autocomplete="shopname" autofocus>
                                        @error('shopname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-success mr-2">{{ __('Update') }}</button>
                                        <a class="btn btn-outline-danger" href="{{ route('all.shop') }}">{{ __('Cancel') }}</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <!-- Footer -->
                @include('seller.partials.footer')
        
            </div>
        </div>
    </div>
@endsection
