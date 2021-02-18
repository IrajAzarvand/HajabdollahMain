<footer>
    <section class="footer_teasers_wrapper dark_section">
        <div class="container">
            <div class="row col-sm-9 col-md-9">

                <div class="footer_teaser pl_about_us_widget col-sm-9 col-md-9">
                    {{-- section title --}}
                    <h3>{{$SharedContents['SectionTitle']}}</h3>

                    {{-- address --}}
                    <p>{{$SharedContents['Address']}}</p>
                </div>
                <div class="footer_teaser pl_about_us_widget">
                    <p><i class="fa fa-envelope"></i> info@hajabdollah.com</p>
                </div>

                <div class="footer_teaser pl_about_us_widget">
                    <p><i class="fa fa-phone"></i> 041-34328221 | 041-34328223</p>
                </div>
                <div class="footer_teaser pl_about_us_widget">
                    <div class="footer_social">
                        <div class="social_wrapper">
                            <a href="https://www.instagram.com/etminan.icecream/" target="_blank"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-paper-plane"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row col-sm-3 col-md-3">
                <div class="footer_teaser pl_about_us_widget">
                    <img src="{{asset('storage/Main/Shared/footerimage.png')}}" alt="">
                </div>
            </div>

        </div>
    </section>
    <div class="copyright">
        <div class="container">
            <div class="row">
                {{-- copyright --}}
                <div class="col-sm-4 col-md-4">{{$SharedContents['CopyRight']}}</div>
                <div class="col-sm-4 col-md-4"></div>
            </div>
        </div>
    </div>
</footer>
