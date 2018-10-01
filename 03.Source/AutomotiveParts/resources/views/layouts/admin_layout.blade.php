<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Automation Parts">
    <title>{{trans('label.app_name')}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/bootstrap-imageupload.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/fileinput.min.css') }}" media="all">
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

</main>
<!-- Essential javascripts for application to work-->
<script src="{{ asset('admin/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('admin/js/popper.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/pace.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/jquery.dataTables.min.js') }} "></script>
<script src="{{ asset('admin/js/plugins/dataTables.bootstrap.min.js') }} "></script>
<script src="{{ asset('admin/js/common/custom_datatables.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/plugins/bootstrap-notify.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/plugins/sweetalert.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/plugins/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/plugins/bootstrap-imageupload.min.js') }}"></script>

<!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you wish to resize images before upload. This must be loaded before fileinput.min.js -->
<script src="{{ asset('admin/js/plugins/piexif.min.js') }}"></script>
<!-- the main fileinput plugin file -->
<script src="{{ asset('admin/js/plugins/fileinput.min.js') }}"></script>
<!-- optionally if you need a theme like font awesome theme you can include it as mentioned below -->
<script src="{{ asset('admin/js/plugins/fileinput-theme.js') }}"></script>
<!-- optionally if you need translation for your language then include  locale file as mentioned below -->
<script src="{{ asset('admin/js/plugins/fileinput-vi.js') }}"></script>

<script src="{{ asset('admin/js/main.js') }}"></script>
@yield('javascript')
</body>
</html>
