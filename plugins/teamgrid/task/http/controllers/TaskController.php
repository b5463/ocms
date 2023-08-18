<?php

namespace Teamgrid\Task\Http\Controllers;

use Teamgrid\Task\Models\Task;
use Backend\Classes\Controller;
use Teamgrid\Project\Models\Project;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Teamgrid\Task\Http\Resources\TaskResource;
use Carbon\Carbon;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Show a specific task.
     *
     * @param string $key
     * @return TaskResource|Response
     */
    public function show($key)
    {
        try {
            // Attempt to find the task by key
            $task = Task::findOrFail($key);
            return new TaskResource($task);
        } catch (ModelNotFoundException $e) {
            // Handle task not found error
            return response(['error' => 'Task not found'], 404);
        }
    }

    /**
     * Store a new task.
     *
     * @return TaskResource|Response
     */
    public function store()
    {
        try {
            // Attempt to find the project by ID
            $project = Project::where('id', post('project_id'))->firstOrFail();
            $user = auth()->user();

            // Create a new task and populate its attributes
            $task = new Task();
            $task->name = post("name");
            $task->description = post("description");
            $task->user_id = $user->id;
            $task->user_name = $user->name;
            $task->project_id = $project->id;
            $task->project_name = $project->name;
            $task->planned_start = Carbon::create(post('planned_start'));
            $task->planned_end = Carbon::create(post('planned_end'));
            $task->due_date = Carbon::create(post('due_date'));
            $task->planned_time = Carbon::create(post('planned_time'));
            $task->tags = post("tags");
            $task->save();

            return new TaskResource($task);
        } catch (ModelNotFoundException $e) {
            // Handle project not found error
            return response(['error' => 'Project not found'], 404);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response(['error' => 'An error occurred'], 500);
        }
    }

    /**
     * Update an existing task.
     *
     * @param string $key
     * @return TaskResource|Response
     */
    public function update($key)
    {
        try {
            // Attempt to find the task by key
            $task = Task::findOrFail($key);
            $task->name = post("name") ?: $task->name;
            $task->description = post("description") ?: $task->description;
            $task->user_id = post("user_id") ?: $task->user_id;
            $task->project_id = post("project_id") ?: $task->project_id;
            $task->planned_start = Carbon::create(post('planned_start')) ?: $task->planned_start;
            $task->planned_end = Carbon::create(post('planned_end')) ?: $task->planned_end;
            $task->due_date = Carbon::create(post('due_date')) ?: $task->due_date;
            $task->planned_time = Carbon::create(post('planned_time')) ?: $task->planned_time;
            $task->tags = post("tags") ?: $task->tags;
            $task->is_done = post("is_done") ?: $task->is_done;

            $task->save();
            return new TaskResource($task);
        } catch (ModelNotFoundException $e) {
            // Handle task not found error
            return response(['error' => 'Task not found'], 404);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response(['error' => 'An error occurred'], 500);
        }
    }

    /**
     * Mark a task as done.
     *
     * @param string $key
     * @return TaskResource|Response
     */
    public function markAsDone($key)
    {
        try {
            // Attempt to find the task by key
            $task = Task::findOrFail($key);
            $task->is_done = true;
            $task->save();
            return new TaskResource($task);
        } catch (ModelNotFoundException $e) {
            // Handle task not found error
            return response(['error' => 'Task not found'], 404);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response(['error' => 'An error occurred'], 500);
        }
    }
}