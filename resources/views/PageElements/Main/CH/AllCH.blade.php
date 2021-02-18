@extends('PageElements.Main.InnerPagesLayout')
@section('PageTitle', 'گواهینامه و افتخارات')
@section('content')


    <section class="with_right_sidebar">
        <div class="container">
            <div class="row">
                <div id="leftcol" class="col-sm-12 col-md-12">
                    @foreach($CHList as $CH)
                        <article class="post">
                            <div class="post_header">
                                <h3 class="post_title"><a href="{{route('ViewCH',[$CH['id']])}}">{{$CH['title']}}</a></h3>

                            </div>
                            <div class="post_content">
                                <figure><a href="{{route('ViewCH',[$CH['id']])}}"><img alt="0" src="{{$CH['image']}}"></a>
                                </figure>

                                <a href="{{route('ViewCH',[$CH['id']])}}" class="btn btn-primary">{{ $BtnMore }}</a></div>
                        </article>
                    @endforeach

                </div>

            </div>
        </div>
    </section>
@endsection
