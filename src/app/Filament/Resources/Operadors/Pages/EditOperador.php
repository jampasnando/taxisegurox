<?php

namespace App\Filament\Resources\Operadors\Pages;

use App\Filament\Resources\Operadors\OperadorResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditOperador extends EditRecord
{
    protected static string $resource = OperadorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
