<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <title>{{config('app.name')}} - @yield('PageTitle')</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="HandheldFriendly" content="true" />
    <meta name="apple-touch-fullscreen" content="yes" />

@if (app()->getLocale()=='fa' ||app()->getLocale()=='ar')
    @include('PageElements.Main.Shared.RTLCoreCSS')
@else
    @include('PageElements.Main.Shared.LTRCoreCSS')
@endif

<!-- Fav and touch icons -->
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
</head>
<body class="sticky_header">
<div class="overflow_wrapper">
    @include('PageElements.Main.Shared.Header')

    <div class="full_page_photo no_photo">
        <div class="hgroup">
            <div class="hgroup_title animated bounceInUp skincolored">
                <div class="container">
                    <h1 class="">{{$PageTitle ?? $SectionTitle}}</h1>
                </div>
            </div>
            <div class="hgroup_subtitle animated bounceInUp ">
                <div class="container">
                    <p>{{$Item['title']?? ''}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="container triangles-of-section IX">
            <div class="triangle-up-left"></div>
            <div class="square-left"></div>
            <div class="triangle-up-right"></div>
            <div class="square-right"></div>
        </div>
        @section('content')
        @show

        @include('PageElements.Main.Shared.Footer')

    </div>
    @include('PageElements.Main.Shared.CoreJS')


</div>
</body>
</html>
