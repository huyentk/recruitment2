<nav class="navbar navbar-default navbar-static-top navbar-fixed-top" style="margin-bottom: 0px">
    <div class="row" id="header-content" style="padding-top: 0px;">
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
                    <img id="img-nav" src="{{ Storage::url('/logo/Capture.PNG') }}">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('get-jobs-list') }}">&nbsp Jobs</a></li>
                    {{--<li><a href="#">Companies</a></li>--}}
                    <li><a href="#">Articles</a></li>
                    <li><a href="#">Introduce</a></li>
                    <li><a href="{{ route('get-contact') }}">Contact Us</a></li>
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
                            <ul class="dropdown-menu" role="menu" style="background-color: #3B4F6B;">
                            @if(Auth::user()->role_id == 3)
                                <li><a href="{{ route('get-student-page',['id' => Auth::user()->id]) }}">My page (Your Account)</a></li>
                            @elseif(Auth::user()->role_id == 2)
                                <li><a href="{{ route('get-employee-page',['id' => Auth::user()->id]) }}">My page (Your Account)</a></li>
                                <li><a href="{{ route('employee-get-company-page',['emp_id' => Auth::user()->id]) }}">My Company Page</a></li>
                                <li><a href="{{ route('get-create-job') }}">Create Job</a></li>
                                <li><a href="{{ route('get-job-management') }}">Jobs Management</a></li>
                            @elseif(Auth::user()->role_id == 1)
                                <li><a href="{{ route('create-company-account') }}">Create company account</a></li>
                            @endif
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('log-out') }}">Logout</a></li>
                            </ul>
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