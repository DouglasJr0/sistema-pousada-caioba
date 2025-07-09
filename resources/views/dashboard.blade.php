@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Bem-vindo, {{ Auth::user()->name }}</p>
@stop


<a href="{{ route('quartos.index') }}"
    style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">
    ➕ Ver Quartos
</a>
