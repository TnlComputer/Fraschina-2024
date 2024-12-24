@extends('adminlte::page')

@section('content')
<h2>Crear Nuevo Permiso</h2>
<form action="{{ route('permissions.store') }}" method="POST">
  @csrf
  <div class="form-group">
    <label for="name">Nombre del Permiso</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
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
  <button type="submit" class="btn btn-primary">Crear Permiso</button>
</form>
@endsection