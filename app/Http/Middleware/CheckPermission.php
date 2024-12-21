<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
  /**
   * Handle an incoming request.
   */
  public function handle(Request $request, Closure $next, int $requiredPermission)
  {
    if (Auth::check() && Auth::user()->permiso === $requiredPermission) {
      return $next($request);
    }

    abort(403, 'No tienes permisos para acceder a esta página.');
  }
}
