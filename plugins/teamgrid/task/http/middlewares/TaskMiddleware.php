<?php

namespace Teamgrid\Task\Http\Middlewares;

use Teamgrid\Task\Models\Task;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request The incoming request.
     * @param Closure $next    The next middleware closure.
     *
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Get the authenticated user
            $user = auth()->user();
            $userId = $user->id;

            // Find the task based on the route key parameter
            $task = Task::where('id', $request->route('key'))->firstOrFail();

            // Check if the authenticated user is the owner of the task
            if ($userId !== $task->user_id) {
                return response("You are not allowed to access this task", 403);
            }

            // Continue with the request
            return $next($request);
        } catch (ModelNotFoundException $e) {
            // Handle task not found error
            return response(['error' => 'Task not found'], 404);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response(['error' => 'An error occurred'], 500);
        }
    }
}