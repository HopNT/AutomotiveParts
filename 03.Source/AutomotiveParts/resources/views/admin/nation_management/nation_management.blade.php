@extends('layouts.admin_layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="bs-component" style="width: 100%">

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="nation">
                        @include('admin.nation_management.elements.list_data_nation')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" src="{{asset('admin/js/nation_management/nation_management.js')}} "></script>
@endsection