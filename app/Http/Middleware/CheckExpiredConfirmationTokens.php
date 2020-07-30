<?php

namespace App\Http\Middleware;

use Closure;

class CheckExpiredConfirmationTokens
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $redirect)
    {
        if($request->confirmation_token->hasExpired()){
            return redirect($redirect)->with('error', ' Token expired');
        }
        return $next($request);
    }
}
