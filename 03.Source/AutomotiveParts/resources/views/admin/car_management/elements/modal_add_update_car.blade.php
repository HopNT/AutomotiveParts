<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/13/2018
 * Time: 09:30
 */
?>

<div class="modal fade" id="modal_add_update_car" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form class="form-horizontal" method="POST" id="form-car"
                      action="{{route('car-save')}}">
                    @csrf
                    <input type="hidden" name="car_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="car_brand"
                                       class="control-label col-md-4">{{trans('label.car.brand')}}</label>
                                <div class="col-md-8">
                                    <div id="select-car-brand" >
                                        <select class="form-control" name="car_brand_id" id="car_brand_id">
                                            <option value="">-- {{trans('label.common.choose')}} {{trans('label.catalog_car.brand')}} --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="catalog_car"
                                       class="control-label required col-md-4">{{trans('label.car.catalog')}}</label>
                                <div class="col-md-8">
                                    <div id="select-catalog-car">
                                        <select id="catalog_car_id" class="form-control" name="catalog_car_id">
                                            <option value="">-- {{trans('label.common.choose')}} {{trans('label.car.catalog')}} --</option>
                                        </select>
                                    </div>
                                    <span class="text-danger" id="catalog_car_id_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="car_manufacturer"
                                       class="control-label col-md-4">{{trans('label.car.car_manufacturer')}}</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="car_manufacturer_id">
                                        <option value="">
                                            -- {{trans('label.common.choose')}} {{trans('label.car.car_manufacturer')}}
                                            --
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nation"
                                       class="control-label col-md-4">{{trans('label.car_brand.nation')}}</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="nation_id">
                                        <option value="">
                                            -- {{trans('label.common.choose')}} {{trans('label.car_brand.nation')}} --
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="factory"
                                       class="control-label col-md-4">{{trans('label.car.factory')}}</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="factory_id">
                                        <option value="">
                                            -- {{trans('label.common.choose')}} {{trans('label.car.factory')}} --
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="year" class="control-label col-md-4">{{trans('label.car.year')}}</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="year_manufacture_id">
                                        <option value="">-- {{trans('label.common.choose')}} {{trans('label.car.year')}}
                                            --
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="motion_system"
                                       class="control-label col-md-4">{{trans('label.car.motion_system')}}</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="motion_system_id">
                                        <option value="">
                                            -- {{trans('label.common.choose')}} {{trans('label.car.motion_system')}} --
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="name"
                                       class="control-label required col-md-4">{{trans('label.car.name')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="name"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.car.name')}}">
                                    <span class="text-danger" id="name_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="number_of_doors"
                                       class="control-label col-md-4">{{trans('label.car.num_of_doors')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="number" name="number_of_doors"
                                           placeholder="{{trans('label.common.input')}} {{trans('label.car.num_of_doors')}}">
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
                                <label for="parts" class="control-label col-md-2">{{trans('label.car.parts')}}</label>
                                <div class="col-md-10">
                                    <select class="form-control" id="parts" style="width: 100%" name="parts[]">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_cancel_car"><i
                        class="fa fa-close"></i>{{trans('label.button.cancel')}}</button>
                <button type="button" class="btn btn-primary" id="btn_save_car"><i
                        class="fa fa-save"></i>{{trans('label.button.save')}}</button>
            </div>
        </div>
    </div>
</div>
