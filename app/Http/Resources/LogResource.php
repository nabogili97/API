<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LogResource extends JsonResource
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
            'thing' => $this->thing,
            'zone' => $this->zone,
            'group' => $this->group,
            'name_action' => $this->name_action,
            'status' => $this->status,
            'value' => $this->value,
        ];
    }
}
