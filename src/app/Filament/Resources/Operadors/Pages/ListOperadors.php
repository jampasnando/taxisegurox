<?php

namespace App\Filament\Resources\Operadors\Pages;

use App\Filament\Resources\Operadors\OperadorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOperadors extends ListRecords
{
    protected static string $resource = OperadorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
