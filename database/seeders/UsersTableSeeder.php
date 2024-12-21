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
    // Crear usuarios de forma segura para evitar duplicados
    $user1 = User::firstOrCreate([
      'email' => 'sandokan992000@gmail.com',
    ], [
      'name' => 'Administrador',
      'password' => Hash::make('Camisa00@'),
      'permiso' => '99',
    ]);

    $user2 = User::firstOrCreate([
      'email' => 'lucho_frasch@hotmail.com',
    ], [
      'name' => 'Luciano',
      'password' => Hash::make('vwgol'),
      'permiso' => '9',

    ]);

    $user3 = User::firstOrCreate([
      'email' => 'tnlcomputer@gmail.com',
    ], [
      'name' => 'prueba',
      'password' => Hash::make('Camisa00@'),
      'permiso' => '9',
    ]);

    $user4 = User::firstOrCreate([
      'email' => 'proveedores@fraschina.com.ar',
    ], [
      'name' => 'Santiago',
      'password' => Hash::make('santi007'),
      'permiso' => '7',
    ]);

    $user5 = User::firstOrCreate([
      'email' => 'fito@fraschina.com.ar',
    ], [
      'name' => 'Fito',
      'password' => Hash::make('tofi47'),
      'permiso' => '3',
    ]);

    $user6 = User::firstOrCreate([
      'email' => 'oficina@gmail.com',
    ], [
      'name' => 'Oficina',
      'password' => Hash::make('456ofi'),
      'permiso' => '7',
    ]);

    $user7 = User::firstOrCreate([
      'email' => 'deposito@gmail.com',
    ], [
      'name' => 'Distrib',
      'password' => Hash::make('depo001'),
      'permiso' => '7',
    ]);

    $user8 = User::firstOrCreate([
      'email' => 'juanFernandez@gmail.com',
    ], [
      'name' => 'Juan Fernandez',
      'password' => Hash::make('JuanM'),
      'permiso' => '5',
    ]);

    // Asignar roles
    $adminRole = Role::findByName('admin');
    $supervisorRole = Role::findByName('supervisor');
    $distribucionRole = Role::findByName('distrib');
    $userRole = Role::findByName('user');
    $oficinaRole = Role::findByName('oficina');

    $user1->assignRole($adminRole);
    $user2->assignRole($supervisorRole);
    $user3->assignRole($supervisorRole);
    $user4->assignRole($distribucionRole);
    $user5->assignRole($oficinaRole);
    $user6->assignRole($distribucionRole);
    $user7->assignRole($distribucionRole);
    $user8->assignRole($userRole);

    // Asignar permisos
    $user1->givePermissionTo('permiso_99');
    $user2->givePermissionTo('permiso_9');
    $user3->givePermissionTo('permiso_9');
    $user4->givePermissionTo('permiso_7');
    $user5->givePermissionTo('permiso_3');
    $user6->givePermissionTo('permiso_7');
    $user7->givePermissionTo('permiso_7');
    $user8->givePermissionTo('permiso_5');
  }
}
