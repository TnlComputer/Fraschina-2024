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
@endsection