<script src="{{asset('Main/js/jquery-1.10.2.min.js')}}"></script>
<script src="{{asset('Main/twitter-bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<!--Pace Page Loader -->
<script src="{{asset('Main/js/pace-0.5.1/pace.min.js')}}"></script>
<!--FlexSlider -->
<script src="{{asset('Main/js/woothemes-FlexSlider-06b12f8/jquery.flexslider-min.js')}}"></script>
<!--Isotope Plugin -->
<script src="{{asset('Main/js/isotope/jquery.isotope.min.js')}}" type="text/javascript"></script>
<!--To-Top Button Plugin -->
<script type="text/javascript" src="{{asset('Main/js/jquery.ui.totop.js')}}"></script>
<!--Easing animations Plugin -->
<script type="text/javascript" src="{{asset('Main/js/easing.js')}}"></script>
<!--WOW Reveal on scroll Plugin -->
<script type="text/javascript" src="{{asset('Main/js/wow.min.js')}}"></script>
<!--Simple Text Rotator -->
<script type="text/javascript" src="{{asset('Main/js/jquery.simple-text-rotator.js')}}"></script>
<!--The Theme Required Js -->
<script type="text/javascript" src="{{asset('Main/js/cleanstart_theme.js')}}"></script>
<!--To collapse the menu -->
<script type="text/javascript" src="{{asset('Main/js/collapser.js')}}"></script>
<!--Slick mini carousel-->
<script type="text/javascript" src="{{asset('Main/js/slick.min.js')}}"></script>

<!--for mini carousel in index page-->

<script>
    $(document).ready(function(){
        $('.mini-carousel').slick({
            slidesToShow: 5,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  infinite: true,
        });
    });
</script>
