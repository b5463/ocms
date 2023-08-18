<?php

namespace Teamgrid\TimeEntry\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Teamgrid\Task\Http\Resources\TaskResource;
use LibUser\UserApi\Http\Resources\UserResource;
use RainLab\User\Models\User;
use Teamgrid\Task\Models\Task;

/**
 * Class TimeEntryResource
 * @package Teamgrid\TimeEntry\Http\Resources
 */
class TimeEntryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'user_name'     => $this->user_name,
            'user'          => new UserResource($this->user),
            'task'          => new TaskResource($this->task),
            'start_time'    => $this->start_time,
            'end_time'      => $this->end_time,
            'total_time'    => $this->total_time,
            'accounting'    => $this->accounting,
            'is_done'       => $this->is_done,
        ];
    }
}