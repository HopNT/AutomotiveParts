<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/21/2018
 * Time: 10:23
 */

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
                                                href="#catalog_parts">{{trans('label.parts.catalog')}}</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                href="#parts">{{trans('label.parts.title')}}</a></li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="catalog_parts">
                            @include('admin.parts_management.elements.list_data_catalog_parts')
                        </div>
                        <div class="tab-pane fade" id="parts">
                            @include('admin.parts_management.elements.list_data_parts')
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
    <script type="text/javascript" src="{{asset('admin/js/common/selector.ajax.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/parts_management/parts_management.js')}} "></script>
    <script type="text/javascript" src="{{asset('admin/js/parts_management/catalog_parts.js')}} "></script>
    <script type="text/javascript" src="{{asset('admin/js/parts_management/parts.js')}} "></script>
@endsection
