<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EditorialProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'title' => $this->title,
            'is_approved_by_ceo' => $this->is_approved_by_ceo,
            'is_approved_by_editorial_director' => $this->is_approved_by_editorial_director,
            'is_approved_by_editorial_responsible' => $this->is_approved_by_editorial_responsible,
            'is_approved_by_sales_director' => $this->is_approved_by_sales_director,
            'publication_date' => $this->publication_date,
            'pages' => $this->pages,
            'price' => $this->price,
            'cost' => $this->cost,
            'author' => new UserResource($this->whenLoaded('author'))
        ];
    }
}
