@extends('adminlte::page')

@section('content')
<div class="container">
  <h1>Agregar Producto a Distribución</h1>
  <form action="{{ route('distribucion_productos.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="distribucion_id" class="form-label">ID de Distribución</label>
      <input type="number" class="form-control" id="distribucion_id" name="distribucion_id"
        value="{{ old('distribucion_id') }}">
    </div>

    <div class="mb-3">
      <label for="producto_id" class="form-label">Producto</label>
      <select class="form-control" id="producto_id" name="producto_id">
        @foreach($productos as $producto)
        <option value="{{ $producto->id }}" {{ old('producto_id')==$producto->id ? 'selected' : '' }}>
          {{ $producto->nombre }}
        </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="precio" class="form-label">Precio</label>
      <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ old('precio') }}">
    </div>

    <div class="mb-3">
      <label for="fecha" class="form-label">Fecha</label>
      <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}">
    </div>

    <div class="mb-3">
      <label for="nomproducto" class="form-label">Nombre del Producto</label>
      <input type="text" class="form-control" id="nomproducto" name="nomproducto" value="{{ old('nomproducto') }}">
    </div>

    <div class="mb-3">
      <label for="fechaUEnt" class="form-label">Fecha Última Entrega</label>
      <input type="date" class="form-control" id="fechaUEnt" name="fechaUEnt" value="{{ old('fechaUEnt') }}">
    </div>

    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <input type="text" class="form-control" id="status" name="status" value="{{ old('status') }}">
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
  </form>
</div>
@endsection