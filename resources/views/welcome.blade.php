@extends('layouts.app')

@section('content')
    <section class="container-fluid">
        <div class="content-welcome">
            <h1>Olá, Seja Bem-vindo!</h1><br>
            <h4>Descubra o Previna Studio Automotivo</h4>
            <p class="paragrafo-welcome">
                Localizado no coração de Porto Alegre, o Previna Studio Automotivo é o seu destino para serviços de estética
                automotiva premium. <strong>Nosso compromisso</strong> é oferecer um cuidado excepcional para o seu veículo,
                focando em cada
                detalhe para garantir sua total satisfação.</p>

            <p>
                Desde <strong>polimentos de alta performance</strong> e <strong>vitrificação de pintura</strong> até
                cuidados
                internos e externos, nossos
                especialistas utilizam apenas produtos de <strong>qualidade superior e técnicas inovadoras</strong>.
                Transforme
                a aparência do
                seu carro e proteja seu investimento com o que há de melhor no mercado.
            </p>

            <p>
                <strong>Venha nos visitar</strong> e descubra como podemos revitalizar seu veículo, proporcionando um brilho
                duradouro e um
                acabamento impecável. No Previna Studio Automotivo, cada carro é tratado com carinho e excelência!
            </p>

            <img src="{{ asset('logo-welcome.jpeg') }}" class="img-fluid shadow-lg logo-welcome" alt="Logo">
        </div>
    </section>
@endsection
