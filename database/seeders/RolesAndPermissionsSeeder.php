<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolesAndPermissionsSeeder extends Seeder
{
  public function run()
  {
    // Deshabilitar las restricciones de clave foránea para evitar problemas de referencia
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    // Eliminar los registros de la tabla 'model_has_permissions', 'role_has_permissions', 'permissions' y 'roles'
    DB::table('model_has_permissions')->delete();
    DB::table('role_has_permissions')->delete();
    DB::table('permissions')->delete();
    DB::table('roles')->delete();

    // Crear permisos
    $permiso99 = Permission::firstOrCreate(['name' => 'permiso_99']);
    $permiso9 = Permission::firstOrCreate(['name' => 'permiso_9']);
    $permiso7 = Permission::firstOrCreate(['name' => 'permiso_7']);
    $permiso5 = Permission::firstOrCreate(['name' => 'permiso_5']);
    $permiso3 = Permission::firstOrCreate(['name' => 'permiso_3']);

    // Crear roles
    $adminRole = Role::firstOrCreate(['name' => 'admin']);
    $supervisorRole = Role::firstOrCreate(['name' => 'supervisor']);
    $distribucionRole = Role::firstOrCreate(['name' => 'distrib']);
    $oficinaRole = Role::firstOrCreate(['name' => 'oficina']);
    $userRole = Role::firstOrCreate(['name' => 'user']);

    // Asignar permisos a roles
    $adminRole->givePermissionTo($permiso99, $permiso9, $permiso7, $permiso5, $permiso3);
    $supervisorRole->givePermissionTo($permiso9, $permiso7, $permiso5, $permiso3);
    $distribucionRole->givePermissionTo($permiso7);
    $oficinaRole->givePermissionTo($permiso5);
    $userRole->givePermissionTo($permiso3);

    // Habilitar las restricciones de clave foránea nuevamente
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }
}