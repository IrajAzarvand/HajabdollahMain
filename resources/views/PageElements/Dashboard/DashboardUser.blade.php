{{--  this class will save current user info's for use in all dashboard pages --}}
@php
    if (!class_exists('DashboardUser')) {
        class DashboardUser
        {
            public static $CurrentUser;
            public static $id;
            public static $UserName;
            public static $Menus;
        }
    }
        //  General
        DashboardUser::$CurrentUser= Auth::user();
        DashboardUser::$id = DashboardUser::$CurrentUser->id;
        DashboardUser::$UserName = DashboardUser::$CurrentUser->name;
        DashboardUser::$Menus = MenuPicker();
@endphp