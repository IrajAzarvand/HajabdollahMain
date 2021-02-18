@extends('PageElements.Main.InnerPagesLayout')
@section('PageTitle', 'گواهینامه و افتخارات')
@section('content')

        <section class="portfolio_slider_wrapper">
            <div class="container">
                <div class="flexslider" id="portfolio_slider" style="background-color: transparent; margin-left:35%;">
                    <ul class="slides" >


                        <li class="item" style="background-image: url({{$SelectedCHImage}}); width: 75%;">
                        </li>

                    </ul>
                </div>
                <div class="portfolio_details">
                    <div class="row">
                        <div class="col-sm-9 col-md-9">
                            <h2 class="section_header">{{$SelectedCHTitle}}</h2>
                            <p>{{$SelectedCHDescription}} </p>
                        </div>
                    </div>
                    <ul class="pager">
                        <li class="next"><a href="{{route('AllCH')}}"><i class="fa fa-chevron-left"></i> {{ $BtnBack }}</a></li>
                    </ul>
                </div>
            </div>
        </section>



@endsection

