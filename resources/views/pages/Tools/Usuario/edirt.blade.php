<!-- resources/views/users/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Editar Usuario')

@section('content')
<div class="container">
  <h2>Editar Usuario</h2>

  <form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label for="name">Nombre</label>
      <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="form-group">
      <label for="email">Correo Electrónico</label>
      <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}"
        required>
    </div>

    <div class="form-group">
      <label for="password">Contraseña</label>
      <input type="password" name="password" id="password" class="form-control">
      <small class="form-text text-muted">Deja vacío si no deseas cambiar la contraseña.</small>
    </div>

    <div class="form-group">
      <label for="permiso">Permiso</label>
      <select name="permiso" id="permiso" class="form-control">
        <option value="">Seleccione un permiso</option>
        <option value="1" {{ old('permiso', $user->permiso) == 1 ? 'selected' : '' }}>Permiso 1</option>
        <option value="2" {{ old('permiso', $user->permiso) == 2 ? 'selected' : '' }}>Permiso 2</option>
        <option value="3" {{ old('permiso', $user->permiso) == 3 ? 'selected' : '' }}>Permiso 3</option>
        <!-- Agrega más opciones según tus permisos -->
      </select>
    </div>

    <div class="form-group">
      <label for="is_active">Activo</label>
      <input type="checkbox" name="is_active" id="is_active" {{ old('is_active', $user->is_active) == 1 ? 'checked' : ''
      }}>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
  </form>
</div>
@endsection