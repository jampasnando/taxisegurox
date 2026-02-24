<?php

namespace App\Filament\Resources\Conductors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ConductorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nrodocumento'),
                TextInput::make('expedido'),
                TextInput::make('tipo'),
                TextInput::make('nombres'),
                TextInput::make('primer_apellido'),
                TextInput::make('segundo_apellido'),
                TextInput::make('tercere_apellido'),
                TextInput::make('celular'),
                Textarea::make('direccion')
                    ->columnSpanFull(),
                TextInput::make('zona'),
                TextInput::make('barrio'),
                TextInput::make('tic'),
                TextInput::make('categoria'),
                Textarea::make('adjunto_documento')
                    ->columnSpanFull(),
                Textarea::make('adjunto_licencia')
                    ->columnSpanFull(),
                Textarea::make('adjunto_tic')
                    ->columnSpanFull(),
            ]);
    }
}
