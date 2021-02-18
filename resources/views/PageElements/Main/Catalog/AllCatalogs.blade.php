@extends('PageElements.Main.InnerPagesLayout')
@section('PageTitle', 'کاتالوگ تصاویر')
@section('content')


    <section class="with_right_sidebar">
        <div class="container">
            <div class="row">
                <div id="leftcol" class="col-sm-12 col-md-12">
                    @if($CList)
                        @foreach($CList as $CL)
                            <article class="post">
                                <div class="post_header">
                                    <h3 class="post_title"><a
                                            href="{{route('ViewCatalog',[$CL['id']])}}">{{$CL['title']}}</a></h3>

                                </div>
                                <div class="post_content">
                                    <figure><a href="{{route('ViewCatalog',[$CL['id']])}}"><img alt="0"
                                                                                           src="{{$CL['image']}}"></a>
                                    </figure>

                                    <a href="{{route('ViewCatalog',[$CL['id']])}}"
                                       class="btn btn-primary">{{ $BtnMore }}</a></div>
                            </article>
                        @endforeach
                    @endif

                </div>

            </div>
        </div>
    </section>
@endsection
