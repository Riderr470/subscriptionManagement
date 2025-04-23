<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Tasks') }}
            </h2>
            <a href="{{ route('tasks.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                {{ __('Create New Task') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Display Success Messages --}}
            @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 rounded">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <ul class="space-y-4">
                        @forelse ($tasks as $task)
                        <li class="border-b dark:border-gray-700 pb-2 flex justify-between items-center">
                            <div>
                                <span class="font-semibold">{{ $task->title }}</span>
                                @if($task->description)
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $task->description }}</p>
                                @endif
                            </div>

                            <div class="flex items-center space-x-3">
                                <span class="text-xs px-2 py-1 rounded {{ $task->completed ? 'bg-green-200 dark:bg-green-800 text-green-800 dark:text-green-200' : 'bg-yellow-200 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200' }}">
                                    {{ $task->completed ? 'Completed' : 'Pending' }}
                                </span>

                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold px-2 py-1">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </li>
                        @empty
                        <li>No tasks found. Create one!</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            {{-- Pagination Links --}}
            {{-- <div class="mt-4">
                {{ $tasks->links() }}
        </div> --}}
    </div>
    </div>
</x-app-layout>