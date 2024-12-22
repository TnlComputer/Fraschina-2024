@extends('adminlte::page')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Selecciona la tabla para exportar</h3>
        </div>
        <form method="POST" action="{{ route('export.generate') }}">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="table">Selecciona una tabla</label>
              <select name="table" id="table" class="form-control">
                <option value="">Selecciona una tabla</option>
                @foreach ($tables as $table)
                <option value="{{ $table }}">{{ $table }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Generar Exportación</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection