<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bagual - Agendamento online</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite(['resources/sass/components/_preloader.scss'])
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css'>
    <link rel='stylesheet' href='https://unpkg.com/css-pro-layout@1.1.0/dist/css/css-pro-layout.css'>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/f22dcab6fe.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>

<body class="light-mode">
    <div class="preloader">
        <div class="centro">
            <div class="spinner"></div>
            <div class="loading">Carregando...</div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="form-login">
            <div class="card p-5 shadow-lg border-0">
                <img src="{{ asset('bagual_light.png') }}" class="react-logo" alt="Logo">
                <h1 class="titulo-form-login">Acessar Sistema</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                            placeholder="Seu E-mail" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" name="password" class="form-control" placeholder="Sua Senha" required
                            autocomplete="off">
                    </div>
                    <div class="form-btn">
                        <button type="submit" class="btn btn-warning rounded-0 mt-4">Entrar</button>
                    </div>
                </form>
            </div>
            <p class="links-importantes-login">
                <a href="#" class="link-form-login">Termos de serviço</a> |
                <a href="#" class="link-form-login">Política de Privacidade</a> |
                <a href="#" class="link-form-login">LGPD</a>
            </p>
        </div>
        <button id="theme-toggle" class="theme-toggle-btn" onclick="toggleTheme()">🌚</button>
    </div>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        function toggleTheme() {
            const body = document.body;
            body.classList.toggle('dark-mode');
            body.classList.toggle('light-mode');

            const theme = body.classList.contains('dark-mode') ? 'dark' : 'light';
            localStorage.setItem('theme', theme);

            const themeToggleButton = document.getElementById('theme-toggle');
            themeToggleButton.textContent = body.classList.contains('dark-mode') ? '💡' : '🌚';
        }

        window.addEventListener('load', function() {
            const preloader = document.querySelector('.preloader');
            setTimeout(function() {
                preloader.classList.add('hidden');
            }, 500);

            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                document.body.classList.remove('light-mode', 'dark-mode');
                document.body.classList.add(savedTheme === 'dark' ? 'dark-mode' :
                    'light-mode');

                const themeToggleButton = document.getElementById('theme-toggle');
                themeToggleButton.textContent = savedTheme === 'dark' ? '💡' : '🌚';
            }
        });
    </script>
</body>

</html>
