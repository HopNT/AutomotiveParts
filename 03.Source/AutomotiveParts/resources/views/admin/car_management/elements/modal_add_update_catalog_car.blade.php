 <?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/10/2018
 * Time: 10:08
 */
?>

<div class="modal fade" id="modal_add_update_catalog_car" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="display: none;" id="title-add"><i class="fa fa-plus"></i>&nbsp;&nbsp;{{trans('label.form.create')}}
                </h5>
                <h5 class="modal-title" style="display: none;" id="title-update"><i class="fa fa-edit"></i>&nbsp;&nbsp;{{trans('label.form.update')}}
                </h5>
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
                <form class="form-horizontal" method="POST" id="form-catalog-car-data"
                      action="{{route('catalog-car-save')}}">
                    @csrf
                    <input type="hidden" name="catalog_car_id">
                    <div class="form-group row">
                        <label for="car_brand_id"
                               class="control-label required col-md-3">{{trans('label.catalog_car.brand')}}</label>
                        <div class="col-md-9">
                            <div id="select-car-brand">
                                <select class="form-control" name="car_brand_id" id="car_brand_id">
                                    <option value="">-- {{trans('label.common.choose')}} {{trans('label.catalog_car.brand')}} --</option>
                                </select>
                            </div>
                            <span class="text-danger" id="car_brand_id_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name"
                               class="control-label required col-md-3">{{trans('label.catalog_car.name')}}</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="name"
                                   placeholder="{{trans('label.catalog_car.name')}}">
                            <span class="text-danger" id="name_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description"
                               class="control-label col-md-3">{{trans('label.common.description')}}</label>
                        <div class="col-md-9">
                            <textarea id="description" class="form-control" rows="4"
                                      placeholder="{{trans('label.common.input')}} {{trans('label.common.description')}}"
                                      name="description"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_cancel_catalog_car"><i
                        class="fa fa-close"></i>{{trans('label.button.cancel')}}</button>
                <button type="button" class="btn btn-primary" id="btn_save_catalog_car"><i
                        class="fa fa-save"></i>{{trans('label.button.save')}}</button>
            </div>
        </div>
    </div>
</div>
