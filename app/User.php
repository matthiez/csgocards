<?php namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['steamid', 'steam_avatar', 'steam_persona_name', 'ip', 'player', 'trade_link', 'email', 'auth_token', 'email_token'];

    protected $hidden = ['remember_token', 'ip'];

    public function getUser($steamid) {
        return User::where('steamid', '=', $steamid)->toArray();
    }

    public function register($steamid, $player) {
        $update = User::where('steamid', '=', $steamid)->update([
            'player' => $player
        ]);
        return $update != 0 ? true : false;
    }

    /* Used if pmAPI returned an Error. */
    public function nullPlayer($steamid) {
        return (User::where('steamid', '=', $steamid)->update(['player' => null]) != 0) ? true : false;
    }

    public function setTradelink($steamid, $tLink) {
        return (User::where('steamid', '=', $steamid)->update(['trade_link' => $tLink]) != 0) ? true : false;
    }

    public function getPlayer($steamId) {
        $player = User::where('steamid', '=', $steamId)->pluck('player');
        return (isset($player[0]) && is_string($player[0])) ? $player[0] : 'Player not found';
    }

    public function existingSteamId($steamId) {
        if(strlen($steamId) != 17 || is_numeric($steamId) === false) return false;
        $u = User::where('steamid', '=', $steamId)->first();
        return isset($u) ? true : false;
    }

    public function isAdmin($steamId) {
        return in_array($steamId, \Config::get('app.admin_steamids')) ? true : false;
    }

    public function setTimezone($steamid, $timezone) {
        return (User::where('steamid', '=', $steamid)->update(['timezone' => $timezone]) != 0) ? true : false;
    }

    public function getSteamIdFromPlayer($player) {
        $steamId = User::where('player', '=', $player)->pluck('steamid');
        return isset($steamId[0]) ? $steamId[0] : null;
    }
}
