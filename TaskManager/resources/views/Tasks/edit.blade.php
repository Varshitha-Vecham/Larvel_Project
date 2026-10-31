<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Edit Task
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6">

        <div class="bg-white p-6 rounded-lg shadow">

            <form method="POST"
                  action="{{ route('tasks.update', $task->id) }}">

                @csrf
                @method('PUT')

                <label>Task Title</label>

                <input type="text"
                       name="title"
                       value="{{ old('title', $task->title) }}"
                       class="w-full border p-2 rounded mb-4"
                       required>

                <label>Description</label>

                <textarea name="description"
                          class="w-full border p-2 rounded mb-4">{{ old('description', $task->description) }}</textarea>

                <label>Status</label>

                <select name="status"
                        class="w-full border p-2 rounded mb-4">

                    <option value="pending"
                        {{ $task->status == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="completed"
                        {{ $task->status == 'completed' ? 'selected' : '' }}>
                        Completed
                    </option>

                </select>

                <label>Due Date</label>

                <input type="date"
                       name="due_date"
                       value="{{ $task->due_date }}"
                       class="w-full border p-2 rounded mb-4">

                <button type="submit"
                        class="bg-blue-600 text-white px-5 py-2 rounded">
                    Update Task
                </button>

                <a href="{{ route('dashboard') }}">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</x-app-layout>