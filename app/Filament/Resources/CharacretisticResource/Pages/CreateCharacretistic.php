<?php

namespace App\Filament\Resources\CharacretisticResource\Pages;

use App\Filament\Resources\CharacteristicResource;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\CreateTranslatable;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCharacretistic extends CreateRecord
{
    use CreateTranslatable;

    protected static string $resource = CharacteristicResource::class;
}
