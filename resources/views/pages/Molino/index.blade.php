@extends('adminlte::page')

@section('content')
<div class="container">
  <div class="row">
    <!-- Cambio de Nombre -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ __('Molino') }}</h3>
        </div>
        <div class="card-body">
          <!-- Formulario de Nombre -->
          {{-- <form method="post" action="{{ route('profile.update') }}" class="mt-4 space-y-6">
            @csrf
            @method('patch')

            <div class="form-group">
              <label for="name" class="form-label">{{ __('Name') }}</label>
              <input id="name" name="name" type="text" class="form-control mt-1 block w-full"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
              @error('name')
              <div class="text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="d-flex justify-content-between">
              <button type="submit" class="btn btn-primary">{{ __('Save Name') }}</button>
            </div>
          </form> --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection