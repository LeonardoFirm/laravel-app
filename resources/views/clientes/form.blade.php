@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="form">
            <h3 class="info-form-cliente">Formulário de Agendamento de Serviço</h3>
            <p class="info-form-cliente">Antes de agendarmos o seu serviço, precisamos de algumas informações.</p>
            <br>
            <ul id="progressbar">
                <li class="active">Informações Pessoais</li>
                <li>Informações de Localização</li>
                <li>Confirmar</li>
            </ul>
            <div class="card p-3 mt-3 shadow-lg border-0">
                <p class="info-form-cadastro">Preencha as informações do formulário</p>
                <p class="info-form-cadastro obrigatorio">Campos obrigatórios (<span class="asterisco">*</span>)</p>
                <form action="{{ route('clientes.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <div id="step1" class="step">
                        <h4>Informações Pessoais</h4>
                        <div class="row gy-4 p-3">
                            <div class="col-lg-2 col-md-6 col-12">
                                <label for="nome"><i class="fa-solid fa-font"></i> Nome<span
                                        class="asterisco">*</span></label>
                                <input type="text" name="nome" class="form-control" placeholder="Ex: José" required
                                    autocomplete="off">
                                <div class="valid-feedback">Preenchido</div>
                                <div class="invalid-feedback">Não pode ficar vazio</div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-12">
                                <label for="sobrenome"><i class="fa-solid fa-font"></i> Sobrenome<span
                                        class="asterisco">*</span></label>
                                <input type="text" name="sobrenome" class="form-control" placeholder="Ex: da Silva"
                                    required autocomplete="off">
                                <div class="valid-feedback">Preenchido</div>
                                <div class="invalid-feedback">Não pode ficar vazio</div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-12">
                                <label for="telefone"><i class="fa-solid fa-phone"></i> Telefone<span
                                        class="asterisco">*</span></label>
                                <input type="text" name="telefone" class="form-control" placeholder="(xx) xxxx-xxxx"
                                    required autocomplete="off">
                                <div class="valid-feedback">Preenchido</div>
                                <div class="invalid-feedback">Não pode ficar vazio</div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-12">
                                <label for="celular"><i class="fa-brands fa-whatsapp"></i> WhatsApp<span
                                        class="asterisco">*</span></label>
                                <input type="text" name="celular" class="form-control" placeholder="(xx) xxxxx-xxxx"
                                    required autocomplete="off">
                                <div class="valid-feedback">Preenchido</div>
                                <div class="invalid-feedback">Não pode ficar vazio</div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-12">
                                <label for="cpf_cnpj"><i class="fa-solid fa-hashtag"></i> CPF ou CNPJ<span
                                        class="asterisco">*</span></label>
                                <input type="text" name="cpf_cnpj" class="form-control" placeholder="CPF ou CNPJ"
                                    maxlength="14" required autocomplete="off">
                                <div class="valid-feedback">Preenchido</div>
                                <div class="invalid-feedback">Não pode ficar vazio</div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck"
                                        required>
                                    <label class="form-check-label" for="invalidCheck">
                                        Concordar com os termos e condições
                                    </label>
                                    <div class="invalid-feedback">
                                        Você deve concordar antes de enviar.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-btn"><button type="button" class="btn btn-warning rounded-2 next">Próximo</button>
                        </div>
                    </div>

                    <div id="step2" class="step" style="display: none;">
                        <h4>Informações de Localização</h4>
                        <div class="row gy-4 p-3">
                            <div class="col-lg-2 col-md-6 col-12">
                                <label for="cep"><i class="fa-solid fa-search"></i> Busque o endereço pelo CEP</label>
                                <input type="text" name="cep" id="cep" class="form-control" placeholder="CEP"
                                    onblur="buscarEndereco()" required autocomplete="off">
                                <div class="valid-feedback">Preenchido</div>
                                <div class="invalid-feedback">Não pode ficar vazio</div>
                            </div>
                            <span>Encontrou algum erro? Altere os dados abaixo manualmente.</span>
                            <div class="col-12">
                                <label for="endereco"><i class="fa-solid fa-location-dot"></i> Endereço<span
                                        class="asterisco">*</span></label>
                                <input type="text" name="endereco" id="endereco" class="form-control"
                                    placeholder="Ex: Rua 123" required autocomplete="off">
                                <div class="valid-feedback">Preenchido</div>
                                <div class="invalid-feedback">Não pode ficar vazio</div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-12">
                                <label for="numero"><i class="fa-solid fa-hashtag"></i> Logradouro<span
                                        class="asterisco">*</span></label>
                                <input type="text" name="numero" id="numero" class="form-control"
                                    placeholder="Ex: 123" required autocomplete="off">
                                <div class="valid-feedback">Preenchido</div>
                                <div class="invalid-feedback">Não pode ficar vazio</div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <label for="bairro"><i class="fa-solid fa-location-dot"></i> Bairro<span
                                        class="asterisco">*</span></label>
                                <input type="text" name="bairro" id="bairro" class="form-control"
                                    placeholder="Ex: Av. Brasil" required autocomplete="off">
                                <div class="valid-feedback">Preenchido</div>
                                <div class="invalid-feedback">Não pode ficar vazio</div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-12">
                                <label for="cidade"><i class="fa-solid fa-location-dot"></i> Cidade<span
                                        class="asterisco">*</span></label>
                                <input type="text" name="cidade" id="cidade" class="form-control"
                                    placeholder="Ex: Porto Alegre" required autocomplete="off">
                                <div class="valid-feedback">Preenchido</div>
                                <div class="invalid-feedback">Não pode ficar vazio</div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-12">
                                <label for="uf"><i class="fa-solid fa-location-dot"></i> UF<span
                                        class="asterisco">*</span></label>
                                <input type="text" name="uf" id="uf" class="form-control"
                                    placeholder="Ex: RS" required autocomplete="off">
                                <div class="valid-feedback">Preenchido</div>
                                <div class="invalid-feedback">Não pode ficar vazio</div>
                            </div>
                        </div>
                        <div class="form-btn-double">
                            <button type="button" class="btn btn-warning rounded-2 previous">Voltar</button>
                            <button type="button" class="btn btn-warning rounded-2 confirm">Próximo</button>
                        </div>
                    </div>

                    <div id="step3" class="step" style="display: none;">
                        <h4>Confirmar</h4>
                        <div class="confirmation-info p-3">
                            <h5>Informações Pessoais</h5>
                            <ul>
                                <li><strong>Nome:</strong> <span id="confirm-nome"></span></li>
                                <li><strong>Sobrenome:</strong> <span id="confirm-sobrenome"></span></li>
                                <li><strong>Telefone:</strong> <span id="confirm-telefone"></span></li>
                                <li><strong>WhatsApp:</strong> <span id="confirm-celular"></span></li>
                                <li><strong>CPF ou CNPJ:</strong> <span id="confirm-cpf_cnpj"></span></li>
                            </ul>
                            <h5>Informações de Localização</h5>
                            <ul>
                                <li><strong>CEP:</strong> <span id="confirm-cep"></span></li>
                                <li><strong>Endereço:</strong> <span id="confirm-endereco"></span></li>
                                <li><strong>Logradouro:</strong> <span id="confirm-numero"></span></li>
                                <li><strong>Bairro:</strong> <span id="confirm-bairro"></span></li>
                                <li><strong>Cidade:</strong> <span id="confirm-cidade"></span></li>
                                <li><strong>UF:</strong> <span id="confirm-uf"></span></li>
                            </ul>
                        </div>
                        <div class="form-btn">
                            <button type="submit" class="btn btn-warning rounded-2">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <script>
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
                    $('#confirm-nome').text($('input[name="nome"]').val());
                    $('#confirm-sobrenome').text($('input[name="sobrenome"]').val());
                    $('#confirm-telefone').text($('input[name="telefone"]').val());
                    $('#confirm-celular').text($('input[name="celular"]').val());
                    $('#confirm-cpf_cnpj').text($('input[name="cpf_cnpj"]').val());
                    $('#confirm-cep').text($('input[name="cep"]').val());
                    $('#confirm-endereco').text($('#endereco').val());
                    $('#confirm-numero').text($('#numero').val());
                    $('#confirm-bairro').text($('#bairro').val());
                    $('#confirm-cidade').text($('#cidade').val());
                    $('#confirm-uf').text($('#uf').val());

                    $('#step2').hide();
                    $('#step3').show();
                    $('#progressbar li').eq(1).removeClass('active').addClass('completed');
                    $('#progressbar li').eq(2).addClass('active');
                }
            });
        });

        function buscarEndereco() {
            var cep = document.getElementById('cep').value.replace(/\D/g, '');
            console.log("CEP digitado:", cep);

            if (cep) {
                var validacep = /^[0-9]{8}$/;

                if (validacep.test(cep)) {
                    fetch(`https://viacep.com.br/ws/${cep}/json/`)
                        .then(response => {
                            console.log("Resposta da API:", response);
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log("Dados retornados da API:", data);
                            if (!data.erro) {
                                document.getElementById('endereco').value = data.logradouro || '';
                                document.getElementById('bairro').value = data.bairro || '';
                                document.getElementById('cidade').value = data.localidade || '';
                                document.getElementById('uf').value = data.uf || '';
                            } else {
                                alert('CEP não encontrado.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Erro ao buscar endereço. Tente novamente.');
                        });
                } else {
                    alert('Formato de CEP inválido.');
                }
            } else {
                alert('Por favor, insira um CEP.');
            }
        }

        (() => {
            'use strict'

            const forms = document.querySelectorAll('.needs-validation');

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
@endsection
