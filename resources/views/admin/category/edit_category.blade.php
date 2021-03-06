@extends('admin.layouts.app')
@section('content')
    <div class="container-scroller">

        <!-- Navbar -->
        @include('admin.partials.navbar')

        <div class="container-fluid page-body-wrapper">
            <div class="row row-offcanvas row-offcanvas-right">

                <!-- Sidebar -->
                @include('admin.partials.sidebar')

                    <!-- Main -->
                    <div class="content-wrapper">
                        <h1 style="text-align: center;" class="page-title">{{ __('Update this Category') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{URL::to('/update/category/'.$category->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="serialnumber">{{ __('Serial Number:') }}</label>
                                        <input id="serialnumber" type="text" class="form-control @error('serialnumber') is-invalid @enderror" name="serialnumber" placeholder="Please enter the serial number" value="{{ $category->serialnumber }}" required autocomplete="serialnumber" autofocus>
                                        @error('serialnumber')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="categoryname">{{ __('Category Name:') }}</label>
                                        <input id="categoryname" type="text" class="form-control @error('categoryname') is-invalid @enderror" name="categoryname" placeholder="Please enter the category name" value="{{ $category->categoryname }}" required autocomplete="categoryname" autofocus>
                                        @error('categoryname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="categoryimage">{{ __('Category Image:') }}</label>
                                        <input id="categoryimage" type="file" class="dropify @error('categoryimage') is-invalid @enderror" name="categoryimage" data-height="150">
                                        <input type="hidden" name="old_image" value="{{$category->categoryimage}}">
                                        @error('categoryimage')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-success mr-2">{{ __('Update') }}</button>
                                        <a class="btn btn-outline-danger" href="{{ route('all.category') }}">{{ __('Cancel') }}</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <!-- Footer -->
                @include('admin.partials.footer')
        
            </div>
        </div>
    </div>
@endsection
