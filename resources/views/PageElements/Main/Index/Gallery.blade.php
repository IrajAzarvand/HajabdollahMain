<section class="portfolio_teasers_wrapper">

    <div class="container">
        <h2 class="section_header fancy centered">{{ $GallerySectionTitle }}</h2>
        <div class="portfolio_strict row">
            <div class="mini-carousel">
                @foreach($Gallery as $key=>$item)

                    <div class="col-sm-4 col-md-4">
                        <div class="portfolio_item wow fadeInUp"><a href="{{route('ViewGallery',[$item['id']])}}">
                                <figure style="background-image:url({{$item['image']}})">
                                    <figcaption>
                                        <div class="portfolio_description">
                                            <h3>{{$item['title_'.app()->getLocale()]}}</h3>
                                        </div>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                    </div>

                @endforeach
            </div>

        </div>

    </div>
</section>
