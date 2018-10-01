<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/19/2018
 * Time: 09:13
 */
//trademark-getById|trademark-delete|trademark-save
$staff = \Illuminate\Support\Facades\Auth::guard('admin')->user();
$can_add_trademark = $staff->can_view('trademark-save');
$can_edit_trademark = $staff->can_view('trademark-getById');
$can_delete_trademark = $staff->can_view('trademark-delete');
?>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="form-group">
                    @if($can_add_trademark)
                        <button class="btn btn-primary" type="button" id="btn_add_new_trademark"><i
                                class="fa fa-plus"></i>{{trans('label.button.create')}}</button>
                    @endif
                    @if($can_delete_trademark)
                        <button class="btn btn-danger" type="button" id="btn_delete_multi_trademark"><i
                                class="fa fa-trash"></i>{{trans('label.button.delete')}}</button>
                    @endif
                </div>
                <table class="table table-responsive-md table-hover table-bordered" style="width: 100%;"
                       id="tbl_trademark">
                    <thead>
                    <tr>
                        @if($can_delete_trademark)
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
                        <th class="text-center">{{trans('label.trade_mark.code')}}</th>
                        <th class="text-center">{{trans('label.trade_mark.name')}}</th>
                        <th class="text-center">{{trans('label.common.status')}}</th>
                        <th class="text-center">{{trans('label.common.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listTradeMark as $key => $tradeMark)
                        <tr>
                            @if($can_delete_trademark)
                                <td class="text-center">
                                    <div class="animated-checkbox">
                                        <label>
                                            <input type="checkbox" class="checkbox"
                                                   data-id="{{$tradeMark->trademark_id}}"><span class="label-text"></span>
                                        </label>
                                    </div>
                                </td>
                            @else
                                <td class="text-center">{{$key + 1}}</td>
                            @endif
                            <td>{{$tradeMark->code}}</td>
                            <td>{{$tradeMark->name}}</td>
                            <td>{{$tradeMark->status ? trans('label.common.status_active') : trans('label.common.status_inactive')}}</td>
                            <td class="text-center">
                                @if($can_edit_trademark)
                                    <button id="btn_update_trademark"
                                            href="{{route('trademark-getById', ['id' => $tradeMark->trademark_id])}}"
                                            class="btn btn-info btn-sm fa fa-edit"></button>
                                @endif
                                @if($can_delete_trademark)
                                    <button id="btn_delete_trademark"
                                            href="{{route('trademark-delete', ['ids[]' => $tradeMark->trademark_id])}}"
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
@include('admin.trademark_management.elements.modal_add_update_trademark')
