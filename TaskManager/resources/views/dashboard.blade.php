<x-app-layout>

    <!-- Dashboard Header -->
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800">
                    Task Manager Dashboard
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Manage and track your daily tasks
                </p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('tasks.create') }}"
                   class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700">
                    + Add New Task
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-5 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-gray-500 font-medium">Total Tasks</h3>
                    <p class="text-3xl font-bold text-indigo-600 mt-2">
                        {{ $tasks->count() }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-gray-500 font-medium">Pending Tasks</h3>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">
                        {{ $tasks->where('status', 'pending')->count() }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-gray-500 font-medium">Completed Tasks</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">
                        {{ $tasks->where('status', 'completed')->count() }}
                    </p>
                </div>

            </div>

            <!-- Task List -->
            <div class="bg-white rounded-xl shadow overflow-hidden">

                <div class="p-6 border-b">
                    <h3 class="text-xl font-semibold text-gray-800">
                        My Tasks
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        View and manage all your tasks here.
                    </p>
                </div>

                @forelse($tasks as $task)

                    <div class="p-6 border-b hover:bg-gray-50">

                        <div class="flex flex-col md:flex-row justify-between gap-4">

                            <div>
                                <h4 class="text-lg font-semibold text-gray-800">
                                    {{ $task->title }}
                                </h4>

                                <p class="text-gray-600 mt-1">
                                    {{ $task->description ?: 'No description provided.' }}
                                </p>

                                <p class="text-sm text-gray-500 mt-2">
                                    Due Date:
                                    {{ $task->due_date ?? 'Not specified' }}
                                </p>

                                <span class="inline-block mt-3 px-3 py-1 rounded-full text-sm
                                    {{ $task->status === 'completed'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </div>

                            <!-- Edit and Delete -->
                            <div class="flex items-center gap-3">

                                <a href="{{ route('tasks.edit', $task->id) }}"
                                   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                    Edit
                                </a>

                                <form action="{{ route('tasks.destroy', $task->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this task?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @empty

                    <!-- Empty Task Message -->
                    <div class="p-10 text-center">

                        <h3 class="text-lg font-semibold text-gray-700">
                            No Tasks Available
                        </h3>

                        <p class="text-gray-500 mt-2">
                            Start managing your work by adding your first task.
                        </p>

                        <a href="{{ route('tasks.create') }}"
                           class="inline-block mt-5 bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700">
                            + Add Your First Task
                        </a>

                    </div>

                @endforelse

            </div>

        </div>
    </div>

</x-app-layout>
