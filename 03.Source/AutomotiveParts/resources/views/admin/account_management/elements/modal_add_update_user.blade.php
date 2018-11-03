<?php
    use App\Http\Common\Enum\GlobalEnum;
?>
<div class="modal fade" id="modal_add_update_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i>&nbsp;{{trans('label.account.update')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" id="form_add_update_user" enctype="multipart/form-data" action="{{route('save-user')}}">
                    @csrf
                    <input type="hidden" name="user_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label required col-md-3">{{trans('label.account.user_name')}}</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" placeholder="{{trans('label.account.enter_user_name')}}" name="name" required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label required col-md-3" style="padding-right: 0;">{{trans('label.account.birth_day')}}</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" id="dob" name="birth_day" placeholder="{{trans('label.account.enter_dob')}}" required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label required col-md-3" style="padding-right: 0;">{{trans('label.account.gender')}}</label>

                                <div class="col-md-9">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="gender" id="gender_{{GlobalEnum::MALE}}" required value="{{GlobalEnum::MALE}}">
                                        <label class="custom-control-label" for="gender_{{GlobalEnum::MALE}}" >Nam</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="gender" id="gender_{{GlobalEnum::FEMALE}}" required value="{{GlobalEnum::FEMALE}}">
                                        <label class="custom-control-label" for="gender_{{GlobalEnum::FEMALE}}" >Nữ</label>
                                    </div>
                                    <br>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label required col-md-3">{{trans('label.account.email')}}</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="email" placeholder="{{trans('label.account.enter_email')}}" name="email" required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label required col-md-3">{{trans('label.account.phone')}}</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" placeholder="{{trans('label.account.enter_phone')}}" name="phone_number" required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label required col-md-3">{{trans('label.account.role')}}</label>
                                <div class="col-md-9">
                                    {!! Form::select('role_id', $data_role, '', ['class' => 'form-control required'])!!}
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label required col-md-3">{{trans('label.account.user_type')}}</label>
                                <div class="col-md-9">
                                    {!! Form::select('user_type', GlobalEnum::getAllUserType(), '', ['class' => 'form-control required'])!!}
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-md-3">{{trans('label.account.code')}}</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" placeholder="{{trans('label.account.enter_code')}}" name="code">
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">{{trans('label.account.fax')}}</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" placeholder="{{trans('label.account.enter_fax')}}" name="fax">
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">{{trans('label.account.id_card')}}</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" placeholder="{{trans('label.account.enter_id_card')}}" name="identify_card">
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">{{trans('label.account.drving_license')}}</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" placeholder="{{trans('label.account.enter_driving_license')}}" name="driving_license">
                                    <span class="text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">{{trans('label.account.address')}}</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" rows="6" placeholder="{{trans('label.account.enter_address')}}" name="address"></textarea>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i>{{trans('label.button.cancel')}}</button>
                <button type="button" class="btn btn-primary" id="btn_save_user"><i class="fa fa-save"></i>{{trans('label.button.save')}}</button>
            </div>
        </div>
    </div>
</div>
