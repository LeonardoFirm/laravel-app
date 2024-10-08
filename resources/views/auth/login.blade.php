@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="form-login">
            <div class="card p-5 rounded-0 shadow-lg border-0">
                <h1>Acessar Sistema</h1>

                <!-- Exibir mensagem de erro de login -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-btn">
                        <button type="submit" class="btn btn-warning mt-4">Entrar</button>
                    </div>
                </form>
            </div>
            <p class="links-importantes-login"><a href="#">Termos de serviço</a> | <a href="#">Política de
                    Privacidade</a></p>
        </section>
    </div>
@endsection
