<nav class="navbar navbar-default navbar-static-top navbar-fixed-top" style="margin-bottom: 0px">
    <div class="row" id="header-content">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a href="{{ route('home') }}">
                    <img id="img-nav"src="{{ Storage::url('/logo/Capture.PNG') }}">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('get-jobs-list') }}">&nbsp Jobs</a></li>
                    <li><a href="#">Companies</a></li>
                    <li><a href="#">Articles</a></li>
                    <li><a href="#">Introduce</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if(Auth::guest())
                        <button type="button" class="btn btn-success navbar-btn"><span class="glyphicon glyphicon-user"></span><a href="{{ route('get-sign-up') }}" style="text-decoration: none;">&nbsp; Sign up</a></button>
                        <button type="button" class="btn btn-info navbar-btn"><span class="glyphicon glyphicon-log-in"></span><a href="{{ route('get-sign-in') }}" style="text-decoration: none;">&nbsp; Sign in</a></button>
                    @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="background-color: #2a88bd;">{{ Auth::user()->full_name }} <span class="caret"></span></a>
                                @if(Auth::user()->role_id == 3)
                                    <ul class="dropdown-menu" role="menu" style="background-color: #3B4F6B;">
                                        <li><a href="#">My page (Your Account)</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="{{ route('log-out') }}">Logout</a></li>
                                    </ul>
                                @elseif(Auth::user()->role_id == 2)
                                    <ul class="dropdown-menu" role="menu" style="background-color: #3B4F6B;">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#">One more separated link</a></li>
                                    </ul>
                                @elseif(Auth::user()->role_id == 1)

                                @endif
                            </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</nav>
<style>
    #header-content {
        background: #3B4F6B;
    }

    #header-content a {
        color: whitesmoke;
    }

    .dropdown-menu > li > a:hover {
        background-color: #2a88bd;
        background-image: none;
    }
</style>