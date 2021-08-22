<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('user.tasks')->only('show', 'edit', 'update');
    }


    /**
     * Display a listing of all tasks.
     * @return Application|Factory|View
     */
    public function index()
    {
        //get authenticated user
        $user = auth()->user();

        //get all tasks belonging to authenticated user in order of recently created
        $tasks = $user->tasks()->latest()->get();

        $context = [
            'tasks' => $tasks,
        ];

        //redirect dashboard view
        return view('dashboard', $context);
    }


    /**
     * Show the form for creating a new task.
     * @return Application|Factory|View
     */
    public function create()
    {
        //return create view
    	return view('tasks.create');
    }


    /**
     * Store a newly created task in storage.
     * @param TaskRequest $request
     * @return RedirectResponse
     */
    public function store(TaskRequest $request): RedirectResponse
    {
        //create a task in database
    	$task = Task::create([
    	    'name' => $request->name, //get name from request
            'description' => $request->description, //get description from request
            'user_id' => auth()->user()->id, //get id from authenticated user
        ]);

    	//redirect to show page
    	return redirect()->route('tasks.show', [$task]);
    }


    /**
     * Show the specified resource.
     * @param Task $task
     * @return Application|Factory|View
     */
    public function show(Task $task) {

        //get task items belonging to task
        $taskItems = $task->taskItems;

        $context = [
            'task', $task,
            'taskItems' => $taskItems,
        ];

        //return show task page
        return view('tasks.show', compact('task'));

    }


    /**
     * Show the form for editing the specified task.
     * @param Task $task
     * @return Application|Factory|View
     */
    public function edit(Task $task)
    {
        //return edit task page
        return view('tasks.edit', compact('task'));
    }


    /**
     * Update the specified task in storage.
     * @param TaskRequest $request
     * @param Task $task
     * @return RedirectResponse
     */
    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        //update task attributes
    	$task->fill([
    	    'name' => $request->name,
            'description' => $request->description,
        ]);

    	//save changes
    	$task->save();

    	//redirect to dashboard page
    	return redirect()->route('dashboard');
    }


    /**
     * Remove the specified task from storage.
     * @param Task $task
     * @return RedirectResponse
     */
    public function destroy(Task $task): RedirectResponse
    {
        //remove task item from storage
        $task->delete();

        //redirect to dashboard page
        return redirect()->route('dashboard');
    }
}
