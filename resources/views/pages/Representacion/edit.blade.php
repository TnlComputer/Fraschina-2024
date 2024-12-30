@extends('adminlte::page')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-header">
          <h3 class="card-title">{{ __('Editar Representación') }}</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('representacion.update', $representacion->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
              <!-- Razón social -->
              <div class="col-md-6 mb-3">
                <label for="razonsocial" class="form-label">Razón social</label>
                <input type="text" name="razonsocial" id="razonsocial"
                  class="form-control @error('razonsocial') is-invalid @enderror"
                  value="{{ old('razonsocial', $representacion->razonsocial) }}" required>
                @error('razonsocial')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <!-- Dirección: Calle y Número -->
              <div class="col-md-6 mb-3">
                <label for="dire_calle" class="form-label">Calle</label>
                <input type="text" name="dire_calle" id="dire_calle"
                  class="form-control @error('dire_calle') is-invalid @enderror"
                  value="{{ old('dire_calle', $representacion->dire_calle) }}">
                @error('dire_calle')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label for="dire_nro" class="form-label">Número</label>
                <input type="text" name="dire_nro" id="dire_nro"
                  class="form-control @error('dire_nro') is-invalid @enderror"
                  value="{{ old('dire_nro', $representacion->dire_nro) }}">
                @error('dire_nro')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Piso y Dpto -->
              <div class="col-md-3 mb-3">
                <label for="piso" class="form-label">Piso</label>
                <input type="text" name="piso" id="piso" class="form-control @error('piso') is-invalid @enderror"
                  value="{{ old('piso', $representacion->piso) }}">
                @error('piso')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label for="dpto" class="form-label">Departamento</label>
                <input type="text" name="dpto" id="dpto" class="form-control @error('dpto') is-invalid @enderror"
                  value="{{ old('dpto', $representacion->dpto) }}">
                @error('dpto')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Código Postal y Observaciones -->
              <div class="col-md-3 mb-3">
                <label for="codpost" class="form-label">Código Postal</label>
                <input type="text" name="codpost" id="codpost"
                  class="form-control @error('codpost') is-invalid @enderror"
                  value="{{ old('codpost', $representacion->codpost) }}">
                @error('codpost')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label for="dire_obs" class="form-label">Observaciones Dirección</label>
                <input type="text" name="dire_obs" id="dire_obs"
                  class="form-control @error('dire_obs') is-invalid @enderror"
                  value="{{ old('dire_obs', $representacion->dire_obs) }}">
                @error('dire_obs')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <!-- Ubicación -->
              <div class="col-md-3 mb-3">
                <label for="barrio_id" class="form-label">Barrio</label>
                <select name="barrio_id" id="barrio_id" class="form-select @error('barrio_id') is-invalid @enderror">
                  <option value="">Seleccione un barrio</option>
                  @foreach ($barrios as $barrio)
                  <option value="{{ $barrio->id }}" @if (old('barrio_id', $representacion->barrio_id) == $barrio->id)
                    selected @endif>{{ $barrio->nombrebarrio }}</option>
                  @endforeach
                </select>
                @error('barrio_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label for="municipio_id" class="form-label">Municipio</label>
                <select name="municipio_id" id="municipio_id"
                  class="form-select @error('municipio_id') is-invalid @enderror">
                  <option value="">Seleccione un municipio</option>
                  @foreach ($municipios as $municipio)
                  <option value="{{ $municipio->id }}" @if (old('municipio_id', $representacion->municipio_id) ==
                    $municipio->id) selected @endif>{{ $municipio->ciudadmunicipio }}</option>
                  @endforeach
                </select>
                @error('municipio_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label for="localidad_id" class="form-label">Localidad</label>
                <select name="localidad_id" id="localidad_id"
                  class="form-select @error('localidad_id') is-invalid @enderror">
                  <option value="">Seleccione una localidad</option>
                  @foreach ($localidades as $localidad)
                  <option value="{{ $localidad->id }}" @if (old('localidad_id', $representacion->localidad_id) ==
                    $localidad->id) selected @endif>{{ $localidad->localidad }}</option>
                  @endforeach
                </select>
                @error('localidad_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label for="zona_id" class="form-label">Zona</label>
                <select name="zona_id" id="zona_id" class="form-select @error('zona_id') is-invalid @enderror">
                  <option value="">Seleccione una zona</option>
                  @foreach ($zonas as $zona)
                  <option value="{{ $zona->id }}" @if (old('zona_id', $representacion->zona_id) == $zona->id) selected
                    @endif>{{ $zona->nombre }}</option>
                  @endforeach
                </select>
                @error('zona_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <!-- Teléfono -->
            <div class="col-md-6 mb-3">
              <label for="telefono" class="form-label">Teléfono</label>
              <input type="text" name="telefono" id="telefono"
                class="form-control @error('telefono') is-invalid @enderror"
                value="{{ old('telefono', $representacion->telefono) }}">
              @error('telefono')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="row">
              <!-- Fiscal -->
              <div class="col-md-4 mb-3">
                <label for="cuit" class="form-label">CUIT</label>
                <input type="text" name="cuit" id="cuit" class="form-control @error('cuit') is-invalid @enderror"
                  value="{{ old('cuit', $representacion->cuit) }}">
                @error('cuit')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-4 mb-3">
                <label for="marcas" class="form-label">Marcas</label>
                <input type="text" name="marcas" id="marcas" class="form-control @error('marcas') is-invalid @enderror"
                  value="{{ old('marcas', $representacion->marcas) }}">
                @error('marcas')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <hr>

            <div class="row">
              <!-- Información adicional -->
              <div class="col-md-12 mb-3">
                <label for="info" class="form-label">Información Adicional</label>
                <textarea name="info" id="info" rows="3"
                  class="form-control @error('info') is-invalid @enderror">{{ old('info', $representacion->info) }}</textarea>
                @error('info')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="d-flex justify-content-between">
              <button type="submit" class="btn btn-primary">{{ __('Actualizar Representación') }}</button>
              <a href="{{ route('representacion.index') }}" class="btn btn-secondary">{{ __('Cancelar') }}</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection