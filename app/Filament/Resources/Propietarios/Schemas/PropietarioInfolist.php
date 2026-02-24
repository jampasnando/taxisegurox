<?php

namespace App\Filament\Resources\Propietarios\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PropietarioInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nrodocumento')
                    ->placeholder('-'),
                TextEntry::make('expedido')
                    ->placeholder('-'),
                TextEntry::make('nombres')
                    ->placeholder('-'),
                TextEntry::make('primer_apellido')
                    ->placeholder('-'),
                TextEntry::make('segundo_apellido')
                    ->placeholder('-'),
                TextEntry::make('tercer_apellido')
                    ->placeholder('-'),
                TextEntry::make('celular')
                    ->placeholder('-'),
                TextEntry::make('direccion')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('zona')
                    ->placeholder('-'),
                TextEntry::make('barrio')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ])
            ->columns(4);
    }
}
