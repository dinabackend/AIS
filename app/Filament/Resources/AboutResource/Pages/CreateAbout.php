<?php

namespace App\Filament\Resources\AboutResource\Pages;

use App\Filament\Resources\AboutResource;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\CreateTranslatable;
use Filament\Resources\Pages\CreateRecord;

class CreateAbout extends CreateRecord
{
    use CreateTranslatable;

    protected static string $resource = AboutResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
