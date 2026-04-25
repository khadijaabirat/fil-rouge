<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogCriticalActions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Actions critiques à logger
        $criticalRoutes = [
            'admin.validateAssociation',
            'admin.banAssociation',
            'admin.validateDonation',
            'admin.rejectDonation',
            'admin.suspendProject',
            'association.withdraw',
        ];

        $routeName = $request->route()->getName();

        if (in_array($routeName, $criticalRoutes)) {
            Log::info('Critical action initiated', [
                'route' => $routeName,
                'user_id' => auth()->id(),
                'user_role' => auth()->user()->role ?? 'guest',
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'timestamp' => now()->toDateTimeString(),
            ]);
        }

        $response = $next($request);

        // Logger après l'action si c'est une action critique
        if (in_array($routeName, $criticalRoutes)) {
            Log::info('Critical action completed', [
                'route' => $routeName,
                'status_code' => $response->getStatusCode(),
                'user_id' => auth()->id(),
            ]);
        }

        return $response;
    }
}
