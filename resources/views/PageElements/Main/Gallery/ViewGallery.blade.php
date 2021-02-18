@extends('PageElements.Main.InnerPagesLayout')
@section('PageTitle', 'گالری تصاویر')
@section('content')

        <section class="portfolio_slider_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        <div class="portfolio_slider_wrapper">
                            <div class="flexslider" id="portfolio_slider">
                                <ul class="slides">
                                    @foreach($Gallery['images'] as $image)
                                        <li class="item" data-thumb="{{$image}}"
                                            style="background-image: url({{$image}})">
                                            <div class="container"><a href="{{$image}}" target="_blank" class="lightbox_portfolio"
                                                                      title="title on a"></a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div id="carousel" class="flexslider">
                                <ul class="slides">
                                    @foreach($Gallery['images'] as $image)
                                        <li><img src="{{$image}}" alt=""></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                <ul class="pager">
                    <li class="next"><a href="{{route('AllGalleries')}}">← {{ $BtnBack }}</a></li>
                </ul>
            </div>
        </section>

@endsection

