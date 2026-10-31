<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Task Manager</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 font-sans text-slate-900">
    <main class="mx-auto max-w-4xl px-5 py-12 sm:px-8">
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <h1 class="text-3xl font-bold tracking-tight">Task Manager</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="rounded-lg bg-slate-800 px-4 py-2 font-semibold text-white transition hover:bg-slate-700">Logout</button>
            </form>
        </div>

        @if(session('success'))
            <div class="mb-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800" role="status">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('tasks.store') }}" class="mb-6 flex flex-col gap-3 sm:flex-row">
            @csrf
            <label for="title" class="sr-only">Enter New Task</label>
            <input id="title" name="title" type="text" value="{{ old('title') }}" placeholder="Enter your new task..." maxlength="255" required class="min-w-0 flex-1 rounded-lg border-slate-300 px-4 py-3 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            <button type="submit" class="rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white transition hover:bg-blue-700">Add Task</button>
        </form>
        @error('title')
            <p class="-mt-3 mb-5 text-sm text-red-600">{{ $message }}</p>
        @enderror

        <section aria-label="Your tasks" class="space-y-3">
            @forelse($tasks as $task)
                <article class="rounded-lg border border-sky-200 bg-white p-4 shadow-sm">
                    @if(isset($editingTask) && $editingTask->is($task))
                        <form method="POST" action="{{ route('tasks.update', $task) }}" class="flex flex-col gap-3 sm:flex-row">
                            @csrf
                            @method('PUT')
                            <label for="edit-title-{{ $task->id }}" class="sr-only">Edit task</label>
                            <input id="edit-title-{{ $task->id }}" name="title" type="text" value="{{ old('title', $task->title) }}" maxlength="255" required class="min-w-0 flex-1 rounded-lg border-slate-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <button type="submit" class="rounded-lg bg-blue-600 px-5 py-2 font-semibold text-white transition hover:bg-blue-700">Update</button>
                            <a href="{{ route('dashboard') }}" class="rounded-lg bg-slate-100 px-5 py-2 text-center font-semibold text-slate-700 transition hover:bg-slate-200">Cancel</a>
                        </form>
                    @else
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <p class="break-words text-lg font-medium">{{ $task->title }}</p>
                            <div class="flex shrink-0 gap-3">
                                <a href="{{ route('tasks.edit', $task) }}" class="rounded-lg bg-slate-100 px-5 py-2 font-semibold text-slate-800 transition hover:bg-slate-200">Edit</a>
                                <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-lg bg-rose-100 px-5 py-2 font-semibold text-rose-800 transition hover:bg-rose-200">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </article>
            @empty
                <div class="rounded-lg border border-dashed border-slate-300 bg-white px-6 py-10 text-center text-slate-500">No tasks yet. Add your first task above.</div>
            @endforelse
        </section>
    </main>
</body>
</html>
