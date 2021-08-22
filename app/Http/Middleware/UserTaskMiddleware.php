<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserTaskMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $authenticatedUser = auth()->user(); //get authenticated user
        $task = $request->task; //get task

        //abort if task doesn't belong to user
        abort_if(!($authenticatedUser->id === $task->user_id), Response::HTTP_FORBIDDEN,
            "You are not allowed to view this task");

        //proceed if task belongs to user
        return $next($request);

    }
}
