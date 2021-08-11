<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\History;
use Session;
use Auth;



class RandomTeamController extends Controller
{
    public function index()
    {
        return view('randomizeTeam.form');
    }

    public function store(Request $request)
    {
        if (isset($request->teams)){
            if (is_array($request->get('teams')))
                $teams = $request->get('teams');
            else
                $teams = explode(',', $request->get('teams'));

            if (is_array($request->get('players')))
                $players = $request->get('players');
            else
                $players = explode(',', $request->get('players'));
            Session::put('randomTeam', $teams);
            Session::put('randomTeamPlayers', $players);

        }
        else{
            $teams= Session::get('randomTeam');
            $players = Session::get('randomTeamPlayers');
        }


        $number_of_players = count($players);
        $number_of_teams = count($teams);

        $teams_json = [];

        if($number_of_players >= $number_of_teams){
            $team_temp = $players;
            for($i=0; $i<$number_of_teams-1; $i++){
                $team_name = $teams[$i];
                $team = [];
                shuffle($team_temp);

                for($j=0; $j<floor($number_of_players/$number_of_teams); $j++){
                    $team[] = $team_temp[$j];
                    unset($team_temp[$j]);
                }
                array_values($team_temp);

                // $teams_json[] = $team_name;
                $teams_json[$team_name] = $team;
            }

            //obsluga wyjatku w ktorych liczby z dzielenia druzyn sa zaokraglane w dol

            $last_team_name = end($teams);
            $last_team = [];
            if(count($teams_json) > 0)
            {
                foreach($team_temp as $key=>$value){
                    if(count(array_values($teams_json)[0]) > count($last_team))
                    {
                        $last_team[] = $value;
                        unset($team_temp[$key]);
                    }
                }
            }else{
                foreach($team_temp as $key=>$value){
                    $last_team[] = $value;
                    unset($team_temp[$key]);
                }
            }


            foreach($teams_json as $key=>$value)
            {
                if(count($team_temp) > 0)
                {
                    array_push($teams_json[$key], array_values($team_temp)[0]);
                    array_shift($team_temp);
                }
            }

            // $teams_json[] = $last_team_name;
            $teams_json[$last_team_name] = $last_team;

        }else{

            return response()->json(['message'=> "Druzyn jest wiecej niz zawodnikow"]);
        }
        if(Auth::user()!=null)
        $history = History::create([
            'type' => 'Losowanie drużyn',
            'data' => 'Gracze: '.implode(", ", $players)."\n".'Drużyny: '.implode(", ", $teams),
            'winner' => json_encode($teams_json),
            'user_id' => Auth::user()->id
        ]);
        return view('randomizeTeam.result')->with('teams_json', $teams_json);
        //return response()->json([$teams_json]);
    }
}
