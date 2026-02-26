<?php

namespace App\Filament\Resources\Propietarios\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class PropietarioVehiculosRelationManager extends RelationManager
{
    protected static string $relationship = 'propietarioVehiculos';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('vehiculo_id')
                    ->relationship('vehiculo', 'placa')
                    ->searchable()
                    ->required(),

                Select::make('tipo')
                    ->options([
                        'PROPIETARIO' => 'PROPIETARIO',
                        'POSEEDOR' => 'POSEEDOR',
                        'TERCERO' => 'TERCERO',
                    ])
                    ->required(),

                FileUpload::make('adjunto_crpva')
                    ->directory('vehiculos/crpva'),

                FileUpload::make('adjunto_poder')
                    ->directory('vehiculos/poder'),

                FileUpload::make('adjunto_matricula')
                    ->directory('vehiculos/matricula'),

                Select::make('estado')
                    ->options([
                        1 => 'ACTIVO',
                        2 => 'INACTIVO',
                    ])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('vehiculo')
            ->columns([
                TextColumn::make('vehiculo.placa')
                    ->label('Placa')
                    ->searchable(),

                TextColumn::make('tipo'),

                ToggleColumn::make('estado'),
                TextColumn::make('created_at')
                    ->date()
                    ->label('Fecha Registro'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Agregar Vehículo'),
                // AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                // DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
