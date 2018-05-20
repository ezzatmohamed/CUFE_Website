<?php

namespace App\Http\Middleware;

use Closure;

class GpaValid
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
        if( !ctype_digit($request['prevcrdts']) || !is_numeric($request['prevGPA']) )
        {
            return redirect('/home');
        }
        else if ( $request['prevGPA'] > 4.0 || $request['prevGPA'] < 0 )
        {
            return redirect('/home');
        }

        return $next($request);
    }
}
