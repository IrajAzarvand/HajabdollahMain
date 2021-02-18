@extends('PageElements.Main.InnerPagesLayout')
@section('PageTitle', 'تماس با ما')
@section('content')

    @if(Session::has('status'))
        <script>alert('{{ Session::get('status') }}')</script>
    @endif

    <section class="with_right_sidebar">
        <div class="container">
            <div class="row">
                <div id="leftcol" class="col-sm-12 col-md-12">


                    <section>
                        <div class="row">
                            <div class="office_address col-sm-6 col-md-4">
                                <div class="team_member"><img src="{{asset('Main/images/Etminan about-us Logo.jpg')}}"
                                                              alt="logo">
                                    <h5>{{$CompanyName}}</h5>
                                    <address>
                                        {{$Address}}
                                    </address>
                                    <abbr title="Phone">{{$PhoneTitle}}:</abbr> (98) 41-34328223<br>
                                    <abbr title="Phone">{{$EmailTitle}}:</abbr> <a
                                        href="mailto:#">info@hajabdollah.com</a>
                                </div>
                            </div>
                            <div class="contact_form col-sm-6 col-md-8">
                                <form name="contact_form" action="{{route('ContactUs')}}" id="contact_form" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <label>{{ $FormNameTitle }} <span style="color: red">*</span></label>
                                            <input name="name" id="name" class="form-control" type="text" value="" required>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <label>{{ $FormEmailTitle }} <span style="color: red">*</span></label>
                                            <input name="email" id="email" class="form-control" type="text" value="" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <label>{{ $FormSubjectTitle }} <span style="color: red">*</span></label>
                                            <input name="subject" id="subject" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <label>{{ $FormMessageTitle }} <span style="color: red">*</span></label>
                                            <textarea name="message" id="message" rows="8"
                                                      class="form-control" required></textarea>
                                        </div>
                                        <div class="col-sm-12 col-md-12"><br/>
                                           <button type="submit" style="border: none; background-color: transparent;">
                                               <a id="submit_btn" class="btn btn-primary" name="submit">{{ $FormSendMessageBtn }}</a> <span
                                                   id="notice" class="alert alert-warning alert-dismissable hidden"
                                                   style="margin-left:20px;"></span>
                                           </button> </div>
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </section>


                </div>

            </div>
        </div>
    </section>
@endsection
