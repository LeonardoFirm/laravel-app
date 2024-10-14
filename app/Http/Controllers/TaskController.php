<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['cliente', 'servico'])->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'cliente_id' => 'required|exists:clientes,id',
            'servico_id' => 'required|exists:servicos,id',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index');
    }

    public function iniciar($id)
    {
        $task = Task::findOrFail($id);
        $task->update(['status' => 'iniciada']);
        return redirect()->route('tasks.index');
    }

    public function avisar($id)
    {
        $task = Task::findOrFail($id);
        $task->update(['status' => 'avisar']);
        return redirect()->route('tasks.index');
    }

    public function finalizar($id)
    {
        $task = Task::findOrFail($id);
        $task->update(['status' => 'finalizada']);
        return redirect()->route('tasks.index');
    }
}
