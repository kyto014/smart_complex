<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class KeyResource extends Resource
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
            'key_id' => $this->key_id,
            'key_type_id' =>$this->key_type_id,
            'key_state_id' => $this->key_state_id,
            'person_id' => $this->person_id,
            'key_string' => $this->key_string
        ];
    }
}
