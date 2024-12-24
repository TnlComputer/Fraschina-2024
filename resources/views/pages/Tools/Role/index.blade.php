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
<table class="table table-striped table-responsive-sm table-striped-columns table-valign-middle table-sm">
  <thead>
    <tr>
      <th>Rol</th>
      <th>Repr</th>
      <th>Dist</th>
      <th>Moli</th>
      <th>Prov</th>
      <th>Agro</th>
      <th>Tran</th>
      <th>Expe</th>
      <th>Agra</th>
      <th>Tool</th>
      <th>Alta</th>
      <th>Edit</th>
      <th>Del </th>
      <th>Acción</th>
    </tr>
  </thead>
  <tbody>
    @foreach($roles as $role)
    <tr class=" text-md">
      <td class="text-capitalize">{{ $role->name }}</td>

      {{-- Mostrar los permisos como columnas --}}
      @foreach([1, 2, 3, 4, 5, 6, 7, 8, 9, 11, 12, 13] as $i)
      <td style="background-color: {{ $role->permissions->contains('name', 'permiso_'.$i) ? '#90ee90' : '#af2626' }};">
      </td>
      {{-- <td> {{ $role->permissions->contains('name', 'permiso_'.$i) ? 'SI' : 'NO' }}</td> --}}
      @endforeach

      <td>

        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-xs" title="Editar">
          <i class="fa-solid fa-pen-to-square fa-xs"></i>
        </a>
        {{-- <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline-block;">
          @csrf
          @method('DELETE') --}}
          {{-- <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline-block;"
            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este rol?')">
            @csrf
            @method('DELETE') --}}
            <button class="btn btn-danger btn-xs" onclick="confirmDeletion('{{ route('roles.destroy', $role->id) }}')"
              title="Eliminar"><i class="fa-solid fa-trash fa-xs"></i></button>
            {{--
          </form> --}}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $roles->links() }}

<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Confirmar Eliminación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que deseas eliminar este rol? Esta acción no se puede deshacer.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="deleteForm" method="POST" style="display: inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script>
  function confirmDeletion(actionUrl) {
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.setAttribute('action', actionUrl);
    const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
    modal.show();
  }
</script>
@endsection