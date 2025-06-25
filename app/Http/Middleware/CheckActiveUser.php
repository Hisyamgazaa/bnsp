<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Check if user is inactive
            if (!$user->is_active) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                // Redirect with message based on whether it's admin or regular user
                if ($request->is('admin/*')) {
                    return redirect()->route('admin.login')
                        ->withErrors(['email' => 'Your account has been deactivated.']);
                } else {
                    return redirect()->route('login')
                        ->withErrors(['email' => 'Your account has been deactivated.']);
                }
            }
        }

        return $next($request);
    }
}
