<?php

namespace App\Arrival\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LibUser\UserApi\Http\Resources\UserResource; // Make sure this path is correct
use LibUser\Userapi\Models\User; // Make sure this path is correct

class ArrivalResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'user' => new UserResource($this->user), // Embed user details using UserResource
            'arrival' => $this->arrival,
        ];
    }
}