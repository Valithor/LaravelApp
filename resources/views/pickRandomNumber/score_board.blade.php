@extends('layout')
@section('content')
    <div class="card mt-5">
        <div class="card-header">
            <h2>Tablica wyników</h2>
            <h4>Poziom trudności - {{ $level }}</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" style="width:100%">
                <tr>
                    <th scope="col">Nick</th>
                    <th scope="col">Wynik</th>
                </tr>
                @foreach($scores as $score)
                    <tr>
                        <td>{{ $score->nick }}</td>
                        <td>{{ $score->score }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
