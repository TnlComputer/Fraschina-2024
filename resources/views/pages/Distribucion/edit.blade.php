@extends('adminlte::page')

@section('content')
@include('pages.Distribucion.Producto.form', ['action' => route('distribucio_producto.update', $distribucion->id),
'method' =>
'PUT',
'buttonText' => 'Actualizar Distribución', 'distribucion' => $distribucion])
@endsection