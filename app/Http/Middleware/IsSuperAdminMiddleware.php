<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSuperAdminMiddleware
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
      // Redirect a guest to the login screen
    if (!auth()->check()) {
        return redirect(route('login'));
      }

      // Check if user has Superadmin role
    if (!auth()->user()->isSuperAdmin()) {
        abort(403);
      }
        return $next($request);
    }
}
