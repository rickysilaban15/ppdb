<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Pengaturan;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip maintenance check for admin routes
        if ($request->is('admin/*') || $request->is('login')) {
            return $next($request);
        }

        // Check if maintenance mode is enabled
        if (Pengaturan::isMaintenanceMode()) {
            // If it's an API request, return JSON response
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Maintenance Mode',
                    'message' => Pengaturan::getMaintenanceMessage(),
                    'schedule' => Pengaturan::getMaintenanceSchedule()
                ], 503);
            }

            // For web requests, show maintenance page
            return response()->view('maintenance', [
                'message' => Pengaturan::getMaintenanceMessage(),
                'schedule' => Pengaturan::getMaintenanceSchedule()
            ], 503);
        }

        return $next($request);
    }
}