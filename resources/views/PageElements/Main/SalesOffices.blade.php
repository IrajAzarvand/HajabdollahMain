<!-- Start SalesOffices Section -->
<section class="reviews-area single-prallex prallex-reviews" data-scroll-index="4">
    <div class="after-overlay">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading  prallex-heading">
                        <h2><span>{{$SectionTitle['salesoffices']}}</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="all-reviews">
                        @foreach($SalesOffices as $SO)
                            <div class="single-reviews @if(app()->getLocale()=='fa')  dir-rtl @endif">
                                <p class="review-desc">
                                    {{$SO}}
                                </p>
                                <div class="content">
                                <span class="service-icon">
                                    <i class="ti-bag"></i>
                                </span>
                                    {{--                                <div class="image">--}}
                                    {{--                                    <img class="img-circle img-responsive ti-location-pin" alt="Reviewer" />--}}
                                    {{--                                </div>--}}
                                    {{--                                <div class="reviewer-name">--}}
                                    {{--                                    <h5>احمد محسن</h5>--}}
                                    {{--                                    <span>مطور تطبيقات</span>--}}

                                    {{--                                </div>--}}
                                </div>
                            </div>
                        @endforeach

                    </div><!--// .all-reviews  -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--// End SalesOffices Section -->
