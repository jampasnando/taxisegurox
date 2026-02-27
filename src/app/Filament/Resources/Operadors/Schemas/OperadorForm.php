<?php

namespace App\Filament\Resources\Operadors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OperadorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre'),
                TextInput::make('contacto'),
                TextInput::make('celular'),
                Textarea::make('direccion')
                    ->columnSpanFull(),
                TextInput::make('estado'),
            ]);
    }
}
