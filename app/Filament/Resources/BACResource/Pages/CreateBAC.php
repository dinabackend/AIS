<?php

namespace App\Filament\Resources\BACResource\Pages;

use App\Filament\Resources\BACResource;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\CreateTranslatable;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBAC extends CreateRecord
{
    use CreateTranslatable;

    protected static string $resource = BACResource::class;
}
