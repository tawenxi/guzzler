<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Gate;

class AdminMiddleware
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
        // if ($this->user->id!=39&&$this->user->id!=36) {
        //     return redirect()->route('geren');
        // }
        if (Gate::denies('showAllSalary')) {
            return redirect()->route('geren');
        }
        return $next($request);
    }
}
