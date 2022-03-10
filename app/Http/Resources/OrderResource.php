<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'quanity' => $this->quanity,
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'price' => $this->price
        ];
    }
}
