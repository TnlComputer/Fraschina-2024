@extends('layouts.app')

@section('title', 'Sesión Expirada')

@section('content')
<div class="text-center mt-5">
  <h1>Sesión Expirada</h1>
  <p>Tu sesión ha expirado. Por favor, inicia sesión nuevamente.</p>
  <a href="{{ route('login') }}" class="btn btn-primary">Ir al Login</a>
</div>
@endsection