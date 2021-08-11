@extends('layout')
@section('content')
    <div class="card mt-5">
        @if(Session::has('message'))
            <div class="alert alert-danger card">
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="card-header">
            <div class="row">
                <div class="col-md-9">
                    <h2>Witaj {{Session::get('nick')}}, zgadnij liczbę</h2>
                </div>
                <div class="col-md-3">
                    <div class="float-right">
                        <form method="POST" action="{{route('pick.store')}}">
                            {{ csrf_field() }}
                            <button class="btn btn-danger" name="pickedNumber" value="0">Poddaję się
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('pick.store')}}">
                {{ csrf_field() }}
                @for($x = 1; $x<=Session::get('size'); $x++)
                    @if(in_array($x, Session::get('tried')))
                        <button class="pick-number btn btn-danger" name="pickedNumber" value="{{$x}}"
                                disabled>{{$x}}</button>
                    @else
                        <button class="pick-number btn btn-success" name="pickedNumber" value="{{$x}}">{{$x}}</button>
                    @endif
                @endfor
            </form>
        </div>
    </div>
@endsection
