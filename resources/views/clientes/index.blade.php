@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h2>Clientes Cadastrados</h2>
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
        <div class="row">
            @if ($clientes->isNotEmpty())
                @foreach ($clientes as $cliente)
                    <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                        <div class="card p-3 rounded-0 mt-3 shadow-lg border-0">
                            <h4>{{ $cliente->nome }} {{ $cliente->sobrenome }}</h4>
                            <span class="info-cliente">Telefone: {{ $cliente->formatted_telefone }}</span>
                            <span class="info-cliente">Celular: {{ $cliente->formatted_celular }}</span>
                            <span class="info-cliente">CPF/CNPJ: {{ $cliente->formatted_cpf_cnpj }}</span>
                            <span class="info-cliente">Endereço: {{ $cliente->endereco }}, {{ $cliente->numero }},
                                {{ $cliente->bairro }}, {{ $cliente->cidade }}, {{ $cliente->uf }},
                                {{ $cliente->cep }}</span>
                            <br>
                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-delete rounded-0"> <i
                                        class="fa-solid fa-trash-can"></i></button>
                            </form>

                            @php
                                $hour = now()->hour;
                                if ($hour >= 5 && $hour < 12) {
                                    $greeting = 'Bom dia';
                                } elseif ($hour >= 12 && $hour < 18) {
                                    $greeting = 'Boa tarde';
                                } else {
                                    $greeting = 'Boa noite';
                                }
                                $message = urlencode(
                                    $greeting . ', ' . $cliente->nome . '! Tudo bem? Aqui é Nome da Empresa.',
                                );
                            @endphp

                            <a href="#" class="btn btn-sm btn-outline-primary rounded-0 float-end whatsapp-link"
                                target="_blank" data-celular="{{ $cliente->celular }}" data-message="{{ $message }}">
                                <i class="fa-brands fa-whatsapp"></i> Chamar <b>{{ $cliente->nome }}</b>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Nenhum cliente cadastrado.</p>
            @endif
        </div>

        <section class="content-excel">
            <a href="{{ route('clientes.exportar-csv') }}" class="btn btn-excel export-csv rounded-0"><i
                    class="fa-solid fa-file-excel"></i> Baixar CSV</a>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const whatsappLinks = document.querySelectorAll('.whatsapp-link');

            whatsappLinks.forEach(link => {
                const celular = link.getAttribute('data-celular');
                const message = link.getAttribute('data-message');
                const isMobile = /iPhone|Android|iPad|iPod/i.test(navigator.userAgent);

                let whatsappUrl;

                if (isMobile) {
                    whatsappUrl = `https://wa.me/55${celular}?text=${message}`;
                } else {
                    whatsappUrl = `https://web.whatsapp.com/send?phone=55${celular}&text=${message}`;
                }

                link.setAttribute('href', whatsappUrl);
            });
        });
    </script>
@endsection
