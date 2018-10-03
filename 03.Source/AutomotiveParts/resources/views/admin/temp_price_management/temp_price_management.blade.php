<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/02/2018
 * Time: 01:35
 */

use Illuminate\Support\Facades\Auth;

$user = Auth::guard('admin')->user();
$router_name = Route::currentRouteName();
$can_view = $user->can_view($router_name);
?>
@extends('layouts.admin_layout')

@section('content')
    @if($can_view)
        <div class="container">
            <div class="row justify-content-center">
                <div class="bs-component" style="width: 100%">
                    <div id="temp_price">
                        @include('admin.temp_price_management.elements.list_data_temp_price')
                    </div>
                </div>
            </div>
        </div>
    @else
        {{trans('label.common.dont_have_permission')}}
    @endif
@endsection
@section('javascript')
    <script type="text/javascript" src="{{ asset('admin/js/price_management/temp_price_management.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/common/selector.ajax.js') }}"></script>
@endsection
