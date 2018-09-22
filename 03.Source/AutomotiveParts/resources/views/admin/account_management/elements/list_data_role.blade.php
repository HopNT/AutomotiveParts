<?php
$staff = \Illuminate\Support\Facades\Auth::guard('admin')->user();
$can_add_role = $staff->can_view('add-role');
$can_edit_role = $staff->can_view('edit-role');
$can_delete_role = $staff->can_view('delete-role');
?>

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div style="margin-bottom: 15px;">
                    @if($can_add_role)
                        <a href="{{route('add-role')}}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;{{trans('label.button.create')}}</a>
                    @endif
                </div>

                <table class="table table-hover table-bordered" id="role_table">
                    <thead>
                    <tr>
                        <th width="30px" style="text-align: center">{{trans('label.account.no')}}</th>
                        <th width="300px">{{trans('label.account.role_name')}}</th>
                        <th width="300px">{{trans('label.account.description')}}</th>
                        <th width="50px" style="text-align: center">{{trans('label.common.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lst_role as $key => $role)
                        <tr>
                            <td style="text-align: center">{{$key+1}}</td>
                            <td>{{$role->role_name}}</td>
                            <td>{{$role->description}}</td>
                            <td style="text-align: center">
                                @if($can_edit_role)
                                    <a href="{{route('edit-role',['id'=>$role->id])}}" class="btn btn-info btn-sm fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{trans('label.button.edit')}}"></a>
                                @endif
                                @if($can_delete_role)
                                    <button href="{{route('delete-role',['id'=>$role->id])}}" id="btn_delete_role" data-confirm="{{trans('label.common.confirm')}}" class="btn btn-danger btn-sm fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{trans('label.button.delete')}}"></button>
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


