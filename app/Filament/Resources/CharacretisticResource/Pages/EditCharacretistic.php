<?php

namespace App\Filament\Resources\CharacretisticResource\Pages;

use App\Filament\Resources\CharacteristicResource;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\EditTranslatable;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCharacretistic extends EditRecord
{
    use EditTranslatable;

    protected static string $resource = CharacteristicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
