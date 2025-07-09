@extends('adminlte::page')

@section('title', 'Editar Quarto')

@section('content_header')
    <h1>Editar Quarto</h1>
@stop

@section('content')
    <form action="{{ route('quartos.update', $quarto->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('quartos.form')

        <button type="submit" class="btn btn-success mt-3">Atualizar</button>
        <a href="{{ route('quartos.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
@stop
