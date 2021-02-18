<section id="slider_wrapper" class="slider_wrapper full_page_photo">
    <div id="main_flexslider" class="flexslider">
        <ul class="slides">
            @foreach ($Slider as $item)

            <li class="item" style="background-image: url({{ $item['image'] }})">
                <div class="container">
                    <div class="carousel-caption animated bounceInUp">
                        <h1>
                            {{ $item['element_content'] }}
                        </h1>
                    </div>
                </div>
            </li>

            @endforeach
        </ul>
    </div>
</section>
