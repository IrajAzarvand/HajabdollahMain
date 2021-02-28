<!--Start Certificates Section -->
<section class="team-area section-padding" data-scroll-index="5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2><span>{{$SectionTitle['certificates']}}</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="all-team">
                    @foreach($Certificates as $key=>$C)
                        <div class="single-team @if(app()->getLocale()=='fa') dir-rtl @endif">
                            <img src="{{$C}}" alt="member-{{$key++}}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!--// End Certificates Section -->
