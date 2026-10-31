
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Create New Task
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow rounded-lg">

                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-2">Task Title</label>
                        <input type="text" name="title"
                            value="{{ old('title') }}"
                            class="w-full border-gray-300 rounded-lg"
                            required>
                        @error('title')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Description</label>
                        <textarea name="description"
                            class="w-full border-gray-300 rounded-lg">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Status</label>
                        <select name="status"
                            class="w-full border-gray-300 rounded-lg" required>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Due Date</label>
                        <input type="date" name="due_date"
                            value="{{ old('due_date') }}"
                            class="w-full border-gray-300 rounded-lg">
                    </div>

                    <button type="submit"
                        class="bg-indigo-600 text-white px-5 py-2 rounded-lg">
                        Save Task
                    </button>

                    <a href="{{ route('dashboard') }}"
                        class="ml-3 text-gray-600">
                        Cancel
                    </a>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
