{{-- @extends('adminlte::page')

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
        <span class="badge bg-info">{{ $permission->description }}</span>
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
@endsection --}}

@extends('adminlte::page')

@section('content')
<h2>Gestión de Roles</h2>
<a href="{{ route('roles.create') }}" class="btn btn-primary">Crear Nuevo Rol</a>
<table class="table">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Repre</th>
      <th>Distri</th>
      <th>Molino</th>
      <th>Provee</th>
      <th>AgroIn</th>
      <th>Transp</th>
      <th>Expdic</th>
      <th>Agenda</th>
      <th>Tools </th>
      <th>Alta </th>
      <th>Baja </th>
      <th>Delete</th>
      <th>Acción</th>
    </tr>
  </thead>
  <tbody>
    @foreach($roles as $role)
    <tr>
      <td class="text-capitalize">{{ $role->name }}</td>

      {{-- Mostrar los permisos como columnas --}}
      @foreach([1, 2, 3, 4, 5, 6, 7, 8, 9, 11, 12, 13] as $i)
      <td style="background-color: {{ $role->permissions->contains('name', 'permiso_'.$i) ? '#90ee90' : '#f8d7da' }};">
      </td>
      @endforeach

      <td>

        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-xs" title="Editar">
          <i class="fa-solid fa-pen-to-square fa-xs"></i>
        </a>
        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline-block;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-xs" title="Eliminar"><i
              class="fa-solid fa-trash fa-xs"></i></button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $roles->links() }}
@endsection