<?php

namespace App\Http\Middleware;

use Closure;
use Gate;

class SudoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $user;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct()
    {
        $this->user = \Auth::user();
    }

    public function handle($request, Closure $next)
    {
        //dd($this->user->id);
        // if ($this->user->id!=39) {
        //     return redirect()->route('geren');
        // }
        if (Gate::denies('showGuzzle')) {
            return redirect()->route('geren');
        }
        return $next($request);
    }
}
