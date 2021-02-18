<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">

        <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('Panel/images/user.png') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ DashboardUser::$UserName }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="nav-icon fa fa-tachometer"></i>
                            <p>
                                داشبورد
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/" class="nav-link" target="_blank">
                            <i class="nav-icon fa fa-globe"></i>
                            <p>
                                صفحه اصلی سایت
                            </p>
                        </a>
                    </li>

                    @foreach (DashboardUser::$Menus as $item)
                    {{--========================================================================--}}
                    <li class="nav-item has-treeview menu-open">
                        <a class="nav-link" id="{{ $item->MainMenu }}" href="{{ $item->Url }}">
                            <i class="nav-icon {{ $item->Icon ? $item->Icon : '' }}"></i>
                            <p>
                                {{ $item->MainMenu }}
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        @if ($item->sub_menus->count())
                        <ul class="nav nav-treeview">
                            @foreach ($item->sub_menus as $subitem)
                            <li class="nav-item">
                                <a class="nav-link" id="{{ $subitem->SubMenu }}" href="{{ route($subitem->Url) }}">
                                    <i class="nav-icon {{ $subitem->Icon ? $subitem->Icon : 'fa fa-circle-o' }}"></i>
                                    <p>{{ $subitem->SubMenu }}</p>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    {{--========================================================================--}}

                    @endforeach
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
