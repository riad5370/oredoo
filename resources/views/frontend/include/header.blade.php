<header class="header navbar-expand-lg fixed-top ">
    <div class="container-fluid ">
        <div class="header-area ">
            <!--logo-->
            <div class="logo">
                <a href="index.html">
                    <img src="{{asset('frontend')}}/assets/img/logo/logo-dark.png" alt="" class="logo-dark">
                    <img src="{{asset('frontend')}}/assets/img/logo/logo-white.png" alt="" class="logo-white">
                </a>
            </div>
            <div class="header-navbar">
                <nav class="navbar">
                    <!--navbar-collapse-->
                    <div class="collapse navbar-collapse" id="main_nav">
                        <ul class="navbar-nav ">
                            <li class="nav-item ">
                                <a class="nav-link active" href="{{route('index')}}"> Home </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="blog.html"> Blogs </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('author.list')}}"> Authors </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.html"> About </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.html"> Contact </a>
                            </li>
                        </ul>
                    </div>
                    <!--/-->
                </nav>
            </div>

            <!--header-right-->
            <div class="header-right ">
                <!--theme-switch-->
                <div class="theme-switch-wrapper">
                    <label class="theme-switch" for="checkbox">
                        <input type="checkbox" id="checkbox" />
                        <span class="slider round ">
                            <i class="lar la-sun icon-light"></i>
                            <i class="lar la-moon icon-dark"></i>
                        </span>
                    </label>
                </div>

                <!--search-icon-->
                <div class="search-icon">
                    <i class="las la-search"></i>
                </div>
                <!--button-subscribe-->
                <div class="botton-sub">
                    @auth('guestlogin')
                        <div class="dropdown">
                        <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::guard('guestlogin')->user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">Profile</a>
                          <a class="dropdown-item" href="{{route('guest.logout')}}">Logout</a>

                        </div>
                      </div>
                    @else
                        <a href="{{route('guest.register')}}" class="btn-subscribe">Sign Up</a>
                    @endauth
                    
                </div>
                <!--navbar-toggler-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </div>
</header>