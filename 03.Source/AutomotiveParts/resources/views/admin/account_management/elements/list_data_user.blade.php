<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div style="margin-bottom: 15px;">
                    <button class="btn btn-primary" type="button" id="btn_add_new_user"><i class="fa fa-plus"></i>&nbsp;{{trans('label.button.create')}}</button>
                </div>
                <table class="table table-hover table-bordered" id="user_table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lst_users as $key => $user)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role_name}}</td>
                            <td>{{$user->status ? 'Active' : 'Inactive'}}</td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.account_management.elements.modal_add_update_user')
