
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="form-group">
                    <button class="btn btn-primary" type="button" id="btn_add_new_nation"><i class="fa fa-plus"></i>{{trans('label.button.create')}}</button>
                </div>
                <table class="table table-hover table-bordered" id="tbl_nation">
                    <thead>
                    <tr>
                        <td class="text-center"><input type="checkbox"></td>
                        <td class="text-center">{{trans('label.nation.code')}}</td>
                        <td class="text-center">{{trans('label.nation.name')}}</td>
                        <td class="text-center">{{trans('label.common.status')}}</td>
                        <td class="text-center">{{trans('label.nation.description')}}</td>
                        <td class="text-center">{{trans('label.common.action')}}</td>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($listNation as $key => $nation)

                    <tr>
                        <td class="text-center"><input type="checkbox"></td>
                        <td class="text-center">{{$nation->code}}</td>
                        <td>{{$nation->name_en}}</td>
                        <td>{{$nation->name_vi}}</td>
                        <td>{{$nation->status ? trans('label.common.status_active') : trans('label.common.status_inactive')}}</td>
                        <td>{{$nation->description}}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
