<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken extends Middleware
{
  protected function handleTokenMismatch($request, TokenMismatchException $exception)
  {
    // Redirigir al login si el token CSRF no coincide
    if ($request->expectsJson()) {
      return response()->json(['message' => 'Tu sesión ha expirado.'], 419);
    }

    return redirect()->route('login')
      ->with('status', 'Tu sesión ha expirado. Por favor, inicia sesión nuevamente.');
  }
}
