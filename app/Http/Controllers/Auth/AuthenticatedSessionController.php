<?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use App\Http\Requests\Auth\LoginRequest;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Validation\ValidationException;
// use Illuminate\View\View;

// class AuthenticatedSessionController extends Controller
// {
//   /**
//    * Display the login view.
//    */
//   public function create(): View
//   {
//     return view('auth.login');
//   }

//   /**
//    * Handle an incoming authentication request.
//    */
//   public function store(LoginRequest $request): RedirectResponse
//   {
//     $request->authenticate();

//     // Validar que el usuario esté activo
//     $user = Auth::user();
//     if (!$user->is_active) {
//       Auth::logout(); // Cerrar cualquier sesión activa
//       throw ValidationException::withMessages([
//         'email' => __('Tu cuenta está desactivada. Contacta al administrador.'),
//       ]);
//     }

//     // Asignar roles y permisos basados en los roles y permisos existentes en la base de datos
//     $this->assignRoleAndPermissions($user);

//     // Asignar roles o permisos basados en el permission_level del usuario
//     // if ($user->permission_level == 99) {
//     //   $user->assignRole('admin');
//     // } elseif ($user->permission_level == 9) {
//     //   $user->assignRole('supervisor');
//     // } elseif ($user->permission_level == 7) {
//     //   $user->assignRole('distribucion');
//     // } elseif ($user->permission_level == 5) {
//     //   $user->assignRole('oficina');
//     // } elseif ($user->permission_level == 3) {
//     //   $user->assignRole('user');
//     // }

//     // Si tienes permisos específicos también puedes asignarlos aquí
//     // Por ejemplo:
//     // if ($user->permission_level == 99) {
//     //   $user->givePermissionTo('permiso_99');
//     // } elseif ($user->permission_level == 9) {
//     //   $user->givePermissionTo('permiso_9');
//     // }

//     $request->session()->regenerate();

//     return redirect()->intended(route('dashboard', absolute: false));
//   }

//   /**
//    * Destroy an authenticated session.
//    */
//   public function destroy(Request $request): RedirectResponse
//   {
//     Auth::guard('web')->logout();

//     $request->session()->invalidate();

//     $request->session()->regenerateToken();

//     return redirect('/');
//   }
// }

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

    // Asignar roles y permisos basados en los roles y permisos existentes en la base de datos
    $this->assignRoleAndPermissions($user);

    $request->session()->regenerate();

    return redirect()->intended(route('dashboard', absolute: false));
  }

  /**
   * Asignar roles y permisos basados en el permission_level del usuario.
   */
  protected function assignRoleAndPermissions($user)
  {
    // Verificar si el permiso_level es nulo
    if (is_null($user->permission_level)) {
      // Puedes asignar un rol predeterminado o manejar el error de otra manera
      throw ValidationException::withMessages([
        'permission_level' => __('El nivel de permiso del usuario no está definido.'),
      ]);
    }

    // Obtener el rol basado en el permission_level del usuario
    $role = $this->getRoleForPermissionLevel($user->permission_level);

    if ($role) {
      // Asignar el rol al usuario (usando el rol existente en la base de datos)
      $user->assignRole($role);

      // Asignar permisos asociados con el rol automáticamente desde la base de datos
      $this->assignPermissionsToRole($role);
    }
  }

  protected function getRoleForPermissionLevel(int $permissionLevel): ?string
  {
    // Consultamos el rol en la base de datos basándonos en el permission_level
    // Asegúrate de que 'permission_level' está en la tabla de roles
    $role = Role::where('permission_level', $permissionLevel)->first();

    return $role ? $role->name : null; // Retorna el nombre del rol si existe
  }

  /**
   * Asignar permisos automáticamente a un usuario basado en el rol desde la base de datos.
   */
  protected function assignPermissionsToRole($roleName)
  {
    // Buscar el rol en la base de datos
    $role = Role::findByName($roleName);

    if ($role) {
      // Asignar permisos del rol automáticamente al usuario
      // Todos los permisos asociados con ese rol serán asignados al usuario.
      $permissions = $role->permissions;

      foreach ($permissions as $permission) {
        // Asignar cada permiso al usuario
        $role->givePermissionTo($permission);
      }
    }
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
