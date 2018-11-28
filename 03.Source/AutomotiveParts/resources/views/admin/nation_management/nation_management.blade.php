<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/17/2018
 * Time: 09:12
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
                    <div id="nation">
                        @include('admin.nation_management.elements.list_data_nation')
                    </div>
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    @else
        {{trans('label.common.dont_have_permission')}}
    @endif
@endsection
@section('javascript')
    <script type="text/javascript" src="{{ asset('admin/js/nation_management/nation_management.js') }}"></script>
@endsection
