<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/07/2018
 * Time: 23:37
 */

use Illuminate\Support\Facades\Auth;

$staff = Auth::guard('admin')->user();
$can_add_accessary = $staff->can_view('accessary-save');
$can_edit_accessary = $staff->can_view('accessary-edit');
$can_delete_accessary = $staff->can_view('accessary-delete');
?>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="form-group">
                    @if($can_add_accessary)
                        <button onclick="window.location='{{route('accessary-create')}}'" class="btn btn-primary" type="button" id="btn_add_new_accessary"><i
                                class="fa fa-plus"></i>{{trans('label.button.create')}}</button>
                    @endif
                    @if($can_delete_accessary)
                        <button class="btn btn-danger" type="button" id="btn_delete_multi_accessary"><i
                                class="fa fa-trash"></i>{{trans('label.button.delete')}}</button>
                    @endif
                </div>
                <table class="table table-responsive-md table-hover table-bordered" style="width: 100%;"
                       id="tbl_accessary">
                    <thead>
                    <tr>
                        @if($can_delete_accessary)
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
                        <th class="text-center">{{trans('label.accessary.type')}}</th>
                        <th class="text-center">{{trans('label.accessary.code')}}</th>
                        <th class="text-center">{{trans('label.accessary.name')}}</th>
                        <th class="text-center">{{trans('label.common.status')}}</th>
                        <th class="text-center">{{trans('label.common.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listAccessary as $key => $accessary)
                        <tr>
                            @if($can_delete_accessary)
                                <td class="text-center">
                                    <div class="animated-checkbox">
                                        <label>
                                            <input type="checkbox" class="checkbox" @if($accessary->status === 0) disabled @endif
                                                   data-id="{{$accessary->accessary_id}}"><span
                                                class="label-text"></span>
                                        </label>
                                    </div>
                                </td>
                            @else
                                <td class="text-center">{{$key + 1}}</td>
                            @endif
                            <td>
                                @if($accessary->type !== null and $accessary->type === 0) {{trans('label.accessary.oem')}}
                                @elseif($accessary->type !== null and $accessary->type === 1) {{trans('label.accessary.options')}}
                                @else{{trans('label.accessary.genuine')}}
                                @endif
                            </td>
                            <td>{{$accessary->code}}</td>
                            <td>{{$accessary->name_vi}}</td>
                            <td>{{$accessary->status ? trans('label.common.status_active') : trans('label.common.status_inactive')}}</td>
                            <td class="text-center">
                                <button id="btn_view_car"
                                        href="{{route('car-used', ['id' => $accessary->accessary_id])}}"
                                        class="btn btn-info btn-sm fa fa-eye"></button>
                                @if($can_edit_accessary)
                                    <a id="btn_update_accessary"
                                            href="{{route('accessary-edit', ['id' => $accessary->accessary_id])}}"
                                            class="btn btn-info btn-sm fa fa-edit"></a>
                                @endif
                                @if($can_delete_accessary)
                                    <button id="btn_delete_accessary" @if($accessary->status === 0) disabled @endif
                                            href="{{route('accessary-delete', ['ids[]' => $accessary->accessary_id])}}"
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
@include('admin.accessary_management.elements.modal_add_update_accessary')
@include('admin.accessary_management.elements.modal_view_used_car')
