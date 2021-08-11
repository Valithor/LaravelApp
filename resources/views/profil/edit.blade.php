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
                <h1 class="heading-line">Edycja</h1>
            </div>
            <section>

                    <!-- My Data -->
                <form route="profile.edit" enctype="multipart/form-data" method="POST">
                    @csrf

                    <!-- Error Message -->
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="row">
                        <h5 class="col ">Moje Dane</h5>
                    </div>

                    <div class="row">
                        <div class="col"> Zdjęcie profilowe </div>
                        <input type="file" name="avatar">                        
                    </div>               

                    <div class="row">
                        <div class="col"> Imię </div>
                        <input value="{{$user->name}}" type="text" name="name" class="col-8 {{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus>
                    </div>

                    <!-- Links -->
                    <div class="row">
                        <h5 class="col ">Moje Linki</h5>
                    </div>

                    <div class="row">
                        <div class="col"> Youtube </div>
                        @if(count($integration->where('site_name', 'youtube')))
                        @for($i = 0; $i < count($integration); $i++)
                        @if($result[$i]['site']==='youtube')
                            <input value="{{$result[$i]['url']}}" type="text" name="link[]" class="col-8">
                        @endif
                        @endfor                        @else
                        <input type="text" name="link[]" class="col-8">
                        @endif
                    </div>

                    <div class="row">
                        <div class="col"> Twitch </div>
                        @if(count($integration->where('site_name', 'twitch')))
                        @for($i = 0; $i < count($integration); $i++)
                        @if($result[$i]['site']==='twitch')
                            <input value="{{$result[$i]['url']}}" type="text" name="link[]" class="col-8">
                        @endif
                        @endfor
                        @else
                        <input type="text" name="link[]" class="col-8">
                        @endif
                    </div>

                    <div class="row">
                        <div class="col"> Twitter </div>
                        @if(count($integration->where('site_name', 'twitter')))
                        @for($i = 0; $i < count($integration); $i++)
                        @if($result[$i]['site']==='twitter')
                            <input value="{{$result[$i]['url']}}" type="text" name="link[]" class="col-8">
                        @endif
                        @endfor                        @else
                        <input type="text" name="link[]" class="col-8">
                        @endif
                    </div>

                    <!-- Button -->

                    <div class="profile-button row">
                        <div class="col"> 
                            <a class="btn btn-primary btn-lg text-light" href="/profile"> Wróć</a>
                            <button class="float-right btn btn-primary btn-lg text-light" type="submit"> Zapisz</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection