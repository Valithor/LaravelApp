
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>

    <body>
    <form method="post" action="{{route('randomizeTeam.store')}}">
    {{ csrf_field() }}
    <div class="input_fields_wrap">
        <h1>Gracze</h1>
        <div><input type="text" name="players[]"></div>
        <div><input type="text" name="players[]"></div>
        <div><input type="text" name="players[]"></div>
        <div><input type="text" name="players[]"></div>
        <div><input type="text" name="players[]"></div>
 
    </div>

    <div class="input_fields_wrap">
        <h1>Druzyny</h1>
        <div><input type="text" name="teams[]"></div>
        <div><input type="text" name="teams[]"></div>
        <div><input type="text" name="teams[]"></div>
        <div><input type="text" name="teams[]"></div>
        <div><input type="text" name="teams[]"></div>
    </div>
    <button class="add_field_button">Wyslij</button>
</form>
    </body>

</html>

