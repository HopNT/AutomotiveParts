<?php
//$staff = \Illuminate\Support\Facades\Auth::guard('admin')->user();
$staff = \Illuminate\Support\Facades\Auth::guard('admin')->user();
$can_add_car = $staff->can_view('car-save');
$can_edit_car = $staff->can_view('car-getById');
$can_delete_car = $staff->can_view('car-delete');
?>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="form-group">
                    @if($can_add_car)
                        <button class="btn btn-primary" type="button" id="btn_add_new_car"><i
                                class="fa fa-plus"></i>{{trans('label.button.create')}}</button>
                    @endif
                    @if($can_delete_car)
                        <button class="btn btn-danger" type="button" id="btn_delete_multi_car"><i
                                class="fa fa-trash"></i>{{trans('label.button.delete')}}</button>
                    @endif
                </div>
                <table class="table table-responsive-md table-hover table-bordered" style="width: 100%;" id="tbl_car">
                    <thead>
                    <tr>
                        @if($can_delete_car)
                            <th class="text-center"><input type="checkbox" id="check_all"></th>
                        @else
                            <th class="text-center">{{trans('label.common.num_of_row')}}</th>
                        @endif
                        <th class="text-center">{{trans('label.car_brand.name')}}</th>
                        <th class="text-center">{{trans('label.catalog_car.name')}}</th>
                        <th class="text-center">{{trans('label.car.name')}}</th>
                        <th class="text-center">{{trans('label.car.num_of_doors')}}</th>
                        <th class="text-center">{{trans('label.common.status')}}</th>
                        <th class="text-center">{{trans('label.common.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listCar as $key => $car)
                        <tr>
                            @if($can_delete_car)
                                <td class="text-center"><input type="checkbox" class="checkbox"
                                                               data-id="{{$car->car_id}}"></td>
                            @else
                                <td class="text-center">{{$key + 1}}</td>
                            @endif
                            <td>{{$car->carBrandName}}</td>
                            <td>{{$car->catalogCarName}}</td>
                            <td>{{$car->name}}</td>
                            <td class="text-right">{{$car->number_of_doors}}</td>
                            <td>{{$car->status ? trans('label.common.status_active') : trans('label.common.status_inactive')}}</td>
                            <td class="text-center">
                                @if($can_edit_car)
                                    <button id="btn_update_catalog_car"
                                            href="#"
                                            class="btn btn-info btn-sm fa fa-edit"></button>
                                @endif
                                @if($can_delete_car)
                                    <button id="btn_delete_catalog_car"
                                            href="#"
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
@include('admin.car_management.elements.modal_add_update_car')
