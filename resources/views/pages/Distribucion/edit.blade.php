@extends('adminlte::page')

@section('content')
@include('pages.Distribucion.form', ['action' => route('distribucion_producto.update', $distribucion->id),
'method' =>
'PUT',
'buttonText' => 'Actualizar Distribución', 'distribucion' => $distribucion])
@endsection