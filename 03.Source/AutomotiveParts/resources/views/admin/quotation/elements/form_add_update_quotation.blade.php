<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 10/29/2018
 * Time: 22:30
 */
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
                    <form class="form-horizontal" method="POST" id="form_quotation"
                          action="#" enctype="multipart/form-data">
                        <input type="hidden" name="quotation_id">
                        <fieldset class="form-group row">
                            <legend class="col-md-12">Thông tin xe</legend>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label
                                                class="control-label col-md-4">{{trans('label.car.brand')}}</label>
                                            <div class="input-group col-md-8">
                                                <select name="car_brand_id" id="car_brand_id" class="form-control">
                                                    <option value>
                                                        -- {{trans('label.common.choose')}} {{trans('label.catalog_car.brand')}}
                                                        --
                                                    </option>
                                                    @foreach($carBrandList as $carBrand)
                                                        <option
                                                            value="{{$carBrand->car_brand_id}}"
                                                            @if($car && $car->catalogCar->carBrand->car_brand_id == $carBrand->car_brand_id) selected @endif>{{$carBrand->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label
                                                class="control-label col-md-4">{{trans('label.car.catalog')}}</label>
                                            <div class="col-md-8">
                                                <div id="select-catalog-car" class="input-group">
                                                    <select id="catalog_car_id" class="form-control"
                                                            name="catalog_car_id">
                                                        <option value="">
                                                            -- {{trans('label.common.choose')}} {{trans('label.car.catalog')}}
                                                            --
                                                        </option>
                                                        @if($car)
                                                            @foreach($catalogCarList as $catalogCar)
                                                                <option value="{{ $catalogCar->catalog_car_id }}"
                                                                        @if($car->catalogCar->catalog_car_id == $catalogCar->catalog_car_id) selected @endif>{{ $catalogCar->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label
                                                class="control-label col-md-4">{{trans('label.car.grade')}}</label>
                                            <div class="col-md-8">
                                                <div id="select-car" class="input-group">
                                                    <select name="car_id" class="form-control" id="car_id">
                                                        <option value>
                                                            -- {{trans('label.common.choose')}} {{trans('label.car.grade')}}
                                                            --
                                                        </option>
                                                        @if($car)
                                                            @foreach($carList as $carItem)
                                                                <option value="{{ $carItem->car_id }}"
                                                                        @if($car->car_id == $carItem->car_id) selected @endif>{{ $carItem->name }}
                                                                    - {{ $carItem->year }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="form-group row">
                            <legend class="col-md-12">Danh sách phụ tùng</legend>
                            <div class="col-md-12">
                                <table class="table table-responsive-md table-hover table-bordered" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th class="text-center">{{trans('label.common.num_of_row')}}</th>
                                        <th class="text-center">{{trans('label.accessary.code')}}</th>
                                        <th class="text-center">{{trans('label.accessary.name')}}</th>
                                        <th class="text-center">{{trans('label.accessary.trademark')}}</th>
                                        <th class="text-center">{{trans('label.common.nation')}}</th>
                                        <th class="text-center">{{trans('label.common.quantity')}}</th>
                                        <th class="text-center">{{trans('label.common.retail_price')}}</th>
                                        <th class="text-center">{{trans('label.common.garage_price')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td><input class="form-control" name="code[]" placeholder="{{trans('label.accessary.code')}}"></td>
                                        <td><input class="form-control" name="name[]" placeholder="{{trans('label.accessary.name')}}"></td>
                                        <td>
                                            <select class="form-control" name="trademark_id[]">
                                                <option value>-- {{trans('label.accessary.trademark')}} --</option>
                                                @foreach($tradeMarkList as $tradeMark)
                                                    <option value="{{$tradeMark->trademark_id}}">{{$tradeMark->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" name="nation_id[]">
                                                <option value>-- {{trans('label.common.nation')}} --</option>
                                                @foreach($nationList as $nation)
                                                    <option value="{{$nation->nation_id}}">{{$nation->name_vi}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-right"><input type="number" name="quantity[]" class="form-control" placeholder="{{trans('label.common.quantity')}}"></td>
                                        <td class="text-right"><input type="number" name="retail_price[]" class="form-control" placeholder="{{trans('label.common.retail_price')}}"></td>
                                        <td class="text-right"><input type="number" name="garage_price[]" class="form-control" placeholder="{{trans('label.common.garage_price')}}"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript" src="{{ asset('admin/js/quotation/quotation_management.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/common/selector.ajax.js') }}"></script>
@endsection
