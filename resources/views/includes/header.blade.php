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
                <a href="#">
                    <img id="img-nav"src="{{ Storage::url('/logo/Capture.PNG') }}">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="#">&nbsp Jobs</a></li>
                    <li><a href="#">Companies</a></li>
                    <li><a href="#">Articles</a></li>
                    <li><a href="#">Introduce</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <button type="button" class="btn btn-success navbar-btn"><span class="glyphicon glyphicon-user"></span>&nbsp; Sign up</button>
                    &nbsp;
                    <button type="button" class="btn btn-info navbar-btn"><span class="glyphicon glyphicon-log-in"></span>&nbsp; Login</button>
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
</style>