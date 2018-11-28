<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

$user = Auth::guard('admin')->user();
$router_name = Route::currentRouteName();
$can_view = $user->can_view($router_name);
?>
@extends('layouts.admin_layout')

@section('content')
    @if($can_view)
        {{--<div class="container">--}}
            {{--<div class="row justify-content-center">--}}
                {{--<div class="bs-component" style="width: 100%">--}}
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                                href="#car_brand">{{trans('label.car.brand')}}</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                href="#catalog_car">{{trans('label.car.catalog')}}</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                href="#car">{{trans('label.car.grade')}}</a></li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="car_brand">
                            @include('admin.car_management.elements.list_data_car_brand')
                        </div>
                        <div class="tab-pane fade" id="catalog_car">
                            @include('admin.car_management.elements.list_data_catalog_car')
                        </div>
                        <div class="tab-pane fade" id="car">
                            @include('admin.car_management.elements.list_data_car')
                        </div>
                    </div>
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    @else
        {{trans('label.common.dont_have_permission')}}
    @endif
@endsection
@section('javascript')
    <script type="text/javascript" src="{{asset('admin/js/car_management/car_management.js')}} "></script>
    <script type="text/javascript" src="{{asset('admin/js/car_management/car_brand.js')}} "></script>
    <script type="text/javascript" src="{{asset('admin/js/car_management/catalog_car.js')}} "></script>
    <script type="text/javascript" src="{{asset('admin/js/car_management/car.js')}} "></script>
    <script type="text/javascript" src="{{asset('admin/js/common/selector.ajax.js')}}"></script>
@endsection
