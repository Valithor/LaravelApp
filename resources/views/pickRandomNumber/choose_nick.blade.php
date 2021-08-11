@extends('layout')
@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="card mt-5">

                @if(Session::has('message'))
                    <div class="alert alert-success card">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="card-header">
                    <h2>Zagraj</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('pick.store')}}">
                        {{ csrf_field() }}
                        <div class="form-group">


                            <label for="nick">Nick:</label>
                            <input type="text" name="nick" class="form-control" placeholder="nick">
                        </div>

                        <div class="form-group">
                            <label for="size">Poziom trudności:</label>
                            <div>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-info">
                                        <input type="radio" name="size" value="10" autocomplete="off"> Łatwy
                                    </label>
                                    <label class="btn btn-info active">
                                        <input type="radio" name="size" value="50" autocomplete="off" checked> Średni
                                    </label>
                                    <label class="btn btn-info">
                                        <input type="radio" name="size" value="100" autocomplete="off"> Trudny
                                    </label>
                                    <label class="btn btn-info">
                                        <input type="radio" name="size" value="250" autocomplete="off"> Niemożliwy
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 form-group text-center">
                            <button type="submit" class="btn btn-success">Start</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card mt-5">
                <div class="card-header">
                    <h2>Tablica wyników</h2>
                </div>
                <div class="card-body">

                        <div class="nav btn-group">
                            <a href="#easy" class="btn btn-info" data-toggle="tab">
                                Łatwy
                            </a>
                            <a href="#medium" class="btn btn-info active" data-toggle="tab">
                                Średni
                            </a>
                            <a href="#hard" class="btn btn-info" data-toggle="tab">
                                Trudny
                            </a>
                            <a href="#impossible" class="btn btn-info" data-toggle="tab">
                                Niemożliwy
                            </a>
                        </div>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="easy" role="tabpanel" aria-labelledby="easy-tab">
                            <table class="table table-striped" style="width:100%">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nick</th>
                                    <th scope="col">Wynik</th>
                                    <th scope="col">Czas</th>
                                </tr>
                                @foreach($scores['easy'] as $score)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $score->nick }}</td>
                                        <td>{{ $score->score }}</td>
                                        <td>
                                            @if($score->time > 60)
                                                {{(int)($score->time/60)}}m {{$score->time%60}}s
                                            @else
                                                {{$score->time%60}}s
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        <div class="tab-pane fade show active" id="medium" role="tabpanel" aria-labelledby="medium-tab">
                            <table class="table table-striped" style="width:100%">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nick</th>
                                    <th scope="col">Wynik</th>
                                    <th scope="col">Czas</th>
                                </tr>
                                @foreach($scores['medium'] as $score)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $score->nick }}</td>
                                        <td>{{ $score->score }}</td>
                                        <td>
                                            @if($score->time > 60)
                                                {{(int)($score->time/60)}}m {{$score->time%60}}s
                                            @else
                                                {{$score->time%60}}s
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        <div class="tab-pane fade" id="hard" role="tabpanel" aria-labelledby="hard-tab">
                            <table class="table table-striped" style="width:100%">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nick</th>
                                    <th scope="col">Wynik</th>
                                    <th scope="col">Czas</th>
                                </tr>
                                @foreach($scores['hard'] as $score)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $score->nick }}</td>
                                        <td>{{ $score->score }}</td>
                                        <td>
                                            @if($score->time > 60)
                                                {{(int)($score->time/60)}}m {{$score->time%60}}s
                                            @else
                                                {{$score->time%60}}s
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        <div class="tab-pane fade" id="impossible" role="tabpanel"
                             aria-labelledby="impossible-tab">
                            <table class="table table-striped" style="width:100%">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nick</th>
                                    <th scope="col">Wynik</th>
                                    <th scope="col">Czas</th>
                                </tr>
                                @foreach($scores['impossible'] as $score)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $score->nick }}</td>
                                        <td>{{ $score->score }}</td>
                                        <td>
                                            @if($score->time > 60)
                                                {{(int)($score->time/60)}}m {{$score->time%60}}s
                                            @else
                                                {{$score->time%60}}s
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
