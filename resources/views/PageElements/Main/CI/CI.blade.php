@extends('PageElements.Main.InnerPagesLayout')
@section('PageTitle', 'معرفی شرکت')
@section('content')


    <section class="with_right_sidebar">
        <div class="container">
            <div class="row">
                <div id="leftcol" class="col-sm-12 col-md-12">
                    @foreach($CIList as $CI)
                        <article class="post">
                            <div class="post_header">
                                <h3 class="post_title">{{$CI['title']}}</a></h3>

                            </div>
                            <div class="post_content">
                                <h4 class="post_title">{{$CI['desc']}}</a></h4>
                            </div>
                        </article>
                    @endforeach

                </div>

            </div>
        </div>
    </section>
@endsection
