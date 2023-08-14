<?php
    namespace LibUser\Userapi\Http\Resources;
    use Illuminate\Http\Resources\Json\JsonResource;

    class UserResource extends JsonResource {

        public function toArray($request) {
            return [
                "id" => $this->id,
                "name" => $this->name,
                "surname" => $this->surname,
                "email" => $this->email,
                "is_activated" => $this->is_activated,
                "registered_at" => date($this->created_at)
            ];
        }
        
    }