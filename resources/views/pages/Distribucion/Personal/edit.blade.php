@extends('adminlte::page')

@section('title', 'Editar Distribución Personal')

@section('content_header')
<h1>Editar Distribución Personal</h1>
@stop

@section('content')
<div class="d-flex justify-content-end">
  <form action="{{ route('distribucion_personal.update', $personal->id) }}" method="POST">
    @csrf
    @method('PUT')
    @include('pages.Distribucion.Personal.form', ['distribucionPersonal' => $personal])

    <div class="d-flex justify-content-between">
      <button type="submit" class="btn btn-primary">Actualizar</button>
      <a href="{{ route('distribucion_personal.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
  </form>
</div>
@stop

@section('js')
<script>
  // Deshabilitar el envío del formulario al presionar "Enter" excepto cuando el foco está en los botones
  document.addEventListener('DOMContentLoaded', function () {
      // Seleccionamos el formulario
      const form = document.querySelector('form');
      
      // Seleccionamos los botones de guardar y cancelar
      const saveButton = document.querySelector('button[type="submit"]');
      const cancelButton = document.querySelector('a.btn-secondary');

      // Función para prevenir el submit
      function preventEnter(event) {
          // Verificar si el enfoque no está en un botón
          if (event.key === 'Enter' && document.activeElement !== saveButton && document.activeElement !== cancelButton) {
              event.preventDefault();
          }
      }

      // Añadir el listener para prevenir el enter en todo el formulario
      form.addEventListener('keydown', preventEnter);
  });
</script>
@stop