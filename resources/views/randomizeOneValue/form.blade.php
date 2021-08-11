@extends('layout')
@section('content')

    <div class="container">
        <div class="col 12 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-light text-center">
                    <h1>Losowanie liczby</h1>
                </div>
                <div class="card-body">
                    <form method="post" id="parent" action="{{route('randomize.store')}}" name="form"
                          class="form-horizontal" data-response-message-animation="slide-in-left" novalidate>
                        @csrf
                        <div class="row justify-content-center m-2" id="parent">
                            <div class="input-group w-25">
                                <input name="numbers[]" class="form-control text-center" type="text" autocomplete="off"
                                       placeholder="Wprowadź liczbę" autofocus onkeypress='validate(event)'
                                       onkeydown="pressEnter(event)" required>
                            </div>
                        </div>
                </div>

                <div class="row mb-3">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-lg bg-primary text-light ">
                            <h6>Losuj liczbę</h6>
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>

        <script src="js/onlyNumbers.js"></script>
@endsection
