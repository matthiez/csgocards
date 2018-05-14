<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Giveaway extends Model
{

    public function alreadyIn($steamId) {
        return (Giveaway::where('steamid', '=', $steamId)->first() === null) ? false : true;
    }

    public function add($steamId) {
        $giveaway = new Giveaway;
        $giveaway->steamid = $steamId;
        $save = $giveaway->save();
        return ($save != 0) ? true : false;
    }

}
