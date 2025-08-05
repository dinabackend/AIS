<?php

namespace App\Filament\Resources\CharacteristicKeyResource\Pages;

use App\Filament\Resources\CharacteristicKeyResource;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\EditTranslatable;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCharacteristicKey extends EditRecord
{
    use EditTranslatable;

    protected static string $resource = CharacteristicKeyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
