<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'id' => $this->resource->id,
            'title' => $this->title,
            'content' => $this->content,
            'description' => $this->description,
            'title' => $this->title,
            'image' => $this->image,
            'public_start_at' => $this->public_start_at,
            'public_end_at' => $this->public_end_at,
            'status' => $this->status
        ];
    }
}
