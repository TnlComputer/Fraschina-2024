@extends('adminlte::page')

@section('content')
@include('pages.Distribucion.Producto.form', ['action' => route('distribucion_producto.store'), 'method' => 'POST',
'buttonText'
=> 'Crear
Distribución'])
@endsection