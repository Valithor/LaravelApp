<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="min-height: 100% !important;" >
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->
    <title>Random Picker</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="icon" href="favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,600,700,900" rel="stylesheet">

    <link rel="stylesheet" href="/css/aos.css">
    <link rel="stylesheet" href="/css/all.css">
    <link rel="stylesheet" href="/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="/css/odometer-theme-minimal.css">
    <link rel="stylesheet" href="/css/swiper.css">
    <link rel="stylesheet" href="/css/laapp.css">
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->



    <!-- Main Navigation -->
    @yield('verified-alert')

<nav class="navbar navbar-expand-md main-nav navigation fixed-top sidebar-left bg-white">
    <div class="container">
    <button class="navbar-toggler" type="button">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <a href="/" class="navbar-brand">

            <img src="/svg/logo.png" alt="Laapp" class="logo logo-sticky">

    </a>

    <div class="collapse navbar-collapse" id="main-navbar">
        <div class="sidebar-brand">
            <a href="/">
                <img src="/svg/logo.png" alt="Laapp Template" class="logo">
            </a>
        </div>

        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link text-primary" href="/">Home</a></li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle text-primary" data-toggle="dropdown">Losowanie</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/randomize">Losowanie jednej liczby</a></li>
                    <li><a class="dropdown-item" href="/randomizeTeam">Losowanie drużyn</a></li>
                    <li><a class="dropdown-item" href="/youtube">Losowanie komentarzy YT</a></li>
                    <li><a class="dropdown-item" href="/tournament">Turniej</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle text-primary" data-toggle="dropdown">Gry</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/pick">Traf w liczbę</a></li>
                </ul>
            </li>
        </ul>

        @auth
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle text-primary profile" style="position:relative; padding-left:50px;" data-toggle="dropdown">
                    <div class="menu-profile"><img src="/svg/avatars/{{Auth::user()->avatar }}" alt="Laapp" class="menu-profile"></div>    
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/profile">Mój Profil</a></li>
                    <li><a class="dropdown-item" href="/history">Historia losowań</a></li>
                    <li><a class="dropdown-item" href="/logout">Wyloguj</a></li>
                </ul>
            </li>
        </ul> 
        @endauth

        @guest
        <ul class="nav navbar-nav ml-auto nav-item">            
                    <li><a class="nav-link text-primary" href="/login">Logowanie</a></li>
                    <li><a class="nav-link text-primary" href="/register">Rejestracja</a></li>            
        </ul> 
        @endguest

    </div>
</div>

</nav>

<main >

<!-- Alternative 2 Heading -->
<header class="header alter2-header section" id="home">
    <div class="shapes-container">
        <!-- diagonal shapes -->

            <div class="shape shape-animated" data-aos="fade-down-right" data-aos-duration="1500" data-aos-delay="100"></div>

            <div class="shape shape-animated" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="100"></div>

            <div class="shape shape-animated" data-aos="fade-up-left" data-aos-duration="500" data-aos-delay="200"></div>

            <div class="shape shape-animated" data-aos="fade-up" data-aos-duration="500" data-aos-delay="200"></div>

            <div class="shape shape-animated" data-aos="fade-up-right" data-aos-duration="1000" data-aos-delay="200"></div>

            <div class="shape shape-animated" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200"></div>

            <div class="shape shape-animated" data-aos="fade-down-left" data-aos-duration="1000" data-aos-delay="100"></div>

            <div class="shape shape-animated" data-aos="fade-down-left" data-aos-duration="1000" data-aos-delay="100"></div>

            <div class="shape shape-animated" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300"></div>


        <!-- animated shapes -->
        <div class="animation-shape shape-ring animation--clockwise"></div>
        <div class="animation-shape shape-circle shape-circle-1 animation--anti-clockwise"></div>
        <div class="animation-shape shape-circle shape-circle-2 animation--clockwise"></div>
        <div class="animation-shape shape-heart animation--clockwise">
            <div class="animation--rotating"></div>
        </div>

        <div class="animation-shape shape-triangle animation--rotating-diagonal">
            <div class="animation--rotating"></div>
        </div>
        <div class="animation-shape shape-diamond animation--anti-clockwise">
            <div class="animation--rotating"></div>
        </div>

        <!-- static shapes -->
        <div class="static-shape shape-ring-1"></div>
        <div class="static-shape shape-ring-2"></div>

        <div class="static-shape shape-circle shape-circle-1">
            <div data-aos="fade-down-left"></div>
        </div>

        <div class="static-shape shape-circle shape-circle-2">
            <div data-aos="fade-down-left" data-aos-delay="500"></div>
        </div>

        <div class="static-shape pattern-dots-1"></div>
        <div class="static-shape pattern-dots-2"></div>

        <!-- main shape -->
        <div class="static-shape background-shape-main"></div>

        <!-- ghost shapes -->
        <div class="static-shape ghost-shape ghost-shape-1"></div>
    </div>


    <div class="container" style="z-index: 1000;">
       @yield('content')
    </div>
