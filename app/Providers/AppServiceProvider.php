<?php

namespace App\Providers;

// use App\Services\EnLetras;
// use App\Services\EnLetrasService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    Paginator::useBootstrap();

    // permiso_99 (Super Usuario) pasa todos los chequeos de permisos
    Gate::before(fn($user) => $user->checkPermissionTo('permiso_99') ? true : null);
  }
}
