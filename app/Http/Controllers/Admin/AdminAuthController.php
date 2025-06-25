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

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
      $user = Auth::user();

      if (!$user->is_active) {
        Auth::logout();
        return back()->withErrors([
          'email' => 'Your account has been deactivated. Please contact administrator.',
        ]);
      }

      if ($user->isAdmin()) {
        $request->session()->regenerate();
        return redirect()->intended(route('admin.dashboard'));
      } else {
        Auth::logout();
        return back()->withErrors([
          'email' => 'Access denied. Admin privileges required.',
        ]);
      }
    }

    return back()->withErrors([
      'email' => 'The provided credentials do not match our records.',
    ]);
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
