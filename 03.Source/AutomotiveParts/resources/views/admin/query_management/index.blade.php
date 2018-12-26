<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/07/2018
 * Time: 23:37
 */

use Illuminate\Support\Facades\Auth;
$user = Auth::guard('admin')->user();
$router_name = Route::currentRouteName();
$can_view = $user->can_view($router_name);
$tabIndex = 0;
?>
@extends('layouts.admin_layout')

@section('content')
    @if($can_view)
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form id="frmRunSQL" role="form" method="post" action="{{route('run-sql')}}" onsubmit="return false">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::textarea('query', '', ['id'=>'query', 'tabindex' =>(++$tabIndex), 'class'=>'form-control', 'placeholder'=>"Nhập lệnh SQL"])}}
                                        <p class="text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" id="btn_run" class="btn btn-primary">
                                        <i class="fa fa-play-circle"></i>Run
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="alert-danger" id="error"></label>
                                <label class="alert-success" id="message"></label>
                                <div class="table-result" style="overflow: auto"></div>
                            </div>
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
    <script type="text/javascript" src="{{asset('admin/js/plugins/JSON-to-Table.min.1.0.0.js')}} "></script>
    <script type="text/javascript" src="{{asset('admin/js/query_management/query_management.js')}} "></script>
@endsection
