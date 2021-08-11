@extends('layout')
@section('content')

    <div class="container">
        <div class="col 12 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-light text-center">
                    <h1>Dodaj nazwy drużyn i graczy</h1>
                </div>
                <div class="card-body">
                    <div class="mx-auto position-relative form-wrapper">
                        <form method="post" action="{{route('randomizeTeam.store')}}" name="form"
                              class="form-group form-filed horizontal" data-response-message-animation="slide-in-left"
                              novalidate>
                            @csrf
                            <div class="row">
                                <div class="justify-content-center col-md-6" id="parentPlayers">
                                    <div class="row justify-content-center m-2">
                                        <div class="input-group w-50">
                                            <input name="players[]" class="form-control text-center" type="text"
                                                   autocomplete="off"
                                                   placeholder="Wprowadź gracza" autofocus
                                                   onkeypress='validateTeam(event)'
                                                   onkeydown="addDivPlayer(event)" required>

                                        </div>
                                    </div>
                                </div>
                                <div class="justify-content-center col-md-6" id="parentTeams">
                                    <div class="row justify-content-center m-2">
                                        <div class="input-group w-50">
                                            <input name="teams[]" class="form-control text-center" type="text"
                                                   autocomplete="off"
                                                   placeholder="Wprowadź drużynę" autofocus
                                                   onkeypress='validateTeam(event)'
                                                   onkeydown="addDivTeam(event)" required>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-lg bg-primary text-light ">
                                        Losuj
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script src="/js/onlyLettersNumbers.js"></script>

@endsection
