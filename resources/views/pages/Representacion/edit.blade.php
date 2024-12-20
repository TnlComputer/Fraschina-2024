@extends('adminlte::page')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h3 class="card-title">{{ __('Nueva Representación') }}</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('representacion.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
              <!-- Razón social -->
              <div class="col-md-6 mb-3">
                <label for="razonsocial" class="form-label">Razón social</label>
                <input type="text" name="razonsocial" id="razonsocial" class="form-control"
                  value="{{ old('razonsocial') }}" required>
              </div>

              <!-- Teléfono -->
              <div class="col-md-6 mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}">
              </div>

              <!-- Dirección: Calle y Número -->
              <div class="col-md-6 mb-3">
                <label for="dire_calle" class="form-label">Calle</label>
                <input type="text" name="dire_calle" id="dire_calle" class="form-control"
                  value="{{ old('dire_calle') }}">
              </div>
              <div class="col-md-3 mb-3">
                <label for="dire_nro" class="form-label">Número</label>
                <input type="text" name="dire_nro" id="dire_nro" class="form-control" value="{{ old('dire_nro') }}">
              </div>

              <!-- Piso y Dpto -->
              <div class="col-md-3 mb-3">
                <label for="piso" class="form-label">Piso</label>
                <input type="text" name="piso" id="piso" class="form-control" value="{{ old('piso') }}">
              </div>
              <div class="col-md-3 mb-3">
                <label for="dpto" class="form-label">Departamento</label>
                <input type="text" name="dpto" id="dpto" class="form-control" value="{{ old('dpto') }}">
              </div>

              <!-- Código Postal y Observaciones -->
              <div class="col-md-3 mb-3">
                <label for="codpost" class="form-label">Código Postal</label>
                <input type="text" name="codpost" id="codpost" class="form-control" value="{{ old('codpost') }}">
              </div>
              <div class="col-md-6 mb-3">
                <label for="dire_obs" class="form-label">Observaciones Dirección</label>
                <input type="text" name="dire_obs" id="dire_obs" class="form-control" value="{{ old('dire_obs') }}">
              </div>
            </div>

            <hr>

            <div class="row">
              <!-- Ubicación -->
              <div class="col-md-4 mb-3">
                <label for="barrio_id" class="form-label">Barrio</label>
                <select name="barrio_id" id="barrio_id" class="form-select">
                  <option value="">Seleccione un barrio</option>
                  @foreach ($barrios as $barrio)
                  <option value="{{ $barrio->id }}" @if (old('barrio_id')==$barrio->id) selected @endif>{{
                    $barrio->nombre }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="localidad_id" class="form-label">Localidad</label>
                <select name="localidad_id" id="localidad_id" class="form-select">
                  <option value="">Seleccione una localidad</option>
                  @foreach ($localidades as $localidad)
                  <option value="{{ $localidad->id }}" @if (old('localidad_id')==$localidad->id) selected @endif>{{
                    $localidad->nombre }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="zona_id" class="form-label">Zona</label>
                <select name="zona_id" id="zona_id" class="form-select">
                  <option value="">Seleccione una zona</option>
                  @foreach ($zonas as $zona)
                  <option value="{{ $zona->id }}" @if (old('zona_id')==$zona->id) selected @endif>{{ $zona->nombre }}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>

            <hr>

            <div class="row">
              <!-- Fiscal -->
              <div class="col-md-4 mb-3">
                <label for="cuit" class="form-label">CUIT</label>
                <input type="text" name="cuit" id="cuit" class="form-control" value="{{ old('cuit') }}">
              </div>
              <div class="col-md-4 mb-3">
                <label for="excenciones" class="form-label">Exenciones</label>
                <input type="text" name="excenciones" id="excenciones" class="form-control"
                  value="{{ old('excenciones') }}">
              </div>

              <div class="col-md-4 mb-3">
                <label for="marcas" class="form-label">Marcas</label>
                <input type="text" name="marcas" id="marcas" class="form-control" value="{{ old('marcas') }}">
              </div>
              {{-- <div class="col-md-4 mb-3">
                <label for="iva_id" class="form-label">IVA</label>
                <select name="iva_id" id="iva_id" class="form-select">
                  <option value="">Seleccione un IVA</option>
                  @foreach ($ivas as $iva)
                  <option value="{{ $iva->id }}" @if (old('iva_id')==$iva->id) selected @endif>{{ $iva->nombre }}
                  </option>
                  @endforeach
                </select>
              </div> --}}
            </div>

            <hr>

            <div class="row">
              <!-- Información adicional -->
              <div class="col-md-6 mb-3">
                <label for="info" class="form-label">Información Adicional</label>
                <textarea name="info" id="info" rows="3" class="form-control">{{ old('info') }}</textarea>
              </div>
              <div class="col-md-6 mb-3">
                <label for="comentarios" class="form-label">Comentarios</label>
                <textarea name="comentarios" id="comentarios" rows="3"
                  class="form-control">{{ old('comentarios') }}</textarea>
              </div>
            </div>

            <hr>

            <!-- Botones -->
            <div class="d-flex justify-content-between">
              <button type="submit" class="btn btn-success">Guardar Cambios</button>
              <a href="{{ route('representacion.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection