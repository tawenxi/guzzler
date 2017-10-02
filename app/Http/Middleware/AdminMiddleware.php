<?php

namespace App\Http\Middleware;

use Gate;
use Closure;
use App\Model\User;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    protected $user;

    /**
     * Create a new middleware instance.
     *
     * @param Guard $auth
     *
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
