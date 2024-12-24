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
    $permiso9 = Permission::firstOrCreate(['name' => 'permiso_9']); // Tools
    $permiso8 = Permission::firstOrCreate(['name' => 'permiso_8']); // Agenda General
    $permiso7 = Permission::firstOrCreate(['name' => 'permiso_7']); // Expedicion
    $permiso6 = Permission::firstOrCreate(['name' => 'permiso_6']); // Traqnsportes
    $permiso5 = Permission::firstOrCreate(['name' => 'permiso_5']); // Proveedores
    $permiso4 = Permission::firstOrCreate(['name' => 'permiso_4']); // Agro
    $permiso3 = Permission::firstOrCreate(['name' => 'permiso_3']); // Molino
    $permiso2 = Permission::firstOrCreate(['name' => 'permiso_2']); // Distribucion
    $permiso1 = Permission::firstOrCreate(['name' => 'permiso_1']); // Representacion

    $permiso11 = Permission::firstOrCreate(['name' => 'permiso_11']); // alta
    $permiso12 = Permission::firstOrCreate(['name' => 'permiso_12']); // edit
    $permiso13 = Permission::firstOrCreate(['name' => 'permiso_13']); // delete

    // Crear roles
    $adminRole = Role::firstOrCreate(['name' => 'admin']);
    $supervisorRole = Role::firstOrCreate(['name' => 'supervisor']);
    $distribucionRole = Role::firstOrCreate(['name' => 'distrib']);
    $oficinaRole = Role::firstOrCreate(['name' => 'oficina']);
    $userRole = Role::firstOrCreate(['name' => 'user']);
    $distribucionRole = Role::firstOrCreate(['name' => 'distrib']);

    // Asignar permisos a roles
    $adminRole->givePermissionTo($permiso99, $permiso13, $permiso12, $permiso11, $permiso9, $permiso8, $permiso7, $permiso6, $permiso5, $permiso4, $permiso3, $permiso2, $permiso1);

    $supervisorRole->givePermissionTo($permiso13, $permiso12, $permiso11, $permiso9, $permiso8, $permiso7, $permiso6, $permiso5, $permiso4, $permiso3, $permiso2, $permiso1);

    $distribucionRole->givePermissionTo($permiso8, $permiso2, $permiso3, $permiso5);

    $oficinaRole->givePermissionTo($permiso1);

    $userRole->givePermissionTo($permiso3);

    // Habilitar las restricciones de clave foránea nuevamente
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }
}
