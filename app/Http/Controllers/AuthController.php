<?php namespace App\Http\Controllers;

use Cookie;
use App\Traits\Poker;
use App\Deposit;
use App\User;
use App\Withdrawal;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Invisnik\LaravelSteamAuth\SteamAuth;

class AuthController extends Controller
{
    use AuthenticatesUsers, Poker;

    protected $redirectTo = '/';
    private $steam;

    public function __construct(SteamAuth $steam) {
        $this->middleware('guest', ['except' => 'logout']);
        $this->steam = $steam;
    }

    public function login() {
        if($this->steam->validate()) {
            $info = $this->steam->getUserInfo();
            $info = isset($info) ? $info : null;
            if($info != null && isset($info->steamID64)) {
                $steamid = $info->steamID64;
                $user = User::where('steamid', '=', $steamid)->first();
                $ip = \Request::ip();
                $token = str_random(128);
                $avatarFull = isset($info->avatarfull) ? $info->avatarfull : '';
                $personaName = isset($info->personaname) ? $info->personaname : '';
                if($user === null) {
                    $user = User::create([
                        'ip' => $ip,
                        'steamid' => $steamid,
                        'steam_avatar' => $avatarFull,
                        'steam_persona_name' => $personaName,
                        'auth_token' => $token
                    ]);
                } else {
                    $user->ip = $ip;
                    $user->update([
                        'ip' => $ip,
                        'steam_avatar' => $avatarFull,
                        'steam_persona_name' => $personaName,
                        'auth_token' => $token
                    ]);
                }
                Cookie::queue('auth_token', $token, time() + 3600 * 24 * 7, '/', '', false, false);
                Auth::login($user, true);
                return redirect('/');
            }
        }
        return $this->steam->redirect(); // redirect to Steam login page
    }
}