</header>


</main>


    <!-- Footer -->
<footer class="@yield('footer','site-footer section bg-dark text-contrast edge top-left')">
    <div class="container py-3">
        <div class="row gap-y text-center text-md-left">
            <div class="col-md-4 mr-auto">
                <img src="/svg/logo-light.png" alt="" class="logo">

                <p>Strona do losowych rzeczy :)</p>
                @yield('contentt')
            </div>

            <div class="col-md-2">
                <nav class="nav flex-column">
                    <a class="nav-item py-2 text-contrast" href="#">About</a>
                    <a class="nav-item py-2 text-contrast" href="#">Services</a>
                    <a class="nav-item py-2 text-contrast" href="#">Blog</a>
                </nav>
            </div>

            <div class="col-md-2">
                <nav class="nav flex-column">
                    <a class="nav-item py-2 text-contrast" href="#">Features</a>
                    <a class="nav-item py-2 text-contrast" href="#">API</a>
                    <a class="nav-item py-2 text-contrast" href="#">Customers</a>
                </nav>
            </div>

            <div class="col-md-2">
                <nav class="nav flex-column">
                    <a class="nav-item py-2 text-contrast" href="#">Careers</a>
                    <a class="nav-item py-2 text-contrast" href="#">Contact</a>
                    <a class="nav-item py-2 text-contrast" href="#">Search</a>
                </nav>
            </div>

            <div class="col-md-2">
                <h6 class="py-2 small">Follow us</h6>

                <nav class="nav justify-content-around">
                    <a href="https://facebook.com/5studios.net" target="_blank" class="btn btn-circle btn-sm brand-facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="btn btn-circle btn-sm brand-twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="btn btn-circle btn-sm brand-instagram"><i class="fab fa-instagram"></i></a>
                </nav>
            </div>
        </div>

        <hr class="mt-5 op-5" />
        <div class="row small">
            <div class="col-md-4">
                <p class="mt-2 mb-0 text-center text-md-left">© 2020 <a href="https://lastlevel.pl">LastLevel</a>. All Rights Reserved</p>
            </div>
        </div>
    </div>
</footer>

<script src="/js/jquery.js"></script>
<script src="/js/popper.js"></script>
<script src="/js/bootstrap.bundle.js"></script>
<script src="/js/jquery.easing.min.js"></script>
<script src="/js/jquery.validate.js"></script>
<script src="/js/aos.js"></script>
<script src="/js/counterup2.js"></script>
<script src="/js/odometer.js"></script>
<script src="/js/swiper.js"></script>
<script src="/js/snap.svg.js"></script>
<script src="/js/tilt.jquery.js"></script>
<script src="/js/typed.js"></script>
<script src="/js/noframework.waypoints.js"></script>
{{-- <script src="js/forms.js"></script>formularz nie działą z tym skryptem --}}
<script src="/js/scrollspy.js"></script>
<script src="/js/site.js"></script>
<script src="/js/onlyNumbers.js"></script>
<script src="/js/hideAlert.js"></script>

</body>
</html>
