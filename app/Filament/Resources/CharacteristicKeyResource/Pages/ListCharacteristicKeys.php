<?php

namespace App\Filament\Resources\CharacteristicKeyResource\Pages;

use App\Filament\Resources\CharacteristicKeyResource;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\ListTranslatable;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCharacteristicKeys extends ListRecords
{
    use ListTranslatable;

    protected static string $resource = CharacteristicKeyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
