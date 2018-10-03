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
?>
<div class="modal fade" id="modal_add_update_temp_price" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                @if($userType == 1)
                    <h5 class="modal-title" style="display: none;" id="title-add"><i
                            class="fa fa-plus"></i>&nbsp;&nbsp;{{trans('label.form.create')}}</h5>
                    <h5 class="modal-title" style="display: none;" id="title-update"><i
                            class="fa fa-edit"></i>&nbsp;&nbsp;{{trans('label.form.update')}}</h5>
                @else
                    <h5 class="modal-title" id="title-add"><i
                            class="fa fa-check"></i>&nbsp;&nbsp;{{trans('label.form.approve')}}</h5>
                @endif
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="alert_error" class="alert alert-danger collapse" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <strong id="message_error"></strong>
                </div>
                <form class="form-horizontal" method="POST" id="form-temp-price"
                      action="{{--{{route('price-save')}}--}}">
                    @csrf
                    <input type="hidden" name="temp_price_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="trademark"
                                       class="control-label col-md-4">{{trans('label.accessary.trademark')}}</label>
                                <div class="col-md-8">
                                    <div id="select-trademark">
                                        <select class="form-control" name="trademark_id" id="trademark_id">
                                            <option value="">
                                                -- {{trans('label.common.choose')}} {{trans('label.accessary.trademark')}}
                                                --
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nation"
                                       class="control-label col-md-4">{{trans('label.common.nation')}}</label>
                                <div class="col-md-8">
                                    <div id="select-nation">
                                        <select class="form-control" name="nation_id" id="nation_id">
                                            <option value="">
                                                -- {{trans('label.common.choose')}} {{trans('label.common.nation')}} --
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="code"
                                       class="control-label required col-md-4">{{trans('label.accessary.code')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="code" id="code"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.accessary.code')}}">
                                    <span class="text-danger" id="code_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="name_vi"
                                       class="control-label required col-md-4">{{trans('label.nation.name_vi')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="name_vi" id="name_vi"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.nation.name_vi')}}">
                                    <span class="text-danger" id="name_vi_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="name_en"
                                       class="control-label col-md-4">{{trans('label.nation.name_en')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="name_en" id="name_en"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.nation.name_en')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="acronym_name"
                                       class="control-label col-md-4">{{trans('label.accessary.acronym_name')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="acronym_name" id="acronym_name"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.accessary.acronym_name')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="unsigned_name"
                                       class="control-label col-md-4">{{trans('label.accessary.unsigned_name')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="unsigned_name" id="unsigned_name"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.accessary.unsigned_name')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="quantity"
                                       class="control-label col-md-4">{{trans('label.common.quantity')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="number" name="quantity"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.common.quantity')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="garage_price"
                                       class="control-label col-md-4">{{trans('label.common.garage_price')}}</label>
                                <div class="col-md-8 input-group">
                                    <input class="form-control" type="number" name="garage_price"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.common.garage_price')}}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">VND</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="retail_price"
                                       class="control-label col-md-4">{{trans('label.common.retail_price')}}</label>
                                <div class="col-md-8 input-group">
                                    <input class="form-control" type="number" name="retail_price"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.common.retail_price')}}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">VND</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="photo_top"
                                       class="control-label col-md-2">{{trans('label.accessary.photo_top')}}</label>
                                <div class="col-md-10">
                                    <div class="input-group" id="photo_top_image_preview">
                                        <input type="text" class="form-control" id="photo_top_image_preview_filename" placeholder="{{trans('label.common.choose')}} {{trans('label.accessary.photo_top')}}">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger" id="photo_top_image_preview_clear"
                                                    style="display:none;">
                                                <span class="fa fa-trash"></span>{{trans('label.form.trash')}}
                                            </button>
                                            <div class="btn btn-primary image-preview-input">
                                                <span class="fa fa-folder-open"></span>
                                                <span id="photo_top_image_preview_input_title">{{trans('label.form.browser')}}</span>
                                                <input type="file" accept="image/*" name="photo_top"/>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="photo_bottom"
                                       class="control-label col-md-2">{{trans('label.accessary.photo_bottom')}}</label>
                                <div class="col-md-10">
                                    <div class="input-group" id="photo_bottom_image_preview">
                                        <input type="text" class="form-control" id="photo_bottom_image_preview_filename" placeholder="{{trans('label.common.choose')}} {{trans('label.accessary.photo_bottom')}}">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger" id="photo_bottom_image_preview_clear"
                                                    style="display:none;">
                                                <span class="fa fa-trash"></span>{{trans('label.form.trash')}}
                                            </button>
                                            <div class="btn btn-primary image-preview-input">
                                                <span class="fa fa-folder-open"></span>
                                                <span id="photo_bottom_image_preview_input_title">{{trans('label.form.browser')}}</span>
                                                <input type="file" accept="image/*" name="photo_bottom"/>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="photo_left"
                                       class="control-label col-md-2">{{trans('label.accessary.photo_left')}}</label>
                                <div class="col-md-10">
                                    <div class="input-group" id="photo_left_image_preview">
                                        <input type="text" class="form-control" id="photo_left_image_preview_filename" placeholder="{{trans('label.common.choose')}} {{trans('label.accessary.photo_left')}}">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger" id="photo_left_image_preview_clear"
                                                    style="display:none;">
                                                <span class="fa fa-trash"></span>{{trans('label.form.trash')}}
                                            </button>
                                            <div class="btn btn-primary image-preview-input">
                                                <span class="fa fa-folder-open"></span>
                                                <span id="photo_left_image_preview_input_title">{{trans('label.form.browser')}}</span>
                                                <input type="file" accept="image/*" name="photo_left"/>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="photo_right"
                                       class="control-label col-md-2">{{trans('label.accessary.photo_right')}}</label>
                                <div class="col-md-10">
                                    <div class="input-group" id="photo_right_image_preview">
                                        <input type="text" class="form-control" id="photo_right_image_preview_filename" placeholder="{{trans('label.common.choose')}} {{trans('label.accessary.photo_right')}}">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger" id="photo_right_image_preview_clear"
                                                    style="display:none;">
                                                <span class="fa fa-trash"></span>{{trans('label.form.trash')}}
                                            </button>
                                            <div class="btn btn-primary image-preview-input">
                                                <span class="fa fa-folder-open"></span>
                                                <span id="photo_right_image_preview_input_title">{{trans('label.form.browser')}}</span>
                                                <input type="file" accept="image/*" name="photo_right"/>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="photo_inner"
                                       class="control-label col-md-2">{{trans('label.accessary.photo_inner')}}</label>
                                <div class="col-md-10">
                                    <div class="input-group" id="photo_inner_image_preview">
                                        <input type="text" class="form-control" id="photo_inner_image_preview_filename" placeholder="{{trans('label.common.choose')}} {{trans('label.accessary.photo_inner')}}">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger" id="photo_inner_image_preview_clear"
                                                    style="display:none;">
                                                <span class="fa fa-trash"></span>{{trans('label.form.trash')}}
                                            </button>
                                            <div class="btn btn-primary image-preview-input">
                                                <span class="fa fa-folder-open"></span>
                                                <span id="photo_inner_image_preview_input_title">{{trans('label.form.browser')}}</span>
                                                <input type="file" accept="image/*" name="photo_inner"/>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="photo_outer"
                                       class="control-label col-md-2">{{trans('label.accessary.photo_outer')}}</label>
                                <div class="col-md-10">
                                    <div class="input-group" id="photo_outer_image_preview">
                                        <input type="text" class="form-control" id="photo_outer_image_preview_filename" placeholder="{{trans('label.common.choose')}} {{trans('label.accessary.photo_outer')}}">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger" id="photo_outer_image_preview_clear"
                                                    style="display:none;">
                                                <span class="fa fa-trash"></span>{{trans('label.form.trash')}}
                                            </button>
                                            <div class="btn btn-primary image-preview-input">
                                                <span class="fa fa-folder-open"></span>
                                                <span id="photo_outer_image_preview_input_title">{{trans('label.form.browser')}}</span>
                                                <input type="file" accept="image/*" name="photo_outer"/>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                @if($userType == 1)
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_cancel_temp_price"><i
                            class="fa fa-close"></i>{{trans('label.button.cancel')}}</button>
                    <button type="button" class="btn btn-primary" id="btn_save_temp_price"><i
                            class="fa fa-save"></i>{{trans('label.button.save')}}</button>
                @endif
                @if($userType == 0)
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_close_temp_price"><i
                            class="fa fa-close"></i>{{trans('label.button.cancel')}}</button>
                    <button type="button" class="btn btn-danger" id="btn_reject_temp_price"><i
                            class="fa fa-ban"></i>{{trans('label.button.reject')}}</button>
                    <button type="button" class="btn btn-primary" id="btn_approve_temp_price"><i
                            class="fa fa-check"></i>{{trans('label.button.approve')}}</button>
                @endif
            </div>
        </div>
    </div>
</div>
