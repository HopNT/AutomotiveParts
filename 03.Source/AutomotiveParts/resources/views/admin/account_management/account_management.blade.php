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
        <div class="container">
            <div class="row justify-content-center">
                <div class="bs-component" style="width: 100%">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#role">{{trans('label.account.role')}}</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#user">{{trans('label.account.user')}}</a></li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="role">
                            @include('admin.account_management.elements.list_data_role')
                        </div>
                        <div class="tab-pane fade" id="user">
                            @include('admin.account_management.elements.list_data_user')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{trans('label.common.dont_have_permission')}}
    @endif
@endsection
@section('javascript')
    <script type="text/javascript" src="{{asset('admin/js/account_management.js')}} "></script>
    <script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script>
    <script>
        $('#dob').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true
        });
    </script>
@endsection
