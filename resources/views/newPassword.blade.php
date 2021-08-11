@extends('layout')
@section('footer','login-footer section bg-dark text-contrast edge')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="login-form card">
                <div class="login-form card-header"> Zmiana Hasła </div>

                <div class="card-body">
                    <!-- Form -->
                    <form method="POST" route="newPassword.store">
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
                        
                        <!-- Token -->
                        <input type="hidden" name="token" value="{{ $token }}">

                        <!-- Password -->
                        <div class="form-group row">
                            <label class="login-form col-md-4 col-form-label text-md-right">Aktualne Hasło</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="current_password" required>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="login-form col-md-4 col-form-label text-md-right">Nowe Hasło</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="login-form col-md-4 col-form-label text-md-right">Powtórz Nowe Hasło</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <!-- button -->
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary text-light">
                                    Wyślij
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
