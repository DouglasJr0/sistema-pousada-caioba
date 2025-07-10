@extends('adminlte::page')

@section('title', 'Hóspedes')

@section('content_header')
    <h1 class="m-0 text-dark">Lista de Hóspedes</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="card-title">Todos os Hóspedes</h3>
            <div class="card-tools">
                <button class="btn btn-light btn-sm" id="btnAddHospede">
                    <i class="fas fa-user-plus"></i> Novo Hóspede
                </button>

            </div>
        </div>
        <div class="card-body">
            <table id="hospedesTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hospedes as $hospede)
                        <tr>
                            <td>{{ $hospede->id }}</td>
                            <td>{{ $hospede->nome }}</td>
                            <td>{{ $hospede->telefone }}</td>
                            <td>{{ $hospede->cpf }}</td>
                            <td>{{ $hospede->email }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning btnEdit" data-id="{{ $hospede->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button class="btn btn-sm btn-danger btnDelete" data-id="{{ $hospede->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#hospedesTable').DataTable();

            $('.btnDelete').click(function() {
                let id = $(this).data('id');

                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Esta ação não poderá ser desfeita!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sim, excluir!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/hospedes/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function() {
                                location.reload();
                            }
                        });
                    }
                });
            });
            $('#btnAddHospede').click(function() {
                Swal.fire({
                    title: 'Novo Hóspede',
                    html: `<input type="text" id="nome" class="swal2-input" placeholder="Nome">
            <input type="text" id="cpf" class="swal2-input" placeholder="CPF">
            <input type="text" id="telefone" class="swal2-input" placeholder="Telefone">
            <input type="email" id="email" class="swal2-input" placeholder="Email">`,
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Salvar',
                    cancelButtonText: 'Cancelar',
                    preConfirm: () => {
                        const nome = $('#nome').val().trim();
                        const cpf = $('#cpf').val().trim();
                        const telefone = $('#telefone').val().trim();
                        const email = $('#email').val().trim();

                        if (!nome) {
                            Swal.showValidationMessage(`O campo nome é obrigatório`);
                            return false;
                        }

                        return {
                            nome,
                            cpf,
                            telefone,
                            email
                        };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('hospedes.store') }}",
                            type: "POST",
                            data: {
                                _token: '{{ csrf_token() }}',
                                ...result.value
                            },
                            success: function(res) {
                                Swal.fire('Sucesso!', res.message, 'success').then(() =>
                                    location.reload());
                            },
                            error: function(xhr) {
                                Swal.fire('Erro!', 'Verifique os dados informados.',
                                    'error');
                            }
                        });
                    }
                });
            });

            $('.btnEdit').click(function() {
                let id = $(this).data('id');

                $.get('/hospedes/' + id + '/edit', function(hospede) {
                    Swal.fire({
                        title: 'Editar Hóspede',
                        html: `<input type="text" id="edit-nome" class="swal2-input" value="${hospede.nome}" placeholder="Nome">
                <input type="text" id="edit-cpf" class="swal2-input" value="${hospede.cpf ?? ''}" placeholder="CPF">
                <input type="text" id="edit-telefone" class="swal2-input" value="${hospede.telefone ?? ''}" placeholder="Telefone">
                <input type="email" id="edit-email" class="swal2-input" value="${hospede.email ?? ''}" placeholder="Email">`,
                        showCancelButton: true,
                        confirmButtonText: 'Atualizar',
                        cancelButtonText: 'Cancelar',
                        preConfirm: () => {
                            const nome = $('#edit-nome').val().trim();
                            const cpf = $('#edit-cpf').val().trim();
                            const telefone = $('#edit-telefone').val().trim();
                            const email = $('#edit-email').val().trim();

                            if (!nome) {
                                Swal.showValidationMessage(
                                `O campo nome é obrigatório`);
                                return false;
                            }

                            return {
                                nome,
                                cpf,
                                telefone,
                                email
                            };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `/hospedes/${id}`,
                                type: 'PUT',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    ...result.value
                                },
                                success: function(res) {
                                    Swal.fire('Atualizado!', res.message,
                                        'success').then(() => location
                                        .reload());
                                },
                                error: function() {
                                    Swal.fire('Erro!',
                                        'Verifique os dados informados.',
                                        'error');
                                }
                            });
                        }
                    });
                });
            });

        });
    </script>
@stop
