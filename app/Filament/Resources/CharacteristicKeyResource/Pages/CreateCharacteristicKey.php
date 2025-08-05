<?php

namespace App\Filament\Resources\CharacteristicKeyResource\Pages;

use App\Filament\Resources\CharacteristicKeyResource;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\CreateTranslatable;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCharacteristicKey extends CreateRecord
{
    use CreateTranslatable;

    protected static string $resource = CharacteristicKeyResource::class;
}
