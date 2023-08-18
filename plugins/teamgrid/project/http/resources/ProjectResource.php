<?php

namespace Teamgrid\Project\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LibUser\UserApi\Http\Resources\UserResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'name'                  => $this->name,
            'description'           => $this->description,
            'customer_id'           => new UserResource($this->customer),
            'project_manager_id'    => new UserResource($this->projectManager),
            'customer_name'         => $this->customer_name,
            'project_manager_name'  => $this->project_manager_name,
            'due_date'              => $this->due_date,
            'accounting'            => $this->accounting,
            'hourly_rate_price'     => $this->hourly_rate_price,
            'budget'                => $this->budget,
            'is_done'               => $this->is_done,
        ];
    }
}