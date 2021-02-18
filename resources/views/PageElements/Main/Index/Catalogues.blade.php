<section class="features_teasers_wrapper">
    <div class="container triangles-of-section">
        <div class="triangle-up-left"></div>
        <div class="square-left"></div>
        <div class="triangle-up-right"></div>
        <div class="square-right"></div>
    </div>
    <div class="container">
        <h2 class="section_header fancy centered">{{ $CatalogSectionTitle }}</h2>
        <div class="row">

            @foreach ($CatalogItems as $catalog)
                <div class="feature_teaser col-sm-4 col-md-4">
                    <a href="{{route('ViewCatalog',[$catalog['id']])}}">  <img alt="responsive" src="{{ $catalog['image']}}"></a>
                </div>
            @endforeach

        </div>
        <div class="centered_button"><a class="btn btn-primary" href="{{route('AllCatalogs')}}">{{ $BtnMore }}</a></div>

    </div>
</section>
