<!--Start Header Area-->
<header>
    <div class="header-container">
        <div class="demo-navber">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="demo-logo">
                            <a class="navbar-brand" href="#"><img src="{{asset('images/logo.png')}}" alt="logo" class="img-responsive"/></a>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="demo-button">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="navber-area">
            <nav class="navbar">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <div class="logo">
                                    <a class="navbar-brand" href="#"><img src="{{asset('images/logo.png')}}" alt="logo" class="img-responsive"/></a>
                                </div>
                            </div>
                            <ul class="menu-sidebar pull-right">
                                <li class="marv-share">
                                    <div class="slideouticons">
                                        <input type="checkbox" id="togglebox">
                                        <label for="togglebox" class="mainlabel"><i class="fa fa-language"></i></label>
                                        <div class="iconswrapper">
                                            <ul>
                                                @foreach($lang as $l)
                                                    <li><a class="" href="/locale/{{$l['title']}}">{{$l['title']}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="collapse navbar-collapse nav-menu pull-right" id="bs-example-navbar-collapse-1">
                                <div class="nav-close-button">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </div>
                                <ul class="nav navbar-nav">
                                    @foreach($Menus as $key=>$menu)
                                        <li><a href="#" data-scroll-nav="{{$key}}">{{$menu}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>
<!-- //End Header Area-->
