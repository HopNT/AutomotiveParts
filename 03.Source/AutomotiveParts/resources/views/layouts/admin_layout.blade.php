<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Quản lý phụ tùng">
    <title>{{config('app.name')}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/tagsinput.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="app sidebar-mini rtl">
<!--/header-->
@include("layouts.elements.nav-top")
<!-- Sidebar menu-->
@include("layouts.elements.nav-left-menu")

<main class="app-content">
    <!--/breadcrums-->
    @include("layouts.elements.breadcrums")

    @yield('content')

    <!-- Modal loading-->
    <div class="modal fade" id="loading-modal" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content" style="background-color: inherit; border: none;">
                <div class="modal-body text-center">
                    <img src="{{asset('images/loading-car.gif')}}" style="width: 50px;">
                </div>
            </div>
        </div>
    </div>
    <style>
        /** SPINNER CREATION **/

        .loader {
            position: relative;
            text-align: center;
            margin: 15px auto 35px auto;
            z-index: 9999;
            display: block;
            width: 80px;
            height: 80px;
            border: 10px solid rgba(0, 0, 0, .3);
            border-radius: 50%;
            border-top-color: #000;
            animation: spin 1s ease-in-out infinite;
            -webkit-animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                -webkit-transform: rotate(360deg);
            }
        }

        @-webkit-keyframes spin {
            to {
                -webkit-transform: rotate(360deg);
            }
        }
    </style>
</main>
<!-- Essential javascripts for application to work-->
<script src="{{ asset('admin/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('admin/js/popper.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/pace.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/jquery.dataTables.min.js') }} "></script>
<script src="{{ asset('admin/js/plugins/dataTables.bootstrap.min.js') }} "></script>
{{--<script src="{{ asset('admin/js/common/custom_datatables.js') }}"></script>--}}
<script type="text/javascript" src="{{ asset('admin/js/plugins/bootstrap-notify.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/plugins/sweetalert.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/plugins/select2.full.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/plugins/tagsinput.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
<script src="{{ asset('admin/js/main.js') }}"></script>
<script>
    var publicPath = '<?=url('/')?>';
</script>
@yield('javascript')
</body>
</html>
