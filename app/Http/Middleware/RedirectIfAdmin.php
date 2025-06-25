<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAdmin
{
  /**
   * Handle an incoming request.
   * If the user is an admin, redirect them to the admin dashboard.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if (Auth::check() && Auth::user()->isAdmin()) {
      // Don't redirect if already accessing admin routes
      if ($request->is('admin/*') || $request->is('admin')) {
        return $next($request);
      }

      // Allow access to the invoice route
      if ($request->is('checkout/invoice/*')) {
        return $next($request);
      }

      // Allow admin to logout
      if ($request->is('logout') || $request->routeIs('logout')) {
        return $next($request);
      }

      // Redirect to admin dashboard with a flash message
      return redirect()->route('admin.dashboard')
        ->with('info', 'Admin users are redirected to the admin dashboard.');
    }

    return $next($request);
  }
}
