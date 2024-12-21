<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
  /**
   * Display the login view.
   */
  public function create(): View
  {
    return view('auth.login');
  }

  /**
   * Handle an incoming authentication request.
   */
  public function store(LoginRequest $request): RedirectResponse
  {
    $request->authenticate();

    // Validar que el usuario esté activo
    $user = Auth::user();
    if (!$user->is_active) {
      Auth::logout(); // Cerrar cualquier sesión activa
      throw ValidationException::withMessages([
        'email' => __('Tu cuenta está desactivada. Contacta al administrador.'),
      ]);
    }

    // Asignar roles o permisos basados en el permission_level del usuario
    if ($user->permission_level == 99) {
      $user->assignRole('admin');
    } elseif ($user->permission_level == 9) {
      $user->assignRole('supervisor');
    } elseif ($user->permission_level == 7) {
      $user->assignRole('distribucion');
    } elseif ($user->permission_level == 5) {
      $user->assignRole('oficina');
    } elseif ($user->permission_level == 3) {
      $user->assignRole('user');
    }

    // Si tienes permisos específicos también puedes asignarlos aquí
    // Por ejemplo:
    // if ($user->permission_level == 99) {
    //   $user->givePermissionTo('permiso_99');
    // } elseif ($user->permission_level == 9) {
    //   $user->givePermissionTo('permiso_9');
    // }

    $request->session()->regenerate();

    return redirect()->intended(route('dashboard', absolute: false));
  }

  /**
   * Destroy an authenticated session.
   */
  public function destroy(Request $request): RedirectResponse
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}