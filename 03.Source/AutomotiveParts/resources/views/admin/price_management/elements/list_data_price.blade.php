<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/02/2018
 * Time: 01:30
 */

use Illuminate\Support\Facades\Auth;

$staff = Auth::guard('admin')->user();
$can_add_price = $staff->can_view('price-save');
$can_edit_price = $staff->can_view('price-edit');
$can_delete_price = $staff->can_view('price-delete');
?>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="form-group">
                    @if($can_add_price)
                        <button class="btn btn-primary" type="button" id="btn_add_new_price"><i
                                class="fa fa-plus"></i>{{trans('label.button.create')}}</button>
                    @endif
                    @if($can_delete_price)
                        <button class="btn btn-danger" type="button" id="btn_delete_multi_price"><i
                                class="fa fa-trash"></i>{{trans('label.button.delete')}}</button>
                    @endif
                </div>
                <table class="table table-responsive-md table-hover table-bordered" style="width: 100%;"
                       id="tbl_price">
                    <thead>
                    <tr>
                        @if($can_delete_price)
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
                        @if($staff->role_id == 1)
                            <th class="text-center">{{trans('label.common.user')}}</th>
                        @endif
                        <th class="text-center">{{trans('label.accessary.code')}}</th>
                        <th class="text-center">{{trans('label.accessary.name')}}</th>
                        <th class="text-center">{{trans('label.common.garage_price')}}</th>
                        <th class="text-center">{{trans('label.common.retail_price')}}</th>
                        <th class="text-center">{{trans('label.common.quantity')}}</th>
                        <th class="text-center">{{trans('label.common.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listPrice as $key => $price)
                        <tr>
                            @if($can_delete_price)
                                <td class="text-center">
                                    <div class="animated-checkbox">
                                        <label>
                                            <input type="checkbox" class="checkbox"
                                                   data-id="{{$price->user_accessary_id}}"><span
                                                class="label-text"></span>
                                        </label>
                                    </div>
                                </td>
                            @else
                                <td class="text-center">{{$key + 1}}</td>
                            @endif
                            @if($staff->role_id == 1)
                                <td>{{$price->user}}</td>
                            @endif
                            <td>{{$price->code}}</td>
                            <td>{{$price->name_vi}}</td>
                            <td class="text-right">{{$price->garage_price}}</td>
                            <td class="text-right">{{$price->retail_price}}</td>
                            <td class="text-right">{{$price->quantity}}</td>
                            <td class="text-center">
                                @if($can_edit_price)
                                    <button id="btn_update_price"
                                            href="{{route('price-edit', ['id' => $price->user_accessary_id])}}"
                                            class="btn btn-info btn-sm fa fa-edit"></button>
                                @endif
                                @if($can_delete_price)
                                    <button id="btn_delete_price"
                                            href="{{route('price-delete', ['ids[]' => $price->user_accessary_id])}}"
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
@include('admin.price_management.elements.modal_add_update_price')
