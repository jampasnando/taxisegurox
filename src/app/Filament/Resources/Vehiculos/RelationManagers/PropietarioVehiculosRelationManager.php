<?php

namespace App\Filament\Resources\Vehiculos\RelationManagers;

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
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Laravel\Pail\File;

class PropietarioVehiculosRelationManager extends RelationManager
{
    protected static string $relationship = 'propietarioVehiculos';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('propietario_id')
                    ->relationship('propietario', 'nombres')
                    ->searchable()
                    ->required(),

                TextInput::make('tipo')
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
            ->recordTitleAttribute('propietario')
            ->columns([
                TextColumn::make('propietario.nombres')
                    ->label('Propietario'),

                TextColumn::make('tipo'),

                TextColumn::make('estado')
                    ->badge(),

                TextColumn::make('created_at')
                    ->label('Fecha Registro')
                    ->date(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // CreateAction::make(),
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
