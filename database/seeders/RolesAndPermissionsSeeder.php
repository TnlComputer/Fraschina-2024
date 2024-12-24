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
    // Deshabilitar restricciones de claves foráneas temporalmente
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    // Limpiar tablas relacionadas con permisos y roles
    DB::table('model_has_permissions')->truncate();
    DB::table('role_has_permissions')->truncate();
    DB::table('permissions')->truncate();
    DB::table('roles')->truncate();

    // Crear permisos
    $permissions = [
      'permiso_1',  // Representación
      'permiso_2',  // Distribución
      'permiso_3',  // Molino
      'permiso_4',  // Agro
      'permiso_5',  // Proveedores
      'permiso_6',  // Transportes
      'permiso_7',  // Expedición
      'permiso_8',  // Agenda General
      'permiso_9',  // Tools
      'permiso_11', // Alta
      'permiso_12', // Editar
      'permiso_13', // Eliminar
      'permiso_99', // Super permiso
    ];

    // Crear todos los permisos en un solo paso
    foreach ($permissions as $permissionName) {
      Permission::firstOrCreate(['name' => $permissionName]);
    }

    // Crear roles
    $roles = [
      'admin' => $permissions, // Admin tiene todos los permisos
      'supervisor' => [
        'permiso_1',
        'permiso_2',
        'permiso_3',
        'permiso_4',
        'permiso_5',
        'permiso_6',
        'permiso_7',
        'permiso_8',
        'permiso_9',
        'permiso_11',
        'permiso_12',
        'permiso_13'
      ],
      'gerencia' => ['permiso_1', 'permiso_2', 'permiso_3', 'permiso_4', 'permiso_5', 'permiso_6', 'permiso_7', 'permiso_8', 'permiso_9', 'permiso_11', 'permiso_12', 'permiso_13'],
      'distribucion' => ['permiso_2', 'permiso_3', 'permiso_5', 'permiso_8', 'permiso_11', 'permiso_12', 'permiso_13'],
      'administracion' => ['permiso_1', 'permiso_11', 'permiso_12', 'permiso_13'],
      'administrativo' => ['permiso_1', 'permiso_11', 'permiso_13'],
      'expedicion' => ['permiso_7', 'permiso_11', 'permiso_13'],
      'externo' => ['permiso_3', 'permiso_13'],
      'admindistrib' => ['permiso_1', 'permiso_2', 'permiso_3', 'permiso_5', 'permiso_8', 'permiso_11', 'permiso_12', 'permiso_13']
    ];

    // Crear roles y asignarles permisos
    foreach ($roles as $roleName => $rolePermissions) {
      $role = Role::firstOrCreate(['name' => $roleName]);
      $role->syncPermissions($rolePermissions);
    }

    // Habilitar restricciones de claves foráneas nuevamente
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }
}
