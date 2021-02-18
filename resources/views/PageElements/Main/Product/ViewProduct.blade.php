@extends('PageElements.Main.InnerPagesLayout')
@section('PageTitle', 'محصولات')
@section('content')

    <section class="portfolio_slider_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="portfolio_slider_wrapper">
                        <div class="flexslider" id="portfolio_slider">
                            <ul class="slides">
                                @foreach($Product['images'] as $image)
                                    <li class="item" data-thumb="{{$image}}"
                                        style="background-image: url({{$image}})">
                                        <div class="container"><a href="{{$image}}" target="_blank"
                                                                  class="lightbox_portfolio"
                                                                  title="title on a"></a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div id="carousel" class="flexslider">
                            <ul class="slides">
                                @foreach($Product['images'] as $image)
                                    <li><img src="{{$image}}" alt=""></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="portfolio_details">
                        <h2 class="section_header">{{$ProductIntroductionTitle}}</h2>
                        <p>{{$Product['introduction']}}</p>
                        <br>
                        <br>
                        <h2 class="section_header">{{$ProductNVTitle}}</h2>
                        <p>{{$Product['nutritional_value']}}</p>
                        <br>
                        <br>
                        @if($ProductCatalog)
                            <a href="{{route('ViewCatalog',[$ProductCatalog])}}"
                               class="btn btn-danger center-block ">{{ $BtnViewProductCatalog }}</a>
                        @endif
                        <br>
                        <br>
                    </div>
                </div>
                <ul class="pager">
                    <li class="next"><a href="{{route('AllProducts')}}">← {{ $BtnBack }}</a></li>
                </ul>
            </div>
    </section>
    @if($RelatedPList)
        <section class="portfolio_teasers_wrapper">
            <div class="container">
                <h2 class="elegant centered section_header">{{$RelatedProductsTitle}}<small></small></h2>
                <div class="portfolio_strict row">
                    @foreach($RelatedPList as $RP)
                        <div class="col-sm-4 col-md-4">
                            <div class="portfolio_item"><a href="{{route('ViewProduct',[$RP['id']])}}">
                                    <figure style="background-image:url({{$RP['image']}})">
                                        <figcaption>
                                            <div class="portfolio_description">
                                                <h3>{{$RP['name']}}</h3>

                                            </div>
                                        </figcaption>
                                    </figure>
                                </a></div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    @endif


@endsection

