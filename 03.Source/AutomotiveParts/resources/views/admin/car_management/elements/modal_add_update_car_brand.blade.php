<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/06/2018
 * Time: 15:11
 */
?>

<div class="modal fade" id="modal_add_update_car_brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form class="form-horizontal" method="POST" id="form-car-brand"
                      action="{{route('car-brand-save')}}">
                    @csrf
                    <input type="hidden" name="car_brand_id">
                    <div class="form-group row">
                        <label for="code_brand"
                               class="control-label required col-md-3">{{trans('label.car_brand.code')}}</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text"
                                   placeholder="{{trans('label.common.input')}} {{trans('label.car_brand.code')}}"
                                   name="code_brand">
                            <span class="text-danger" id="code_brand_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name"
                               class="control-label required col-md-3">{{trans('label.car_brand.name')}}</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text"
                                   placeholder="{{trans('label.common.input')}} {{trans('label.car_brand.name')}}"
                                   name="name">
                            <span class="text-danger" id="name_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nation" class="control-label col-md-3">{{trans('label.car_brand.nation')}}</label>
                        <div class="col-md-9">
                            <select id="nation_id" name="nation_id" class="form-control">
                                <option value="">-- {{trans('label.common.choose')}} {{trans('label.car_brand.nation')}}
                                    --
                                </option>
                                @foreach($listNation as $nation)
                                    <option value="{{$nation->nation_id}}">{{$nation->name_vi}}</option>
                                @endforeach
                            </select>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_cancel_car_brand"><i
                        class="fa fa-close"></i>{{trans('label.button.cancel')}}</button>
                <button type="button" class="btn btn-primary" id="btn_save_car_brand"><i
                        class="fa fa-save"></i>{{trans('label.button.save')}}</button>
            </div>
        </div>
    </div>
</div>
