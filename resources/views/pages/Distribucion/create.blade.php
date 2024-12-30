@extends('adminlte::page')

@section('content')
@include('Pages.Distribucion.form', ['action' => route('distribucion.store'), 'method' => 'POST', 'buttonText' => 'Crear
Distribución'])
@endsection