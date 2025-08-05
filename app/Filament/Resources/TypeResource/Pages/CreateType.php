<?php

namespace App\Filament\Resources\TypeResource\Pages;

use App\Filament\Resources\TypeResource;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\CreateTranslatable;
use Filament\Resources\Pages\CreateRecord;

class CreateType extends CreateRecord
{
    use CreateTranslatable;

    protected static string $resource = TypeResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
