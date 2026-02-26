<?php

namespace App\Filament\Resources\Propietarios\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PropietarioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información Personal')
                    ->schema([
                        TextInput::make('nrodocumento')
                            ->required()
                            ->maxLength(30),

                        TextInput::make('expedido')
                            ->maxLength(20),

                        TextInput::make('nombres')
                            ->required(),

                        TextInput::make('primer_apellido'),

                        TextInput::make('segundo_apellido'),

                        TextInput::make('tercer_apellido'),

                        TextInput::make('celular'),

                        TextInput::make('direccion'),

                        TextInput::make('zona'),

                        TextInput::make('barrio'),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }
}
