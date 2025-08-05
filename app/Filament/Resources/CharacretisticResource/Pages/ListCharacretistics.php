<?php

namespace App\Filament\Resources\CharacretisticResource\Pages;

use App\Filament\Resources\CharacteristicResource;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\ListTranslatable;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCharacretistics extends ListRecords
{
    use ListTranslatable;

    protected static string $resource = CharacteristicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
