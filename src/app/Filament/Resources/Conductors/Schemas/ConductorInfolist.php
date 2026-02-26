<?php

namespace App\Filament\Resources\Conductors\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ConductorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nrodocumento')
                    ->placeholder('-'),
                TextEntry::make('expedido')
                    ->placeholder('-'),
                TextEntry::make('tipo')
                    ->placeholder('-'),
                TextEntry::make('nombres')
                    ->placeholder('-'),
                TextEntry::make('primer_apellido')
                    ->placeholder('-'),
                TextEntry::make('segundo_apellido')
                    ->placeholder('-'),
                TextEntry::make('tercere_apellido')
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
                TextEntry::make('tic')
                    ->placeholder('-'),
                TextEntry::make('categoria')
                    ->placeholder('-'),
                TextEntry::make('adjunto_documento')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('adjunto_licencia')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('adjunto_tic')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
