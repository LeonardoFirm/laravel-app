<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Auth\LoginController;

// Rotas de tarefas
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index')->middleware('auth');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store')->middleware('auth');
Route::post('/tasks/iniciar/{id}', [TaskController::class, 'iniciar'])->name('tasks.iniciar')->middleware('auth');
Route::post('/tasks/finalizar/{id}', [TaskController::class, 'finalizar'])->name('tasks.finalizar')->middleware('auth');

// Rotas de clientes
Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index')->middleware('auth');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/clientes/form', [ClienteController::class, 'showForm'])->name('clientes.form');
Route::get('/clientes', [ClienteController::class, 'showClientes'])->name('clientes.index')->middleware('auth');
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy')->middleware('auth');

// Rotas de serviços
Route::get('/servicos/form/{cliente_id}', [ClienteController::class, 'showServicosForm'])->name('servicos.form');
Route::post('/servicos/store/{cliente_id}', [ClienteController::class, 'storeServicos'])->name('servicos.store');

// Rota para buscar modelos
Route::get('/modelos/{marcaId}', [ClienteController::class, 'getModelos']);

//Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Exportar CSV
Route::get('clientes/exportar-csv', [ClienteController::class, 'exportarCsv'])->name('clientes.exportar-csv');

// Rota principal
Route::get('/', function () {
    return view('welcome');
})->name('home');