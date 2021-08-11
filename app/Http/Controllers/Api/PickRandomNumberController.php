<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Session;
use Log;
use App\Score;


class PickRandomNumberController extends Controller
{
    public function index()
    {
        //sprawdza czy użytkownik podał swój nick w tej sesji
        if (!Session::has('nick')) {
            $scores = [
                "easy" => Score::where('difficulty', '=', 'easy')->take(25)->get()->sortBy('time')->sortBy('score'),
                "medium" => Score::where('difficulty', '=', 'medium')->take(25)->get()->sortBy('time')->sortBy('score'),
                "hard" => Score::where('difficulty', '=', 'hard')->take(25)->get()->sortBy('time')->sortBy('score'),
                "impossible" => Score::where('difficulty', '=', 'impossible')->take(25)->get()->sortBy('time')->sortBy('score'),
            ];
            return view('pickRandomNumber.choose_nick')->with('scores', $scores); //wyświedla widok wybierania nicku
        } else {
            return view('pickRandomNumber.pick_number'); //wyświetla widok strzelania liczby
        }
    }

    public function store(Request $request)
    {
        $difficulties = [
            "10" => "easy",
            "50" => "medium",
            "100" => "hard",
            "250" => "impossible",
        ];
        if (!Session::has('nick')) {
            $data = $request->all();
            Session::put('nick', $data['nick']); //zapisuje nick
            Session::put('size', $data['size']); //zapisuje ilość opcji
            Session::put('tryCount', 0); //ustawia wstępną wartość licznika prób na 0
            Session::put('number', rand(1, $data['size'])); //losuje liczbę
            Session::put('tried', []); //tworzy pustą listę liczb które już zostały spróbowane
            Session::put('timeStart', now());
        } else {
            $number = $request->pickedNumber;
            Session::put('tryCount', Session::get('tryCount') + 1); //zwiększa licznik prób

            $tried = Session::get('tried');
            array_push($tried, $number); //dodaje wybrany numer do tablicy spróbowanych
            Session::put('tried', $tried); //zapisuje tablicę spróbowanych
            if ((int)$number === 0) { //liczba równa 0 symbolizuje chęć rozpoczęcia ponownie
                Session::flush(); //kasuje z pamięci wszystkie dane sesyjne
            } else {
                if ((int)$number === Session::get('number')) { //kiedy wybrana zostanie właściwa liczba

                    $message = "Zgadłeś po " . Session::get('tryCount') . " próbach! Brawo! Chcesz zagrać ponownie?"; //ustawia komunikat
                    $score = new Score();
                    $score->nick = Session::get('nick');
                    $score->score = Session::get('tryCount');
                    $score->difficulty = $difficulties[Session::get('size')];
                    $score->time = now()->diffInSeconds(Session::get('timeStart'));
                    $score->save(); //zapisanie wyniku
                    Session::flush(); //kasuje z pamięci wszystkie dane sesyjne
                } else {
                    if ($number > Session::get('number')) //ustawia komunikat w zależności od wybranej liczby
                    {
                        $message = "Nie zgadłeś! Próbuj dalej! Liczba której szukasz jest mniejsza. " . Session::get('tryCount') . " prób do tej pory.";
                    } else {
                        $message = "Nie zgadłeś! Próbuj dalej! Liczba której szukasz jest większa. " . Session::get('tryCount') . " prób do tej pory.";
                    }
                }
                Session::flash('message', $message); //wyświetlenie wiadomości
            }
        }
        return redirect()->route('pick.index');
    }
}
