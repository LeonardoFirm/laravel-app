@extends('layouts.start')

@section('content')
    <section class="content-start-card">
        <div class="content-welcome">
            <h4>Seja bem-vindo(a) ao</h4>
            <img src="{{ asset('bagual_light.png') }}" class="logo-bagual" alt="Bagual">
            <p>O seu aplicativo de agendamento online!</p>
            <div class="content-btn">
                <a href="{{ route('clientes.form') }}"><i class="fa-solid fa-edit"></i>&NonBreakingSpace;
                    Agendar</a>
            </div>
        </div>
        <footer class="creditos">
            <p>Copyright &copy; 2024 - Desenvolvido por <a href="https://devpoa.com.br/" target="_blank">Devpoa</a>.</p>
        </footer>
    </section>
@endsection
