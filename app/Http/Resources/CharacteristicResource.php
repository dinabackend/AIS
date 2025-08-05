<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CharacteristicResource extends JsonResource
{

    private $id = 0;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'key'   => $this->characteristic_key->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->name];
            }),
            'value' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->value];
            })
        ];
    }
}
