@extends('PageElements.Main.MasterLayout')
@section('contents')

    @include('PageElements.Main.Header')
    @include('PageElements.Main.Slider')
<div class="body-overlay"></div>
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>

@include('PageElements.Main.AboutUs')
@include('PageElements.Main.Products')
@include('PageElements.Main.Export')
@include('PageElements.Main.SalesOffices')
@include('PageElements.Main.Certificates')
@include('PageElements.Main.Newsletter')
@include('PageElements.Main.Events')
{{--@include('PageElements.Main.Counter')--}}
{{--@include('PageElements.Main.Pricing')--}}
@include('PageElements.Main.ContactUs')
@include('PageElements.Main.Footer')

@endsection
