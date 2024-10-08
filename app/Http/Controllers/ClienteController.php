<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Servico;
use App\Models\Task;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function showForm()
    {
        return view('clientes.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'sobrenome' => 'required',
            'telefone' => 'required',
            'celular' => 'required',
            'cpf_cnpj' => 'required',
            'endereco' => 'required',
            'bairro' => 'required',
            'numero' => 'required|integer',
            'cep' => 'required',
        ]);

        $cliente = Cliente::create($request->all());
        return redirect()->route('servicos.form', ['cliente_id' => $cliente->id]);
    }

    public function showClientes()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function showServicosForm($cliente_id)
    {
        $marcas = Marca::all();
        $servicos = Servico::all();

        return view('servicos.form', compact('cliente_id', 'marcas', 'servicos'));
    }

    public function storeServicos(Request $request, $cliente_id)
    {
        $request->validate([
            'modelo' => 'required|exists:modelos,id',
            'servico_id' => 'required|exists:servicos,id',
        ]);

        $cliente = Cliente::find($cliente_id);
        $modelo = Modelo::find($request->modelo);
        $servico = Servico::find($request->servico_id);

        if (!$cliente || !$modelo || !$servico) {
            return redirect()->back()->withErrors('Erro ao recuperar informações do cliente, modelo ou serviço.');
        }

        Task::create([
            'title' => "{$cliente->nome} {$cliente->sobrenome} - Modelo: {$modelo->nome} - Serviço: {$servico->nome}",
            'cliente_id' => $cliente->id,
            'servico_id' => $servico->id,
            'status' => 'não iniciada'
        ]);

        return redirect()->route(Auth::check() ? 'tasks.index' : 'home');
    }

    public function getModelos($marcaId)
    {
        $modelos = Modelo::where('marca_id', $marcaId)->get();
        return response()->json($modelos);
    }

    public function showTasks()
    {
        $tasks = Task::with('servico')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if ($cliente) {
            $cliente->delete();
            return redirect()->route('clientes.index')->with('success', 'Cliente deletado com sucesso.');
        }

        return redirect()->route('clientes.index')->withErrors('Cliente não encontrado.');
    }

    public function exportarCsv()
{
    $clientes = Cliente::all();
    $fileName = 'clientes.csv';

    // Definindo o cabeçalho para download do CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    header('Pragma: no-cache');
    header('Expires: 0');

    $output = fopen('php://output', 'w');

    fputcsv($output, ['Nome', 'Sobrenome', 'Telefone', 'Celular', 'CPF/CNPJ', 'Endereco', 'Numero', 'Bairro', 'cep']);

    foreach ($clientes as $cliente) {
        fputcsv($output, [
            $cliente->nome,
            $cliente->sobrenome,
            $cliente->formatted_telefone,
            $cliente->formatted_celular,
            $cliente->formatted_cpf_cnpj,
            $cliente->endereco,
            $cliente->numero,
            $cliente->bairro,
            $cliente->cep
        ]);
    }

    fclose($output);
    exit;
}
}
