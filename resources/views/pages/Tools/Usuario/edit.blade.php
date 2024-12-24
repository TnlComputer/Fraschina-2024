@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content')
<div class="container">
  <h2>Editar Usuario</h2>

  <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label for="name">Nombre</label>
      <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $usuario->name) }}" required>
    </div>

    <div class="form-group">
      <label for="email">Correo Electrónico</label>
      <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $usuario->email) }}"
        required>
    </div>

    <div class="form-group">
      <label for="password">Contraseña (Dejar en blanco para no cambiarla)</label>
      <input type="password" name="password" id="password" class="form-control">
    </div>

    <div class="form-group">
      <label for="password_confirmation">Confirmar Contraseña</label>
      <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
    </div>

    <!-- Roles -->
    <div class="form-group">
      <label for="role">Rol</label>
      <select name="role" id="role" class="form-control">
        <option value="">Seleccione un rol</option>
        @foreach ($roles as $role)
        <option value="{{ $role->id }}" {{ old('role', $usuario->roles->first()->id ?? '') == $role->id ? 'selected' :
          '' }}>
          {{ $role->name }}
        </option>
        @endforeach
      </select>
    </div>

    <!-- Campo para is_active -->
    <div class="form-group">
      <label for="is_active">Activo</label>
      <input type="hidden" name="is_active" value="0"> <!-- Campo oculto para el valor falso -->
      <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $usuario->is_active) ?
      'checked' : '' }}>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
  </form>
</div>
@endsection