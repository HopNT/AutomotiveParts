<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 10/29/2018
 * Time: 22:29
 */

use Illuminate\Support\Facades\Auth;

$staff = Auth::guard('admin')->user();
$can_add_quotation = $staff->can_view('quotation-create');
$can_edit_quotation = $staff->can_view('quotation-edit');
$can_delete_quotation = $staff->can_view('quotation-delete');
?>

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="form-group">
                    @if($can_add_quotation && $staff->user_type == 1)
                        <button onclick="window.location='{{route('quotation-create')}}'" class="btn btn-primary"><i
                                class="fa fa-plus"></i>&nbsp;{{trans('label.button.create')}}</button>
                    @endif
                    @if($can_delete_quotation && $staff->user_type == 1)
                        <button class="btn btn-danger" type="button" id="btn_delete_multi_quotation"><i
                                class="fa fa-trash"></i>{{trans('label.button.delete')}}</button>
                    @endif
                </div>
                <table class="table table-responsive-md table-hover table-bordered" style="width: 100%;"
                       id="tbl_quotation">
                    <thead>
                    <tr>
                        @if($can_delete_quotation && $staff->user_type == 1)
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
                        @if($staff->user_type == 0)
                            <th class="text-center">{{trans('label.user.code')}}</th>
                            <th class="text-center">{{trans('label.user.name')}}</th>
                        @endif
                        <th class="text-center">{{trans('label.quotation.code')}}</th>
                        <th class="text-center">{{trans('label.common.created_at')}}</th>
                        {{--<th class="text-center">{{trans('label.common.updated_at')}}</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listQuotation as $key => $quotation)
                        <tr>
                            @if($can_delete_quotation && $staff->user_type == 1)
                                <td class="text-center">
                                    <div class="animated-checkbox">
                                        <label>
                                            <input type="checkbox" class="checkbox"
                                                   data-id="{{$quotation->quotation_id}}"><span
                                                class="label-text"></span>
                                        </label>
                                    </div>
                                </td>
                            @else
                                <td class="text-center">{{$key + 1}}</td>
                            @endif
                            @if($staff->user_type == 0)
                                <td>{{$quotation->user->code}}</td>
                                <td>{{$quotation->user->name}}</td>
                            @endif
                            <td>{{$quotation->code}}</td>
                            <td>{{date('d/m/Y H:i:s', strtotime($quotation->created_at))}}</td>
                            {{--<td>{{date('d/m/Y H:i:s', strtotime($quotation->updated_at))}}</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
