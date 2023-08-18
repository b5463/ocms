<?php

namespace Teamgrid\Task\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Teamgrid\Project\Http\Resources\ProjectResource;
use LibUser\UserApi\Http\Resources\UserResource;

class TaskResource extends JsonResource
{
    public function toArray($request)
    {
        try {
            return [
                'id'                => $this->id,
                'name'              => $this->name,
                'description'       => $this->description,
                'user'              => new UserResource($this->user),
                'project'           => new ProjectResource($this->project),
                'project_name'      => $this->project_name,
                'due_date'          => $this->due_date,
                'planned_start'     => $this->planned_start,
                'planned_end'       => $this->planned_end,
                'planned_time'      => $this->planned_time,
                'tracked_time'      => $this->getTrackedTimeAttribute(),
                'tags'              => $this->tags,
                'done'              => $this->is_done,
            ];
        } catch (\Exception $e) {
            // Handle any exceptions that may occur while processing the resource
            return [
                'error' => 'An error occurred while processing the resource',
            ];
        }
    }
}