<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LastIncidentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'since' => str_replace(' ago', '', Carbon::createFromDate($this->crime_date)->diffForHumans()), // How long ago it happened
            'time' => Carbon::createFromDate($this->crime_date)->format('m/d/Y H:i:s'), // Crime date
            'type' => $this->type_of_engagement, // Type of crime
            'display_address' => $this->display_address, // Display address
        ];
    }
}
