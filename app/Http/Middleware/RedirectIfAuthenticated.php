<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
   /**
    * Handle an incoming request.
    *
    * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    */
   public function handle(Request $request, Closure $next, string ...$guards): Response
   {
      $guards = empty($guards) ? [null] : $guards;

      foreach ($guards as $guard) {
         if ($request->is('register') && Auth::check()  && Auth::user()->is_admin) {
            return $next($request);
         }
         if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME);
         }
      }

      return $next($request);
   }
}
