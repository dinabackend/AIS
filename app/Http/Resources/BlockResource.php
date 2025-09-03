<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->name];
            }),
            'img' => $this->getFirstMediaUrl('block_img'),
            'options' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => collect($item->options)->pluck('text')];
            }),
        ];
    }
}
