@extends('adminlte::page')

@section('content_header')
<h1>Editar Molino</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('molino.update', $molino->id) }}" method="POST" id="molinoForm">
      @csrf
      @method('PUT')

      @include('Pages.Molino.form', ['action' => 'edit', 'molino' => $molino])

      <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary" id="submitBtn">Guardar</button>
        <a href="{{ route('molino.index') }}" class="btn btn-secondary">Cancelar</a>
      </div>
    </form>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('molinoForm');
    const submitButton = document.getElementById('submitBtn');
    
    // Prevenir el submit al presionar "Enter" en los campos de texto
    form.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') {
        e.preventDefault(); // Evita el submit cuando presionas Enter
      }
    });
    
    // Permitir el submit solo cuando el botón "Guardar" es clickeado
    submitButton.addEventListener('click', () => {
      form.submit();
    });
  });
</script>

@endsection