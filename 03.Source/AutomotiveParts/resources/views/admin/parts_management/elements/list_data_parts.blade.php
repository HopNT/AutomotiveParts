<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/21/2018
 * Time: 10:24
 */

use Illuminate\Support\Facades\Auth;

$staff = Auth::guard('admin')->user();
$can_add_parts = $staff->can_view('parts-save');
$can_edit_parts = $staff->can_view('parts-get-by-id');
$can_delete_parts = $staff->can_view('parts-delete');
?>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="form-group">
                    @if($can_add_parts)
                        <button class="btn btn-primary" type="button" id="btn_add_new_parts"><i
                                class="fa fa-plus"></i>{{trans('label.button.create')}}</button>
                    @endif
                    @if($can_delete_parts)
                        <button class="btn btn-danger" type="button" id="btn_delete_multi_parts"><i
                                class="fa fa-trash"></i>{{trans('label.button.delete')}}</button>
                    @endif
                </div>
                <table class="table table-responsive-md table-hover table-bordered" style="width: 100%;"
                       id="tbl_parts">
                    <thead>
                    <tr>
                        @if($can_delete_parts)
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
                        <th class="text-center">{{trans('label.parts.catalog')}}</th>
                        <th class="text-center">{{trans('label.parts.code')}}</th>
                        <th class="text-center">{{trans('label.parts.name')}}</th>
                        <th class="text-center">{{trans('label.common.status')}}</th>
                        <th class="text-center">{{trans('label.common.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listParts as $key => $parts)
                        <tr>
                            @if($can_delete_parts)
                                <td class="text-center">
                                    <div class="animated-checkbox">
                                        <label>
                                            <input type="checkbox" class="checkbox"
                                                   data-id="{{$parts->parts_id}}"><span class="label-text"></span>
                                        </label>
                                    </div>
                                </td>
                            @else
                                <td class="text-center">{{$key + 1}}</td>
                            @endif
                            <td>{{$parts->catalogPartsName}}</td>
                            <td>{{$parts->code}}</td>
                            <td>{{$parts->name}}</td>
                            <td>{{$parts->status ? trans('label.common.status_active') : trans('label.common.status_inactive')}}</td>
                            <td class="text-center">
                                @if($can_edit_parts)
                                    <button id="btn_update_parts"
                                            href="{{route('parts-get-by-id', ['id' => $parts->parts_id])}}"
                                            class="btn btn-info btn-sm fa fa-edit"></button>
                                @endif
                                @if($can_delete_parts)
                                    <button id="btn_delete_parts"
                                            href="{{route('parts-delete', ['ids[]' => $parts->parts_id])}}"
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
@include('admin.parts_management.elements.modal_add_update_parts')
