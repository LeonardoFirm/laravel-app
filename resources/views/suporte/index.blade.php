@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h2>Suporte</h2>
        <br>
        <section class="card shadow-lg p-5 rounded-0 border-0">
            @php
                $nome = 'Devpoa';
                $celular = '51997421833';
                $hour = now()->hour;
                if ($hour >= 5 && $hour < 12) {
                    $greeting = 'Bom dia';
                } elseif ($hour >= 12 && $hour < 18) {
                    $greeting = 'Boa tarde';
                } else {
                    $greeting = 'Boa noite';
                }
                $message = urlencode($greeting . ', ' . $nome . '! Tudo bem? Gostaria de sua ajuda no sistema.');
            @endphp

            <p>Precisando de ajuda com o sistema? Clique no botão abaixo e solicite suporte.</p>

            <a id="whatsapp-link" href="#" class="btn btn-sm btn-outline-primary rounded-0 float-end" target="_blank">
                <i class="fa-brands fa-whatsapp"></i> Chamar <b>{{ $nome }}</b>
            </a>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const celular = '{{ $celular }}';
            const message = '{{ $message }}';
            const isMobile = /iPhone|Android|iPad|iPod/i.test(navigator.userAgent);

            let whatsappLink;

            if (isMobile) {
                whatsappLink = `https://wa.me/55${celular}?text=${message}`;
            } else {
                whatsappLink = `https://web.whatsapp.com/send?phone=55${celular}&text=${message}`;
            }

            document.getElementById('whatsapp-link').setAttribute('href', whatsappLink);
        });
    </script>
@endsection
