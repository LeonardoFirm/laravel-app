@extends('layouts.app')

@section('content')
    <section class="container-fluid">
        <h3>Dashboard</h3>

        <div class="row mt-3">

            <div class="col-lg-3 col-6 col-12">
                <ul class="ul-task card shadow-lg p-3 rounded-0 border-0">
                    <h4>Não Iniciadas <span
                            class="badge bg-secondary">{{ $tasks->filter(function ($task) {
                                    return !in_array($task->status, ['iniciada', 'finalizada']);
                                })->count() }}</span>
                    </h4>
                    @foreach ($tasks as $task)
                        @if ($task->status !== 'iniciada' && $task->status !== 'finalizada' && $task->status !== 'avisar')
                            <li id="task-{{ $task->id }}" class='text-pedido li-task'>
                                {{ $task->title }} <br><br>
                                <form action="{{ route('tasks.iniciar', $task->id) }}" method="POST"
                                    style="display:inline; padding: 0; width: 0;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-dark rounded-0 float-end"> <i
                                            class="fa-solid fa-spray-can-sparkles"></i></button>
                                </form>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-3 col-6 col-12">
                <ul class="ul-task card shadow-lg p-3 rounded-0 border-0">
                    <h4>Em Execução <span
                            class="badge bg-secondary">{{ $tasks->where('status', 'iniciada')->count() }}</span></h4>
                    @foreach ($tasks as $task)
                        @if ($task->status === 'iniciada')
                            <li id="task-{{ $task->id }}" class="iniciar li-task">
                                {{ $task->title }}<br>
                                <span class="iniciado"><b><i class="fa-solid fa-soap"></i> Executando
                                        Serviço</b></span><br><br>
                                <span>Valor do Serviço: R$
                                    {{ $task->servico ? number_format($task->servico->valor, 2, ',', '.') : 'Não disponível' }}</span>
                                <form action="{{ route('tasks.avisar', $task->id) }}" method="POST"
                                    style="display:inline; padding: 0; width: 0;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-dark rounded-0 float-end"> <i
                                            class="fa-solid fa-hand-sparkles"></i></button>
                                </form>
                            </li>
                        @endif
                    @endforeach
                </ul>

            </div>
            <div class="col-lg-3 col-6 col-12">
                <ul class="ul-task card shadow-lg p-3 rounded-0 border-0">
                    <h4>Avisar Cliente <span
                            class="badge bg-secondary">{{ $tasks->where('status', 'avisar')->count() }}</span></h4>
                    @foreach ($tasks as $task)
                        @if ($task->status === 'avisar')
                            <li id="task-{{ $task->id }}" class="avisar li-task">
                                {{ $task->title }} <br><br>
                                @php
                                    $message = urlencode(
                                        "Olá {$task->cliente->nome}, tudo bem? Passando para avisar que o serviço, {$task->servico->nome}, foi finalizado!",
                                    );
                                @endphp
                                <a href="#" class="btn btn-sm btn-dark btn-dash rounded-0 float-end whatsapp-link"
                                    target="_blank" data-celular="{{ $task->cliente->celular }}"
                                    data-message="{{ $message }}">
                                    <i class="fa-brands fa-whatsapp"></i> Avisar <b>{{ $task->cliente->nome }}</b>
                                </a>
                                <form action="{{ route('tasks.finalizar', $task->id) }}" method="POST"
                                    style="display:inline; padding: 0; width: 0;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-dark rounded-0 float-end me-1"> <i
                                            class="fa-solid fa-check-double"></i></button>
                                </form>
                            </li>
                        @endif
                    @endforeach
                </ul>

            </div>

            <div class="col-lg-3 col-6 col-12">
                <ul class="ul-task card shadow-lg p-3 rounded-0 border-0">
                    <h4>Finalizadas <span
                            class="badge bg-secondary">{{ $tasks->where('status', 'finalizada')->count() }}</span></h4>
                    @foreach ($tasks as $task)
                        @if ($task->status === 'finalizada')
                            <li id="task-{{ $task->id }}" class="finalizar li-task">
                                {{ $task->title }}
                                <br>
                                <span><b>Finalizado!</b></span>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

        </div>
    </section>

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
