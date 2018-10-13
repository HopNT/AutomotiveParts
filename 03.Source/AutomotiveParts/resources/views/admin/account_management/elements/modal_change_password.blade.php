<?php
    use App\Http\Common\Enum\GlobalEnum;
?>
<div class="modal fade" id="modal_change_pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i>&nbsp;{{trans('label.account.update')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" id="form_change_password" action="{{route('change_password')}}">
                    @csrf
                    <input type="hidden" name="user_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label required col-md-4">{{trans('label.account.old_pass')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="password" placeholder="{{trans('label.account.enter_old_pass')}}" name="old_password" required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label required col-md-4" style="padding-right: 0;">{{trans('label.account.new_pass')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="password" name="password" placeholder="{{trans('label.account.enter_new_pass')}}" required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label required col-md-4" style="padding-right: 0;">{{trans('label.account.re_new_pass')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="password" name="password_confirmation" placeholder="{{trans('label.account.confirm_new_pass')}}" required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i>{{trans('label.button.cancel')}}</button>
                <button type="button" class="btn btn-primary" id="btn_change_password"><i class="fa fa-save"></i>{{trans('label.button.save')}}</button>
            </div>
        </div>
    </div>
</div>
