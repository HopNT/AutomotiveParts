<?php
$cbCount = 0;
$tabIndex = 0;
$pageSelected = isset($pageSelected)? $pageSelected : [];
$user = \Illuminate\Support\Facades\Auth::guard('admin')->user();
$can_add_role = $user->can_view('add-role');
?>
@extends('layouts.admin_layout')
@section('content')
    @if($can_add_role)
    <div class="container">
        <div class="row justify-content-center">
            <div class="tile" style="width: 100%">
                <form id="frmRole" role="form" method="post" action="{{route('add-role')}}" onsubmit="return false">
                    {{ csrf_field() }}
                    @if(isset($role->id))
                        {{Form::hidden('id', $role->id)}}
                    @endif

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label required">Tên</label>
                                {{Form::text('role_name', $role->role_name, ['id'=>'role_name', 'tabindex' =>(++$tabIndex), 'class'=>'form-control', 'maxlength'=>128, 'placeholder'=>"Nhập tên"])}}
                                <p class="text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label class="control-label">Mô tả</label>
                                {{Form::text('description', $role->description, ['id'=>'description', 'tabindex' =>(++$tabIndex), 'class'=>'form-control', 'maxlength'=>500, 'placeholder'=>"Nhập mô tả"])}}
                                <p class="text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="simple-table" class="table table-sm table-bordered">
                            <div class="form-group">
                                <p class="text-danger"  id='mn_selected_list'></p>
                            </div>
                            <thead>
                            <tr>
                                <th>
                                    <label>
                                        <input name="form-field-checkbox" name="cb_all" tabindex="{{(++$tabIndex)}}" type="checkbox" class="ace cb_all">
                                        <span class="lbl"></span>
                                    </label>
                                </th>
                                <th>Danh sách function</th>
                                <th>Mô tả</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pageList as $lev1)
                                @include("admin.account_management.elements.page_row", ['memu' => $lev1, 'level'=>1, 'cbCount' => (++$cbCount), 'page_selected' =>$pageSelected])
                                @if($lev1->pages && count($lev1->pages)>0)
                                    @foreach($lev1->pages as $lev2)
                                        @include("admin.account_management.elements.page_row", ['memu' => $lev2, 'level'=>2, 'cbCount' => (++$cbCount), 'page_selected' =>$pageSelected])
                                    @endforeach
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="button-row ">
                        <div class="pull-right">
                            <button type="submit" id="btn_save" class="btn btn-primary">
                                <i class="fa fa-save"></i>{{trans('label.button.save')}}
                            </button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
    @else
        {{trans('label.common.dont_have_permission')}}
    @endif
@endsection
@section('javascript')
    <script type="text/javascript" src="{{asset('admin/js/role.management.js')}} "></script>
@endsection
