<?php
//car-brand-save|car-brand-delete|car-brand-getById
$staff = \Illuminate\Support\Facades\Auth::guard('admin')->user();
$can_add_car_brand = $staff->can_view('car-brand-save');
$can_edit_car_brand = $staff->can_view('car-brand-getById');
$can_delete_car_brand = $staff->can_view('car-brand-delete');
?>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="form-group">
                    @if($can_add_car_brand)
                        <button class="btn btn-primary" type="button" id="btn_add_new_car_brand"><i
                                class="fa fa-plus"></i>{{trans('label.button.create')}}</button>
                    @endif
                    @if($can_delete_car_brand)
                        <button class="btn btn-danger" type="button" id="btn_delete_multi_car_brand"><i
                                class="fa fa-trash"></i>{{trans('label.button.delete')}}</button>
                    @endif
                </div>
                <table class="table table-responsive-md table-hover table-bordered" style="width: 100%"
                       id="tbl_car_brand">
                    <thead>
                    <tr>
                        @if($can_delete_car_brand)
                            <th class="text-center">
                                <div class="animated-checkbox">
                                    <label>
                                        <input type="checkbox" id="check_all"><span class="label-text"></span>
                                    </label>
                                </div>
                            </th>
                        @else
                            <th class="text-center">{{trans('label.common.num_of_row')}}</th>
                        @endif
                        <th class="text-center">{{trans('label.car_brand.code')}}</th>
                        <th class="text-center">{{trans('label.car_brand.name')}}</th>
                        <th class="text-center">{{trans('label.car_brand.nation')}}</th>
                        <th class="text-center">{{trans('label.common.status')}}</th>
                        <th class="text-center">{{trans('label.common.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listCarBrand as $key => $carBrand)
                        <tr>
                            @if($can_delete_car_brand)
                                <td class="text-center">
                                    <div class="animated-checkbox">
                                        <label>
                                            <input type="checkbox" @if($carBrand->status === 0) disabled @endif class="checkbox" data-id="{{$carBrand->car_brand_id}}"><span class="label-text"></span>
                                        </label>
                                    </div>
                                </td>
                            @else
                                <td class="text-center">{{$key + 1}}</td>
                            @endif
                            <td class="text-center">{{$carBrand->code_brand}}</td>
                            <td>{{$carBrand->name}}</td>
                            <td>{{$carBrand->name_vi}}</td>
                            <td>{{$carBrand->status === 1 ? trans('label.common.status_active') : trans('label.common.status_inactive')}}</td>
                            <td class="text-center">
                                @if($can_edit_car_brand)
                                    <button id="btn_update_car_brand"
                                            href="{{route('car-brand-getById', ['id' => $carBrand->car_brand_id])}}"
                                            class="btn btn-info btn-sm fa fa-edit"></button>
                                @endif
                                @if($can_delete_car_brand)
                                    <button id="btn_delete_car_brand" @if($carBrand->status === 0) disabled @endif
                                            href="{{route('car-brand-delete', ['ids[]' => $carBrand->car_brand_id])}}"
                                            class="btn btn-danger btn-sm fa fa-trash"></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.car_management.elements.modal_add_update_car_brand')
