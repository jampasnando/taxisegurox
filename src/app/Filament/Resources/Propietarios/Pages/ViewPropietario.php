<?php

namespace App\Filament\Resources\Propietarios\Pages;

use App\Filament\Resources\Propietarios\PropietarioResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPropietario extends ViewRecord
{
    protected static string $resource = PropietarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
