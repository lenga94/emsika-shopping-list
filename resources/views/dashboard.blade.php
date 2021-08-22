<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="flex">
                    <div class="flex-auto text-2xl mb-4">Tasks List</div>

                    <div class="flex-auto text-right mt-2">
                        <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add new Task</a>
                    </div>
                </div>
                <table class="w-full text-md rounded mb-4">
                    <thead>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">Task</th>
                        <th class="text-left p-3 px-5">Description</th>
                        <th class="text-left p-3 px-5">Actions</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr class="border-b hover:bg-orange-100">
                            <td class="p-3 px-5">
                                {{$task->name}}
                            </td>
                            <td class="p-3 px-5">
                                {{$task->description}}
                            </td>
                            <td class="p-3 px-5">

                                <a href="{{ route('tasks.show', $task->id) }}" id="show-task" class="mr-3 text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">View</a>
                                <a href="{{ route('tasks.edit', $task->id) }}" id="edit-task" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Edit</a>
                                {!! Form::open(['route' => ['tasks.delete', $task->id], 'method' => 'DELETE', 'id' => 'deleteTaskForm', 'class' => 'inline-block']) !!}
                                    {{ Form::submit('Delete', ['id' => 'delete-task', 'class' => 'text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline']) }}
                                {!! Form::close() !!}
                            </td>
                        </tr>


                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
