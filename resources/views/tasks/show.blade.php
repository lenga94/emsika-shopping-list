<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $task->name }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium text-gray-900">Task Name</h3>
                        <p class="mt-1 text-sm text-gray-600">{{ $task->name }}</p>
                        <br>
                        <h3 class="text-lg font-medium text-gray-900">Task Description</h3>
                        <p class="mt-1 text-sm text-gray-600">{{ $task->description }}</p>
                        <br>
                        <h3 class="text-lg font-medium text-gray-900">Owner</h3>
                        <p class="mt-1 text-sm text-gray-600">{{ $task->user->name }}</p>
                        <br>
                        <h3 class="text-lg font-medium text-gray-900">Task Items</h3>
                        <p class="mt-1 text-sm text-gray-600">{{ $task->taskItems->count() }}</p>
                        <br>
                        <h3 class="text-lg font-medium text-gray-900">Date Created</h3>
                        <p class="mt-1 text-sm text-gray-600">{{ $task->created_at }}</p>
                        <br>
                    </div>
                </div>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    {!! Form::open(['route' => ['task.items.store'], 'method' => 'POST', 'id' => 'createTaskItemForm']) !!}

                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">

                            <div class="flex">
                                <div class="flex-auto text-2xl mb-4">
                                    <h3>Create Task Item</h3>
                                    <p class="text-lg font-medium text-gray-900">Fill the form below to add a new task item for {{ $task->name }} task</p>
                                </div>
                            </div>

                            <hr>
                            <br>

                            <div class="grid grid-cols-6 gap-6">

                                <!-- Name -->
                                <div class="col-span-6 sm:col-span-4">
                                    {{ Form::label('name', 'Name', ['class' => 'block font-medium text-sm text-gray-700']) }}
                                    {{ Form::text('name', '', ['class' => 'form-input rounded-md shadow-sm mt-1 block w-full', 'id' => 'name', 'autocomplete' => 'off', 'placeholder' => 'Name', 'required']) }}

                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <!-- /Name -->

                                <!-- /Description -->
                                <div class="col-span-6 sm:col-span-4">
                                    {{ Form::label('description', 'Description', ['class' => 'block font-medium text-sm text-gray-700']) }}
                                    {{ Form::textarea('description', '', ['class' => 'form-input rounded-md shadow-sm mt-1 block w-full', 'id' => 'description', 'rows' => '5', 'autocomplete' => 'off', 'placeholder' => 'Description']) }}

                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                                <!-- /Description -->

                                <!-- Task Id -->
                                {{ Form::hidden('task_id', $task->id, []) }}
                                <!-- /Task Id -->
                            </div>
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            {{ Form::submit('Save Task Item', ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                        <div class="flex">
                            <div class="flex-auto text-2xl mb-4">Task Item List</div>

                        </div>
                        <table class="w-full text-md rounded mb-4">
                            <thead>
                            <tr class="border-b">
                                <th class="text-left p-3 px-5">Task</th>
                                <th class="text-left p-3 px-5">Description</th>
                                <th class="text-left p-3 px-5">Status</th>
                                <th class="text-left p-3 px-5">Actions</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($task->taskItems as $taskItem)
                                <tr class="border-b hover:bg-orange-100">
                                    <td class="p-3 px-5">
                                        {{$taskItem->name}}
                                    </td>
                                    <td class="p-3 px-5">
                                        {{$taskItem->description}}
                                    </td>
                                    <td class="p-3 px-5">
                                        {{$taskItem->status}}
                                    </td>
                                    <td class="p-3 px-5">

                                        @if($taskItem->status === "PENDING")
                                            {!! Form::open(['route' => ['task.items.mark.as.done', $taskItem->id], 'method' => 'PATCH', 'id' => 'updateTaskItemToDoneForm', 'class' => 'inline-block']) !!}
                                            {{ Form::submit('Mark as Done', ['id' => 'mark-completed', 'class' => 'mr-3 text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline']) }}
                                            {!! Form::close() !!}
                                        @elseif($taskItem->status === "DONE")
                                            {!! Form::open(['route' => ['task.items.mark.as.pending', $taskItem->id], 'method' => 'PATCH', 'id' => 'updateTaskItemToPendingForm', 'class' => 'inline-block']) !!}
                                            {{ Form::submit('Mark as Pending', ['id' => 'mark-completed', 'class' => 'mr-3 text-sm bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline']) }}
                                            {!! Form::close() !!}
                                        @endif
                                        <a href="{{ route('task.items.edit', $taskItem->id) }}" id="edit-task-item" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Edit</a>
                                        {!! Form::open(['route' => ['task.items.delete', $taskItem->id], 'method' => 'DELETE', 'id' => 'deleteTaskItemForm', 'class' => 'inline-block']) !!}
                                        {{ Form::submit('Delete', ['id' => 'delete-task-item', 'class' => 'text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline']) }}
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
