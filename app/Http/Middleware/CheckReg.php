<?php

namespace App\Http\Middleware;

use App\Traits\Poker;

use Closure;
use Auth;

/**
 * Class CheckReg
 * @package App\Http\Middleware
 */
class CheckReg
{
    use Poker;

    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $route = $request->route()->uri();

        $isRegged = false;

        $player = Auth::user()->player;

        if($player) {
            $isRegged = true;
            $api = $this->api([
                'Command' => 'AccountsGet',
                'Player' => $player
            ]);
            if(isset($api->Error)) $isRegged = false;
        }

        if($route === 'registration' && $isRegged) return redirect('poker');

        /* Redirect all other to Registration */
        return (!$isRegged && $route !== 'registration') ? redirect('registration') : $next($request);
    }
}
