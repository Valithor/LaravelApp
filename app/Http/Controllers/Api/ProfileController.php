<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Integration;
use App\Models\User;
use Alaouy\Youtube\Facades\Youtube;
use Illuminate\Support\Str;
use Auth;
use Image;


class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Profil Konta
     */
    public function index(){  
        $user = Auth::user();
        $integration = Integration::where('user_id',$user->id)->get();
        $links=Integration::$integrationLinks;
        $site = Integration::$integrationSites; // aktualne strony  
        foreach($integration as $site){
            $url_path = parse_url($site->link, PHP_URL_PATH);
            if(Str::contains($site->link, $site->site_name))    
            $result[] = ['site' => $site->site_name, 'url' => $url_path];
        }       
        return view('profil/index', compact('user','integration', 'result', 'links'));
    }
    
    /**
     * Edycja Konta
     */
    public function edit(){
        $user = Auth::user();
        $integration = Integration::where('user_id',$user->id)->get();
        $site = Integration::$integrationSites; // aktualne strony  
        foreach($integration as $site){
            $result[] = ['site' => $site->site_name, 'url' => $site->link];
        }

        return view('profil/edit', compact('user','integration', 'result'));
    }

    /**
     * Zmiana ustawien
     */
    public function store(Request $req){

        $validation = $req->validate([
            'name'=>'required | min:3'
        ]);

        $user = Auth::user();

        $user->name = $req->name;
        if($req->hasFile('avatar')){
            $avatar=$req->file('avatar');
            $filename=time().'.'.$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save(public_path('/svg/avatars/'. $filename));
            $user=Auth::user();
            $user->avatar=$filename;
            $user->save();
        }
        $user->save(); // Aktualizacja dane uzytkownika

        $site = Integration::$integrationSites; // aktualne strony     
        for($i=0; $i<count($site); $i++){
            if(Integration::where('user_id',$user->id)->where('site_name',$site[$i])->first()!=null){
            $integration = Integration::where('user_id',$user->id)->where('site_name',$site[$i])->first();
            $integration->site_name = $site[$i];

            if($req->link[$i]) $integration->link = $req->link[$i]; // jesli link nie jest pusty, wprowadz go
            else $integration->link = ""; // w innym przypadku wprowadz pusty string.
            }
            elseif ($req->link[$i]) {
                $integration = Integration::create(['user_id'=>$user->id, 'site_name'=>$site[$i], 'link'=>$req->link[$i]]);
            }
            else
            continue;
         

            $integration->save(); // Aktualizacja lub stworzenie Linki do konkretnego klienta
        }
        return redirect()->route('profile.edit')->with('message','Zmiany zostały zapisane.');
    }
}
