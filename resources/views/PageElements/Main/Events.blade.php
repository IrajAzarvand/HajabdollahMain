<!-- Start Events Section -->
<section class="section-padding dir-rtl" data-scroll-index="6">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2><span>{{$SectionTitle['events']}}</span></h2>
                </div>
            </div>
        </div>
        <div class="row mt80">

            @foreach($EventsList as $event)
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="mr-blog-entry">
                        <div class="mr-entry-image clearfix">
                            <img class="img-responsive" src="{{$event['image']}}" alt="#">
                        </div>
                        <div class="mr-blog-detail">
                            <div class="mr-entry-title mr-mb-10">
                                <a href="#">
                                    <h5 class="mr-tw-6">{{$event['title']}}</h5>
                                </a>
                            </div>
                            <div class="mr-entry-content">
                                <p>{{$event['desc']}}</p>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</section>
<!-- // End Events Section -->
