<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'content' => $this->content,
            'description' => $this->description,
            'qty' => $this->qty,
            'price' => $this->price,
            'retail_price' => $this->retail_price,
            'image' => $this->image,
            'status' => $this->status
        ];
    }
}
