<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/21/2018
 * Time: 10:23
 */
//catalog-car-save|catalog-car-delete|catalog-car-getById
$staff = \Illuminate\Support\Facades\Auth::guard('admin')->user();
$can_add_catalog_parts = $staff->can_view('catalog-parts-save');
$can_edit_catalog_parts = $staff->can_view('catalog-parts-getById');
$can_delete_catalog_parts = $staff->can_view('catalog-parts-delete');
?>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="form-group">
                    @if($can_add_catalog_parts)
                        <button class="btn btn-primary" type="button" id="btn_add_new_catalog_parts"><i
                                class="fa fa-plus"></i>{{trans('label.button.create')}}</button>
                    @endif
                    @if($can_delete_catalog_parts)
                        <button class="btn btn-danger" type="button" id="btn_delete_multi_catalog_parts"><i
                                class="fa fa-trash"></i>{{trans('label.button.delete')}}</button>
                    @endif
                </div>
                <table class="table table-responsive-md table-hover table-bordered" style="width: 100%;"
                       id="tbl_catalog_parts">
                    <thead>
                    <tr>
                        @if($can_delete_catalog_parts)
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
                        <th class="text-center">{{trans('label.catalog_parts.code')}}</th>
                        <th class="text-center">{{trans('label.catalog_parts.name')}}</th>
                        <th class="text-center">{{trans('label.common.status')}}</th>
                        <th class="text-center">{{trans('label.common.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listCatalogParts as $key => $catalogParts)
                        <tr>
                            @if($can_delete_catalog_parts)
                                <td class="text-center">
                                    <div class="animated-checkbox">
                                        <label>
                                            <input type="checkbox" class="checkbox" @if($catalogParts->status == 0) disabled @endif
                                                   data-id="{{$catalogParts->catalog_parts_id}}"><span class="label-text"></span>
                                        </label>
                                    </div>
                                </td>
                            @else
                                <td class="text-center">{{$key + 1}}</td>
                            @endif
                            <td>{{$catalogParts->code}}</td>
                            <td>{{$catalogParts->name}}</td>
                            <td>{{$catalogParts->status == 1 ? trans('label.common.status_active') : trans('label.common.status_inactive')}}</td>
                            <td class="text-center">
                                @if($can_edit_catalog_parts)
                                    <button id="btn_update_catalog_parts"
                                            href="{{route('catalog-parts-getById', ['id' => $catalogParts->catalog_parts_id])}}"
                                            class="btn btn-info btn-sm fa fa-edit"></button>
                                @endif
                                @if($can_delete_catalog_parts)
                                    <button id="btn_delete_catalog_parts"
                                            href="{{route('catalog-parts-delete', ['ids[]' => $catalogParts->catalog_parts_id])}}"
                                            class="btn btn-danger btn-sm fa fa-trash" @if($catalogParts->status == 0) disabled @endif></button>
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
@include('admin.parts_management.elements.modal_add_update_catalog_parts')
