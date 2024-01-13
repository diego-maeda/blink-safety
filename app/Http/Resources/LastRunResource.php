<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LastRunResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * TODO LEAVE THIS CODE LIKE THIS FOR NOW, BUT IT HAS TO BE UPDATED TO BE BETTER ACOMMODATE
     *  FUTURE PDS.
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if($this->precinct == '32803') {
            return [
                'created_at' => $this->created_at->format('c'),
                'next_run' => Carbon::createFromDate($this->created_at)->addMinutes(1)->format('c'),
            ];
        } else {
            return [
                'created_at' => $this->created_at->format('c'),
                'next_run' => Carbon::createFromDate($this->created_at)->addMinutes(5)->format('c'),
            ];
        }

    }
}
