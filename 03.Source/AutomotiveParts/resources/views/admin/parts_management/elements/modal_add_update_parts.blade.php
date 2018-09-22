<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/21/2018
 * Time: 10:24
 */
?>
<div class="modal fade" id="modal_add_update_parts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <div id="alert_error" class="alert alert-danger d-none" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <strong id="message_error"></strong>
                </div>
                <form class="form-horizontal" method="POST" id="form-parts"
                      action="#">
                    @csrf
                    <input type="hidden" name="parts_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="catalog_parts"
                                       class="control-label required col-md-4">{{trans('label.parts.catalog')}}</label>
                                <div class="col-md-8">
                                    <div id="select-catalog-parts">
                                        <select class="form-control" name="catalog_parts_id" id="catalog_parts_id">
                                            <option value="">
                                                -- {{trans('label.common.choose')}} {{trans('label.parts.catalog')}} --
                                            </option>
                                        </select>
                                    </div>
                                    <span class="text-danger" id="catalog_parts_id_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="code"
                                       class="control-label required col-md-4">{{trans('label.parts.code')}}</label>
                                <div class="col-md-8">
                                    <input type="text" name="code" class="form-control"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.parts.code')}}">
                                    <span class="text-danger" id="code_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="name"
                                       class="control-label col-md-4">{{trans('label.parts.name')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="name"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.parts.name')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="width"
                                       class="control-label col-md-4">{{trans('label.parts.width')}}</label>
                                <div class="col-md-8">
                                    <input type="number" name="width" class="form-control" placeholder="{{trans('label.common.input')}} {{trans('label.parts.width')}}">
                                </div>
                            </div>
                        </div>
                        {{--<div class="col-md-6">--}}
                            {{--<div class="form-group row">--}}
                                {{--<label for="technique_picture"--}}
                                       {{--class="control-label col-md-4">{{trans('label.common.technique_picture')}}</label>--}}
                                {{--<div class="col-md-8">--}}
                                    {{--<div class="input-group">--}}
                                        {{--<span class="input-group-btn">--}}
                                        {{--<span class="btn btn-primary"--}}
                                              {{--onclick="$(this).parent().find('input[type=file]').click();">{{trans('label.common.choose')}}</span>--}}
                                            {{--<input name="file"--}}
                                                   {{--onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());"--}}
                                                   {{--style="display: none;" type="file" accept="image/*">--}}
                                        {{--</span>--}}
                                        {{--<span class="form-control"></span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="height"
                                       class="control-label col-md-4">{{trans('label.parts.height')}}</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="height"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.parts.height')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="number_of_tooth"
                                       class="control-label col-md-4">{{trans('label.parts.number_of_tooth')}}</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="number_of_tooth"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.parts.number_of_tooth')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inner_diameter"
                                       class="control-label col-md-4">{{trans('label.parts.inner_diameter')}}</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="inner_diameter"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.parts.inner_diameter')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="outer_diameter"
                                       class="control-label col-md-4">{{trans('label.parts.outer_diameter')}}</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="number_of_tooth"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.parts.outer_diameter')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="torque"
                                       class="control-label col-md-4">{{trans('label.parts.torque')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="torque"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.parts.torque')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="life_cycle"
                                       class="control-label col-md-4">{{trans('label.parts.life_cycle')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="life_cycle"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.parts.life_cycle')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="weight"
                                       class="control-label col-md-4">{{trans('label.parts.weight')}}</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="weight"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.parts.weight')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="liquor"
                                       class="control-label col-md-4">{{trans('label.parts.liquor')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="liquor"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.parts.liquor')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="description"
                                       class="control-label col-md-2">{{trans('label.common.description')}}</label>
                                <div class="col-md-10">
                                <textarea class="form-control" name="description" rows="4"
                                          placeholder="{{trans('label.common.input')}} {{trans('label.common.description')}}"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="technique_picture"
                                       class="control-label col-md-2">{{trans('label.common.technique_picture')}}</label>
                            </div>
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
