@extends('adminlte::page')

@section('content')
@include('pages.Distribucion.form', ['action' => route('distribucion_producto.store'), 'method' => 'POST',
'buttonText'
=> 'Crear
Distribución'])
@endsection