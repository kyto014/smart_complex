<?php

namespace App\Http\Resources;

use App\Models\Key;
use Illuminate\Http\Resources\Json\Resource;

class PersonResource extends Resource
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
            'person_id' => $this->person_id,
            'forname' => $this->forname,
            'surname' => $this->surname,
            'email' => $this->email,
            'keys' => Key::collection($this->keys),
            'person_type_id' => $this->person_type_id,
            'role_id' => $this->role_id
        ];
    }
}
