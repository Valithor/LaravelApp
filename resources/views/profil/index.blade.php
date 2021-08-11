@extends('layout')
@section('footer','login-footer section bg-dark text-contrast edge')

@section('content')
    <div class="user-profile row">

        <!-- Content -->
        @section('verified-alert')
            @if(session()->has('message'))
                <div id="login-verified"> {{session()->get('message')}} </div>
            @endif
        @endsection

        <div class="user-panel">
            <div class="section-heading text-center">
                <h1 class="heading-line">Mój Profil</h1>
            </div>
            <section>

                <!-- My Data -->
                <div class="row">
                    <h5 class="col ">Moje Dane</h5>
                </div>
                <div class="row">
                <img src="/svg/avatars/{{$user->avatar}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">           
                </div>
                <div class="row">
                    <div class="col"> Imię </div>
                    <div class="col-8"> {{$user->name}} </div>
                </div>
                <div class="row">
                    <div class="col"> E-mail </div>
                    <div class="col-8"> {{$user->email }}</div>
                </div>
                <!-- Links -->

                <div class="row">
                    <h5 class="col ">Moje Linki</h5>
                </div>
                @foreach($result as $count=>$one)
                     <div class="row">
                    <div class="col"> {{ucfirst(trans($one['site']))}} </div>
                    @if($one['url'] != Null)
                    @if($one['site']==='youtube')
                        <a href="{{$integration[$count]->link}}" class="col-8">{{Youtube::getChannelById(substr($one['url'],9))->snippet->title}}</a>
                    @else
                        <a href="{{$integration[$count]->link}}" class="col-8">{{substr($one['url'],1)}}</a>
                    @endif                
                    @else
                        <div class="col-8">Brak</div>
                    @endif
                </div>
                @endforeach
               

                <!-- Other -->
                <div class="row">
                    <h5 class="col ">Inne</h5>
                </div>
                <div class="row">
                <div class="col"> Weryfikacja Konta </div>
                    <div class="col-8"> 
                        
                        @if($user->email_verified_at === NULL) 
                            Nie
                        @else 
                            Tak
                        @endif
                        
                    </div>
                </div>
                <div class="profile-button row">
                    <div class="col-md"> 
                            <a class="btn btn-primary btn-lg text-light" href="newPassword"> Zmień Hasło</a>
                            <a class="float-right btn btn-primary btn-lg text-light" href="profile/edit"> Edytuj</a>
                    </div>
                </div>

            </section>
        </div>
    </div>
@endsection