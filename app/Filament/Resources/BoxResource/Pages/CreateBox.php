<?php

namespace App\Filament\Resources\BoxResource\Pages;

use App\Filament\Resources\BoxResource;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\CreateTranslatable;
use Filament\Resources\Pages\CreateRecord;

class CreateBox extends CreateRecord
{
    use CreateTranslatable;

    protected static string $resource = BoxResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
