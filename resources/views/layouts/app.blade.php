<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nome do Aplicativo Web</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMw2U7gQ8oG1gI2c1nPjAz3Q4g51g5xL8g1vG3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f22dcab6fe.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
        <nav class="sidebar">
            <img src="{{ asset('logo.webp') }}" alt="Logo">
            <ul>
                @auth
                    <li><a href="{{ route('tasks.index') }}"><i class="fa-solid fa-tasks"></i>&NonBreakingSpace; Tarefas</a>
                    </li>
                    <li><a href="{{ route('clientes.index') }}"><i class="fa-solid fa-users"></i>&NonBreakingSpace;
                            Clientes</a></li>
                @else
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i>&NonBreakingSpace; Início</a></li>
                    <li><a href="{{ route('clientes.form') }}"><i class="fa-solid fa-edit"></i>&NonBreakingSpace;
                            Agendar</a></li>
                @endauth
            </ul>
            <ul class="bottom-item">
                @auth
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-link" style="color: inherit; text-decoration: none;">
                                <i class="fa-solid fa-right-to-bracket"></i>&NonBreakingSpace; Sair
                            </button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}"><i class="fa-solid fa-user-lock"></i>&NonBreakingSpace; Acessar</a>
                    </li>
                @endauth
            </ul>
        </nav>
        <div class="container">
            @yield('content')
        </div>
    </div>
</body>

</html>
