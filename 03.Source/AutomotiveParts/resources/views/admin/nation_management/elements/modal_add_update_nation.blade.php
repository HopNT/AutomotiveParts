<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/17/2018
 * Time: 09:13
 */
?>
<div class="modal fade" id="modal_add_update_nation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="display: none;" id="title-add"><i class="fa fa-plus"></i>&nbsp;&nbsp;{{trans('label.form.create')}}</h5>
                <h5 class="modal-title" style="display: none;" id="title-update"><i class="fa fa-edit"></i>&nbsp;&nbsp;{{trans('label.form.update')}}</h5>
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
                <form class="form-horizontal" method="POST" id="form-nation"
                      action="{{route('nation-save')}}">
                    @csrf
                    <input type="hidden" name="nation_id">
                    <div class="form-group row">
                        <label for="code_brand"
                               class="control-label required col-md-3">{{trans('label.nation.code')}}</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text"
                                   placeholder="{{trans('label.common.input')}} {{trans('label.nation.code')}}"
                                   name="code">
                            <span class="text-danger" id="code_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name"
                               class="control-label col-md-3">{{trans('label.nation.name_vi')}}</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text"
                                   placeholder="{{trans('label.common.input')}} {{trans('label.nation.name_vi')}}"
                                   name="name_vi">
                            {{--<span class="text-danger" id="name_vi_error"></span>--}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nation" class="control-label col-md-3">{{trans('label.nation.name_en')}}</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text"
                                   placeholder="{{trans('label.common.input')}} {{trans('label.nation.name_en')}}"
                                   name="name_en">
                            {{--<span class="text-danger" id="name_en_error"></span>--}}
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_cancel_nation"><i
                        class="fa fa-close"></i>{{trans('label.button.cancel')}}</button>
                <button type="button" class="btn btn-primary" id="btn_save_nation"><i
                        class="fa fa-save"></i>{{trans('label.button.save')}}</button>
            </div>
        </div>
    </div>
</div>
