<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @can('task-create')
                        <a
                            class="inline-flex items-center px-4 py-2 mb-4 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25"
                            href="{{ route('tasks.create') }}">
                            Create Task
                        </a>
                    @endcan

                    <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md mb-4">
                        <table class="min-w-full border divide-y divide-gray-200">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span
                                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">SR</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span
                                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Title</span>
                                </th>

                                <th class="px-6 py-3 bg-gray-50">
                                    <span
                                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Description</span>
                                </th>

                                <th class="px-6 py-3 w-1 bg-gray-50">
                                    <span
                                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Status</span>
                                </th>
                                <th class="px-6 py-3 w-1 bg-gray-50">
                                    <span
                                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Action</span>
                                </th>
                            </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid text-center">
                            @foreach($tasks as $key => $task)
                                <tr class="bg-white">
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        <a href="" class="hover:underline">{{ $key+1 }}</a>
                                    </td>
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        <a href="" class="hover:underline">{{ $task->title }}</a>
                                    </td>

                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        <a href="" class="hover:underline">{{ $task->description }}</a>
                                    </td>
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        <a href="" class="hover:underline">{{ $task->status }}</a>
                                    </td>
                                    <td class="flex px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        @can('task-update')
                                            <a
                                                class="inline-flex items-center px-4 py-2 mr-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25"
                                                href="{{ route('tasks.changeStatus', $task) }}">
                                                Change Status
                                            </a>
                                        @endcan

                                        @can('task-update')
                                            <a
                                                class="inline-flex items-center px-4 py-2 mr-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25"
                                                href="{{ route('tasks.edit', $task) }}">
                                                Edit
                                            </a>
                                        @endcan

                                        @can('task-delete')
                                            <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                                                  onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <x-primary-button class="flex-inline">
                                                    Delete
                                                </x-primary-button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $tasks->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
