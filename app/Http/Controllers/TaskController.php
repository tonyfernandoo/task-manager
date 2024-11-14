<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Tampilkan semua tugas milik pengguna yang sedang login
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())->get();
        return view('tasks.index', compact('tasks'));
    }

    // Tampilkan form untuk membuat tugas baru
    public function create()
    {
        return view('tasks.create');
    }

    // Simpan tugas baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('tasks.index');
    }

    // Tampilkan form untuk mengedit tugas yang dipilih
    public function edit(Task $task)
    {
        // Pastikan hanya pemilik tugas yang bisa mengedit
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    // Update tugas yang dipilih di database
    public function update(Request $request, Task $task)
    {
        // Pastikan hanya pemilik tugas yang bisa mengupdate
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $task->update($request->only(['title', 'description', 'status']));

        return redirect()->route('tasks.index');
    }

    // Hapus tugas yang dipilih dari database
    public function destroy(Task $task)
    {
        // Pastikan hanya pemilik tugas yang bisa menghapus
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index');
    }
}
