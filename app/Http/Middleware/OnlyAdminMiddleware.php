<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OnlyAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $adminIds = explode(";", env('SUPER_ADMIN_ID'));

        if (!Auth::check()) {
            return redirect()->route('welcome');
        }

        if (in_array(Auth::id(), $adminIds)) {
            return $next($request);
        };

        return back();
    }
}
