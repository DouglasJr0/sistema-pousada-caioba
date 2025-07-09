@extends('adminlte::page')

@section('title', 'Quartos')

@section('content_header')
    <h1>Quartos</h1>
@stop

@section('content')
    <a href="{{ route('quartos.create') }}" class="btn btn-primary mb-3">Novo Quarto</a>

    <table id="quartosTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Número</th>
                <th>Tipo</th>
                <th>Capacidade</th>
                <th>Valor Diária</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quartos as $quarto)
                <tr>
                    <td>{{ $quarto->numero }}</td>
                    <td>{{ $quarto->tipo }}</td>
                    <td>{{ $quarto->capacidade }}</td>
                    <td>R$ {{ number_format($quarto->valor_diaria, 2, ',', '.') }}</td>
                    <td>{{ ucfirst($quarto->status) }}</td>
                    <td>
                        <a href="{{ route('quartos.edit', $quarto->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('quartos.destroy', $quarto->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Tem certeza que deseja excluir este quarto?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('#quartosTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
                }
            });
        });
    </script>
@stop
