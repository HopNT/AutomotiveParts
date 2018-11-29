<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 11/29/2018
 * Time: 13:55
 */
?>

<div class="modal fade" id="modal_import_accessary" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-add"><i class="fa fa-file"></i>&nbsp;&nbsp;Import</h5>
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
                <form class="form-horizontal" method="POST" id="form_data"
                      action="#" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-primary">
                                    <i class="fa fa-folder-open"></i>{{trans('label.form.browser')}}&hellip;
                                    <input type="file" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" style="display: none;" multiple>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>