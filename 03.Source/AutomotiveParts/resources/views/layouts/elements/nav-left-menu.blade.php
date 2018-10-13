<?php
    $current = \Illuminate\Support\Facades\Route::currentRouteName();

    $arr_icon = [
        'account-management'=>'fa fa-user',
        'car-management'=>'fa fa-car',
        'parts-management'=>'fa fa-cog',
        'nation-management'=>'fa fa-globe',
        'trademark-management'=>'fa fa-trademark',
        'price-management'=>'fa fa-usd',
        'temp-price-management'=>'fa fa-check',
        'accessary-management'=>'fa fa-cogs',

    ];
    $user = \Illuminate\Support\Facades\Auth::guard('admin')->user();
?>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        @if($user->avatar)
            <img class="app-sidebar__user-avatar" src="{{asset('admin/images/avatar-icon.png')}}" alt="{{$user->name}}">
        @else
            <i class="app-menu__icon fa fa-user-circle-o fa-3x" style="margin-right: 20px"></i>
        @endif
        <div>
            <p class="app-sidebar__user-name">{{$user->name}}</p>
            <p class="app-sidebar__user-designation">{{$user->roles->role_name}}</p>
        </div>
    </div>
    <ul class="app-menu">

        @foreach($leftMenu as $menu)
            <li><a class="app-menu__item {{$current == $menu->route_name ? 'active' : ''}}" href="{{route($menu->route_name)}}"><i class="app-menu__icon {{$arr_icon[$menu->route_name]}}"></i><span class="app-menu__label">{{$menu->function_name}}</span></a></li>
        @endforeach

        {{-- Trang chủ --}}
        {{--<li><a class="app-menu__item active" href="index.html"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">{{trans('label.homepage')}}</span></a></li>--}}

        {{-- Quản lý thông tin phụ tùng --}}
        {{--<li><a class="app-menu__item" href="{{route('accessary-management')}}"><i class="app-menu__icon fa fa-accessible-icon"></i><span class="app-menu__label">{{trans('label.route.accessary-management')}}</span></a></li>--}}

        {{-- Quản lý thông tin xe --}}
        {{--<li><a class="app-menu__item" href="{{route('car-management')}}"><i class="app-menu__icon fa fa-car"></i><span class="app-menu__label">{{trans('label.car.management')}}</span></a></li>--}}

        {{-- Quản lý thông tin quốc gia --}}
        {{--<li><a class="app-menu__item" href="{{route('nation-management')}}"><i class="app-menu__icon fa fa-car"></i><span class="app-menu__label">{{trans('label.nation.management')}}</span></a></li>--}}

        {{-- Quản lý thông tin thương hiệu --}}
        {{--<li><a class="app-menu__item" href="{{route('trademark-management')}}"><i class="app-menu__icon fa fa-car"></i><span class="app-menu__label">{{trans('label.trade_mark.management')}}</span></a></li>--}}

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
