@extends('layout')
@section('content')
    <div class="container">
        <div class="col 12 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-light text-center">
                    <h1>Wylosowano następujące drużyny:</h1>
                </div>
                <div class="card-body">
                    <div class="mx-auto row position-relative form-wrapper justify-content-center">
                        @foreach ($teams_json as $team => $player)
                            <div class="col-md-6 bring-to-front">
                                <style type="text/css">
                                    .table {
                                        margin-right: auto;
                                        margin-left: auto;
                                        margin-bottom: 5%;
                                        margin-top: 5%;
                                        width: 80%;
                                    }
                                </style>
                                <table class="table table-bordered table-striped center">
                                    <thead class="bg-primary">
                                    <tr>
                                        <th class="text-center text-light">{{$team}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-center">
                                            @foreach($player as $p)
                                                {{$p}}<br>
                                            @endforeach
                                            {{-- {{$loop->last? "": "  &nbsp; " }} --}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                        <form method="post" id="form" action="{{route('randomizeTeam.store')}}" name="form"
                              class="form text-center" data-response-message-animation="slide-in-left" novalidate>
                            @csrf
                            <button type="submit" class="btn btn-lg bg-primary text-light m-2">Ponowne Losowanie
                            </button>
                            <a href="/randomizeTeam" id="destroySession" type="submit"
                               class="btn btn-lg bg-primary text-light m-2">Anuluj</a>
                        </form>

                </div>
            </div>
        </div>
    </div>
@endsection
