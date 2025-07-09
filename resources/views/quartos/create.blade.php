@extends('adminlte::page')

@section('title', 'Cadastrar Quarto')

@section('content_header')
    <h1>Cadastrar Quarto</h1>
@stop

@section('content')
    <form action="{{ route('quartos.store') }}" method="POST">
        @csrf

        @include('quartos.form')

        <button type="submit" class="btn btn-success mt-3">Salvar</button>
        <a href="{{ route('quartos.index') }}" class="btn btn-secondary mt-3">Voltar</a>
    </form>
@stop
