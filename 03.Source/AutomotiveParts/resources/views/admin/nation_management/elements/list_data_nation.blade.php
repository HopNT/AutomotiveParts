<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/17/2018
 * Time: 09:13
 */
//nation-save|nation-getById|nation-delete
$staff = \Illuminate\Support\Facades\Auth::guard('admin')->user();
$can_add_nation = $staff->can_view('nation-save');
$can_edit_nation = $staff->can_view('nation-getById');
$can_delete_nation = $staff->can_view('nation-delete');
?>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="form-group">
                    @if($can_add_nation)
                        <button class="btn btn-primary" type="button" id="btn_add_new_nation"><i
                                class="fa fa-plus"></i>{{trans('label.button.create')}}</button>
                    @endif
                    @if($can_delete_nation)
                        <button class="btn btn-danger" type="button" id="btn_delete_multi_nation"><i
                                class="fa fa-trash"></i>{{trans('label.button.delete')}}</button>
                    @endif
                </div>
                <table class="table table-responsive-md table-hover table-bordered" style="width: 100%;"
                       id="tbl_nation">
                    <thead>
                    <tr>
                        @if($can_delete_nation)
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
                        <th class="text-center">{{trans('label.nation.code')}}</th>
                        <th class="text-center">{{trans('label.nation.name')}}</th>
                        <th class="text-center">{{trans('label.common.status')}}</th>
                        <th class="text-center">{{trans('label.common.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listNation as $key => $nation)
                        <tr>
                            @if($can_delete_nation)
                                <td class="text-center">
                                    <div class="animated-checkbox">
                                        <label>
                                            <input type="checkbox" class="checkbox"
                                                   data-id="{{$nation->nation_id}}"><span class="label-text"></span>
                                        </label>
                                    </div>
                                </td>
                            @else
                                <td class="text-center">{{$key + 1}}</td>
                            @endif
                            <td>{{$nation->code}}</td>
                            <td>{{$nation->name_vi}}<br>{{ $nation->name_en }}</td>
                            <td>{{$nation->status ? trans('label.common.status_active') : trans('label.common.status_inactive')}}</td>
                            <td class="text-center">
                                @if($can_edit_nation)
                                    <button id="btn_update_nation"
                                            href="{{route('nation-getById', ['id' => $nation->nation_id])}}"
                                            class="btn btn-info btn-sm fa fa-edit"></button>
                                @endif
                                @if($can_delete_nation)
                                    <button id="btn_delete_nation"
                                            href="{{route('nation-delete', ['ids[]' => $nation->nation_id])}}"
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
@include('admin.nation_management.elements.modal_add_update_nation')
