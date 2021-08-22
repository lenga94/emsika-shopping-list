<?php

use App\Http\Controllers\TaskItemsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->prefix('tasks')->group(function() {

    /**
     * Tasks Routes
     */
    Route::get('/',[TasksController::class, 'index'])->name('dashboard');
    Route::get('/create',[TasksController::class, 'create'])->name('tasks.create');
    Route::post('/store', [TasksController::class, 'store'])->name('tasks.store');
    Route::get('/{task}/show', [TasksController::class, 'show'])->name('tasks.show');
    Route::get('/{task}/edit', [TasksController::class, 'edit'])->name('tasks.edit');
    Route::patch('/{task}/update', [TasksController::class, 'update'])->name('tasks.update');
    Route::delete('/{task}/delete', [TasksController::class, 'destroy'])->name('tasks.delete');


    /**
     * Task Items Routes
     */
    Route::prefix('task-items')->group(function() {
        Route::post('/store', [TaskItemsController::class, 'store'])->name('task.items.store');
        Route::get('/{taskItem}/edit', [TaskItemsController::class, 'edit'])->name('task.items.edit');
        Route::patch('/{taskItem}/update', [TaskItemsController::class, 'update'])->name('task.items.update');
        Route::patch('/{taskItem}/mark-as-done', [TaskItemsController::class, 'markAsDone'])->name('task.items.mark.as.done');
        Route::patch('/{taskItem}/mark-as-pending', [TaskItemsController::class, 'markAsPending'])->name('task.items.mark.as.pending');
        Route::delete('/{taskItem}/delete', [TaskItemsController::class, 'destroy'])->name('task.items.delete');
    });
});
