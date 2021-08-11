<?php

namespace App\Http\Controllers\Api;

use App\Tournament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Session;
use Log;


class TournamentController extends Controller
{
    private function generateTournamentType1($players)
    {
        $count = count($players);
        $P = pow(2,floor(log($count,2))+1);
        $firstlayer = (2*$count)-$P;
        $colcount = ceil(log($count,2))+($firstlayer<1);
        $table = [];
        $col = [];
        for ($i = 0; $i < $firstlayer; $i++)
        {
            $col[] = $players[$i];
        }
        $table[]=$col;
        $col = [];
        for($i = 0; $i < $firstlayer/2; $i++)
        {
            $col[] = '';
        }
        for($i = $firstlayer; $i < $count; $i++)
        {
            $col[] = $players[$i];
        }
        $lastlayer = count($col);
        $table[]=$col;
        for ($i = 0; $i < $colcount-1; $i++)
        {
            $col = [];
            for($j = 0; $j < $lastlayer/2; $j++)
            {
                $col[] = '';
            }
            $lastlayer = $i+1;
            $table[] = $col;
        }
        if(count($table[0])<1)
        {
            array_splice($table,0,1);
        }
        return $table;
    }

    private function generateTournamentType2($players)
    {
        $count = count($players);
        $left = $this->generateTournamentType1(array_slice($players,0, ceil($count/2)));
        $right = array_reverse($this->generateTournamentType1(array_slice($players, ceil($count/2), floor($count/2))));
        $middle = [];
        $middle[] = '';
        $left[]=$middle;
        return array_merge($left, $right);
    }

    public function index()
    {
        return view('tournament.form'); //wyświedla widok wybierania graczy
    }

    public function submit(Request $request)
    {
        $players = array_filter($request->players);
        Log::Debug($request);
        if($request->shuffle)
        {
            shuffle($players);
        }
        $count = count($players);
        $tournament = new Tournament();
        $tournament->type = $request->type;
        $tournament->players = $count;
        if($request->type == 1)
        {
            $tournament->data = json_encode($this->generateTournamentType1($players));
            Log::Debug('single');
        } else {
            $tournament->data = json_encode($this->generateTournamentType2($players));
            Log::Debug('double');
        }

        Log::Debug($tournament);

        $tournament->save();

        $url = '/tournament/' . $tournament->id;
        return redirect($url);
    }

    public function edit($id, Request $request)
    {
        $tournament = Tournament::findOrFail($id);
        $tournament->update(['data' => $request->tournament]);

        $response = array(
            'status' => 'success',
            'msg' => $request->message,
        );
    }

    public function show($id)
    {
        $tournament = Tournament::find($id);
        return view('tournament.show')->with('tournament', $tournament);
    }
}
