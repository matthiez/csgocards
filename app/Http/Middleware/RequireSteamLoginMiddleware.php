<?php namespace App\Http\Middleware;

use Closure;
use Auth;

class RequireSteamLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        //$route = $request->route()->getPath();

        /*        if ($route === 'registration' ) {
                    return redirect('/')->withErrors(['error' => 'Please sign in through Steam first in order to register an account.']);
                }*/

        if(Auth::guest()) {
            return redirect()->guest('/')->withErrors(['error' => 'Please sign in through Steam first in order to access this page.']);
        }
        return $next($request);
    }
}
