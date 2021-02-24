
<!-- Start NewsLetter Section -->
<section class="newsletter-area single-prallex prallex-newsletter dir-rtl">
    <div class="after-overlay">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading  prallex-heading">
                        <h2><span>{{$SectionTitle['newsletter']}}</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <p>
                            {{$NLDescription}}
                        </p>
                        <div id="show_subscriber_msg"></div>
                        <form method="post" id="subscriber_form" action="contact.php">
                            <div class="subscribe-box">
                                <input type="email" class="form-control text-box" id="subscriberemail" name="subscriber_email" placeholder="{{$MailPlaceholder}}" required>
                                <input type="submit" name="submit" class="submit-subscribe-btn" value="{{$BtnSubscribe}}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--// End Newsletter Section -->
