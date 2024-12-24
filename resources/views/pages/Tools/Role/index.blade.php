@extends('adminlte::page')

@section('content')
<h2>Gestión de Roles</h2>
<a href="{{ route('roles.create') }}" class="btn btn-primary">Crear Nuevo Rol</a>
<table class="table">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Permisos</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($roles as $role)
    <tr>
      <td>{{ $role->name }}</td>
      <td>
        @foreach($role->permissions as $permission)
        <span class="badge bg-info">{{ $permission->name }}</span>
        @endforeach
      </td>
      <td>
        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Editar</a>
        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline-block;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $roles->links() }}
@endsection