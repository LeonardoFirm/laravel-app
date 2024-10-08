@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h5>Dashboard</h5>

        {{-- <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Nova tarefa" required>
        <button type="submit">Adicionar</button>
    </form> --}}

        <h4>Não Iniciadas</h4>
        <ul>
            @foreach ($tasks as $task)
                @if ($task->status !== 'iniciada' && $task->status !== 'finalizada')
                    <li id="task-{{ $task->id }}">
                        {{ $task->title }}
                        <br>
                        <form action="{{ route('tasks.iniciar', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-success rounded-0">Iniciar Serviço <i
                                    class="fa-solid fa-spray-can-sparkles"></i></button>
                        </form>
                    </li>
                @endif
            @endforeach
        </ul>

        <h4>Em Execução</h4>
        <ul>
            @foreach ($tasks as $task)
                @if ($task->status === 'iniciada')
                    <li id="task-{{ $task->id }}" class="iniciar">
                        {{ $task->title }}<br>
                        <span class="iniciado"><b><i class="fa-solid fa-soap"></i> Executando Serviço</b></span><br><br>
                        <span>Valor do Serviço: R$
                            {{ $task->servico ? number_format($task->servico->valor, 2, ',', '.') : 'Não disponível' }}</span><br><br>
                        <form action="{{ route('tasks.avisar', $task->id) }}" method="POST"
                            style="display:inline; padding: 0; width: 0; margin-top: 20px">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-0">Avisar Cliente <i
                                    class="fa-solid fa-hand-sparkles"></i></button>
                        </form>
                    </li>
                @endif
            @endforeach
        </ul>


        <h4>Avisar Cliente</h4>
        <ul>
            @foreach ($tasks as $task)
                @if ($task->status === 'avisar')
                    <li id="task-{{ $task->id }}" class="finalizar">
                        {{ $task->title }}
                        <br>
                        <span><b>Aguardando contato...</b></span>
                        <a href="https://wa.me/55{{ $task->cliente->celular }}?text=Olá {{ $task->cliente->nome }}, tudo bem? Passando para avisa que o serviço, {{ $task->servico->nome }}, foi finalizado!"
                            class="btn btn-sm btn-outline-dark rounded-0" target="_blank">
                            <i class="fa-brands fa-whatsapp"></i> Avisar <b>{{ $task->cliente->nome }}</b>
                        </a>
                        <form action="{{ route('tasks.finalizar', $task->id) }}" method="POST"
                            style="display:inline; padding: 0; width: 0; margin-top: 20px">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-0">Feito! <i
                                    class="fa-solid fa-check-double"></i></button>
                        </form>
                    </li>
                @endif
            @endforeach
        </ul>

        <h4>Finalizadas</h4>
        <ul>
            @foreach ($tasks as $task)
                @if ($task->status === 'finalizada')
                    <li id="task-{{ $task->id }}" class="finalizar">
                        {{ $task->title }}
                        <br>
                        <span><b>Finalizado!</b></span>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endsection
