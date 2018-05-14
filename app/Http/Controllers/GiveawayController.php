<?php namespace App\Http\Controllers;

use Auth;
use App\Giveaway as Model;
use Illuminate\Http\Request;

class GiveawayController extends Controller
{
    private $Model;

    public function __construct(Model $giveaway, Request $request) {
        $this->Model = $giveaway;
    }

    public function enter() {
        $user = Auth::user();
        if($this->Model->alreadyIn($user->steamid)) return response()->json('Not adding you to this giveaway because you have already entered it.', 400);
        if($this->Model->add($user->steamid)) return response()->json('You have been successfully added to the giveaway. Good Luck!');
        return response()->json('An error occured. Please <a href="' . env('APP_WEBMASTER_MAIL') . '" title="Contact an administrator">contact an administrator</a>.', 400);
    }

}
