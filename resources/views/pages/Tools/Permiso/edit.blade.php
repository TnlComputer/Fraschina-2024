{{-- @extends('adminlte::page')

@section('content')
<h2>Editar Permiso</h2>
<form action="{{ route('permissions.update', $permission->id) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="form-group">
    <label for="name">Nombre del Permiso</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $permission->name) }}" required>
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
  <button type="submit" class="btn btn-primary">Actualizar Permiso</button>
</form>
@endsection --}}
@extends('adminlte::page')

@section('content')
<h2>Editar Permiso</h2>
<form action="{{ route('permissions.update', $permission->id) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="form-group">
    <label for="name">Nombre del Permiso</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $permission->name) }}" required>
  </div>
  <div class="form-group">
    <label for="description">Descripción del Permiso</label>
    <input type="text" name="description" id="description" class="form-control"
      value="{{ old('description', $permission->description) }}" required>
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

  <div class="form-group d-flex justify-content-between">
    <button type="submit" class="btn btn-primary">Actualizar Permiso</button>
    <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Cancelar</a>
  </div>
</form>
@endsection