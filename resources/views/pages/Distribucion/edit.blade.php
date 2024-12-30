@extends('adminlte::page')

@section('content')
@include('Pages.Distribucion.form', ['action' => route('distribucion.update', $distribucion->id), 'method' => 'PUT',
'buttonText' => 'Actualizar Distribución', 'distribucion' => $distribucion])
@endsection