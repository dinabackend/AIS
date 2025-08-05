<?php

namespace App\Http\Resources;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Type */
class TypeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->name];
            }),
            'count' => $this->products()->count()
        ];
    }
}
