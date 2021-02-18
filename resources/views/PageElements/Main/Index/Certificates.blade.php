<section class="call_to_action dark_section">
    <div class="container">
        <div class="mini-carousel">
            @foreach($CH_Images as $ch)
                <div style="margin-left: 10px;"><a href="{{route('AllCH')}}"><img src="{{$ch}}" alt=""></a></div>
            @endforeach
        </div>
    </div>
</section>
