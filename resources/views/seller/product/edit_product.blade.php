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
                        <h1 style="text-align: center;" class="page-title">{{ __('Update this Product') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{URL::to('/update/product/'.$product->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="productid">{{ __('Product ID:') }}</label>
                                        <input id="productid" type="text" class="form-control @error('productid') is-invalid @enderror" name="productid" placeholder="Please enter the product id" value="{{ $product->productid }}" required autocomplete="productid" autofocus>
                                        @error('productid')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="productname">{{ __('Product Name:') }}</label>
                                        <input id="productname" type="text" class="form-control @error('productname') is-invalid @enderror" name="productname" placeholder="Please enter the product name" value="{{ $product->productname }}" required autocomplete="productname" autofocus>
                                        @error('productname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="productmodel">{{ __('Product Model:') }}</label>
                                        <input id="productmodel" type="text" class="form-control @error('productmodel') is-invalid @enderror" name="productmodel" placeholder="Please enter the product model" value="{{ $product->productmodel }}" required autocomplete="productmodel" autofocus>
                                        @error('productmodel')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="brand">{{ __('Select Brand:') }}</label>
                                        <select id="brand" name="brand" class="selectpicker @error('brand') is-invalid @enderror" required>
                                            <option disabled selected>Nothing selected</option>
                                            @foreach($brand as $brnd)
                                                <option value="{{$brnd->id}}">{{$brnd->brandname}}</option>
                                            @endforeach
                                        </select>
                                        @error('brand')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="category">{{ __('Select Category:') }}</label>
                                        <select id="category" name="category" class="selectpicker @error('category') is-invalid @enderror" required>
                                            <option disabled selected>Nothing selected</option>
                                            @foreach($category as $ctgry)
                                                <option value="{{$ctgry->id}}">{{$ctgry->categoryname}}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="productcolor">{{ __('Product Color:') }}</label>
                                        <input id="productcolor" type="text" class="form-control @error('productcolor') is-invalid @enderror" name="productcolor" placeholder="Please enter the product color" value="{{ $product->productcolor }}" required autocomplete="productcolor" autofocus>
                                        @error('productcolor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="shop">{{ __('Select Shop:') }}</label>
                                        <select id="shop" name="shop" class="selectpicker @error('shop') is-invalid @enderror" required>
                                            <option disabled selected>Nothing selected</option>
                                            @foreach($shop as $shp)
                                                <option value="{{$shp->id}}">{{$shp->shopname}}</option>
                                            @endforeach
                                        </select>
                                        @error('shop')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="coverimage">{{ __('Cover Image (Optional):') }}</label>
                                        <input id="coverimage" type="file" class="dropify @error('coverimage') is-invalid @enderror" data-height="150" name="coverimage">
                                        <input type="hidden" name="old_image" value="{{$product->coverimage}}">
                                        @error('coverimage')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="otherimages">{{ __('Other Images (Optional):') }}</label>
                                        <br>
                                        <label>{{ __('*Minimum 3 images are required*') }}</label>
                                        <input id="otherimages" type="file" class="dropify @error('otherimages') is-invalid @enderror" data-height="150" name="otherimages[]" multiple>
                                        @foreach($product->otherimages as $othrimg)
                                            <input type="hidden" name="otherimages_id[]" value="{{$othrimg->id}}">
                                            <input type="hidden" name="old_otherimages[]" value="{{$othrimg->otherimage}}">
                                        @endforeach
                                        @error('otherimages')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="regularprice">{{ __('Regular Price:') }}</label>
                                        <input id="regularprice" type="text" class="form-control @error('regularprice') is-invalid @enderror" name="regularprice" placeholder="Please enter the regular price" value="{{ $product->regularprice }}" required autocomplete="regularprice" autofocus>
                                        @error('regularprice')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="discountedprice">{{ __('Discounted Price:') }}</label>
                                        <input id="discountedprice" type="text" class="form-control @error('discountedprice') is-invalid @enderror" name="discountedprice" placeholder="Please enter the discounted price" value="{{ $product->discountedprice }}" required autocomplete="discountedprice" autofocus>
                                        @error('discountedprice')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="productquantity">{{ __('Product Quantity:') }}</label>
                                        <input id="productquantity" type="text" class="form-control @error('productquantity') is-invalid @enderror" name="productquantity" placeholder="Please enter the product quantity" value="{{ $product->productquantity }}" required autocomplete="productquantity" autofocus>
                                        @error('productquantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="productdescription">{{ __('Product Description:') }}</label>
                                        <textarea class="form-control p-input @error('productdescription') is-invalid @enderror" id="productdescription" type="text" rows="5" name="productdescription" placeholder="Please enter the product description" required autocomplete="productdescription" autofocus>{{ $product->productdescription }}</textarea>
                                        @error('productdescription')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-success mr-2">{{ __('Update') }}</button>
                                        <a class="btn btn-outline-danger" href="{{ route('all.product') }}">{{ __('Cancel') }}</a>
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

@section('scripts')
<script>
    var limit = 3;
    $(document).ready(function(){
        $('#otherimages').change(function(){
            var files = $(this)[0].files;
            if(files.length < limit){
                alert("Minimum "+limit+" images are required.");
                $('#otherimages').val('');
                return false;
            }else{
                return true;
            }
        });
    });
</script>
@endsection
