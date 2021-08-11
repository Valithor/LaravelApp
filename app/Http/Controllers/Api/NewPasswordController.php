<?php

namespace App\Http\Controllers\Api;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\mailNewPassword;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Auth;


class newPasswordController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * generowanie nowy token
     */
    public function index(){

        $userEmail = Auth::user()->email;
        $passwordReset = DB::table('password_resets');

        if(!$passwordReset->where('email',$userEmail)->first()){
            $passwordReset->insert([
                'email' => $userEmail,
                'token' => str_random(60),
                'created_at' => Carbon::now()
            ]);
        }
        else{
            $passwordReset->where('email',$userEmail)->update(['token' => str_random(60)]);
        }

        $tokenData = $passwordReset->where('email', $userEmail)->first();

        $this->sendResetEmail($userEmail, $tokenData->token);

        return redirect()->route('profile.index')->with('message','E-mail zostal wyslany.');
    }

    /**
     * generowanie link i wyslanie maila
     */
    private function sendResetEmail($email, $token)
    {
        //Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->select('name', 'email')->first();
        //Generate, the password reset link. The token generated is embedded in the link
        $link = config('base_url') . 'newPassword/change/' . $token;

        Mail::to($email)->send(new mailNewPassword($link));
    }

    /**
     * widok zmiany hasla
     */
    public function edit($token){
        return view('newPassword')->with('token',$token);
    }

    /**
     * Zmiana hasla
     */
    public function store(Request $req){
        $user = Auth::user();
        $user_token = DB::table('password_resets')->where('email', $user->email)->select('email', 'token')->first()->token;

        if ($user_token == $req->token){ // czy token jest aktulany
            if(!(Hash::check($req->get('current_password'),Auth::user()->password))){
                return redirect()->back()->withErrors(['current_password' => 'Aktualne Hasło jest nie prawdiłowe']);
            }
            if(strcmp($req->get('current_password'), $req->get('password'))== 0){
                return redirect()->back()->withErrors(['current_password' => 'Nowe Hasło nie może być takie same jak Aktualne Hasło']);
            }
            
            $req->validate([
                'current_password' => 'required',
                'password' => 'required | min:6 | confirmed'
            ]);

            $user->password = bcrypt($req->get('password'));
            $user->save();

            DB::table('password_resets')->where('email',$user->email)->delete();
            
            return redirect()->route('profile.index')->with('message','Zmiany zostały zapisane.');;
        }
        else return redirect()->back()->withErrors(['token' => 'Nie aktualny token.']);
    }
}


