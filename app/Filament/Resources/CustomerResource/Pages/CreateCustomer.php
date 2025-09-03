<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\EventResource;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\CreateTranslatable;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    use CreateTranslatable;

    protected static string $resource = EventResource::class;
}
