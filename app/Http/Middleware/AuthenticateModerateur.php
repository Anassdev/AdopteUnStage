<?php namespace App\Http\Middleware;

use App\Moderateur;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class AuthenticateModerateur {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($this->auth->guest())
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
                return redirect()->back()->with('flash_error', 'Page non autorisée! Vous devez être un modérateur!');
			}
		} else {

            if(!($this->auth->user()->user_type == get_class(new Moderateur()))) {

                if ($request->ajax())
                {
                    return response('Unauthorized.', 401);
                }
                else
                {
                    return redirect()->back()->with('flash_error', 'Page non autorisée! Vous devez être un modérateur!');
                }
            }
        }

		return $next($request);
	}

}
