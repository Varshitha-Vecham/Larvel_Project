<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // READ: Display all tasks belonging to the logged-in user
    public function index()
{
    $tasks = Task::where('user_id', Auth::id())->latest()->get();

    return view('dashboard', compact('tasks'));
}
    // Show Create Task page
    public function create()
    {
        return view('Tasks.create');
    }

    // CREATE: Save a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed',
            'due_date' => 'nullable|date',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('dashboard')
                         ->with('success', 'Task added successfully!');
    }

    // SHOW: Display a particular task
    public function show(Task $task)
    {
        $task = Task::where('user_id', Auth::id())
                    ->findOrFail($task->id);

        return redirect()->route('tasks.edit', $task->id);
    }

    // Show Edit Task page
    public function edit(Task $task)
    {
        $task = Task::where('user_id', Auth::id())
                    ->findOrFail($task->id);

        return view('Tasks.edit', compact('task'));
    }

    // UPDATE: Update an existing task
    public function update(Request $request, Task $task)
    {
        $task = Task::where('user_id', Auth::id())
                    ->findOrFail($task->id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed',
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->only([
            'title',
            'description',
            'status',
            'due_date',
        ]));

        return redirect()->route('dashboard')
                         ->with('success', 'Task updated successfully!');
    }

    // DELETE: Delete a task
    public function destroy(Task $task)
    {
        $task = Task::where('user_id', Auth::id())
                    ->findOrFail($task->id);

        $task->delete();

        return redirect()->route('dashboard')
                         ->with('success', 'Task deleted successfully!');
    }
}
