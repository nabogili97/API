<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryYahooResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $id = !empty($this->resource['Id']) ? $this->resource['Id'] : $this->resource['child']['genreId'];
        $nameCategory = !empty($this->resource['Title']['Medium']) ? $this->resource['Title']['Medium'] : $this->resource['child']['genreName'];
        return [
            'id' => $id,
            'name' => $nameCategory
        ];
    }
}
