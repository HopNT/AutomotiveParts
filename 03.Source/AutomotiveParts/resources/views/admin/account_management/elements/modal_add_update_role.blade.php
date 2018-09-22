<div class="modal fade" id="modal_add_update_role" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i>&nbsp;{{trans('label.account.update')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" id="form_add_update_role" action="{{route('save-role')}}">
                    @csrf
                    <input type="hidden" name="role_id">
                    <div class="form-group row">
                        <label class="control-label required col-md-3">{{trans('label.account.role_name')}}</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" placeholder="{{trans('label.account.enter_role_name')}}" name="role_name" required>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3">{{trans('label.account.description')}}</label>
                        <div class="col-md-9">
                            <textarea class="form-control" rows="4" placeholder="{{trans('label.account.enter_description')}}" name="description"></textarea>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i>{{trans('label.button.cancel')}}</button>
                <button type="button" class="btn btn-primary" id="btn_save_role"><i class="fa fa-save"></i>{{trans('label.button.save')}}</button>
            </div>
        </div>
    </div>
</div>
