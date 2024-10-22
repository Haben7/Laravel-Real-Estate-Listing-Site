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
    return asset('storage/' . $image->path); // Adjust the path if needed
}),
 
        'title' => $this->title,
        'price' => $this->price,
        'location' => $this->location,
        'bedrooms' => $this->bedrooms,
        'bathrooms'=>   $this->bathrooms,
         // 'title' => $this->title,
            // 'location' => $this->location,
            // 'property_type' => $this->property_type,
            // 'listing_type' => $this->listing_type,
            // 'price' => $this->price,
            // 'negotiable' => $this->negotiable,
            // 'lot_size' => $this->lot_size,
            // 'bedrooms' => $this->bedrooms,
            // 'bathrooms' => $this->bathrooms,
            // 'floors' => $this->floors,
            // 'garden'=> $this->garden,
            // 'has_pool' => $this->has_pool,
            // 'heating_system' => $this->heating_system,
            // 'cooling_system' => $this->cooling_system,
            // 'furnishing_status' => $this->furnishing_status,
            // 'condition' => $this->condition,
            // 'ownership_type' => $this->ownership_type,
            // 'title_status' => $this->title_status,
            // 'building_permits' => $this->building_permits,
            // 'mortgage_status' => $this->mortgage_status,
            // 'owner_id'  => $this->owner_id,
            // 'created_at' => $this->created_at,
        ];
    }
}
