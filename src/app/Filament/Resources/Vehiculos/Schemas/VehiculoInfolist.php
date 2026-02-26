<?php

namespace App\Filament\Resources\Vehiculos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class VehiculoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('placa')
                    ->placeholder('-'),
                TextEntry::make('modelo')
                    ->placeholder('-'),
                TextEntry::make('color')
                    ->placeholder('-'),
                TextEntry::make('nroplazas')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('combustible')
                    ->placeholder('-'),
                TextEntry::make('motor')
                    ->placeholder('-'),
                TextEntry::make('chasis')
                    ->placeholder('-'),
                TextEntry::make('estado')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
