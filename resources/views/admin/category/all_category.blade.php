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
                        <h1 style="text-align: center;" class="page-title">{{ __('All Categories') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                        <div class="col-12">
                                            <table id="order-listing" class="table table-striped" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Serial') }}</th>
                                                        <th>{{ __('Image') }}</th>
                                                        <th>{{ __('Name') }}</th>
                                                        <th>{{ __('Actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($category as $ctgry)
                                                        <tr>
                                                            <td>{{$ctgry->serialnumber}}</td>
                                                            <td>
                                                                <img style="height: 80px; width: 100px; border-radius: 5px;" src="{{asset($ctgry->categoryimage)}}">
                                                            </td>
                                                            <td>{{$ctgry->categoryname}}</td>
                                                            <td>
                                                                <a class="fa fa-edit" style="color: green; text-decoration: none; padding-right: 5px;" href="{{URL::to('/edit/category/'.$ctgry->id)}}"></a>
                                                                <a class="fa fa-trash" style="color: red; text-decoration: none; padding-left: 5px;" href="{{URL::to('/delete/category/'.$ctgry->id)}}" id="delete"></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- Footer -->
                @include('admin.partials.footer')
        
            </div>
        </div>
    </div>
@endsection
