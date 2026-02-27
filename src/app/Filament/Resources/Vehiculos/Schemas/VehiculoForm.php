<?php

namespace App\Filament\Resources\Vehiculos\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VehiculoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información Vehicular de la Placa: '. $schema->getRecord()?->placa ?? '')
                    ->schema([
                        TextInput::make('placa')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20)
                            ->autofocus(),

                        TextInput::make('modelo')
                            ->required()
                            ->maxLength(100),

                        TextInput::make('color')
                            ->maxLength(50),

                        TextInput::make('nroplazas')
                            ->numeric(),

                        Select::make('combustible')
                            ->options([
                                'GASOLINA/GNV' => 'GASOLINA/GNV',
                                'GASOLINA' => 'GASOLINA',
                                'GNV' => 'GNV',
                                'DIESEL' => 'DIESEL',
                                'ELECTRICO' => 'ELECTRICO',
                                'HIBRIDO' => 'HIBRIDO',
                            ])
                            ->required(),

                        TextInput::make('motor'),

                        TextInput::make('chasis'),
                        Select::make('estado')
                            ->options([
                                1 => 'ACTIVO',
                                2 => 'SUSPENDIDO',
                                3 => 'BLOQUEADO',
                            ])
                            ->required(),
                    ])
                    ->collapsible()
                    ->collapsed(fn ($record): bool => $record !== null)
                    ->columns(3)
                    ->columnSpanFull(),


            ]);
    }
}
