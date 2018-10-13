<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/05/2018
 * Time: 16:59
 */
?>
<div class="modal fade" id="modal_comment_temp_price" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-comment"><i
                        class="fa fa-comment"></i>&nbsp;&nbsp;{{trans('label.form.comment')}}</h5>
            </div>
            <div class="modal-body">
                <div id="alert_error" class="alert alert-danger collapse" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <strong id="message_error"></strong>
                </div>
                <form class="form-horizontal" method="POST" id="form-comment"
                      action="{{--{{route('temp-price-save')}}--}}">
                    @csrf
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_close_temp_price"><i
                        class="fa fa-close"></i>{{trans('label.button.cancel')}}</button>
                <button type="button" class="btn btn-danger" id="btn_reject_temp_price"><i
                        class="fa fa-ban"></i>{{trans('label.button.reject')}}</button>
            </div>
        </div>
    </div>
</div>
