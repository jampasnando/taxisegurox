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
    protected static ?string $title = 'Vehículos';

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
                Select::make('estado')
                    ->options([
                        1 => 'ACTIVO',
                        2 => 'INACTIVO',
                    ])
                    ->required(),
                FileUpload::make('adjunto_crpva')
                    ->directory('vehiculos/crpva'),

                FileUpload::make('adjunto_poder')
                    ->directory('vehiculos/poder'),

                FileUpload::make('adjunto_matricula')
                    ->directory('vehiculos/matricula'),
                FileUpload::make('adjunto_fotofrontal')
                    ->directory('vehiculos/fotofrontal'),
                FileUpload::make('adjunto_fotoposterior')
                    ->directory('vehiculos/fotoposterior'),
                FileUpload::make('adjunto_fotolateralizq')
                    ->directory('vehiculos/fotolateralizq'),
                FileUpload::make('adjunto_fotolateralder')
                    ->directory('vehiculos/fotolateralder'),
            ])
            ->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('vehiculo')
            // ->recordClasses(fn ($record) => [
            //     'bg-gray-100 text-gray-300' => ($record->estado == 0 || $record->estado === false),
            // ])
            // ->extraAttributes(fn ($record) => ($record?->estado == 0 || $record?->estado === false) ? ['style' => 'background-color: #f3f4f6; color: red !important;'] : [])
            ->columns([
                TextColumn::make('vehiculo.placa')
                    ->label('Placa')
                    ->extraAttributes(fn ($record) => ($record?->estado == 0 || $record?->estado === false) ? ['style' => 'color: red !important;'] : [])
                    ->searchable(),

                TextColumn::make('tipo')
                ->extraAttributes(fn ($record) => ($record?->estado == 0 || $record?->estado === false) ? ['style' => 'color: red !important;'] : []),

                ToggleColumn::make('estado'),
                TextColumn::make('created_at')
                    ->date()
                    ->label('Fecha Registro'),
            ])
            ->defaultSort('estado', 'desc')
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
