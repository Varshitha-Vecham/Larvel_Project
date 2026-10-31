<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // Get all tasks of logged-in user
   public function index(Request $request)
{
    $tasks = $request->user()->tasks()->latest()->get();

    return response()->json([
        'success' => true,
        'tasks' => $tasks
    ], 200);
}
    // Create a new task
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pending,completed',
            'due_date' => 'nullable|date',
        ]);

        $task = $request->user()->tasks()->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Task created successfully',
            'task' => $task
        ], 201);
    }

    // Get a single task
    public function show(Request $request, $id)
    {
        $task = $request->user()->tasks()->findOrFail($id);

        return response()->json([
            'success' => true,
            'task' => $task
        ], 200);
    }

    // Update a task
    public function update(Request $request, $id)
    {
        $task = $request->user()->tasks()->findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|in:pending,completed',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully',
            'task' => $task
        ], 200);
    }

    // Delete a task
    public function destroy(Request $request, $id)
    {
        $task = $request->user()->tasks()->findOrFail($id);

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully'
        ], 200);
    }
}