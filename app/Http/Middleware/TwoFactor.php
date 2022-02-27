<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TwoFactor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if(auth()->check() && $user->two_factor_code)
        {
            if($user->two_factor_expires_at->lessThan(now()))

            {
                $user->resetTwoFactorCode();

                auth()->logout();

                return redirect()->route('login')
                ->withMessage('The two factor code has expired. Please login again.');
            }
            if(!$request->is('verify*'))
            {
                return redirect()->route('verify.index');
            }
        }

        return $next($request);
    }
}
