<?php

namespace App\Filament\Resources\BACResource\Pages;

use App\Filament\Resources\BACResource;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\ListTranslatable;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBACS extends ListRecords
{
    use ListTranslatable;

    protected static string $resource = BACResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
