<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Task') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium text-gray-900">Create New Task</h3>

                        <p class="mt-1 text-sm text-gray-600">
                            Fill the form on the right to create a new task.
                        </p>
                    </div>
                </div>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    {!! Form::open(['route' => ['tasks.store'], 'method' => 'POST', 'id' => 'createTaskForm']) !!}

                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
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
                                </div>
                            </div>

                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                {{ Form::submit('Save Task', ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
