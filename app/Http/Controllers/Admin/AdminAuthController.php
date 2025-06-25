<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminAuthController extends Controller
{
  /**
   * Show admin login form
   */
  public function showLoginForm(): View
  {
    return view('admin.login');
  }

  /**
   * Handle admin login
   */
  public function login(Request $request): RedirectResponse
  {
    $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    // First check if the user exists and has admin role
    $user = \App\Models\User::where('email', $request->email)->first();

    if (!$user || $user->role !== 'admin') {
      return back()->withErrors([
        'email' => 'Access denied. Admin privileges required.',
      ])->withInput($request->only('email'));
    }

    // Check if the account is active
    if (!$user->is_active) {
      return back()->withErrors([
        'email' => 'Your account has been deactivated. Please contact administrator.',
      ])->withInput($request->only('email'));
    }

    // Now attempt authentication with credentials
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect()->intended(route('admin.dashboard'));
    }

    return back()->withErrors([
      'email' => 'The provided credentials do not match our records.',
    ])->withInput($request->only('email'));
  }

  /**
   * Handle admin logout
   */
  public function logout(Request $request): RedirectResponse
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login');
  }
}
