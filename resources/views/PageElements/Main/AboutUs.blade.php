
<!-- Start About Area -->
<section class="section-padding @if(app()->getLocale()=='fa') dir-rtl @endif" id="marv-about" data-scroll-index="1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading" >
                    <h2><span>{{$SectionTitle['aboutus']}}</span></h2>
                </div>
            </div>
        </div>
        <div class="row mt80">
            <div class="col-lg-7 col-sm-12">
                <p class="typo-pg">{{$AboutUsContent}}</p>

            </div>
            <div class="col-lg-5 col-sm-12">
                <div class="about-bg">
                    <img src="images/about.png" class="img-responsive" alt="#">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- // End About Area -->
