@extends('adminlte::page')

@section('content_header')
<h1>Crear Molino</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('molino.store') }}" method="POST">
      @csrf

      @include('Pages.Molino.form', ['action' => 'create'])
      <div class=" d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('molino.index') }}" class="btn btn-secondary">Cancelar</a>
      </div>
    </form>
  </div>
</div>
@endsection