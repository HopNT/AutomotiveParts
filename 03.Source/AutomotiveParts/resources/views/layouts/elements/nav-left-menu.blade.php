<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    {{--<div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">--}}
        {{--<div>--}}
            {{--<p class="app-sidebar__user-name">John Doe</p>--}}
            {{--<p class="app-sidebar__user-designation">Frontend Developer</p>--}}
        {{--</div>--}}
    {{--</div>--}}
    <ul class="app-menu">

        {{-- Trang chủ --}}
        <li><a class="app-menu__item active" href="index.html"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">{{trans('label.homepage')}}</span></a></li>

        {{-- Quản lý thông tin phụ tùng --}}
        <li><a class="app-menu__item" href="{{route('accessary-management')}}"><i class="app-menu__icon fa fa-accessible-icon"></i><span class="app-menu__label">{{trans('label.route.accessary-management')}}</span></a></li>

        {{-- Quản lý thông tin xe --}}
        <li><a class="app-menu__item" href="{{route('car-management')}}"><i class="app-menu__icon fa fa-car"></i><span class="app-menu__label">{{trans('label.car.management')}}</span></a></li>

        {{-- Quản lý thông tin quốc gia --}}
        <li><a class="app-menu__item" href="{{route('nation-management')}}"><i class="app-menu__icon fa fa-car"></i><span class="app-menu__label">{{trans('label.nation.management')}}</span></a></li>

        {{-- Quản lý thông tin thương hiệu --}}
        <li><a class="app-menu__item" href="{{route('trademark-management')}}"><i class="app-menu__icon fa fa-car"></i><span class="app-menu__label">{{trans('label.trade_mark.management')}}</span></a></li>

        {{-- Quản lý thông tin bộ phận xe --}}
        <li><a class="app-menu__item" href="{{route('parts-management')}}"><i class="app-menu__icon fa fa-car"></i><span class="app-menu__label">{{trans('label.parts.management')}}</span></a></li>

        {{-- Quản lý giá phụ tùng --}}
        <li><a class="app-menu__item" href="{{route('price-management')}}"><i class="app-menu__icon fa fa-paypal"></i><span class="app-menu__label">{{trans('label.route.price-management')}}</span></a></li>

        {{-- Quản lý yêu cầu thêm phụ tùng --}}
        <li><a class="app-menu__item" href="{{route('temp-price-management')}}"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">{{trans('label.route.temp-price-management')}}</span></a></li>

        {{--<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Pages</span><i class="treeview-indicator fa fa-angle-right"></i></a>--}}
            {{--<ul class="treeview-menu">--}}
                {{--<li><a class="treeview-item" href="blank-page.html"><i class="icon fa fa-circle-o"></i> Blank Page</a></li>--}}
                {{--<li><a class="treeview-item" href="page-login.html"><i class="icon fa fa-circle-o"></i> Login Page</a></li>--}}
                {{--<li><a class="treeview-item" href="page-lockscreen.html"><i class="icon fa fa-circle-o"></i> Lockscreen Page</a></li>--}}
                {{--<li><a class="treeview-item" href="page-user.html"><i class="icon fa fa-circle-o"></i> User Page</a></li>--}}
                {{--<li><a class="treeview-item" href="page-invoice.html"><i class="icon fa fa-circle-o"></i> Invoice Page</a></li>--}}
                {{--<li><a class="treeview-item" href="page-calendar.html"><i class="icon fa fa-circle-o"></i> Calendar Page</a></li>--}}
                {{--<li><a class="treeview-item" href="page-mailbox.html"><i class="icon fa fa-circle-o"></i> Mailbox</a></li>--}}
                {{--<li><a class="treeview-item" href="page-error.html"><i class="icon fa fa-circle-o"></i> Error Page</a></li>--}}
            {{--</ul>--}}
        {{--</li>--}}

    </ul>
</aside>
