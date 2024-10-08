@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <script>
            function fetchModelos(marcaId) {
                const modeloSelect = document.getElementById('modelo');
                modeloSelect.innerHTML = '<option value="">Carregando...</option>';

                if (marcaId) {
                    fetch(`/modelos/${marcaId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            modeloSelect.innerHTML = '';

                            data.forEach(modelo => {
                                const option = document.createElement('option');
                                option.value = modelo.id;
                                option.textContent = modelo.nome;
                                modeloSelect.appendChild(option);
                            });

                            if (data.length === 0) {
                                modeloSelect.innerHTML = '<option value="">Nenhum modelo encontrado</option>';
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching modelos:', error);
                            modeloSelect.innerHTML = '<option value="">Erro ao carregar modelos</option>';
                        });
                } else {
                    modeloSelect.innerHTML = '<option value="">Selecione uma marca primeiro</option>';
                }
            }

            function showValorServico(servicoId) {
                const servicos = @json($servicos);

                const servico = servicos.find(s => s.id == servicoId);
                const valorField = document.getElementById('valorServico');

                if (servico) {
                    valorField.value = servico.valor.toFixed(2);
                } else {
                    valorField.value = '';
                }
            }
        </script>

        <section class="form">
            <h3>Detalhes do Veículo e Serviço</h3>
            <div class="card p-5 w-100 rounded-0 mt-3 shadow-lg border-0">
                <form action="{{ route('servicos.store', $cliente_id) }}" method="POST">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-lg-3 col-md-6 col-12 mb-0">
                            <label for="marca">Marca</label>
                            <select id="marca" name="marca" class="form-select" onchange="fetchModelos(this.value)">
                                <option value="">Selecione uma marca</option>
                                @foreach ($marcas as $marca)
                                    <option value="{{ $marca->id }}">{{ $marca->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-0">
                            <label for="modelo">Modelo</label>
                            <select id="modelo" name="modelo" class="form-select">
                                <option value="">Selecione uma marca primeiro</option>
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-0">
                            <label for="placaVeiculo">Valor do Serviço</label>
                            <input type="text" id="placaVeiculo" name="placaVeiculo" class="form-control" />
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-0">
                            <label for="servico">Serviço:/label>
                                <select id="servico" name="servico_id" class="form-select"
                                    onchange="showValorServico(this.value)">
                                    <option value="">Selecione um serviço</option>
                                    @foreach ($servicos as $servico)
                                        <option value="{{ $servico->id }}">{{ $servico->nome }}</option>
                                    @endforeach
                                </select>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-0">
                            <label for="valorServico">Valor do Serviço</label>
                            <input type="text" id="valorServico" name="valorServico" class="form-control" readonly />
                        </div>
                    </div>
                    <div class="form-btn"><button type="submit" class="btn btn-warning mt-4 rounded-0">Enviar</button>
                    </div>
                </form>
            </div>
        </section>

    </div>
@endsection
