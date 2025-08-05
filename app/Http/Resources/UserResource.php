<?php

namespace App\Http\Resources;

use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $locale = app()->getLocale();

        $specialists = Specialist::get();

        $translatedSpecialists = [];
        foreach ($specialists as $specialist) {
            $translatedSpecialists[] = [
                'id' => $specialist->id,
                'name' => $specialist->translate($locale)->name,
                'position' => $specialist->translate($locale)->position,
                'image' => $specialist->getFirstMediaUrl('specialists'),
            ];
        }

        return $translatedSpecialists;
    }
}
