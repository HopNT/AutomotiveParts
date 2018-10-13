<?php
use App\Http\Common\Enum\GlobalEnum;
?>

@extends('layouts.admin_layout')

@section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="tile" style="width: 100%">
                    <form class="form-horizontal" method="POST" id="form_add_update_user" action="{{route('view_profile')}}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$user->user_id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label required col-md-3">{{trans('label.account.user_name')}}</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" placeholder="{{trans('label.account.enter_user_name')}}" name="name" value="{{$user->name}}" required>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label required col-md-3" style="padding-right: 0;">{{trans('label.account.birth_day')}}</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" id="dob" name="birth_day" placeholder="{{trans('label.account.enter_dob')}}" value="{{$user->birth_day}}" required>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label required col-md-3" style="padding-right: 0;">{{trans('label.account.gender')}}</label>

                                    <div class="col-md-9">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="gender" id="gender_{{GlobalEnum::MALE}}" required value="{{GlobalEnum::MALE}}" <?= $user->gender ? 'checked' : '' ?>>
                                            <label class="custom-control-label" for="gender_{{GlobalEnum::MALE}}" >Nam</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="gender" id="gender_{{GlobalEnum::FEMALE}}" required value="{{GlobalEnum::FEMALE}}" <?= !$user->gender ? 'checked' : '' ?>>
                                            <label class="custom-control-label" for="gender_{{GlobalEnum::FEMALE}}" >Nữ</label>
                                        </div>
                                        <br>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label required col-md-3">{{trans('label.account.email')}}</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="email" placeholder="{{trans('label.account.enter_email')}}" name="email" readonly value="{{$user->email}}">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label required col-md-3">{{trans('label.account.phone')}}</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" placeholder="{{trans('label.account.enter_phone')}}" name="phone_number" required value="{{$user->phone_number}}">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                {{--<div class="form-group row">--}}
                                    {{--<label class="control-label required col-md-3">{{trans('label.account.role')}}</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--{!! Form::select('role_id', $data_role, '', ['class' => 'form-control required'])!!}--}}
                                        {{--<span class="text-danger"></span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group row">--}}
                                    {{--<label class="control-label required col-md-3">{{trans('label.account.user_type')}}</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--{!! Form::select('user_type', GlobalEnum::getAllUserType(), '', ['class' => 'form-control required'])!!}--}}
                                        {{--<span class="text-danger"></span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label col-md-3">{{trans('label.account.fax')}}</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" placeholder="{{trans('label.account.enter_fax')}}" name="fax" value="{{$user->fax}}">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3">{{trans('label.account.id_card')}}</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" placeholder="{{trans('label.account.enter_id_card')}}" name="identify_card" value="{{$user->identify_card}}">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3">{{trans('label.account.drving_license')}}</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" placeholder="{{trans('label.account.enter_driving_license')}}" name="driving_license" value="{{$user->driving_license}}" >
                                        <span class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3">{{trans('label.account.address')}}</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="4" placeholder="{{trans('label.account.enter_address')}}" name="address">{{$user->address}}</textarea>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="float: right">
                                <button type="button" class="btn btn-primary" id="btn_save_user"><i class="fa fa-save"></i>{{trans('label.button.save')}}</button>
                                <button type="button" class="btn btn-primary" id="btn_change_pass"><i class="fa fa-key"></i>{{trans('label.button.change-pass')}}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        @include('admin.account_management.elements.modal_change_password')
@endsection
@section('javascript')
    <script type="text/javascript" src="{{asset('admin/js/account_management.js')}} "></script>
    <script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script>
    <script>
        $('#dob').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true
        });
    </script>
@endsection
