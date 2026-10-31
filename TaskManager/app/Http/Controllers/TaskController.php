<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // READ: Display all tasks belonging to the logged-in user
    public function index()
    {
        $tasks = $this->currentUser()->tasks()->latest()->get();

        return view('dashboard', compact('tasks'));
    }

    // CREATE: Save a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Task added successfully!');
    }

    public function edit(Task $task)
    {
        $task = $this->currentUser()->tasks()->findOrFail($task->id);
        $tasks = $this->currentUser()->tasks()->latest()->get();

        return view('dashboard', ['tasks' => $tasks, 'editingTask' => $task]);
    }

    // UPDATE: Update an existing task
    public function update(Request $request, Task $task)
    {
        $task = $this->currentUser()->tasks()->findOrFail($task->id);

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task->update(['title' => $request->title]);

        return redirect()->route('dashboard')
            ->with('success', 'Task updated successfully!');
    }

    // DELETE: Delete a task
    public function destroy(Task $task)
    {
        $task = $this->currentUser()->tasks()->findOrFail($task->id);

        $task->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Task deleted successfully!');
    }

    /**
     * Return the authenticated application user with its concrete model type.
     */
    private function currentUser(): User
    {
        $user = Auth::user();

        abort_unless($user instanceof User, 403);

        return $user;
    }
}
