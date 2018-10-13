<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/02/2018
 * Time: 01:37
 */

use Illuminate\Support\Facades\Auth;

$staff = Auth::guard('admin')->user();
$userType = $staff->user_type;
$can_add_temp_price = $staff->can_view('temp-price-save');
$can_edit_temp_price = $staff->can_view('temp-price-edit');
$can_delete_temp_price = $staff->can_view('temp-price-delete');
$can_approve_temp_price = $staff->can_view('temp-price-approve');
$can_reject_temp_price = $staff->can_view('temp-price-reject');
?>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="form-group">
                    @if($userType == 1 && $can_add_temp_price)
                        <button class="btn btn-primary" type="button" id="btn_add_new_temp_price"><i
                                class="fa fa-plus"></i>{{trans('label.button.create')}}</button>
                    @endif
                    @if($userType == 1 && $can_delete_temp_price)
                        <button class="btn btn-danger" type="button" id="btn_delete_multi_temp_price"><i
                                class="fa fa-trash"></i>{{trans('label.button.delete')}}</button>
                    @endif
                    @if($userType == 0 && $can_approve_temp_price)
                        <button class="btn btn-primary" type="button" id="btn_approve_multi_temp_price"><i
                                class="fa fa-check"></i>{{trans('label.button.approve')}}</button>
                    @endif
                    @if($userType == 0 && $can_reject_temp_price)
                        <button class="btn btn-danger" type="button" id="btn_reject_multi_temp_price"><i
                                class="fa fa-ban"></i>{{trans('label.button.reject')}}</button>
                    @endif
                </div>
                <table class="table table-responsive-md table-hover table-bordered" style="width: 100%;"
                       id="tbl_temp_price">
                    <thead>
                    <tr>
                        @if($can_delete_temp_price || $can_approve_temp_price || $can_reject_temp_price)
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
                        @if($userType == 0)
                            <th class="text-center">{{trans('label.common.user')}}</th>
                        @endif
                        <th class="text-center">{{trans('label.accessary.code')}}</th>
                        <th class="text-center">{{trans('label.accessary.name')}}</th>
                        <th class="text-center">{{trans('label.common.garage_price')}}</th>
                        <th class="text-center">{{trans('label.common.retail_price')}}</th>
                        <th class="text-center">{{trans('label.common.quantity')}}</th>
                        <th class="text-center">{{trans('label.common.created_at')}}</th>
                        <th class="text-center">{{trans('label.common.approve_at')}}</th>
                        <th class="text-center">{{trans('label.common.reject_at')}}</th>
                        <th class="text-center">{{trans('label.common.status')}}</th>
                        <th class="text-center">{{trans('label.common.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listTempPrice as $key => $tempPrice)
                        <tr style="@if($tempPrice->status == 3) color: red; @elseif($tempPrice->status == 2) color: green; @elseif($tempPrice->status == 4) color: gray; @endif">
                            @if($can_delete_temp_price || $can_approve_temp_price || $can_reject_temp_price)
                                <td class="text-center">
                                    <div class="animated-checkbox">
                                        <label>
                                            <input type="checkbox" class="checkbox"
                                                   data-id="{{$tempPrice->temp_price_id}}"><span
                                                class="label-text"></span>
                                        </label>
                                    </div>
                                </td>
                            @else
                                <td class="text-center">{{$key + 1}}</td>
                            @endif
                            @if($userType == 0)
                                <td>
                                    <button id="btn_update_temp_price" class="btn btn-link" href="{{route('temp-price-edit', ['id' => $tempPrice->temp_price_id])}}">{{$tempPrice->user}}</button>
                                </td>
                            @endif
                            <td>{{$tempPrice->code}}</td>
                            <td>{{$tempPrice->name_vi}}</td>
                            <td class="text-right">{{$tempPrice->garage_price ? number_format($tempPrice->garage_price) : ''}}</td>
                            <td class="text-right">{{$tempPrice->garage_price ? number_format($tempPrice->retail_price) : ''}}</td>
                            <td class="text-right">{{$tempPrice->quantity}}</td>
                            <td>{{ date('d/m/Y H:i:s', strtotime($tempPrice->created_at)) }}</td>
                            @if($tempPrice->status == 2)
                                <td>{{ date('d/m/Y H:i:s', strtotime($tempPrice->updated_at)) }}</td>
                            @else
                                <td></td>
                            @endif
                            @if($tempPrice->status == 3)
                                <td>{{ date('d/m/Y H:i:s', strtotime($tempPrice->updated_at)) }}</td>
                            @else
                                <td></td>
                            @endif
                            @if($tempPrice->status == 2)
                                <td>{{trans('label.common.status_approve')}}</td>
                            @endif
                            @if($tempPrice->status == 3)
                                <td>{{trans('label.common.status_reject')}}</td>
                            @endif
                            @if($tempPrice->status == 4)
                                <td>{{trans('label.common.status_pending')}}</td>
                            @endif
                            <td class="text-center">
                                @if($userType == 1 && $can_edit_temp_price)
                                    <button id="btn_update_temp_price"
                                            href="{{route('temp-price-edit', ['id' => $tempPrice->temp_price_id])}}"
                                            class="btn btn-info btn-sm fa fa-edit"></button>
                                @endif
                                @if($userType == 1 && $can_delete_temp_price)
                                    <button id="btn_delete_temp_price"
                                            href="{{route('temp-price-delete', ['ids[]' => $tempPrice->temp_price_id])}}"
                                            class="btn btn-danger btn-sm fa fa-trash"></button>
                                @endif
                                @if($userType == 0 && $can_approve_temp_price)
                                    <button id="btn_approve_temp_price"
                                            href="{{route('temp-price-approve', ['ids[]' => $tempPrice->temp_price_id])}}"
                                            class="btn btn-info btn-sm fa fa-check"></button>
                                @endif
                                @if($userType == 0 && $can_reject_temp_price)
                                    <button id="btn_reject_temp_price"
                                            href="{{route('temp-price-reject', ['ids[]' => $tempPrice->temp_price_id])}}"
                                            class="btn btn-danger btn-sm fa fa-ban"></button>
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
@include('admin.temp_price_management.elements.modal_add_update_temp_price')
