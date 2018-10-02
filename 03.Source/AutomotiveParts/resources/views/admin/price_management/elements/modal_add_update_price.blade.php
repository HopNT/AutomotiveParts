<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 10/02/2018
 * Time: 01:30
 */
?>
<div class="modal fade" id="modal_add_update_price" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                <form class="form-horizontal" method="POST" id="form-price"
                      action="{{route('price-save')}}">
                    @csrf
                    <input type="hidden" name="user_accessary_id">
                    <div class="form-group row">
                        <label for="accessary_id"
                               class="control-label required col-md-3">{{trans('label.parts.accessary')}}</label>
                        <div class="col-md-9">
                            <select id="accessary_id" style="width: 100%;" class="form-control" name="accessary_id"></select>
                            <span class="text-danger" id="accessary_id_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="garage_price"
                               class="control-label col-md-3">{{trans('label.common.garage_price')}}</label>
                        <div class="col-md-9 input-group">
                            <input class="form-control" type="number" name="garage_price" placeholder="{{trans('label.common.input')}} {{trans('label.common.garage_price')}}">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">VND</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="retail_price"
                               class="control-label col-md-3">{{trans('label.common.retail_price')}}</label>
                        <div class="col-md-9 input-group">
                            <input class="form-control" type="number" name="retail_price" placeholder="{{trans('label.common.input')}} {{trans('label.common.retail_price')}}">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">VND</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="quantity"
                               class="control-label col-md-3">{{trans('label.common.quantity')}}</label>
                        <div class="col-md-9 input-group">
                            <input class="form-control" type="number" name="quantity" placeholder="{{trans('label.common.input')}} {{trans('label.common.quantity')}}">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_cancel_price"><i
                        class="fa fa-close"></i>{{trans('label.button.cancel')}}</button>
                <button type="button" class="btn btn-primary" id="btn_save_price"><i
                        class="fa fa-save"></i>{{trans('label.button.save')}}</button>
            </div>
        </div>
    </div>
</div>
