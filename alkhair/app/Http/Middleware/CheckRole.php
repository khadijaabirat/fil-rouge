<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,string $role): Response
    {
        if(!$request->user() || $request->user()->role!==$role)
            {
                abort(403,'accés non autorisé');
            }
            if (Auth::user()->role === 'association' && Auth::user()->status !== 'ACTIVE') {
    return redirect()->route('association.dashboard')->with('error', ' votre compte est bloquer  ');
}
        return $next($request);
    }
}
