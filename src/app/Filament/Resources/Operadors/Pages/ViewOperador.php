<?php

namespace App\Filament\Resources\Operadors\Pages;

use App\Filament\Resources\Operadors\OperadorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOperador extends ViewRecord
{
    protected static string $resource = OperadorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
