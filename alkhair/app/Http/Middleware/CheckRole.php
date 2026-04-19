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
       if ($request->user()->role === 'association' && $request->user()->status !== 'ACTIVE') {
            return redirect()->route('home')->with('error', 'Votre compte est en attente de validation ou bloqué.');
        }
        return $next($request);
    }
}
