<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} - @yield('PageTitle')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    @include('PageElements.Dashboard.Shared.Css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('PageElements.Dashboard.DashboardUser')

        @include('PageElements.Dashboard.Shared.Topbar')

        @include('PageElements.Dashboard.Shared.Menu')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @yield('ContentHeader')
                </h1>

            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Info boxes -->
                <div class="row">

                    @section('content')
                    @show

                </div>
                <!-- /.row -->


            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer text-left">
            <strong>Design & Develop: <a href="https://vazhenegar.com" target="_blank">Iraj Azarvand</a></strong>
        </footer>


    </div>
    <!-- ./wrapper -->

    @include('PageElements.Dashboard.Shared.Js')

</body>

</html>
