<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/02/2018
 * Time: 01:30
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
        <div class="container">
            <div class="row justify-content-center">
                <div class="bs-component" style="width: 100%">
                    <div id="price">
                        @include('admin.price_management.elements.list_data_price')
                    </div>
                </div>
            </div>
        </div>
    @else
        {{trans('label.common.dont_have_permission')}}
    @endif
@endsection
@section('javascript')
    <script type="text/javascript" src="{{ asset('admin/js/price_management/price_management.js') }}"></script>
@endsection
