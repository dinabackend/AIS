<?php

namespace App\Filament\Resources\BACResource\Pages;

use App\Filament\Resources\BACResource;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\EditTranslatable;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBAC extends EditRecord
{
    use EditTranslatable;

    protected static string $resource = BACResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
