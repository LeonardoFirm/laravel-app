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

<body class="light-mode content-app">
    <div class="preloader">
        <div class="centro">
            <div class="spinner"></div>
            <div class="loading">Carregando...</div>
        </div>
    </div>
    <div class="layout has-sidebar fixed-sidebar fixed-header">
        <aside id="sidebar" class="sidebar break-point-sm has-bg-image">
            <a id="btn-collapse" class="sidebar-collapser"><i class="fa-solid fa-chevron-left fa-2xs"></i></a>
            <div class="image-wrapper">
                <img src="{{ asset('bg-sidebar.png') }}" alt="sidebar background" />
            </div>
            <div class="sidebar-layout">
                <div class="sidebar-header">
                    <div class="pro-sidebar-logo">
                        <img src="{{ asset('devpoa.png') }}" alt="Logo">
                        <strong class="nome-empresa"> Devpoa</strong>
                    </div>
                </div>
                <div class="sidebar-content">
                    <nav class="menu open-current-submenu">
                        <ul>
                            <li class="menu-header"><span> MENU </span></li>
                            @auth
                                <li class="menu-item sub-menu">
                                    <a class="link-sidebar" href="#">
                                        <span class="menu-icon">
                                            <i class="fa-solid fa-tasks"></i>
                                        </span>
                                        <span class="menu-title">Tarefas</span>
                                    </a>
                                    <div class="sub-menu-list">
                                        <ul>
                                            <li class="menu-item">
                                                <a class="link-sidebar" href="{{ route('tasks.index') }}">
                                                    <span class="menu-icon">
                                                        <i class="fa-solid fa-database"></i>
                                                    </span>
                                                    <span class="menu-title">Serviços</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="menu-item sub-menu">
                                    <a class="link-sidebar" href="#">
                                        <span class="menu-icon">
                                            <i class="fa-solid fa-users"></i>
                                        </span>
                                        <span class="menu-title">Clientes</span>
                                    </a>
                                    <div class="sub-menu-list">
                                        <ul>
                                            <li class="menu-item">
                                                <a class="link-sidebar" href="{{ route('clientes.index') }}">
                                                    <span class="menu-icon">
                                                        <i class="fa-solid fa-database"></i>
                                                    </span>
                                                    <span class="menu-title">Lista</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="menu-item sub-menu">
                                    <a class="link-sidebar" href="#">
                                        <span class="menu-icon">
                                            <i class="fa-solid fa-chart-column"></i>
                                        </span>
                                        <span class="menu-title">Administrativo</span>
                                    </a>
                                    <div class="sub-menu-list">
                                        <ul>
                                            <li class="menu-item">
                                                <a class="link-sidebar" href="{{ route('admin.dashboard') }}">
                                                    <span class="menu-icon">
                                                        <i class="fa-solid fa-database"></i>
                                                    </span>
                                                    <span class="menu-title">Fluxo</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="menu-header"><span> AJUDA </span></li>
                                <li class="menu-item sub-menu">
                                    <a class="link-sidebar" href="#">
                                        <span class="menu-icon">
                                            <i class="fa-solid fa-headset"></i>
                                        </span>
                                        <span class="menu-title">Suporte</span>
                                    </a>
                                    <div class="sub-menu-list">
                                        <ul>
                                            <li class="menu-item">
                                                <a class="link-sidebar" href="{{ route('suporte.index') }}">
                                                    <span class="menu-icon">
                                                        <i class="fa-solid fa-database"></i>
                                                    </span>
                                                    <span class="menu-title">Solicitar</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            @else
                                <li class="menu-item">
                                    <a class="link-sidebar" href="{{ route('home') }}">
                                        <span class="menu-icon">
                                            <i class="fa-solid fa-home"></i>
                                        </span>
                                        <span class="menu-title">Início</span>
                                    </a>
                                </li>
                                <li class="menu-item sub-menu">
                                    <a class="link-sidebar" href="#">
                                        <span class="menu-icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <span class="menu-title">Agendamento</span>
                                    </a>
                                    <div class="sub-menu-list">
                                        <ul>
                                            <li class="menu-item">
                                                <a href="{{ route('clientes.form') }}">
                                                    <span class="menu-icon">
                                                        <i class="fa-solid fa-edit"></i>
                                                    </span>
                                                    <span class="menu-title">Agende Aqui</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            @endauth
                        </ul>
                    </nav>
                </div>
                <div class="sidebar-footer">
                    <div class="footer-box">
                        <div>
                            <img src="{{ asset('bagual_light.png') }}" class="react-logo" alt="Logo">
                            <p class="frase-efeito-footer-logo">O seu aplicativo de agendamento online!</p>
                        </div>
                        <div style="padding: 0 10px">
                            @auth
                                <ul class="ul-task">
                                    <li class="menu-item">
                                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn-logout">
                                                <span class="menu-icon">
                                                    <i class="fa-solid fa-sign-out"></i>
                                                </span>
                                                <span class="menu-title">Sair</span>
                                            </button>
                                        </form>
                                    </li>
                                @else
                                    <li class="menu-item li-task">
                                        <a class="link-sidebar" href="{{ route('login') }}" target="_blank">
                                            <span class="menu-icon">
                                                <i class="fa-solid fa-sign-in"></i>
                                            </span>
                                            <span class="menu-title">Acessar</span>
                                        </a>
                                    </li>
                                </ul>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <div id="overlay" class="overlay"></div>
        <div class="layout">
            <main class="content">
                @yield('content')
                <div>
                    <a id="btn-toggle" href="#" class="sidebar-toggler break-point-sm">
                        <i class="ri-menu-line ri-xl"></i>
                    </a>
                </div>
                <footer class="footer">
                    <small style="margin-bottom: 20px; display: inline-block">
                        Copyright © 2024 Todos os direitos reservados. Desenvolvido por
                        <a target="_blank" href="https://devpoa.com.br/"> Devpoa </a>.
                    </small>
                    <br />
                    <div class="social-links">
                        <a href="" target="_blank">
                            <i class="fa-brands fa-whatsapp fa-lg"></i>
                        </a>
                        <a href="" target="_blank">
                            <i class="fa-brands fa-instagram fa-lg"></i>
                        </a>
                        <a href="" target="_blank">
                            <i class="fa-brands fa-facebook-f fa-lg"></i>
                        </a>
                        <a href="" target="_blank">
                            <i class="fa-brands fa-linkedin-in fa-lg"></i>
                        </a>
                    </div>
                </footer>
                <button id="theme-toggle" class="theme-toggle-btn" onclick="toggleTheme()">🌚</button>
            </main>
            <div class="overlay"></div>
        </div>
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

    <script src='https://unpkg.com/@popperjs/core@2'></script>
</body>

</html>
