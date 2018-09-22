<?php
//$staff = \Illuminate\Support\Facades\Auth::guard('admin')->user();
//$can_add_catalog_car = $staff->can_view('catalog-car-save');
//$can_edit_catalog_car = $staff->can_view('catalog-car-getById');
//$can_delete_catalog_car = $staff->can_view('catalog-car-delete');
?>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="form-group">
                    <button class="btn btn-primary" type="button" id="btn_add_new_car"><i
                            class="fa fa-plus"></i>{{trans('label.button.create')}}</button>
                    <button class="btn btn-danger" type="button" id="btn_delete_multi_car"><i
                            class="fa fa-trash"></i>{{trans('label.button.delete')}}</button>
                </div>
                <table class="table table-responsive-md table-hover table-bordered" style="width: 100%;" id="tbl_car">
                    <thead>
                    <tr>
                        {{--                        <td class="text-center">{{trans('label.common.number')}}</td>--}}
                        <th class="text-center"><input type="checkbox" id="check_all"></th>
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
                            {{--<td class="text-center">{{$key + 1}}</td>--}}
                            <td class="text-center"><input type="checkbox" class="checkbox"
                                                           data-id="{{$car->car_id}}"></td>
                            <td>{{$car->carBrandName}}</td>
                            <td>{{$car->catalogCarName}}</td>
                            <td>{{$car->name}}</td>
                            <td class="text-right">{{$car->number_of_doors}}</td>
                            <td>{{$car->status ? trans('label.common.status_active') : trans('label.common.status_inactive')}}</td>
                            <td class="text-center">
                                <button id="btn_update_catalog_car"
                                        href="#"
                                        class="btn btn-info btn-sm fa fa-edit"></button>
                                <button id="btn_delete_catalog_car"
                                        href="#"
                                        class="btn btn-danger btn-sm fa fa-trash"></button>
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
