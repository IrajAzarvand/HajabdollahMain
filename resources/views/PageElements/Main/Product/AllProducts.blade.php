@extends('PageElements.Main.InnerPagesLayout')
@section('PageTitle', 'محصولات')
@section('content')

        <section class="portfolio_strict">
            <div class="container">

                <ul class="portfolio_filters">
                    <li><a href="#" data-filter="*">*</a></li>
                    @foreach($CategoriesList as $cat)
                        <li><a href="#" data-filter=".cat{{$cat['id']}}">{{$cat['name']}}</a></li>

                    @endforeach
                </ul>
                <div class="row isotope_portfolio_container">
                    @foreach($PList as$item)
                        <div class="cat{{$item['cat']}} col-xs-12 col-sm-6 col-md-4 col-lg-4">
                            <div class="portfolio_item">
                                <a href="{{route('ViewProduct',[$item['id']])}}">
                                    <figure
                                        style="background-image:url({{$item['image']}})">
                                        <figcaption>
                                            <div class="portfolio_description">
                                                <h3>{{$item['name']}}</h3>

                                            </div>
                                        </figcaption>
                                    </figure>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
@endsection
