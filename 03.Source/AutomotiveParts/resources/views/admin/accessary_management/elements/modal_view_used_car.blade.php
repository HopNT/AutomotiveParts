<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 11/10/2018
 * Time: 10:16
 */
?>
<div class="modal fade" id="modal_view_used_car" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Danh sách xe sử dụng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-responsive-md table-hover table-bordered" style="width: 100%;"
                        id="tbl_car_use">
                    <thead>
                        <tr>
                            <th class="text-center">{{trans('label.common.num_of_row')}}</th>
                            <th class="text-center">{{trans('label.car_brand.name')}}</th>
                            <th class="text-center">{{trans('label.catalog_car.name')}}</th>
                            <th class="text-center">{{trans('label.car.name')}}</th>
                            <th class="text-center">{{trans('label.car.year')}}</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
