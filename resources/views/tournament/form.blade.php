@extends('layout')
@section('content')

    <div class="container bring-to-front">
        <div class="shadow rounded p-5 bg-contrast overflow-hidden">
            <div class="section-heading text-center">
                <h2 class="heading-line">Tworzenie tabeli turniejowej</h2>
            </div>

            <div class="mx-auto position-relative form-wrapper">
                <form method="post" id="form" action="{{route('tournament.submit')}}" name="form"
                      class="form text-center" data-response-message-animation="slide-in-left" novalidate>
                    @csrf
                    <div class="list-group col-md-6 mx-auto">
                        <div>
                            <input type="checkbox" name="shuffle" id="shuffle" class="form-check-input">
                            <label class="form-check-label" for="shuffle">Przetasuj zawodników</label>
                        </div>
                        <div>
                            <label for="type">Typ tabeli</label>
                            <select class="form-control" name="type" id="type">
                                <option value="1" selected>Pojedyncza</option>
                                <option value="2">Podwójna</option>
                            </select>
                        </div>
                    </div>
                    <div id="parent" class="list-group">
                        <div class="form-group form-filed horizontal">
                            <input name="players[]" class="input" type="text" autocomplete="off"
                                   placeholder="Wprowadź gracza" autofocus onkeydown="next(event)" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg btn-alternate align-center">Prześlij</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        function next(evt) {
            if (evt.which == 13) {
                addTextInput();
                evt.preventDefault();
            }
        }

        function addTextInput() {
            var newDiv = document.createElement("div");
            newDiv.className = 'form-group form-filed horizontal';

            var input = document.createElement("input");
            input.placeholder = 'Wprowadź gracza';
            input.type = 'text';
            input.className = 'input';
            input.autocomplete = 'off';
            input.name = 'players[]';
            input.required = true;
            input.addEventListener("keydown", next);

            newDiv.appendChild(input);
            var parentDiv = document.getElementById("parent");
            parentDiv.appendChild(newDiv);
            input.focus();
        }
    </script>
@endsection
