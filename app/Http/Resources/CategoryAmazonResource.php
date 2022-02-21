<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryAmazonResource extends JsonResource
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
            'id' => $this->resource['CategoryResult']['category'][0]['Id'],
            'name' => $this->resource['CategoryResult']['category'][0]['ContextFreeName'],
        ];
    }
}
