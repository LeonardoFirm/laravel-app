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
                const valorField = document.getElementById('valorServico');

                const servico = servicos.find(s => s.id == servicoId);

                if (servico) {
                    valorField.value = 'Valor do serviço R$ ' + servico.valor.toFixed(2).replace('.', ',');
                } else {
                    valorField.value = '';
                }
            };

            (() => {
                'use strict'

                const forms = document.querySelectorAll('.needs-validation')

                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
            })();

            $(document).ready(function() {
                $('input[name="telefone"]').mask('(00) 0000-0000');
                $('input[name="celular"]').mask('(00) 00000-0000');
                $('input[name="cep"]').mask('00000-000');

                $('.next').on('click', function() {
                    let valid = true;
                    $('#step1 input').each(function() {
                        if (!this.checkValidity()) {
                            valid = false;
                            $(this).addClass('is-invalid');
                            $(this).removeClass('is-valid');
                        } else {
                            $(this).addClass('is-valid');
                            $(this).removeClass('is-invalid');
                        }
                    });
                    if (valid) {
                        $('#step1').hide();
                        $('#step2').show();
                        $('#progressbar li').eq(0).removeClass('active').addClass('completed');
                        $('#progressbar li').eq(1).addClass('active');
                    }
                });

                $('.previous').on('click', function() {
                    $('#step2').hide();
                    $('#step1').show();
                    $('#progressbar li').eq(1).removeClass('active');
                    $('#progressbar li').eq(0).addClass('active');
                });


                $('.confirm').on('click', function() {
                    let valid = true;
                    $('#step2 input').each(function() {
                        if (!this.checkValidity()) {
                            valid = false;
                            $(this).addClass('is-invalid');
                            $(this).removeClass('is-valid');
                        } else {
                            $(this).addClass('is-valid');
                            $(this).removeClass('is-invalid');
                        }
                    });
                    if (valid) {
                        // Preencher informações de confirmação
                        $('#confirm-marca').text($('input[name="marca"]').val());
                        $('#confirm-modelo').text($('input[name="modelo"]').val());
                        $('#confirm-placaveiculo').text($('input[name="placaveiculo"]').val());
                        $('#confirm-servico_id').text($('input[name="servico_id"]').val());
                        $('#confirm-valorServico').text($('input[name="valorServico"]').val());

                        $('#step2').hide();
                        $('#step3').show();
                        $('#progressbar li').eq(1).removeClass('active').addClass('completed');
                        $('#progressbar li').eq(2).addClass('active');
                    }
                });
            });
        </script>

        <section class="form">
            <h3>Detalhes do Veículo e Serviço</h3>
            <div class="card p-3 rounded-3 mt-3 shadow-lg border-0">
                <p class="info-form-cadastro">Preencha as informações do formulário</p>
                <br>
                <ul id="progressbar">
                    <li class="active">Informações do Veículo</li>
                    <li>Informações de Seriço</li>
                    <li>Confirmar</li>
                </ul>
                <form action="{{ route('servicos.store', $cliente_id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <div id="step1" class="step">
                        <div class="row gy-4 p-3">
                            <div class="col-lg-4 col-md-6 col-12 mb-0">
                                <label for="marca">Marca</label>
                                <select id="marca" name="marca" class="form-select"
                                    onchange="fetchModelos(this.value)" required autocomplete="off">
                                    <option value="">Selecione uma marca</option>
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->id }}">{{ $marca->nome }}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">
                                    Preenchido
                                </div>
                                <div class="invalid-feedback">
                                    Não pode ficar vázio
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12 mb-0">
                                <label for="modelo">Modelo</label>
                                <select id="modelo" name="modelo" class="form-select" required autocomplete="off">
                                    <option value="">Selecione uma marca antes</option>
                                </select>
                                <div class="valid-feedback">
                                    Preenchido
                                </div>
                                <div class="invalid-feedback">
                                    Não pode ficar vázio
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12 mb-0">
                                <label for="placaVeiculo">Placa do Veículo</label>
                                <input type="text" id="placaVeiculo" name="placaVeiculo"
                                    class="form-control placa-veiculo" maxlength="7" placeholder="LLLNLNN" required
                                    autocomplete="off">
                                <div class="valid-feedback">
                                    Preenchido
                                </div>
                                <div class="invalid-feedback">
                                    Não pode ficar vázio
                                </div>
                            </div>
                            <div class="form-btn"><button type="button"
                                    class="btn btn-warning rounded-2 next">Próximo</button>
                            </div>
                        </div>
                    </div>

                    <div id="step2" class="step" style="display: none;">
                        <div class="row gy-4 p-3">
                            <div class="col-lg-4 col-md-6 col-12 mb-0">
                                <label for="servico">Serviço</label>
                                <select id="servico" name="servico_id" class="form-select"
                                    onchange="showValorServico(this.value)" required autocomplete="off">
                                    <option value="">Selecione um serviço</option>
                                    @foreach ($servicos as $servico)
                                        <option value="{{ $servico->id }}">{{ $servico->nome }}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">
                                    Preenchido
                                </div>
                                <div class="invalid-feedback">
                                    Não pode ficar vázio
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12 mb-0">
                                <label for="valorServico"></label>
                                <input type="text" id="valorServico" name="valorServico" class="form-control border-0"
                                    readonly style="pointer-events: none; font-weight: bold; font-size: 1.25rem;" required
                                    autocomplete="off">
                                <div class="valid-feedback">
                                    Preenchido
                                </div>
                                <div class="invalid-feedback">
                                    Não pode ficar vázio
                                </div>
                            </div>
                            <div class="form-btn-double">
                                <button type="button" class="btn btn-warning rounded-2 previous">Voltar</button>
                                <button type="button" class="btn btn-warning rounded-2 confirm">Próximo</button>
                            </div>
                        </div>
                    </div>

                    <div id="step3" class="step" style="display: none;">
                        <div class="row gy-4 p-3">
                            <h4>Confirmar</h4>
                            <div class="confirmation-info p-3">
                                <h5>Informações do Veículo</h5>
                                <ul>
                                    <li><strong>Marca:</strong> <span id="confirm-marca"></span></li>
                                    <li><strong>Modelo:</strong> <span id="confirm-modelo"></span></li>
                                    <li><strong>Placa:</strong> <span id="confirm-placaveiculo"></span></li>
                                </ul>
                                <h5>Informações de Serviço</h5>
                                <ul>
                                    <li><strong>Serviço:</strong> <span id="confirm-servico_id"></span></li>
                                    <li><strong>Valor do Serviço:</strong> <span id="confirm-valorServico"></span></li>
                                </ul>
                            </div>
                            <div class="form-btn">
                                <button type="submit" class="btn btn-warning rounded-2">Enviar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
