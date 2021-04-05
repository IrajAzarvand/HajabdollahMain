<!--Start Products Area-->
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
                    <button data-filter="" class="active">*</button>
                    @foreach($PTypeList as $List)
                        <button data-filter=".{{$List['id']}}">{{$List['name']}}</button>
                    @endforeach
                </div>
                <div class="mr-masonry mr-columns-3">
                    {{--if one of the categories selected, this section will become clear and show products related to that category--}}
                    {{--and if one of the ptypes selected, this section will show categories related to that ptype --}}
                    <div id="ProductsSection">
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
                                                    <li><a target="_blank" class="image-link"
                                                           href="{{$item['RelatedImage']}}"><i
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
    </div>
</section>

<!--//End Gallery Area-->

<script>
    {{-- get selected category id and show related products--}}
    function showCategoryProducts(category) {
        let selectedCategory = category;
        $.ajax({
            type: "GET",
            url: '/Product/' + selectedCategory,

            success: function (data) {
                //show content
                // $('#ProductsSection').empty();

                // create products collection related to selected category
                // function createElementdiv(obj) {
                //
                //     // Create main div
                //     let productsSection = document.getElementById(obj);
                //     let div_obj = document.createElement("div");
                //     div_obj.setAttribute("class", "mr-masonry-item");
                //     div_obj.setAttribute("id", "mr-masonry-item")
                //     productsSection.appendChild(div_obj);
                //
                //     // Create second div inside mr-masonry-item
                //     let productDiv = document.getElementById("mr-masonry-item");
                //     let div2_obj = document.createElement("div");
                //     div2_obj.setAttribute("class", "marv-portfolio");
                //     div2_obj.setAttribute("id", "marv-portfolio")
                //     productDiv.appendChild(div2_obj);
                //
                //
                //     // Create a tag inside second div
                //     let div2 = document.getElementById("marv-portfolio");
                //     let a_obj = document.createElement("a");
                //     a_obj.setAttribute("class", "marv-portfolio-img");
                //     a_obj.setAttribute("id", "marv-portfolio-img")
                //     div2.appendChild(a_obj);
                //
                //
                //     // Create img tag inside a tag
                //     let a_tag = document.getElementById("marv-portfolio-img");
                //     let img = document.createElement("img");
                //     img.setAttribute("class", "img-responsive");
                //     img.setAttribute("id", "img-responsive")
                //     a_tag.appendChild(img);
                //
                //
                //     // Create second div block
                //     let second_div = document.getElementById("marv-portfolio");
                //     let second_div_block = document.createElement("div");
                //     second_div_block.setAttribute("class", "mr-overbg");
                //     second_div_block.setAttribute("id", "mr-overbg")
                //     second_div.appendChild(second_div_block);
                //
                //
                //     // Create content div in second block
                //     let second_block = document.getElementById("mr-overbg");
                //     let div_in_second_block = document.createElement("div");
                //     div_in_second_block.setAttribute("class", "marv-portfolio-content");
                //     div_in_second_block.setAttribute("id", "marv-portfolio-content")
                //     second_block.appendChild(div_in_second_block);
                //
                //
                //     // Create ul in second div block
                //     let second_block_div = document.getElementById("marv-portfolio-content");
                //     let ul = document.createElement("ul");
                //     ul.setAttribute("class", "marv-portfolio-icon");
                //     ul.setAttribute("id", "marv-portfolio-icon")
                //     second_block_div.appendChild(ul);
                //
                //
                //     // Create first li in ul
                //     let ul_obj = document.getElementById("marv-portfolio-icon");
                //     let li_obj = document.createElement("li");
                //     li_obj.setAttribute("id", "first_li_obj")
                //     ul_obj.appendChild(li_obj);
                //
                //
                //     // Create catalog link in first li
                //     let first_li = document.getElementById("first_li_obj");
                //     let catalog_link = document.createElement("a");
                //     catalog_link.setAttribute("id", "catalog_link")
                //     first_li.appendChild(catalog_link);
                //
                //
                //     // Create catalog icon
                //     let catalog = document.getElementById("catalog_link");
                //     let catalog_icon = document.createElement("i");
                //     catalog_icon.setAttribute("class", "fa fa-leanpub")
                //     catalog_icon.setAttribute("id", "catalog_icon")
                //     catalog.appendChild(catalog_icon);
                //
                //
                //     // Create second li in ul
                //     let the_ul_obj = document.getElementById("marv-portfolio-icon");
                //     let li2_obj = document.createElement("li");
                //     li2_obj.setAttribute("id", "second_li_obj")
                //     the_ul_obj.appendChild(li2_obj);
                //
                //
                //     // Create products images popup link in second li
                //     let second_li = document.getElementById("second_li_obj");
                //     let images_popup_link = document.createElement("a");
                //     images_popup_link.setAttribute("class", "image-link")
                //     images_popup_link.setAttribute("target", "_blank")
                //     images_popup_link.setAttribute("id", "product_image_popup")
                //     second_li.appendChild(images_popup_link);
                //
                //
                //     // Create product images link icon
                //     let images_popup = document.getElementById("product_image_popup");
                //     let link_icon = document.createElement("i");
                //     link_icon.setAttribute("class", "fa fa-arrows-alt")
                //     link_icon.setAttribute("id", "product_image_icon")
                //     images_popup.appendChild(link_icon);
                //
                // }


                //show content
                // console.log(data);
                //
                // let list = '';
                // let Cat_id = '';
                // data.forEach(function (entry) {
                //
                //
                // });


            }
        });
    }
</script>

