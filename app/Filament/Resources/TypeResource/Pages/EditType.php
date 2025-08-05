<?php

namespace App\Filament\Resources\TypeResource\Pages;

use App\Filament\Resources\TypeResource;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\EditTranslatable;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditType extends EditRecord
{
    use EditTranslatable;

    protected static string $resource = TypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
