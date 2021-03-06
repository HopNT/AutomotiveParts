<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/21/2018
 * Time: 10:24
 */
?>
<div class="modal fade" id="modal_add_update_catalog_parts" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="display: none;" id="title-add"><i
                        class="fa fa-plus"></i>&nbsp;&nbsp;{{trans('label.form.create')}}</h5>
                <h5 class="modal-title" style="display: none;" id="title-update"><i
                        class="fa fa-edit"></i>&nbsp;&nbsp;{{trans('label.form.update')}}</h5>
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
                <form class="form-horizontal" method="POST" id="form-catalog-parts"
                      action="{{route('catalog-parts-save')}}">
                    @csrf
                    <input type="hidden" name="catalog_parts_id">
                    <div class="form-group row">
                        <label for="name"
                               class="control-label col-md-3">{{trans('label.common.icon')}}</label>
                        <div class="col-md-9">
                            <div class="input-group" id="photo_image_preview">
                                <input type="text" class="form-control" id="photo_image_preview_filename"
                                       placeholder="{{trans('label.common.choose')}} {{trans('label.common.icon')}}">
                                <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger"
                                                    id="photo_image_preview_clear"
                                                    style="display:none;">
                                                <span class="fa fa-trash"></span>{{trans('label.form.trash')}}
                                            </button>
                                            <div class="btn btn-primary image-preview-input">
                                                <span class="fa fa-folder-open"></span>
                                                <span
                                                    id="photo_image_preview_input_title">{{trans('label.form.browser')}}</span>
                                                <input type="file" accept="image/*" name="photo"/>
                                            </div>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="code"
                               class="control-label required col-md-3">{{trans('label.catalog_parts.code')}}</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" maxlength="255"
                                   placeholder="{{trans('label.common.input')}} {{trans('label.catalog_parts.code')}}"
                                   name="code">
                            <span class="text-danger" id="code_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name"
                               class="control-label required col-md-3">{{trans('label.catalog_parts.name')}}</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" maxlength="255"
                                   placeholder="{{trans('label.common.input')}} {{trans('label.catalog_parts.name')}}"
                                   name="name">
                            <span class="text-danger" id="name_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="parent_id"
                               class="control-label col-md-3">{{trans('label.catalog_parts.parent_id')}}</label>
                        <div class="col-md-9">
                            <select class="form-control" name="parent_id" style="width: 100%;"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3">{{trans('label.common.description')}}</label>
                        <div class="col-md-9">
                            <textarea id="description" class="form-control" rows="4"
                                      placeholder="{{trans('label.common.input')}} {{trans('label.common.description')}}"
                                      name="description"></textarea>
                        </div>
                    </div>
                    <div id="status" class="form-group row">
                        <label class="control-label col-md-3">{{trans('label.common.status')}}</label>
                        <div class="col-md-9">
                            <select class="form-control" name="status">
                                <option value="0">{{trans('label.common.status_inactive')}}</option>
                                <option value="1">{{trans('label.common.status_active')}}</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_cancel_catalog_parts"><i
                        class="fa fa-close"></i>{{trans('label.button.cancel')}}</button>
                <button type="button" class="btn btn-primary" id="btn_save_catalog_parts"><i
                        class="fa fa-save"></i>{{trans('label.button.save')}}</button>
            </div>
        </div>
    </div>
</div>

