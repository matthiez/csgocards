<?php namespace App\Http\Controllers;

use App\Price;
use App\User;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $price;
    protected $User;

    public function __construct(Price $price, Request $request, User $User) {
        $this->price = $price;
        $this->User = $User;
    }

    public function updatePrices() {
        if(!$this->User->isAdmin(Auth::user()->steamid)) return redirect('/');
        if($this->price->updatePricesSteamApis()) return response()->json('Prices successfully updated.');
        return response()->json('Prices not fully updated.', 400);
    }

    public function index() {
        return $this->User->isAdmin(Auth::user()->steamid) ? view('admin') : view('errors.404');
    }
}
