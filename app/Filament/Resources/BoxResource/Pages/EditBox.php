<?php

namespace App\Filament\Resources\BoxResource\Pages;

use App\Filament\Resources\BoxResource;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\EditTranslatable;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBox extends EditRecord
{
    use EditTranslatable;

    protected static string $resource = BoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
