<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ((Auth::check() && Auth::user()->user_role === 'embroider' || Auth::check() && Auth::user()->user_role === 'client') && Auth::user()->user_status === 'inactive') {
            return response('هذا المستخدم غير فعال', 404)
            ->header('Content-Type', 'text/plain; charset=utf-8');
        }
        // Allow the request to proceed
        return $next($request);
    }
}
