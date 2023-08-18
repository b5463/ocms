<?php

namespace Teamgrid\TimeEntry\Http\Controllers;

use Teamgrid\TimeEntry\Models\TimeEntry;
use Teamgrid\Task\Models\Task;
use Backend\Classes\Controller;
use Teamgrid\TimeEntry\Http\Resources\TimeEntryResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

/**
 * Class TimeEntryController
 * @package Teamgrid\TimeEntry\Http\Controllers
 */
class TimeEntryController extends Controller
{
    /**
     * Start time tracking for a task.
     *
     * @return TimeEntryResource|JsonResponse
     */
    public function startTimeTracking()
    {
        try {
            $taskId = post('task_id');
            $task = Task::findOrFail($taskId);
            $user = auth()->user();

            $timeEntry = new TimeEntry();
            $timeEntry->task_id = $task->id;
            $timeEntry->user_name = $user->name;
            $timeEntry->user_id = $user->id;
            $timeEntry->start_time = Carbon::now();
            $timeEntry->save();

            return new TimeEntryResource($timeEntry);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Task not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    /**
     * Stop time tracking for a time entry.
     *
     * @param string $key
     * @return TimeEntryResource|JsonResponse
     */
    public function stopTimeTracking($key)
    {
        try {
            $timeEntry = TimeEntry::findOrFail($key);
            $timeEntry->end_time = Carbon::now();
            $timeEntry->save();

            return new TimeEntryResource($timeEntry);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Time entry not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
}