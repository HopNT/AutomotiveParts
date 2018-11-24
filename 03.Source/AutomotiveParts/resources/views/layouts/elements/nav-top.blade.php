<!-- Navbar-->
<header class="app-header"><div class="app-header__logo">{{config('app.name')}}</div>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                {{--<li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i>Settings</a></li>--}}
                <li><a class="dropdown-item" href="{{route('view_profile')}}"><i class="fa fa-user fa-lg"></i>Trang cá nhân</a></li>
                <li>
                    <a class="dropdown-item" href="javascript: void(0)" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i>Đăng xuất</a>
                    <form id="logout-form" action="{{ route('admin_logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</header>
