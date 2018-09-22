<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/19/2018
 * Time: 09:13
 */
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
$user = Auth::guard('admin')->user();
$router_name = Route::currentRouteName();
$can_view = $user->can_view($router_name);
?>
@extends('layouts.admin_layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="bs-component" style="width: 100%">
                <div id="trademark">
                    @include('admin.trademark_management.elements.list_data_trademark')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript" src="{{ asset('admin/js/trademark_management/trademark_management.js') }}"></script>
@endsection
