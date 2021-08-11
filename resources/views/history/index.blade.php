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
                <h1 class="heading-line">Historia Losowań</h1>
            </div>
            <section>
                <table>
                    <tr>
                    <th>Rodzaj losowania</th>
                    <th>Pula</th>
                    <th>Wynik</th>
                    <th></th>
                    </tr>
                    @foreach($histories as $history)
                    <tr>
                    <td>{{$history->type}}</td>                
                    <td>{!! nl2br(e($history->data)) !!}</td>
                     @if($history->type==='Losowanie drużyn')
                    <td><a href="{{url('history/team', $history->id)}}">Podgląd</a></td>
                    @else
                    <td>{{$history->winner}}</td>
                    @endif
                    <td>{{$history->created_at->diffForHumans()}}</td>
                    </tr>
                    @endforeach
                    </table>
            </section>
        </div>
    </div>
@endsection