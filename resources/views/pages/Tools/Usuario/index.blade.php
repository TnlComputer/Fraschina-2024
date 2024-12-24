@extends('adminlte::page')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card-header">
        <h3 class="card-title">{{ __('Usuarios') }}</h3>
      </div>
      <div class="col-12">
        <div class="py-2">
          <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-2 text-gray-900 text-left text-xs">
                <div class="barra__index d-flex justify-content-between align-items-center mb-3">
                  <div class="div__nuevo">
                    <form action="{{ route('usuarios.create') }}">
                      <input class="btn btn-primary" type="submit" value="Nuevo">
                    </form>
                  </div>
                  <div class="div__buscar d-flex">
                    <form method="get" action="{{ route('usuarios.index') }}" class="form__buscar d-flex">
                      @csrf
                      <input type="text" placeholder="Buscar por nombre" name="name" value="{{ $name }}"
                        class="form-control me-2" style="max-width: 350px;">
                      <input type="submit" value="Buscar" class="btn btn-secondary">
                    </form>
                  </div>
                </div>
                <table class="table table-sm table-striped table-bordered w-100 text-md">
                  </thead>
                  @forelse($usuarios as $usuario)
                  <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                      @if ($usuario->roles->isNotEmpty())
                      @foreach ($usuario->roles as $role)
                      <span class="text-capitalize">{{ $role->name }}</span>
                      @endforeach
                      @else
                      Sin roles asignados
                      @endif
                    </td>
                    {{-- <td>
                      @if ($usuario->roles->isNotEmpty())
                      <ul>
                        @foreach ($usuario->roles as $role)
                        @if ($role->permissions->isNotEmpty())
                        @foreach ($role->permissions as $permission)
                        <li>{{ $permission->name }}</li>
                        @endforeach
                        @else
                        <li>Sin permisos asignados</li>
                        @endif
                        @endforeach
                      </ul>
                      @else
                      Sin permisos
                      @endif
                    </td> --}}
                    <td>{{ $usuario->status }}</td>
                    {{-- <td>{{ $user->status }}</td> --}}
                    <td class=" d-flex justify-content-between">
                      {{-- <a href="{{ route('usuario.show', $usuario->id) }}" class="btn-xs btn-info" title="Ver">
                        <i class="fa-regular fa-eye fa-xs align-middle"></i>
                      </a> --}}
                      <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn-xs btn-warning" title="Editar">
                        <i class="fa-solid fa-pen-to-square fa-xs "></i>
                      </a>
                      <form method="POST" action="{{ route('usuarios.destroy', $usuario->id) }}"
                        onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-xs btn-danger" title="Eliminar">
                          <i class="fa-solid fa-trash fa-xs"></i>
                        </button>
                      </form>
                    </td>

                  </tr>
                  @empty
                  <p>No hay registros para mostrar...</p>
                  @endforelse
                </table>
                {{ $usuarios->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection