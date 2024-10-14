@extends('layouts.app')
@extends('admin.graficos')

@section('content')
    <div class="container">
        <h2>Dashboard Administrativo</h2>

        <div class="row gy-4 mt-3">
            <div class="col-lg-3 col-md-4 col-12">
                <div class="cards shadow-lg rounded-3 p-3 border-0 card-status text-pedido">
                    <p class="titulo-status">Não Iniciadas</p>
                    <li>{{ $statusTarefas['nao_iniciadas'] }}</li>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-12">
                <div class="cards shadow-lg rounded-3 p-3 border-0 card-status iniciar">
                    <p class="titulo-status">Em Execução</p>
                    <li>{{ $statusTarefas['iniciadas'] }}</li>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-12">
                <div class="cards shadow-lg rounded-3 p-3 border-0 card-status avisar">
                    <p class="titulo-status">Avisar Cliente</p>
                    <li>{{ $statusTarefas['avisar'] }}</li>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-12">
                <div class="cards shadow-lg rounded-3 p-3 border-0 card-status finalizar">
                    <p class="titulo-status">Finalizadas</p>
                    <li>{{ $statusTarefas['finalizadas'] }}</li>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <div class="card shadow-lg p-3 rounded-3 border-0">
                    <div class="card-body">
                        <h5 class="card-title">Receita Total (bruto)</h5>
                        <p class="card-text font-valor-total-servico text-green">
                            <i class="fa-solid fa-arrow-trend-up"></i>
                            R${{ number_format($valorTotalServicos, 2, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <div class="card shadow-lg p-3 rounded-3 border-0">
                    <div class="card-body">
                        <h5 class="card-title">Total de Clientes Cadastrados</h5>
                        <p class="card-text font-valor-total-servico text-blue">
                            <i class="fa-solid fa-people-group"></i>
                            {{ $totalClientes }}
                        </p>
                    </div>
                </div>
            </div>

            @yield('content')

            <div class="col-12">
                <div class="card shadow-lg p-3 rounded-3 border-0">
                    <div class="card-body">
                        <h5 class="card-title">Clientes Recém Cadastrados</h5>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nome</th>
                                        <th>Contatos</th>
                                        <th>Dados</th>
                                        <th>Cadastrado em</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientesRecemCadastrados as $cliente)
                                        <tr>
                                            <td style="width: 20px"><i class="fa-solid fa-user"></i></td>
                                            <td class="text-nowrap">{{ $cliente->nome }} {{ $cliente->sobrenome }}</td>
                                            <td class="text-nowrap">{{ $cliente->formatted_telefone }} /
                                                {{ $cliente->formatted_celular }}</td>
                                            <td class="text-nowrap">{{ $cliente->formatted_cpf_cnpj }}</td>
                                            <td class="text-nowrap">{{ $cliente->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
