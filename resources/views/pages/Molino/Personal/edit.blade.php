@extends('adminlte::page')

@section('content_header')
<h1>Editar Molino Personal</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <form id="editForm" action="{{ route('molino_personal.update', $personal->id) }}" method="POST">
      @csrf
      @method('PUT')

      {{-- Incluye el formulario común para crear/editar --}}
      @include('Pages.Molino.Personal.form', ['action' => 'edit', 'personal' => $personal])

      <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary" id="saveButton">Actualizar</button>
        <a href="{{ route('molino.show', ['molino' => $personal->molino_id]) }}" class="btn btn-secondary">Cancelar</a>
      </div>
    </form>
  </div>
</div>

@section('js')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('editForm');
    const saveButton = document.getElementById('saveButton');

    // Prevenir el envío al presionar "Enter" en cualquier campo
    form.addEventListener('keydown', function (event) {
      if (event.key === 'Enter') {
        event.preventDefault(); // Evitar el comportamiento por defecto
      }
    });

    // Permitir envío solo al hacer clic en el botón guardar
    saveButton.addEventListener('click', function () {
      form.submit();
    });
  });
</script>
@stop

@endsection