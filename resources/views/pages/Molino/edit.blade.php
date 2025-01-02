@extends('adminlte::page')

@section('content_header')
<h1>Editar Molino</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('molino.update', $molino->id) }}" method="POST">
      @csrf
      @method('PUT')

      @include('Pages.Molino.form', ['action' => 'edit', 'molino' => $molino])

      <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('molino.index') }}" class="btn btn-secondary">Cancelar</a>
      </div>
    </form>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('form').addEventListener('keydown', (e) => {
      if (e.key === 'Enter') e.preventDefault();
        });
    });
</script>
@endsection