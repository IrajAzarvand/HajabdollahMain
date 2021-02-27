<!-- Start Contact Section -->
<section id="contact" class="contact dir-rtl" data-scroll-index="7">
    <div class="part-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading prallex-heading">
                        <h2><span>{{$SectionTitle['contactus']}}</span></h2>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="part-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="contact-form">
                        <h4>{{$CUFormTitle}}</h4>
                        <p class="mt30">{{$CUFormDescription}}</p>
                        <div id="show_contact_msg"></div>
                        <form id='contact-form' class="mt25" method="post" action="contact.php">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input id="contact_name" type="text" name="name" placeholder="{{$CUFormName}}"
                                           class="form-control" required="required">
                                </div>
                                <div class="form-group col-md-6">
                                    <input id="contact_phone" type="text" name="phone" placeholder="{{$CUFormPhone}}"
                                           class="form-control" required="required">
                                </div>
                                <div class="form-group col-sm-6">
                                    <input id="contact_email" type="email" name="email" class="form-control"
                                           placeholder="{{$CUFormEmail}}" required="required">
                                </div>
                                <div class="form-group col-sm-6">
                                    <input id="contact_subject" type="text" name="subject"
                                           placeholder="{{$CUFormSubject}}" class="form-control" required="required">
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea id="contact_text" rows="6" name="message" class="form-control"
                                              placeholder="{{$CUFormMessage}}" required="required"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <button type="submit" value="Send Now"
                                                class="button">{{$CUFormBtnSend}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5 mb-30">
                    <div class="box-info">
                        <h4>{{$CUInfoTitle}}</h4>
                        <p class="mt30">{{$CUInfoDescription}}</p>
                        <div class="item mt-20">
                            <i class="ti-location-pin"></i>
                            <h5>
                                <span>{{$CUInfoAddressTitle}}</span>
                                {{$CUAddressContent}}
                            </h5>
                        </div>

                        <div class="item mt-20">
                            <i class="ti-email"></i>
                            <h5>
                                <span>{{$CUInfoEmailTitle}}</span>
                                <a href="#">info@hajabdollah.com</a>
                                <br>
                                <a href="#">sale@hajabdollah.com</a>

                            </h5>
                        </div>

                        <div class="item mt-20">
                            <i class="ti-headphone-alt"></i>
                            <h5>
                                <span>{{$CUInfoPhoneTitle}}</span>
                                @foreach($CUPhoneContent as $CU)
                                    {{$CU}}
                                    <br>
                                @endforeach


                            </h5>
                        </div>

                        <div class="social-icon mt-20">
                            <a href="https://www.youtube.com/channel/UCiF7PtLSdUJfSbZdwSArWRA" data-tooltip="youtube"> <i class="fa fa-youtube"></i> </a>
                            <a href="https://www.facebook.com/Hajabdollah.pashmak/" data-tooltip="facebook"> <i class="fa fa-facebook"></i> </a>
                            <a href="https://t.me/Hajabdollah_pashmak_co" data-tooltip="telegram"> <i class="fa fa-paper-plane"></i> </a>
                            <a href="https://www.aparat.com/hajabdollah.pashmak" data-tooltip="aparat"> <i class="fa fa-file-movie-o"></i> </a>
                            <a href="https://www.instagram.com/hajabdollah.pashmak/" data-tooltip="instagram"> <i class="fa fa-instagram"></i> </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- //End Contact Section -->
