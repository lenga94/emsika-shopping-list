<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskItemRequest;
use App\Models\Task;
use App\Models\TaskItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TaskItemsController extends Controller
{
    /**
     * Store a newly created task item in storage.
     * @param TaskItemRequest $request
     * @return RedirectResponse
     */
    public function store(TaskItemRequest $request): RedirectResponse
    {
        //create a task item in database
        $task = TaskItem::create($request->all());

        //redirect to show page
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified task item.
     * @param TaskItem $taskItem
     * @return Application|Factory|View
     */
    public function edit(TaskItem $taskItem)
    {
        //return edit task item page
        return view('task-items.edit', compact('taskItem'));
    }


    /**
     * Update the specified task item in storage.
     * @param TaskItemRequest $request
     * @param TaskItem $taskItem
     * @return RedirectResponse
     */
    public function update(TaskItemRequest $request, TaskItem $taskItem): RedirectResponse
    {
        //update task attributes
        $taskItem->fill([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        //save changes
        $taskItem->save();

        //redirect to dashboard page
        return redirect()->route('tasks.show', [$taskItem->task]);
    }

    /**
     * Update the specified task item's status as DONE in storage.
     * @param TaskItem $taskItem
     * @return RedirectResponse
     */
    public function markAsDone(TaskItem $taskItem): RedirectResponse
    {
        //update task item attributes
        $taskItem->fill([
            'status' => 'DONE',
        ]);

        //save changes
        $taskItem->save();

        //redirect  back
        return redirect()->back();
    }

    /**
     * Update the specified task item's status as PENDING in storage.
     * @param TaskItem $taskItem
     * @return RedirectResponse
     */
    public function markAsPending(TaskItem $taskItem): RedirectResponse
    {
        //update task item attributes
        $taskItem->fill([
            'status' => 'PENDING',
        ]);

        //save changes
        $taskItem->save();

        //redirect  back
        return redirect()->back();
    }

    /**
     * Remove the specified task item from storage.
     * @param TaskItem $taskItem
     * @return RedirectResponse
     */
    public function destroy(TaskItem $taskItem): RedirectResponse
    {
        //remove task item from storage
        $taskItem->delete();

        //redirect to back
        return redirect()->back();
    }
}
