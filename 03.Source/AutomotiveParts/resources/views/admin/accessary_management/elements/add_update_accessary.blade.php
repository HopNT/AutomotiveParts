<?php
//    dd($data->type)
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
                    <form class="form-horizontal" method="POST" id="form-accessary"
                          action="{{route('accessary-save')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="accessary_id" value="@if($data){{$data->accessary_id}}@endif">
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

                        <fieldset class="row">
                            <legend class="col-md-12">Thông tin phụ tùng</legend>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="trademark"
                                                   class="control-label col-md-4">{{trans('label.accessary.trademark')}}</label>
                                            <div class="col-md-8">
                                                <div id="select-trademark">
                                                    <select class="form-control" name="trademark_id" id="trademark_id">
                                                        <option value="">
                                                            -- {{trans('label.common.choose')}} {{trans('label.accessary.trademark')}}
                                                            --
                                                        </option>
                                                        @foreach($tradeMarkList as $tradeMark)
                                                            <option value="{{ $tradeMark->trademark_id }}"
                                                                    @if($data && $tradeMark->trademark_id == $data->trademark_id) selected @endif>{{ $tradeMark->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="nation"
                                                   class="control-label col-md-4">{{trans('label.common.nation')}}</label>
                                            <div class="col-md-8">
                                                <div id="select-nation">
                                                    <select class="form-control" name="nation_id" id="nation_id">
                                                        <option value="">
                                                            -- {{trans('label.common.choose')}} {{trans('label.common.nation')}}
                                                            --
                                                        </option>
                                                        @foreach($listNation as $key => $nation)
                                                            <option value="{{ $nation->nation_id }}"
                                                                    @if ($data && $nation->nation_id == $data->nation_id)
                                                                    selected="selected"
                                                                @endif>{{ $nation->name_vi }}

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
                                            <label for="type"
                                                   class="control-label col-md-4">{{trans('label.accessary.type')}}</label>
                                            <div class="col-md-8">
                                                <select class="form-control" name="type" id="type">
                                                    @if($data)
                                                        <option value="">
                                                            {{trans('label.accessary.main')}}
                                                        </option>
                                                        <option value="0"
                                                                @if($data->type !== null && $data->type === 0) selected="selected" @endif>{{trans('label.accessary.oem')}}</option>
                                                        <option value="1"
                                                                @if($data->type !== null && $data->type === 1) selected="selected" @endif>{{trans('label.accessary.options')}}</option>
                                                    @else
                                                        <option value="">
                                                            {{trans('label.accessary.main')}}
                                                        </option>
                                                        <option value="0">{{trans('label.accessary.oem')}}</option>
                                                        <option value="1">{{trans('label.accessary.options')}}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="code"
                                                   class="control-label required col-md-4">{{trans('label.accessary.code')}}</label>
                                            <div class="col-md-8">
                                                <input class="form-control" name="code" id="code" maxlength="20"
                                                       value="@if($data) {{$data->code}} @endif"
                                                       placeholder="{{trans('label.common.input')}} {{trans('label.accessary.code')}}">
                                                <span class="text-danger" id="code_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="name_vi"
                                                   class="control-label required col-md-4">{{trans('label.nation.name_vi')}}</label>
                                            <div class="col-md-8">
                                                <input class="form-control" name="name_vi" id="name_vi" maxlength="100"
                                                       value="@if($data){{ $data->name_vi }}@endif"
                                                       placeholder="{{trans('label.common.input')}} {{trans('label.nation.name_vi')}}">
                                                <span class="text-danger" id="name_vi_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="name_en"
                                                   class="control-label col-md-4">{{trans('label.nation.name_en')}}</label>
                                            <div class="col-md-8">
                                                <input class="form-control" name="name_en" id="name_en" maxlength="100"
                                                       value="@if($data){{ $data->name_en }}@endif"
                                                       placeholder="{{trans('label.common.input')}} {{trans('label.nation.name_en')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="acronym_name"
                                                   class="control-label col-md-4">{{trans('label.accessary.acronym_name')}}</label>
                                            <div class="col-md-8">
                                                <input class="form-control" name="acronym_name" id="acronym_name"
                                                       maxlength="100" value="@if($data){{ $data->acronym_name }}@endif"
                                                       placeholder="{{trans('label.common.input')}} {{trans('label.accessary.acronym_name')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="unsigned_name"
                                                   class="control-label col-md-4">{{trans('label.accessary.unsigned_name')}}</label>
                                            <div class="col-md-8">
                                                <input class="form-control" name="unsigned_name" id="unsigned_name"
                                                       maxlength="100"
                                                       value="@if($data){{ $data->unsigned_name }}@endif"
                                                       placeholder="{{trans('label.common.input')}} {{trans('label.accessary.unsigned_name')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="price"
                                                   class="control-label required col-md-2">{{ trans('label.accessary.price') }}</label>
                                            <div class="col-md-10 input-group">
                                                <input class="form-control" type="text" name="price" maxlength="15"
                                                       placeholder="{{trans('label.common.input')}} {{trans('label.accessary.price')}}"
                                                       value="@if($data){{ $data->price }}@endif">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">VND</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="accessary_link"
                                                   class="control-label col-md-2">{{trans('label.accessary.accessary_link')}}</label>
                                            <div class="col-md-10">
                                                <select multiple class="form-control" id="accessary_link"
                                                        style="width: 100%"
                                                        name="accessary_link[]">
                                                    @if($list)
                                                        @foreach($list as $item)
                                                            <option value="{{ $item->code }}"
                                                                    selected="selected">{{ $item->code }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="accessary_link"
                                                   class="control-label col-md-2">{{trans('label.accessary.list_car')}}</label>
                                            <div class="col-md-10 input-group">
                                                <select multiple class="form-control" id="car_used"
                                                        name="car_used[]">
                                                    @if($carUsed)
                                                        @foreach($carUsed as $car)
                                                            <option value="{{ $car->car_id }}"
                                                                    selected="selected">{{ $car->name }}
                                                                - {{ $car->yearManufacture->year }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="parts"
                                                   class="control-label col-md-2">{{trans('label.car.parts')}}</label>
                                            <div class="input-group col-md-10">
                                                <select multiple class="form-control" id="parts" name="parts[]">
                                                    @if ($partsAccessary)
                                                        @foreach($partsAccessary as $item)
                                                            <option value="{{$item->catalog_parts_id}}"
                                                                    selected>{{$item->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="photo_top"
                                                   class="control-label col-md-2">{{trans('label.accessary.photo_top')}}</label>
                                            <div class="col-md-10">
                                                @if ($data && $data->photo_top != null && $data->photo_top != '')
                                                    <div class="input-group" id="photo_top_image_preview"
                                                         data-toggle="popover"
                                                         data-placement="top"
                                                         data-content="<img width='250' height='250' src='{{ url($data->photo_top) }}'/>">
                                                        <input type="text" class="form-control"
                                                               id="photo_top_image_preview_filename"
                                                               placeholder="{{trans('label.common.choose')}} {{trans('label.accessary.photo_top')}}"
                                                               value="{{ $data->photo_top_name }}">
                                                        <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger"
                                                            id="photo_top_image_preview_clear">
                                                        <span class="fa fa-trash"></span>{{trans('label.form.trash')}}
                                                    </button>
                                                    <div class="btn btn-primary image-preview-input">
                                                        <span class="fa fa-folder-open"></span>
                                                        <span
                                                            id="photo_top_image_preview_input_title">{{trans('label.form.change')}}</span>
                                                        <input type="file" accept="image/*" name="photo_top"/>
                                                    </div>
                                                </span>
                                                    </div>
                                                @else
                                                    <div class="input-group" id="photo_top_image_preview">
                                                        <input type="text" class="form-control"
                                                               id="photo_top_image_preview_filename"
                                                               placeholder="{{trans('label.common.choose')}} {{trans('label.accessary.photo_top')}}">
                                                        <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger"
                                                            id="photo_top_image_preview_clear"
                                                            style="display:none;">
                                                        <span class="fa fa-trash"></span>{{trans('label.form.trash')}}
                                                    </button>
                                                    <div class="btn btn-primary image-preview-input">
                                                        <span class="fa fa-folder-open"></span>
                                                        <span
                                                            id="photo_top_image_preview_input_title">{{trans('label.form.browser')}}</span>
                                                        <input type="file" accept="image/*" name="photo_top"/>
                                                    </div>
                                                </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="photo_bottom"
                                                   class="control-label col-md-2">{{trans('label.accessary.photo_bottom')}}</label>
                                            <div class="col-md-10">
                                                @if ($data && $data->photo_bottom != null && $data->photo_bottom != '')
                                                    <div class="input-group" id="photo_bottom_image_preview"
                                                         data-toggle="popover" data-placement="top"
                                                         data-content="<img width='250' height='250' src='{{ url($data->photo_bottom) }}'/>">
                                                        <input type="text" class="form-control"
                                                               id="photo_bottom_image_preview_filename"
                                                               value="{{ $data->photo_bottom_name }}"
                                                               placeholder="{{trans('label.common.choose')}} {{trans('label.accessary.photo_bottom')}}">
                                                        <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger"
                                                            id="photo_bottom_image_preview_clear">
                                                        <span class="fa fa-trash"></span>{{trans('label.form.trash')}}
                                                    </button>
                                                    <div class="btn btn-primary image-preview-input">
                                                        <span class="fa fa-folder-open"></span>
                                                        <span
                                                            id="photo_bottom_image_preview_input_title">{{trans('label.form.change')}}</span>
                                                        <input type="file" accept="image/*" name="photo_bottom"/>
                                                    </div>
                                                </span>
                                                    </div>
                                                @else
                                                    <div class="input-group" id="photo_bottom_image_preview">
                                                        <input type="text" class="form-control"
                                                               id="photo_bottom_image_preview_filename"
                                                               placeholder="{{trans('label.common.choose')}} {{trans('label.accessary.photo_bottom')}}">
                                                        <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger"
                                                            id="photo_bottom_image_preview_clear"
                                                            style="display:none;">
                                                        <span class="fa fa-trash"></span>{{trans('label.form.trash')}}
                                                    </button>
                                                    <div class="btn btn-primary image-preview-input">
                                                        <span class="fa fa-folder-open"></span>
                                                        <span
                                                            id="photo_bottom_image_preview_input_title">{{trans('label.form.browser')}}</span>
                                                        <input type="file" accept="image/*" name="photo_bottom"/>
                                                    </div>
                                                </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="photo_left"
                                                   class="control-label col-md-2">{{trans('label.accessary.photo_left')}}</label>
                                            <div class="col-md-10">
                                                @if ($data && $data->photo_left != null)
                                                    <div class="input-group" id="photo_left_image_preview"
                                                         data-toggle="popover"
                                                         data-placement="top"
                                                         data-content="<img width='250' height='250' src='{{ url($data->photo_left) }}'/>">
                                                        <input type="text" class="form-control"
                                                               id="photo_left_image_preview_filename"
                                                               value="{{ $data->photo_left_name }}"
                                                               placeholder="{{trans('label.common.choose')}} {{trans('label.accessary.photo_left')}}">
                                                        <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger"
                                                            id="photo_left_image_preview_clear">
                                                        <span class="fa fa-trash"></span>{{trans('label.form.trash')}}
                                                    </button>
                                                    <div class="btn btn-primary image-preview-input">
                                                        <span class="fa fa-folder-open"></span>
                                                        <span
                                                            id="photo_left_image_preview_input_title">{{trans('label.form.change')}}</span>
                                                        <input type="file" accept="image/*" name="photo_left"/>
                                                    </div>
                                                </span>
                                                    </div>
                                                @else
                                                    <div class="input-group" id="photo_left_image_preview">
                                                        <input type="text" class="form-control"
                                                               id="photo_left_image_preview_filename"
                                                               placeholder="{{trans('label.common.choose')}} {{trans('label.accessary.photo_left')}}">
                                                        <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger"
                                                            id="photo_left_image_preview_clear"
                                                            style="display:none;">
                                                        <span class="fa fa-trash"></span>{{trans('label.form.trash')}}
                                                    </button>
                                                    <div class="btn btn-primary image-preview-input">
                                                        <span class="fa fa-folder-open"></span>
                                                        <span
                                                            id="photo_left_image_preview_input_title">{{trans('label.form.browser')}}</span>
                                                        <input type="file" accept="image/*" name="photo_left"/>
                                                    </div>
                                                </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="photo_right"
                                                   class="control-label col-md-2">{{trans('label.accessary.photo_right')}}</label>
                                            <div class="col-md-10">
                                                @if ($data && $data->photo_right != null)
                                                    <div class="input-group" id="photo_right_image_preview"
                                                         data-toggle="popover" data-placement="top"
                                                         data-content="<img width='250' height='250' src='{{ url($data->photo_right) }}'/>">
                                                        <input type="text" class="form-control"
                                                               id="photo_right_image_preview_filename"
                                                               value="{{ $data->photo_right_name }}"
                                                               placeholder="{{trans('label.common.choose')}} {{trans('label.accessary.photo_right')}}">
                                                        <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger"
                                                            id="photo_right_image_preview_clear">
                                                        <span class="fa fa-trash"></span>{{trans('label.form.trash')}}
                                                    </button>
                                                    <div class="btn btn-primary image-preview-input">
                                                        <span class="fa fa-folder-open"></span>
                                                        <span
                                                            id="photo_right_image_preview_input_title">{{trans('label.form.change')}}</span>
                                                        <input type="file" accept="image/*" name="photo_right"/>
                                                    </div>
                                                </span>
                                                    </div>
                                                @else
                                                    <div class="input-group" id="photo_right_image_preview">
                                                        <input type="text" class="form-control"
                                                               id="photo_right_image_preview_filename"
                                                               placeholder="{{trans('label.common.choose')}} {{trans('label.accessary.photo_right')}}">
                                                        <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger"
                                                            id="photo_right_image_preview_clear"
                                                            style="display:none;">
                                                        <span class="fa fa-trash"></span>{{trans('label.form.trash')}}
                                                    </button>
                                                    <div class="btn btn-primary image-preview-input">
                                                        <span class="fa fa-folder-open"></span>
                                                        <span
                                                            id="photo_right_image_preview_input_title">{{trans('label.form.browser')}}</span>
                                                        <input type="file" accept="image/*" name="photo_right"/>
                                                    </div>
                                                </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="photo_inner"
                                                   class="control-label col-md-2">{{trans('label.accessary.photo_inner')}}</label>
                                            <div class="col-md-10">
                                                @if ($data && $data->photo_inner != null)
                                                    <div class="input-group" id="photo_inner_image_preview"
                                                         data-toggle="popover" data-placement="top"
                                                         data-content="<img width='250' height='250' src='{{ url($data->photo_inner) }}'/>">
                                                        <input type="text" class="form-control"
                                                               id="photo_inner_image_preview_filename"
                                                               value="{{ $data->photo_inner_name }}"
                                                               placeholder="{{trans('label.common.choose')}} {{trans('label.accessary.photo_inner')}}">
                                                        <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger"
                                                            id="photo_inner_image_preview_clear">
                                                        <span class="fa fa-trash"></span>{{trans('label.form.trash')}}
                                                    </button>
                                                    <div class="btn btn-primary image-preview-input">
                                                        <span class="fa fa-folder-open"></span>
                                                        <span
                                                            id="photo_inner_image_preview_input_title">{{trans('label.form.change')}}</span>
                                                        <input type="file" accept="image/*" name="photo_inner"/>
                                                    </div>
                                                </span>
                                                    </div>
                                                @else
                                                    <div class="input-group" id="photo_inner_image_preview">
                                                        <input type="text" class="form-control"
                                                               id="photo_inner_image_preview_filename"
                                                               placeholder="{{trans('label.common.choose')}} {{trans('label.accessary.photo_inner')}}">
                                                        <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger"
                                                            id="photo_inner_image_preview_clear"
                                                            style="display:none;">
                                                        <span class="fa fa-trash"></span>{{trans('label.form.trash')}}
                                                    </button>
                                                    <div class="btn btn-primary image-preview-input">
                                                        <span class="fa fa-folder-open"></span>
                                                        <span
                                                            id="photo_inner_image_preview_input_title">{{trans('label.form.browser')}}</span>
                                                        <input type="file" accept="image/*" name="photo_inner"/>
                                                    </div>
                                                </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="photo_outer"
                                                   class="control-label col-md-2">{{trans('label.accessary.photo_outer')}}</label>
                                            <div class="col-md-10">
                                                @if ($data && $data->photo_outer != null)
                                                    <div class="input-group" id="photo_outer_image_preview"
                                                         data-toggle="popover" data-placement="top"
                                                         data-content="<img width='250' height='250' src='{{ url($data->photo_outer) }}'/>">
                                                        <input type="text" class="form-control"
                                                               id="photo_outer_image_preview_filename"
                                                               value="{{ $data->photo_outer_name }}"
                                                               placeholder="{{trans('label.common.choose')}} {{trans('label.accessary.photo_outer')}}">
                                                        <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger"
                                                            id="photo_outer_image_preview_clear">
                                                        <span class="fa fa-trash"></span>{{trans('label.form.trash')}}
                                                    </button>
                                                    <div class="btn btn-primary image-preview-input">
                                                        <span class="fa fa-folder-open"></span>
                                                        <span
                                                            id="photo_outer_image_preview_input_title">{{trans('label.form.change')}}</span>
                                                        <input type="file" accept="image/*" name="photo_outer"/>
                                                    </div>
                                                </span>
                                                    </div>
                                                @else
                                                    <div class="input-group" id="photo_outer_image_preview">
                                                        <input type="text" class="form-control"
                                                               id="photo_outer_image_preview_filename"
                                                               placeholder="{{trans('label.common.choose')}} {{trans('label.accessary.photo_outer')}}">
                                                        <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger"
                                                            id="photo_outer_image_preview_clear"
                                                            style="display:none;">
                                                        <span class="fa fa-trash"></span>{{trans('label.form.trash')}}
                                                    </button>
                                                    <div class="btn btn-primary image-preview-input">
                                                        <span class="fa fa-folder-open"></span>
                                                        <span
                                                            id="photo_outer_image_preview_input_title">{{trans('label.form.browser')}}</span>
                                                        <input type="file" accept="image/*" name="photo_outer"/>
                                                    </div>
                                                </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="prioritize"
                                                   class="control-label col-md-2">{{trans('label.accessary.prioritize')}}</label>
                                            <div class="col-md-10">
                                                <div class="form-control">
                                                    <div class="animated-checkbox">
                                                        <label>
                                                            <input type="checkbox" class="checkbox" name="prioritize"
                                                                   @if ($data && $data->prioritize == 1) checked="checked" @endif><span
                                                                class="label-text"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="description"
                                                   class="control-label col-md-2">{{trans('label.common.description')}}</label>
                                            <div class="col-md-10">
                                                <textarea id="description"
                                                          name="description">@if($data){{ $data->description }}@endif</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($data)
                                    <div id="status" class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="status"
                                                       class="control-label col-md-2">{{trans('label.common.status')}}</label>
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
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="tile-footer">
                    <div class="form-group text-right">
                        <button onclick="window.location='{{route('accessary-management')}}'" type="button" class="btn btn-secondary"
                                id="btn_cancel_accessary"><i
                                class="fa fa-close"></i>{{trans('label.button.cancel')}}</button>
                        <button type="button" class="btn btn-primary" id="btn_save_accessary"><i
                                class="fa fa-save"></i>{{trans('label.button.save')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.car_management.elements.modal_add_update_car_brand')
@endsection
@section('javascript')
    <script type="text/javascript" src="{{ asset('admin/js/accessary_management/accessary_management.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/common/selector.ajax.js') }}"></script>
@endsection
