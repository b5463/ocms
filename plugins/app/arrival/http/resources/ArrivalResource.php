<?php
namespace App\Arrival\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LibUser\UserApi\Http\Resources\UserResource;
 
class ArrivalResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'user' => new UserResource($this->user),
            'arrival' => $this->arrival,
        ];
    }
}