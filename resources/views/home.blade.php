@extends('layout')
@section('content')

@section('verified-alert')
    @if(session('verified'))
        <div id="login-verified"> E-mail został pomyślnie zweryfikowany!  </div>
    @elseif(session('status'))
        <div id="login-verified"> Hasło zostało zresetowane! </div>
    @endif
@endsection

    <section class="jumbotron text-center bg-primary">
        <div class="container">
            <h1 style="font-size:75px" class="jumbotron-heading text-white">Random Picker</h1>
            <p style="font-size:25px" class="lead text-light">Wszystko czego potrzebujesz do losowania</p>
        </div>
    </section>
    <div class="card mt-5">
        <div id="featuresCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#featuresCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#featuresCarousel" data-slide-to="1"></li>
                <li data-target="#featuresCarousel" data-slide-to="2"></li>
                <li data-target="#featuresCarousel" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="#youtube">
                        <img class="d-block w-100 cropimg"
                             src="https://colorlib.com/wp/wp-content/uploads/sites/2/comment-moderation-guide-wordress-800x453.png"
                             alt="slide">
                        <div class="carousel-caption"><h2>Losowanie komentarzy</h2></div>
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="/randomize">
                        <img class="d-block w-100 cropimg"
                             src="https://lh3.googleusercontent.com/proxy/V5Tw88Vcv7zaY_zHSbNvNs0Q9VGdk1Ew_mOq3LO5b_0rJB9j4cXzyt8gvXAoi8WvVPtIvgC6HbBjBo_EuSG-SQYT4Lm3wIm6MA"
                             alt="slide">
                        <div class="carousel-caption"><h2>Losowanie liczb</h2></div>
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="/randomizeTeam">
                        <img class="d-block w-100 cropimg" height="400px"
                             src="http://www.clker.com/cliparts/5/8/0/a/1516496967366986588free-clipart-teams-working-together.hi.png"
                             alt="slide">
                        <div class="carousel-caption"><h2>Losowanie drużyn</h2></div>
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="/pick">
                        <img class="d-block w-100 cropimg" height="400px"
                             src="https://thumbs.dreamstime.com/b/hand-drawing-lots-bowl-small-colorful-paper-pieces-cut-randomly-68370310.jpg"
                             alt="slide">
                        <div class="carousel-caption"><h2>Zgadywanie liczby</h2></div>
                    </a>
                </div>
            </div>
            <a class="carousel-control-prev" href="#featuresCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Poprzedni</span>
            </a>
            <a class="carousel-control-next" href="#featuresCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Następny</span>
            </a>
        </div>
    </div>


    <div class="row" style="padding-top:50px">
        <div class="col-xs-12 col-md-6 col-lg-4" style="margin-bottom: 50px">
            <a href="/youtube">
            <div class="card">
                <div class="card-header bg-primary text-light">
                    Integracja z Youtube
                </div>
                <div class="card-body">
                    <img class="d-block w-100 cropimg-small"
                         src="https://storage.googleapis.com/support-forums-api/attachment/thread-20727358-8718586484531082096.png"
                         alt="youtube">
                    <p class="text-primary">
                        Losuj komentarze jednym kliknięciem
                    </p>
                </div>
            </div>
            </a>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-4" style="margin-bottom: 50px">
            <a href="/randomize">
            <div class="card">
                <div class="card-header bg-primary text-light">
                    Losowanie liczb
                </div>
                <div class="card-body">
                    <img class="d-block w-100 cropimg-small"
                         src="https://cdn.dribbble.com/users/2694115/screenshots/5824849/lifelimitsart_025.png"
                         alt="dices">
                    <p class="text-primary">
                        Losuj spośród wybranego zbioru
                    </p>
                </div>
            </div>
            </a>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-4" style="margin-bottom: 50px">
            <a href="/randomizeTeam">
                <div class="card">
                    <div class="card-header bg-primary text-light">
                        Losowanie drużyn
                    </div>
                    <div class="card-body">
                        <img class="d-block w-100 cropimg-small"
                             src="https://idatassist.com/wp-content/uploads/bfi_thumb/dreamstime_s_97267612-30plbij3f6l4ihnhxqd7emdx8u2dqenhb30vgrdxneh9pg3pe.jpg"
                             alt="dices">
                        <p class="text-primary">
                            Przydzielaj graczy do drużyn
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-4" style="margin-bottom: 50px">
            <a href="/pick">
                <div class="card">
                    <div class="card-header bg-primary text-light">
                        Gry
                    </div>
                    <div class="card-body">
                        <img class="d-block w-100 cropimg-small"
                             src="https://previews.123rf.com/images/djvstock/djvstock1704/djvstock170410719/76008534-gamepad-videogame-console-icon-vector-illustration-graphic-design.jpg"
                             alt="dices">
                        <p class="text-primary">
                            Graj w zgadywanie liczby
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <script>
        $(function () {
            $('.carousel').carousel({
                interval: 2000
            });
        });
    </script>
@endsection
