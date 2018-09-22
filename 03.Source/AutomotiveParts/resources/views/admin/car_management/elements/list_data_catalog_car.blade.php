<?php
//catalog-car-save|catalog-car-delete|catalog-car-getById
$staff = \Illuminate\Support\Facades\Auth::guard('admin')->user();
$can_add_catalog_car = $staff->can_view('catalog-car-save');
$can_edit_catalog_car = $staff->can_view('catalog-car-getById');
$can_delete_catalog_car = $staff->can_view('catalog-car-delete');
?>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="form-group">
                    @if($can_add_catalog_car)
                        <button class="btn btn-primary" type="button" id="btn_add_new_catalog_car"><i
                                class="fa fa-plus"></i>{{trans('label.button.create')}}</button>
                    @endif
                    @if($can_delete_catalog_car)
                        <button class="btn btn-danger" type="button" id="btn_delete_multi_catalog_car"><i
                                class="fa fa-trash"></i>{{trans('label.button.delete')}}</button>
                    @endif
                </div>
                <table class="table table-responsive-md table-hover table-bordered" style="width: 100%;"
                       id="tbl_catalog_car">
                    <thead>
                    <tr>
                        @if($can_delete_catalog_car)
                            <th class="text-center"><input type="checkbox" id="check_all"></th>
                        @else
                            <th class="text-center">{{trans('label.common.num_of_row')}}</th>
                        @endif
                        <th class="text-center">{{trans('label.car_brand.name')}}</th>
                        <th class="text-center">{{trans('label.catalog_car.name')}}</th>
                        <th class="text-center">{{trans('label.common.status')}}</th>
                        <th class="text-center">{{trans('label.common.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listCatalogCar as $key => $catalogCar)
                        <tr>
                            @if($can_delete_catalog_car)
                                <td class="text-center"><input type="checkbox" class="checkbox"
                                                               data-id="{{$catalogCar->catalog_car_id}}"></td>
                            @else
                                <td class="text-center">{{$key + 1}}</td>
                            @endif
                            <td>{{$catalogCar->carBrandName}}</td>
                            <td>{{$catalogCar->name}}</td>
                            <td>{{$catalogCar->status ? trans('label.common.status_active') : trans('label.common.status_inactive')}}</td>
                            <td class="text-center">
                                @if($can_edit_catalog_car)
                                    <button id="btn_update_catalog_car"
                                            href="{{route('catalog-car-getById', ['id' => $catalogCar->catalog_car_id])}}"
                                            class="btn btn-info btn-sm fa fa-edit"></button>
                                @endif
                                @if($can_delete_catalog_car)
                                    <button id="btn_delete_catalog_car"
                                            href="{{route('catalog-car-delete', ['ids[]' => $catalogCar->catalog_car_id])}}"
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
@include('admin.car_management.elements.modal_add_update_catalog_car')
