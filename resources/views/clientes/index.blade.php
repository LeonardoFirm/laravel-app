@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <article>
            <h2>Clientes Cadastrados</h2>
        </article>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <br>
        <div class="row gy-4">
            @if ($clientes->isNotEmpty())
                @foreach ($clientes as $cliente)
                    <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                        <div class="card p-3 rounded-0 mt-3 shadow-lg border-0">
                            <h4>{{ $cliente->nome }} {{ $cliente->sobrenome }}</h4>
                            <span class="info-cliente">Telefone: {{ $cliente->formatted_telefone }}</span>
                            <span class="info-cliente">Celular: {{ $cliente->formatted_celular }}</span>
                            <span class="info-cliente">CPF/CNPJ: {{ $cliente->formatted_cpf_cnpj }}</span>
                            <span class="info-cliente">Endereço: {{ $cliente->endereco }}, {{ $cliente->numero }},
                                {{ $cliente->bairro }},
                                {{ $cliente->cep }}</span>
                            <br>
                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger float-end rounded-0"> Deletar <i
                                        class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Nenhum cliente cadastrado.</p>
            @endif
        </div>

        <section class="content-excel">
            <a href="{{ route('clientes.exportar-csv') }}" class="btn btn-outline-success export-csv rounded-0"><i
                    class="fa-solid fa-file-excel"></i> Baixar CSV</a>
        </section>
    </div>
@endsection
