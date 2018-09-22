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
                <form class="form-horizontal" method="POST" id="form_add_update_user" action="{{route('save-user')}}">
                    @csrf
                    <input type="hidden" name="user_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label required col-md-4">{{trans('label.account.user_name')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" placeholder="{{trans('label.account.enter_user_name')}}" name="name" required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label required col-md-4">{{trans('label.account.birth_day')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="dob" name="birth_day" placeholder="{{trans('label.account.enter_dob')}}" required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label required col-md-4">{{trans('label.account.gender')}}</label>
                                <div class="col-md-8 animated-radio-button">
                                    <label>
                                        <input class="form-control" type="radio" name="gender" required value="{{\App\Http\Common\Enum\GlobalEnum::MALE}}"><span class="label-text">Nam</span>
                                    </label> &nbsp;&nbsp;&nbsp;
                                    <label>
                                        <input class="form-control" type="radio" name="gender" required value="{{\App\Http\Common\Enum\GlobalEnum::FEMALE}}"><span class="label-text">Nữ</span>
                                    </label>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label required col-md-4">{{trans('label.account.email')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="email" placeholder="{{trans('label.account.enter_email')}}" name="email" required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label required col-md-4">{{trans('label.account.phone')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" placeholder="{{trans('label.account.enter_phone')}}" name="phone_number" required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label required col-md-4">{{trans('label.account.role')}}</label>
                                <div class="col-md-8">
                                    {!! Form::select('role_id', ['1','2'], '1', ['class' => 'form-control required'])!!}
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-md-4">{{trans('label.account.fax')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" placeholder="{{trans('label.account.enter_fax')}}" name="fax">
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-4">{{trans('label.account.id_card')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" placeholder="{{trans('label.account.enter_id_card')}}" name="identify_card">
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-4">{{trans('label.account.drving_license')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" placeholder="{{trans('label.account.enter_driving_license')}}" name="drving_license">
                                    <span class="text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-4">{{trans('label.account.address')}}</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" rows="7" placeholder="{{trans('label.account.enter_address')}}" name="address"></textarea>
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
