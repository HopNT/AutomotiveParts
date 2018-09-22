<?php
    $current_route = \Illuminate\Support\Facades\Route::currentRouteName();
?>

<div class="app-title">
    <div class="app-breadcrumb">
        <h1>{{trans('label.route.'.$current_route)}}</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="{{$current_route}}">{{trans('label.route.'.$current_route)}}</a></li>
    </ul>
</div>
