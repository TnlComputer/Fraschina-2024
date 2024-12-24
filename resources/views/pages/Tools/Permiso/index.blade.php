@extends('adminlte::page')

@section('content')
<h2>Gestión de Permisos</h2>
<a href="{{ route('permissions.create') }}" class="btn btn-primary">Crear Nuevo Permiso</a>
<table class="table">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($permissions as $permission)
    <tr>
      <td>{{ $permission->name }}</td>
      <td>
        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning">Editar</a>
        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline-block;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $permissions->links() }}
@endsection