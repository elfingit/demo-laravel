<?php

namespace App\Http\Middleware;

use Closure;

class RoleAcl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
	    if (\Auth::guest()) {
		    return redirect('/login');
	    }

	    if (!$this->isAllow(\Auth::user(), $request)) {
		    abort('403');
	    }

	    return $next($request);
    }

	private function isAllow($user, $request)
	{
		$acl = config('acl');

		if (!isset($acl[$user->role->name])) {
			return false;
		}

		$rights = $acl[$user->role->name];

		if (isset($rights[0]) && $rights[0] === '*') {
			return true;
		}

		$routeName = \Route::getCurrentRoute()->action['as'];

		if (in_array($routeName, $rights)) {
			return true;
		}

		return false;
	}

}
