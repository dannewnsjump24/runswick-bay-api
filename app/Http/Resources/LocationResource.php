<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Domain\Locations\Models\Location */
class LocationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'trip_id' => $this->trip_id,
            'trip' => new TripResource($this->whenLoaded('trip')),
            'latitude' => (float) $this->latitude,
            'longitude' => (float) $this->longitude,
            'images' => LocationImageResource::collection($this->whenLoaded('images')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
