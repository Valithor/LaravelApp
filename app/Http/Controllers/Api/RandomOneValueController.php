<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Session;
use Auth;
use App\Models\History;



class RandomOneValueController extends Controller
{
    public function index()
    {           
        return view('randomizeOneValue.form');
    }

    public function store(Request $request)
    {
        $data = $request->all();  

        if(!empty(Session::get('fields')) && !array_key_exists('numbers',$data)) {
            $fields= Session::get('fields');
            $rand_index = array_rand($fields);        
            $rand_value = $fields[$rand_index];
            if(Auth::user()!=null)
            $history = History::create([
                'type' => 'Losowanie jednej liczby',
                'data' => implode(", ", $fields),
                'winner' => $rand_value,
                'user_id' => Auth::user()->id
            ]);
        }
        else{      
            if(!empty(array_filter($data["numbers"]))){
                $fields = array_filter($data["numbers"]);  
                $rand_index = array_rand($fields);                
                $rand_value = $fields[$rand_index];
                if(Auth::user()!=null)
                $history = History::create([
                    'type' => 'Losowanie jednej liczby',
                    'data' => implode(", ", $fields),
                    'winner' => $rand_value,
                    'user_id' => Auth::user()->id
                ]);
                Session::forget('fields');
                Session::put('fields', $fields);
            }else{
                return view('randomizeOneValue.form');
            }  
        }     
        return view('randomizeOneValue.result', compact('rand_value'));     
    } 

}
