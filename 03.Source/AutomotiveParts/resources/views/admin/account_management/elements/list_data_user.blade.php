<?php
$staff = \Illuminate\Support\Facades\Auth::guard('admin')->user();
$can_add_user = $staff->can_view('save-user');
$can_edit_user = $staff->can_view('get-user');
$can_delete_user = $staff->can_view('delete-user');
?>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div style="margin-bottom: 15px;">
                    @if($can_add_user)
                        <button class="btn btn-primary" type="button" id="btn_add_new_user"><i class="fa fa-plus"></i>&nbsp;{{trans('label.button.create')}}</button>
                    @endif
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
                            <td style="text-align: center">{{$key+1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role_name}}</td>
                            <td>{{$user->status ? 'Active' : 'Inactive'}}</td>
                            <td style="text-align: center">
                                @if($can_edit_user)
                                    <button href="{{route('get-user',['id'=>$user->user_id])}}" id="btn_get_user" class="btn btn-info btn-sm fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{trans('label.button.edit')}}"></button>
                                @endif
                                @if($can_delete_user)
                                    <button href="{{route('delete-user',['id'=>$user->user_id])}}" id="btn_delete_user" data-confirm="{{trans('label.common.confirm')}}" class="btn btn-danger btn-sm fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{trans('label.button.delete')}}"></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.account_management.elements.modal_add_update_user')
