<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
  public function run()
  {
    // Lista de usuarios
    $users = [
      [
        'name' => 'Administrador',
        'email' => 'sandokan992000@gmail.com',
        'password' => 'Camisa00@',
        'permiso' => '99',
        'role' => 'admin',
        'permissions' => ['permiso_99'],
      ],
      [
        'name' => 'Luciano',
        'email' => 'lucho_frasch@hotmail.com',
        'password' => 'vwgol00@',
        'permiso' => '9',
        'role' => 'gerencia',
        'permissions' => ['permiso_13', 'permiso_12', 'permiso_11', 'permiso_9', 'permiso_8', 'permiso_7', 'permiso_6', 'permiso_5', 'permiso_4', 'permiso_3', 'permiso_2', 'permiso_1'],
      ],
      [
        'name' => 'prueba',
        'email' => 'tnlcomputer@gmail.com',
        'password' => 'Camisa00@',
        'permiso' => '9',
        'role' => 'gerencia',
        'permissions' => ['permiso_13', 'permiso_12', 'permiso_11', 'permiso_9', 'permiso_8', 'permiso_7', 'permiso_6', 'permiso_5', 'permiso_4', 'permiso_3', 'permiso_2', 'permiso_1'],
      ],
      [
        'name' => 'Santiago',
        'email' => 'proveedores@fraschina.com.ar',
        'password' => 'santi007',
        'permiso' => '7',
        'role' => 'administracion',
        'permissions' => ['permiso_12', 'permiso_11', 'permiso_8', 'permiso_5', 'permiso_3', 'permiso_2', 'permiso_1'],
      ],
      [
        'name' => 'Fito',
        'email' => 'fito@fraschina.com.ar',
        'password' => 'tofi47A7',
        'permiso' => '7',
        'role' => 'administracion',
        'permissions' => ['permiso_12', 'permiso_11', 'permiso_8', 'permiso_5', 'permiso_3', 'permiso_2', 'permiso_1'],
      ],
      [
        'name' => 'Sol',
        'email' => 'oficina@gmail.com',
        'password' => '456ofi',
        'permiso' => '5',
        'role' => 'admindistrib',
        'permissions' => ['permiso_12', 'permiso_11', 'permiso_8', 'permiso_5', 'permiso_3', 'permiso_2'],
      ],
      [
        'name' => 'Magali',
        'email' => 'magali@gmail.com',
        'password' => 'Maga001',
        'permiso' => '5',
        'role' => 'distribucion',
        'permissions' => ['permiso_12', 'permiso_11', 'permiso_8', 'permiso_5', 'permiso_3', 'permiso_2'],
      ],
      [
        'name' => 'Juan Fernandez',
        'email' => 'juanFernandez@gmail.com',
        'password' => 'JuanM',
        'permiso' => '3',
        'role' => 'externo',
        'permissions' => ['permiso_3'],
      ],
    ];

    // Crear usuarios, asignar roles y permisos
    foreach ($users as $userData) {
      $user = User::firstOrCreate(
        ['email' => $userData['email']],
        [
          'name' => $userData['name'],
          'password' => Hash::make($userData['password']),
          'permiso' => $userData['permiso'],
        ]
      );

      // Asignar rol
      $role = Role::findByName($userData['role']);
      $user->assignRole($role);

      // Asignar permisos
      if (!empty($userData['permissions'])) {
        $user->givePermissionTo($userData['permissions']);
      }
    }
  }
}