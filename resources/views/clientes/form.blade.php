@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="form">
            <h3>Dados do Cliente</h3>
            <div class="card p-5 rounded-0 mt-3 shadow-lg border-0">
                <form action="{{ route('clientes.store') }}" method="POST">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-lg-6 col-md-6 col-12">
                            <input type="text" name="nome" class="form-control" placeholder="Nome" required>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <input type="text" name="sobrenome" class="form-control" placeholder="Sobrenome" required>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="telefone" class="form-control" placeholder="Telefone">
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="celular" class="form-control" placeholder="Celular" required>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="cpf_cnpj" class="form-control" placeholder="CPF ou CNPJ">
                        </div>
                        <div class="col-12">
                            <input type="text" name="endereco" class="form-control" placeholder="Endereço" required>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <input type="text" name="bairro" class="form-control" placeholder="Bairro" required>
                        </div>
                        <div class="col-lg-2 col-md-6 col-12">
                            <input type="text" name="numero" class="form-control" placeholder="Número" required>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="cep" class="form-control" placeholder="CEP" required>
                        </div>
                    </div>
                    <div class="form-btn"><button type="submit" class="btn btn-warning mt-4 rounded-0">Próximo</button></div>
                </form>
            </div>
        </section>
    </div>
@endsection
