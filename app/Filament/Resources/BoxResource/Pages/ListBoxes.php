<?php

namespace App\Filament\Resources\BoxResource\Pages;

use App\Filament\Resources\BoxResource;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\ListTranslatable;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBoxes extends ListRecords
{
    use ListTranslatable;

    protected static string $resource = BoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
