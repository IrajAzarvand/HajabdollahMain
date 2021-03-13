<!--Start Gallery Area-->
<section id="marv-portfolio"
         class="@if(app()->getLocale()=='fa') dir-rtl @endif mr-masonry-block popup-gallery section-padding "
         data-scroll-index="2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2><span>{{$SectionTitle['products']}}</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                <div class="isotope-filters isotope-tooltip">
                    <button data-filter="" class="active">* </button>
                    @foreach($PTypeList as $List)
                        <button data-filter=".{{$List['id']}}">{{$List['name']}}</button>
                    @endforeach
                </div>
                <div class="mr-masonry mr-columns-3">
                    @foreach($Cat as $item)
                    <div class="mr-masonry-item {{$item['ptypeId']}}">
                        <div class="marv-portfolio">
                            <a class="marv-portfolio-img" href="#">
                                <img class="img-responsive" src="{{$item['image']}}" alt="#">
                            </a>
                            <div class="mr-overbg">
                                <div class="marv-portfolio-content">
                                    <h5 class="title mr-font-white"><a href="#">{{$item['name']}}</a></h5>
                                    <hr>
                                    <ul class="marv-portfolio-icon">
                                        <li><a href="#"><i class="fa fa-leanpub"></i></a></li>
                                        <li><a class="image-link popup-img" href="images/portfolio/03.jpg"><i
                                                    class="fa fa-arrows-alt"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>

<!--//End Gallery Area-->
