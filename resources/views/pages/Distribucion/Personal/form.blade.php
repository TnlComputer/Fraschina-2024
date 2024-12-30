<div class="row">
  <div class="col-md-6 mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror"
      value="{{ old('nombre', $distribucionPersonal->nombre ?? '') }}" required>
    @error('nombre')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-6 mb-3">
    <label for="apellido" class="form-label">Apellido</label>
    <input type="text" name="apellido" id="apellido" class="form-control @error('apellido') is-invalid @enderror"
      value="{{ old('apellido', $distribucionPersonal->apellido ?? '') }}">
    @error('apellido')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-6 mb-3">
    <label for="distribucion_id" class="form-label">Distribución</label>
    <select name="distribucion_id" id="distribucion_id"
      class="form-control @error('distribucion_id') is-invalid @enderror" required>
      <option value="">Seleccione una distribución</option>
      @foreach ($distribuciones as $distribucion)
      <option value="{{ $distribucion->id }}" {{ old('distribucion_id', $distribucionPersonal->distribucion_id ?? '') ==
        $distribucion->id ? 'selected' : '' }}>
        @if($distribucion->nomfantasia && $distribucion->razonsocial)
        {{ $distribucion->nomfantasia }} - {{ $distribucion->razonsocial }}
        @elseif($distribucion->nomfantasia)
        {{ $distribucion->nomfantasia }}
        @elseif($distribucion->razonsocial)
        {{ $distribucion->razonsocial }}
        @endif
      </option>
      @endforeach
    </select>
    @error('distribucion_id')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-6 mb-3">
    <label for="area_id" class="form-label">Área</label>
    <select name="area_id" id="area_id" class="form-control @error('area_id') is-invalid @enderror" required>
      <option value="">Seleccione un área</option>
      @foreach ($areas as $area)
      <option value="{{ $area->id }}" {{ old('area_id', $distribucionPersonal->area_id ?? '') == $area->id ? 'selected'
        : '' }}>
        {{ $area->area }}
      </option>
      @endforeach
    </select>
    @error('area_id')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-6 mb-3">
    <label for="cargo_id" class="form-label">Cargo</label>
    <select name="cargo_id" id="cargo_id" class="form-control @error('cargo_id') is-invalid @enderror" required>
      <option value="">Seleccione un cargo</option>
      @foreach ($cargos as $cargo)
      <option value="{{ $cargo->id }}" {{ old('cargo_id', $distribucionPersonal->cargo_id ?? '') == $cargo->id ?
        'selected' : '' }}>
        {{ $cargo->cargo }}
      </option>
      @endforeach
    </select>
    @error('cargo_id')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-6 mb-3">
    <label for="profesion_id" class="form-label">Profesión</label>
    <select name="profesion_id" id="profesion_id" class="form-control @error('profesion_id') is-invalid @enderror"
      required>
      <option value="">Seleccione una profesión</option>
      @foreach ($profesiones as $profesion)
      <option value="{{ $profesion->id }}" {{ old('profesion_id', $distribucionPersonal->profesion_id ?? '') ==
        $profesion->id ? 'selected' : '' }}>
        {{ $profesion->nombreprofesion }}
      </option>
      @endforeach
    </select>
    @error('profesion_id')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-6 mb-3">
    <label for="teldirecto" class="form-label">Teléfono Directo</label>
    <input type="text" name="teldirecto" id="teldirecto" class="form-control @error('teldirecto') is-invalid @enderror"
      value="{{ old('teldirecto', $distribucionPersonal->teldirecto ?? '') }}">
    @error('teldirecto')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-6 mb-3">
    <label for="telparticular" class="form-label">Teléfono Particular</label>
    <input type="text" name="telparticular" id="telparticular"
      class="form-control @error('telparticular') is-invalid @enderror"
      value="{{ old('telparticular', $distribucionPersonal->telparticular ?? '') }}">
    @error('telparticular')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-6 mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
      value="{{ old('email', $distribucionPersonal->email ?? '') }}">
    @error('email')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-12 mb-3">
    <label for="observaciones" class="form-label">Observaciones</label>
    <textarea name="observaciones" id="observaciones"
      class="form-control @error('observaciones') is-invalid @enderror">{{ old('observaciones', $distribucionPersonal->observaciones ?? '') }}</textarea>
    @error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>