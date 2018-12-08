<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 12/08/2018
 * Time: 18:03
 */

//dd($listYear)
?>

@extends('layouts.admin_layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div id="alert_error" class="alert alert-danger collapse" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <strong id="message_error"></strong>
                    </div>
                    <form class="form-horizontal" method="POST" id="form-car"
                          action="{{route('car-save')}}">
                        @csrf
                        <input type="hidden" name="car_id" value="{{$data ? $data->car_id : ''}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="car_brand"
                                           class="control-label col-md-4">{{trans('label.car.brand')}}</label>
                                    <div class="col-md-8">
                                        <div id="select-car-brand">
                                            <select class="form-control" name="car_brand_id" id="car_brand_id">
                                                <option value>
                                                    -- {{trans('label.common.choose')}} {{trans('label.catalog_car.brand')}}
                                                    --
                                                </option>
                                                @foreach($carBrandList as $carBrand)
                                                    <option
                                                        value="{{$carBrand->car_brand_id}}" @if($data && $data->catalogCar->carBrand->car_brand_id == $carBrand->car_brand_id) selected @endif>{{$carBrand->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="catalog_car"
                                           class="control-label required col-md-4">{{trans('label.car.catalog')}}</label>
                                    <div class="col-md-8">
                                        <div id="select-catalog-car">
                                            <select id="catalog_car_id" class="form-control" name="catalog_car_id">
                                                <option value="">
                                                    -- {{trans('label.common.choose')}} {{trans('label.car.catalog')}}
                                                    --
                                                </option>
                                                @if($data)
                                                    @foreach($catalogCarList as $catalogCar)
                                                        <option value="{{ $catalogCar->catalog_car_id }}"
                                                                @if($data->catalogCar->catalog_car_id == $catalogCar->catalog_car_id) selected @endif>{{ $catalogCar->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <span class="text-danger" id="catalog_car_id_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="car_manufacturer"
                                           class="control-label col-md-4">{{trans('label.car.car_manufacturer')}}</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="car_manufacturer_id">
                                            <option value="">
                                                -- {{trans('label.common.choose')}} {{trans('label.car.car_manufacturer')}}
                                                --
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="nation"
                                           class="control-label col-md-4">{{trans('label.car_brand.nation')}}</label>
                                    <div class="col-md-8">
                                        <div id="select-nation">
                                            <select class="form-control" name="nation_id">
                                                <option value="">
                                                    -- {{trans('label.common.choose')}} {{trans('label.car_brand.nation')}}
                                                    --
                                                </option>
                                                @foreach($listNation as $key => $nation)
                                                    <option value="{{ $nation->nation_id }}" @if($data && $data->nation->nation_id == $nation->nation_id) selected @endif>
                                                        {{ $nation->name_vi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="factory"
                                           class="control-label col-md-4">{{trans('label.car.factory')}}</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="factory_id">
                                            <option value="">
                                                -- {{trans('label.common.choose')}} {{trans('label.car.factory')}} --
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="year" class="control-label col-md-4">{{trans('label.car.year')}}</label>
                                    <div class="col-md-8">
                                        <div id="select-year-manufacture">
                                            <select class="form-control" name="year_manufacture_id"
                                                    id="year_manufacture_id">
                                                <option value="">
                                                    -- {{trans('label.common.choose')}} {{trans('label.car.year')}}
                                                    --
                                                </option>
                                                @foreach($listYear as $key => $year)
                                                    <option value="{{ $year->year_manufacture_id }}" @if($data && $data->year_manufacture_id == $year->year_manufacture_id) selected @endif>
                                                        {{ $year->year }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="name"
                                           class="control-label required col-md-4">{{trans('label.car.id')}}</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="code" maxlength="255" @if($data) disabled @endif;
                                               placeholder="{{trans('label.common.input')}} {{trans('label.car.id')}}" value="{{$data && $data->code ? $data->code : ''}}">
                                        <span class="text-danger" id="code_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="name"
                                           class="control-label required col-md-4">{{trans('label.car.name')}}</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="name" maxlength="255"
                                               placeholder="{{trans('label.common.input')}} {{trans('label.car.name')}}"
                                                value="{{$data && $data->name ? $data->name : ''}}">
                                        <span class="text-danger" id="name_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="motion_system"
                                           class="control-label col-md-4">{{trans('label.car.motion_system')}}</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="motion_system_id">
                                            <option value="">
                                                -- {{trans('label.common.choose')}} {{trans('label.car.motion_system')}}
                                                --
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="number_of_doors"
                                           class="control-label col-md-4">{{trans('label.car.num_of_doors')}}</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="number_of_doors" maxlength="2"
                                               value="{{$data && $data->number_of_doors ? $data->number_of_doors : ''}}"
                                               placeholder="{{trans('label.common.input')}} {{trans('label.car.num_of_doors')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($data)
                            <div class="row">
                                <div id="status" class="col-md-12">
                                    <div class="form-group row">
                                        <label class="control-label col-md-2">{{trans('label.common.status')}}</label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="status">
                                                <option value="0"
                                                        @if($data->status == 0) selected @endif>{{trans('label.common.status_inactive')}}</option>
                                                <option value="1"
                                                        @if($data->status==1) selected @endif>{{trans('label.common.status_active')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="description"
                                           class="control-label col-md-2">{{trans('label.common.description')}}</label>
                                    <div class="col-md-10">
                                <textarea class="form-control" name="description" rows="4"
                                          placeholder="{{trans('label.common.input')}} {{trans('label.common.description')}}">{{$data && $data->description ? $data->description : ''}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tile-footer">
                    <div class="form-group text-right">
                        <button onclick="window.location='{{route('car-management')}}'" type="button" class="btn btn-secondary" id="btn_cancel_car"><i
                                class="fa fa-close"></i>{{trans('label.button.cancel')}}</button>
                        <button type="button" class="btn btn-primary" id="btn_save_car"><i
                                class="fa fa-save"></i>{{trans('label.button.save')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript" src="{{asset('admin/js/car_management/car_management.js')}} "></script>
    <script type="text/javascript" src="{{asset('admin/js/car_management/car.js')}} "></script>
    <script type="text/javascript" src="{{asset('admin/js/common/selector.ajax.js')}}"></script>
@endsection
