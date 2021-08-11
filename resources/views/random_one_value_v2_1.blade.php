
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
        <title>Laravel</title>

    </head>

    <body>
    <form method="post" action="{{route('randomize.store')}}">
    {{ csrf_field() }}
<?php

$message = '';
if (isset($_POST['numbers'])) {
    $numbers[] = $_POST['numbers'];
}
?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Dodaj wartość do wylosowania</h2>
        </div>
        <div class="card-body">
            <?php if (!empty($message)): ?>
                <div class="alert alert-success">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
            <form method="post">

                <div class="form-group">
                    <label for="numbers">Podaj wartości po przecinku </label>
                    <input type="text" name="numbers" id="numbers" class="form-control">
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-outline-info">Losuj</button>
                    
                    
                </div>
            </form>
        </div>
    </div>
</div>       
        
        


</html>
