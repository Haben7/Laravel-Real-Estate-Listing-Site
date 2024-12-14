<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
          'images' => $this->images->map(function($image) {
    return asset('storage/' . $image->path);
}),
 
        'title' => $this->title,
        'price' => $this->price,
        'location' => $this->location,
        'bedrooms' => $this->bedrooms,
        'bathrooms'=>   $this->bathrooms,
        'property_type' => $this->property_type,          
        'negotiable' => $this->negotiable,
        'owner_contact' => $this->owner_contact,
        'owner_email' => $this->owner_email,
        'size' => $this->size,
        'area' => $this->area,
        'description' => $this->description,
        'real_estate_name' =>$this->real_estate_name,
        
        
        ];
    }
    
}
