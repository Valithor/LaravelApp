<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\User;
use Illuminate\Support\Str;
use Auth;


class HistoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Profil Konta
     */
    public function index(){  
        $user = Auth::user();
        $histories = History::latest()->where('user_id',$user->id)->limit(10)->get();        
        return view('history/index', compact('histories'));
    }
    public function teamShow($id){
        $history= History::findOrFail($id);
        $teams_json=json_decode($history->winner, true);
        return view('history.randomizeTeam', compact('teams_json'));
    }
    
   
}
