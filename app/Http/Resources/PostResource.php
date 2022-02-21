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
            'category_id' => $this->category_id,
            'title' => $this->title,
            'content' => $this->content,
            'description' => $this->description,
            'title' => $this->title,
            'viewed' => $this->viewed,
            'img' => $this->img,
            'public_start_at' => $this->public_start_at,
            'public_end_at' => $this->public_end_at,
            'status' => $this->status
        ];
    }
}
